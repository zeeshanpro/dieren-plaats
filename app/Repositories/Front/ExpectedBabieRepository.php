<?php 
namespace App\Repositories\Front;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Front\ExpectedBabieInterface;
use App\Models\ExpectedBabie;
use App\Models\ExpectedBabiesSubscribe;
use App\Models\Race;
use App\Models\Kind;
use App\Models\Breeder;
use App\Models\BreederReview;
use App\Models\User;
use App\Models\AdAttribute;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Front\ExpectedBabieRequest;
use Intervention\Image\ImageManagerStatic as Image;

class ExpectedBabieRepository implements ExpectedBabieInterface
{ 
    public function list_expected_babie( $limit = 4 ){
        $data['result'] = ExpectedBabie::
                                with(['expected_babieKind','expected_babieRace','expected_babieUser'])
                                ->limit( $limit )->get();
        $loggedInuserId = Auth::id();
        if( $loggedInuserId > 0 ){
            $data['subscribedBabies'] = $this->getSubscribedBabies( $loggedInuserId );                        
        } else {
            $data['subscribedBabies'] = [];                        
        }
        
        $data['code'] = 200;
        return $data;
    }

    public function showExpectedBabiesOfProfile( $userId ){
        if( Breeder::where( 'user_id', '=', $userId )->exists() ) {
            $data['Breeder'] = Breeder::where( 'user_id', '=', $userId )->with('breederKind.breeder_kindKind')
                                ->first();
            $data['User'] = User::where( 'id', '=', $userId )
                                    ->select('id', 'name', 'usertype')
                                    ->withCount(['userAds','userBreederReviews'])->first();

            $data['alreadyReviewed'] = false;
            $breederRec = Breeder::where( 'user_id', '=', $userId )->first();
            $reviewReport = BreederReview::where( 'breeder_id', '=', $breederRec->id );
            $sellerReviewReport = array();
            $sellerReviewReport['avg_rating'] = round($reviewReport->avg( 'rating' ), 1 );
            $sellerReviewReport['no_of_reviews'] = $reviewReport->count();
            $data['sellerReport'] = $sellerReviewReport;
            $loggedInuserId = Auth::id();
            if( $loggedInuserId > 0 ){    
                $breederReviewed = BreederReview::where( 'breeder_id', '=', $breederRec->id )
                                                ->where( 'user_id', '=', $loggedInuserId )->count();
                if( $breederReviewed > 0 ){
                    $data['alreadyReviewed'] = true;
                } 
                $data['subscribedBabies'] = $this->getSubscribedBabies( $loggedInuserId );
            } else {
                $data['subscribedBabies'] = [];
            }
            
            $data['expectedBabies'] = ExpectedBabie::where('user_id', '=', $userId)
                                ->with(['expected_babieKind','expected_babieRace'])
                                ->withCount('expected_babieExpectedBabiesSubscribe')
                                ->orderBy('id', 'DESC')
                                ->paginate( REC_PER_PAGE );
                  
            $data['userId'] = $userId;
            $data['code'] = 201;
            return $data;
        } else {
            $data['code'] = 422; 
            $data['msg'] = 'Unable to fetch details'; 
        }        
    }

    public function getSubscribedBabies( $loggedInuserId ){
        if( $loggedInuserId > 0 ){    
            return ExpectedBabiesSubscribe::where( 'user_id', '=', $loggedInuserId )
                                    ->pluck('expected_babies_id')
                                    ->toArray();
        } else {
            return [];
        }
    }

    public function showMyExpectedBabies(){
        $userId = Auth::id();
        if(Breeder::where( 'user_id', '=', $userId )->exists() ) {
            $data['Breeder'] = Breeder::where( 'user_id', '=', $userId )->with('breederKind.breeder_kindKind')
                                ->first();
            $data['User'] = User::where( 'id', '=', $userId )
                                    ->select('id', 'name', 'usertype')
                                    ->withCount(['userAds','userBreederReviews'])->first();

            $breederRec = Breeder::where( 'user_id', '=', $userId )->first();
            $reviewReport = BreederReview::where( 'breeder_id', '=', $breederRec->id );
            $sellerReviewReport = array();
            $sellerReviewReport['avg_rating'] = round($reviewReport->avg( 'rating' ), 1 );
            $sellerReviewReport['no_of_reviews'] = $reviewReport->count();
            $data['sellerReport'] = $sellerReviewReport;
            
            $data['expectedBabies'] = ExpectedBabie::where('user_id', '=', $userId)
                                ->with(['expected_babieKind','expected_babieRace',
                                    'expected_babieExpectedBabiesSubscribe.expected_babies_subscribeUser' => function($query) {
                                        $query->select('id', 'name');
                                    },
                                    'expected_babieExpectedBabiesSubscribe.expected_babies_subscribeUser.Breeder' => function($query) {
                                        $query->select('user_id','company_name', 'logo');
                                    } ] )
                                ->withCount('expected_babieExpectedBabiesSubscribe')
                                ->orderBy('id', 'DESC')
                                ->paginate( REC_PER_PAGE );

            $data['code'] = 201;
            $data['userId'] = $userId;
            return $data;
        } else {
            $data['code'] = 201; 
            $data['msg'] = 'No expected babies in your profile.'; 
        }        
    }

