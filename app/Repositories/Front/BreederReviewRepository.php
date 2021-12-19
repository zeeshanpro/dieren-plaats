<?php 
namespace App\Repositories\Front;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Front\BreederReviewInterface;
use App\Http\Requests\Front\BreederReviewRequest;
use App\Models\BreederReview;
use App\Models\Breeder;
use Mail;
use Illuminate\Support\Str;

class BreederReviewRepository implements BreederReviewInterface
{ 

    public function createBreederReview( BreederReviewRequest $request ){
        if($request->ajax()) {
            $userId = Auth::id();
            $breederRec = Breeder::where('user_id', '=', $request->uid)->with('breederUser')->first();
            DB::beginTransaction();   
            try { 
                    $newBreederReview = new BreederReview;
                    $newBreederReview->rating = $request->stars;
                    $newBreederReview->opinion = filter_var( $request->comment , FILTER_SANITIZE_STRING );
                    $newBreederReview->breeder_id = $breederRec->id ; 
                    $newBreederReview->user_id = $userId;
                    $newBreederReview->save();
            
                    DB::commit();
                    $data['code'] = 201;
                    $data['error'] = false;
                    $data['msg'] = 'Review Saved Successfully';

                    // preparing to send email to the Breeder 
                    $profileLink = route( 'showProfile', ['userId' => $breederRec->user_id , 'title' => Str::slug($breederRec->owner_name) ] );
                    $arrayToSend = array('customer' => Auth::user()->name, 'stars' => $request->stars, 
                                            'msg' => $newBreederReview->opinion, 'seller_profile_link' => $profileLink );
                        Mail::send( 'mailtemplates.seller_review_received' , $arrayToSend, function( $message ) use( $breederRec ) {
                        $message->to( $breederRec->breederUser->email );
                        $message->subject( 'Je hebt een review ontvangen' );
                    } );    

                    return $data;

            } catch(\Exception $e) {
                DB::rollBack();
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $e->getMessage();
                return $data;
            }
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'Please refresh the page and try again';
            return $data;
        }
    } 

    public function getBreederCountByReviewRange(){
        $ranges = [ // the start of each review range.
            '1' => 0.51,
            '2' => 1.51,
            '3' => 2.51,
            '4' => 3.51,
            '5' => 4.51
        ];

        $output = BreederReview::join('breeders', 'breeder_reviews.breeder_id', '=', 'breeders.id')
                    ->join('users', 'breeders.user_id', '=', 'users.id')
                    ->selectRaw( 'breeder_reviews.breeder_id, AVG(breeder_reviews.rating) as avgrating' )
                    ->where('users.usertype', '=', 'Breeder')
                    ->groupBy('breeder_reviews.breeder_id')
                    ->get()
                    ->map(function ($rating) use ($ranges) {
                        foreach($ranges as $key => $breakpoint)
                        {
                            if( $rating->avgrating <= ( $key + 0.5 ) and  $rating->avgrating >= ( $key - 0.49 ) )
                            {
                                $rating->range = $key;
                                break;
                            }
                        }
                        return $rating;
                    })
                    ->mapToGroups(function ($rating, $key) {
                        return [$rating->range => $rating];
                    })
                    ->map(function ($group) {
                        return count($group);
                    })
                    ->sortKeys();            
                    
        return $output;
    }
}