    public function showExpectedBabiesWithSearchAndPaginate( Request $request ){
        $sqlObj =  ExpectedBabie::where( 'expected_at' , '>=', 'CURDATE()' )
                                ->with(['expected_babieKind','expected_babieRace', 'expected_babieUser.Breeder.avgRating',
                                'expected_babieUser.Breeder.breederKind.breeder_kindKind'])
                                ->withCount('expected_babieExpectedBabiesSubscribe'); 

                                //->with( ['Breeder', 'Breeder.breederKinds.breeder_kindKind', 'Breeder.avgRating' ] )                     

        if( isset($request->kindId) and isset($request->raceId) ){
            $sqlObj->where(function ($query) use( $request ) {
                $query->where('kind_id', '=', $request->kindId)
                      ->orWhere('race_id', '=', $request->raceId);
            });
        } else {
            if( isset($request->kindId) and is_numeric($request->kindId)  ){
                $sqlObj->where( 'kind_id', '=', $request->kindId );
            }
    
            if( isset($request->raceId) and is_numeric($request->raceId) ){
                $sqlObj->where( 'race_id', '=', $request->raceId );
            }
        }
        
        if( isset( $request->date ) ){
            $arrDate = explode( ',' , $request->date );
            if( count( $arrDate ) == 2 ){
                $startDate = explode( '-' , $arrDate[0] );
                $endDate = explode( '-' , $arrDate[1] );
                if( count( $startDate ) == 3 and count( $endDate ) == 3 ){
                    if( checkdate ( $startDate[1], $startDate[2], $startDate[0] ) and checkdate ( $endDate[1], $endDate[2], $endDate[0] ) ){
                        if( strtotime( $arrDate[1] ) >= strtotime( $arrDate[0] ) ){
                            $sqlObj->whereBetween('expected_at', [ $arrDate[0] , $arrDate[1] ]);
                        }
                    }
                }
                
            }
        } else if( isset( $request->month ) and is_numeric( $request->month ) and ( $request->month >= 1 and $request->month <= 3 ) ){
            $month = $request->month;
            $startingDate = date("Y-m-d", strtotime(date('m', strtotime('+'.$month.' month')).'/01/'.date('Y').' 00:00:00'));
            $endingDate = date("Y-m-t", strtotime(date('m', strtotime('+'.$month.' month')).'/01/'.date('Y').' 00:00:00'));
            $sqlObj->whereBetween('expected_at', [$startingDate, $endingDate]);
        }
        
        if( isset( $request->sortby ) ){
            switch( $request->sortby ){
                case 'datedesc':    
                    $sqlObj->orderByDesc('expected_at');
                    break;
                case 'dateasc':
                    $sqlObj->orderBy('expected_at','ASC');
                    break;    
                default:
                    $sqlObj->orderByDesc('id');
                break;
            }
        } else {
            $sqlObj->orderByDesc('id');
        }   

        $data['expectedBabies'] = $sqlObj->paginate( REC_PER_PAGE );
        
        $loggedInuserId = Auth::id();
        if( $loggedInuserId > 0 ){    
            $data['subscribedBabies'] = ExpectedBabiesSubscribe::where( 'user_id', '=', $loggedInuserId )
                                    ->pluck('expected_babies_id')
                                    ->toArray();
        } else {
            $data['subscribedBabies'] = [];
        }


        $data['code'] = 201;
        return $data;
    }

    public function search_expected_babie(Request $request){
        $query = $request->get('query');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        if($request->ajax())
        {
            $output="";
            $data['result'] = ExpectedBabie::where('title', 'like', '%'.$query.'%')
                                ->orWhere('father', 'like', '%'.$query.'%')
                                ->orWhere('mother', 'like', '%'.$query.'%')
                                ->orWhere('expected_at', 'like', '%'.$query.'%')
                                ->with(['expected_babieKind','expected_babieRace','expected_babieUser'])
                                ->paginate(REC_PER_PAGE);
            $data['code'] = 200; 
            return $data;
        }
    }

    public function view( Request $request ){
        $data['result'] = ExpectedBabie::where('id', '=', $request->adId )  
                                ->with(['expected_babieKind','expected_babieRace','expected_babieUser.Breeder'])
                                ->first();

        $data['races'] =  Race::all();
        $data['kinds'] =  Kind::all();
        $data['attributes'] =  AdAttribute::with('ad_attributeAdAttributeOptions')->get();
        $data['code'] = 200;
        
        return $data;
    }

    public function create_expected_babie( Request $request ){
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), 
                [ 
                    'expected_at' => 'required|date_format:Y-m-d|after:tomorrow',
                    'father' => 'required',
                    'mother' => 'required',
                    'father_pic' => 'required|image|mimes:jpg,jpeg,png|max:5200',
                    'mother_pic' => 'required|image|mimes:jpg,jpeg,png|max:5200',
                    'race_id' => 'required|numeric',
                    'kind_id' => 'required|numeric'
                ]); 
            if ($validator->fails()) { 
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $validator->errors()->first();;
                return $data;
            }
            $userId = Auth::id();
            DB::beginTransaction();   
            try { 
                if($request->file()) {
                    
                    $newExpectedBabie = new ExpectedBabie;

                    if( $request->hasFile('father_pic') ) { 
                        $fileName = uploadImage( $request, 'father_pic', 'uploads/expectedbabies' );
                        $newExpectedBabie->father_pic = $fileName;
                    }
                    
                    if( $request->hasFile('mother_pic') ) { 
                        $fileName = uploadImage( $request, 'mother_pic', 'uploads/expectedbabies' );
                        $newExpectedBabie->mother_pic = $fileName;
                    }
                    
                    $newExpectedBabie->title = '';
                    $newExpectedBabie->desc = '';
                    $newExpectedBabie->expected_at = $request->expected_at;
                    $newExpectedBabie->father = $request->father;
                    $newExpectedBabie->mother = $request->mother;
                    $newExpectedBabie->race_id = $request->race_id;
                    $newExpectedBabie->kind_id = $request->kind_id;
                    $newExpectedBabie->user_id = $userId;
                    $newExpectedBabie->save();
            
                    DB::commit();

                    $data['code'] = 201;
                    $data['msg'] = 'Expected Ad Saved Successfully!!';
                    $data['error'] = false;
                } else {
                    $data['code'] = 422;
                    $data['msg'] = 'Please upload images of Father and Mother';
                    $data['error'] = true;
                }
                return $data;
            } catch(\Exception $e) {
                DB::rollBack();
                $data['code'] = 422;
                $data['msg'] = $e->getMessage();
                $data['error'] = true;
                return $data;
            }
        } else {
            $data['code'] = 422;
            $data['msg'] = 'Invalid call';
            $data['error'] = true;
            return $data;
        }
    } 

    public function update_expected_babie( Request $request ){
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), 
                [ 
                    'expected_at' => 'required|date_format:Y-m-d|after:tomorrow',
                    'father' => 'required',
                    'mother' => 'required',
                    'father_pic' => 'sometimes|image|mimes:jpg,jpeg,png|max:5200',
                    'mother_pic' => 'sometimes|image|mimes:jpg,jpeg,png|max:5200',
                    'race_id' => 'required|numeric',
                    'kind_id' => 'required|numeric',
                    'ebId' => 'required|numeric|exists:expected_babies,id'
                ]); 
            if ($validator->fails()) { 
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $validator->errors()->first();;
                return $data;
            }
            $userId = Auth::id();
            DB::beginTransaction();   
            try { 
                    $updateExpectedBabie = ExpectedBabie::where('user_id', '=', $userId)
                                                    ->where('id', '=', $request->ebId )->first();
                    if($updateExpectedBabie) {
                        if($request->file()) {
                            if( $request->hasFile('father_pic') ) { 
                                $fileName = uploadImage( $request, 'father_pic', 'uploads/expectedbabies' );
                                $updateExpectedBabie->father_pic = $fileName;
                            }
                            
                            if( $request->hasFile('mother_pic') ) { 
                                $fileName = uploadImage( $request, 'mother_pic', 'uploads/expectedbabies' );
                                $updateExpectedBabie->mother_pic = $fileName;
                            }
                        }
                        $updateExpectedBabie->expected_at = $request->expected_at;
                        $updateExpectedBabie->father = $request->father;
                        $updateExpectedBabie->mother = $request->mother;
                        $updateExpectedBabie->race_id = $request->race_id;
                        $updateExpectedBabie->kind_id = $request->kind_id;
                        $updateExpectedBabie->update();
                        $data['code'] = 201;
                        $data['msg'] = 'Expected Ad Updated Successfully!!';
                        $data['error'] = false;
                    } else {
                        $data['code'] = 422;
                        $data['msg'] = 'Please refresh and try again.';
                        $data['error'] = true;
                    }
            
                    DB::commit();                
                    return $data;
            } catch(\Exception $e) {
                DB::rollBack();
                $data['code'] = 422;
                $data['msg'] = $e->getMessage();
                $data['error'] = true;
                return $data;
            }
        } else {
            $data['code'] = 422;
            $data['msg'] = 'Invalid call';
            $data['error'] = true;
            return $data;
        }
    } 

    public function delete_expected_babie( Request $request ){
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), 
                [ 
                    'expectedId' => 'required|numeric|exists:expected_babies,id'
                ]); 
            if ($validator->fails()) { 
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $validator->errors()->first();;
                return $data;
            }
            $userId = Auth::id();
            DB::beginTransaction();   
            try { 
                    $updateExpectedBabie = ExpectedBabie::where('user_id', '=', $userId)
                                                    ->where('id', '=', $request->expectedId )->first();
                    if($updateExpectedBabie) {
                        // unlink the files 
                        @unlink( 'storage/app/public/uploads/expectedbabies/'. $updateExpectedBabie->father_pic );
                        @unlink( 'storage/app/public/uploads/expectedbabies/thumb/'. $updateExpectedBabie->father_pic );
                        @unlink( 'storage/app/public/uploads/expectedbabies/'. $updateExpectedBabie->mother_pic );
                        @unlink( 'storage/app/public/uploads/expectedbabies/thumb'. $updateExpectedBabie->mother_pic );
                        $updateExpectedBabie->delete();
                        $data['code'] = 201;
                        $data['msg'] = 'Expected Ad Deleted Successfully!!';
                        $data['error'] = false;
                    } else {
                        $data['code'] = 422;
                        $data['msg'] = 'Please refresh and try again.';
                        $data['error'] = true;
                    }
            
                    DB::commit();                
                    return $data;
            } catch(\Exception $e) {
                DB::rollBack();
                $data['code'] = 422;
                $data['msg'] = $e->getMessage();
                $data['error'] = true;
                return $data;
            }
        } else {
            $data['code'] = 422;
            $data['msg'] = 'Invalid call';
            $data['error'] = true;
            return $data;
        }
    } 

    public function subscribe( Request $request ){        
        $data = array();
        $validator = Validator::make($request->all(), 
                [ 
                    'expectedAdId' => 'required|numeric'
                ]); 

        if ($validator->fails()) { 
            // to review Sunny
            if( $request->is('api/*')){
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $validator->errors()->first();
            }

            $validator->validate();
        }

        if($request->ajax()) {
            $userId = Auth::id();
            $userRec = User::find( $userId );
            if( $userRec ) {
                DB::beginTransaction();   
                try {
                    $adViewRec = ExpectedBabiesSubscribe::where('expected_babies_id' , '=' , $request->expectedAdId )
                                        ->where('user_id' , '=' , $userId )
                                        ->first();
                    if( $adViewRec ){
                        $adViewRec->delete();
                        $data['msg'] = 'Unsubscribed Successfully';
                    } else {
                        $newAdView = new ExpectedBabiesSubscribe;
                        $newAdView->user_id = $userId;
                        $newAdView->expected_babies_id = $request->expectedAdId;
                        $newAdView->save();
                        $data['msg'] = 'Subscribed Successfully';
                    }
    
                    DB::commit();
                    $data['code'] = 201;
                    $data['error'] = false;
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
                $data['msg'] = 'Please log out and log back in and try again';
                return $data;
            }
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'Invalid call';
            return $data;
        }
    }

    public function update( Request $request ){        
    }
}
