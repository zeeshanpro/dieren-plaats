<?php 
namespace App\Repositories;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserInterface;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Breeder;
use App\Models\BreederKind;
use App\Models\BreederReview;
use App\Models\Renewal;
use App\Models\RenewalsPaymentDetail;
use App\Models\ExpectedBabie;
use App\Models\ExpectedBabiesSubscribe;
use App\Models\Ad;
use App\Models\AdImage;
use App\Models\AdView;
use App\Models\AdSelectedAttribute;
use App\Models\PaidAd;
use App\Models\Message;

class UserRepository implements UserInterface
{ 
    public function listSubscriptions(){
        $data['result'] = Renewal::with(['user:id,name,email,stripe_id,stripe_product_id,usertype','paymentDetails'])
                                ->get();
        $data['code'] =  200;
        return $data;
    }
    public function searchSubscriptions(Request $request)
    {
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $searchUser = $request->get('query');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        if($request->ajax())
        {
            // $renewalObj = Renewal::with(['user' => function( $query ) use ( $searchUser ){
            //     $query->when( $searchUser, function ($query) use( $searchUser ) {
            //         $query->where( 'name', 'like', '%'.$searchUser.'%' );
            //         $query->orWhere( 'email', 'like', '%'.$searchUser.'%' );
            //         $query->orWhere( 'stripe_id', '=', $searchUser );
            //     } );
            // } ,'paymentDetails']);

            $renewalObj = Renewal::with(['user:id,name,email,stripe_id,stripe_product_id,usertype','paymentDetails']);
            if( $dateFrom != '' and $dateTo != ''){
                $renewalObj->whereBetween('date_of_transaction', [$dateFrom, $dateTo]);
            }
            $data['result'] = $renewalObj->paginate(REC_PER_PAGE);
            $data['code'] = 200;
            return $data;
        }
    }



    public function listUsers(){
        $data['result'] = User::where('usertype' , '!=' , 'Admin')
                                ->withCount(['userAds','userExpectedBabies'])
                                ->with(['Breeder', 'latestRenewal'])
                                ->orderBy('id', 'DESC')
                                ->paginate(REC_PER_PAGE);
        $data['code'] =  200;
        
        return $data;
    }

    public function searchUsers(Request $request)
    {
        $query = $request->get('query');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        $userType = $request->get('type');
        if( $userType == 'Normal' or $userType == 'Shelter' or $userType == 'Breeder' ){

        } else {
            $userType = '';
        }

        if($request->ajax())
        {
            $output="";
            $data['result'] = User::where('name', 'like', '%'.$query.'%')
                ->where('usertype' , '!=' , 'Admin')
                ->where( function( $query ) use ( $userType ) {
                    if( $userType != '' )
                    $query->where( 'usertype', '=', $userType );
                } )
                ->withCount(['userAds','userExpectedBabies'])
                ->with('Breeder')
                ->paginate(REC_PER_PAGE);

            $data['code'] = 200; 
            return $data;
        }
    }

    public function viewUser( $userId ){
        $data = array();
        if( $userId != '' and is_numeric( $userId ) ) {
            $data['data'] = User::select('id','name','email','usertype','created_at','status')->where('id', '=', $userId )  
                                ->with(['userAds','Breeder','userBreederReviews','userExpectedBabies'])
                                ->first();
        
            $data['code'] = 200;
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors()->first();
        }
        
        
        return $data;
    }

    public function createUser( UserRequest $request ){
        
        DB::beginTransaction();   
        try { 
                $newUser = new User;
                $newUser = $request->name;
                $newUser = $request->email;
                $newUser = $request->password;
                $newUser = $request->usertype;
                $newUser = $request->save();
        
                DB::commit();
                return $this->success("User created", [
                    'order_id'  => $newUser->id,
                    'error' => false,
                    'request' => $request->all(),
                ] , 201 );

        } catch(\Exception $e) {
            DB::rollBack();
            $this->error($e->getMessage(), $e->getCode());
        }
    } 

    public function update(Request $request) {
        $data = array();

        $validator = Validator::make($request->all(), 
                [ 
                    'userId' => 'required|numeric',
                    'name' => 'required',
                    'email' => 'required'
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
        DB::beginTransaction();   
        try {
                $isClean = true;

                $userRec = User::find( $request->userId );
                $userRec->name = $request->name;
                $userRec->email = $request->email;
                if( $request->status == 1 ){
                    $userRec->status = 1;
                } else {
                    $userRec->status = 0;
                }
                
                if( $userRec->isDirty() )
                {
                    $userRec->save();
                    $isClean = false;
                }
                
                $breederRec = Breeder::where('user_id', '=', $request->userId )->first();
                if( $breederRec != null ){
                    $breederRec->company_name = $request->company_name;
                    $breederRec->owner_name = $request->owner_name;
                    $breederRec->company_about = $request->company_about;
                    $breederRec->street = $request->street;
                    $breederRec->city = $request->city;
                    $breederRec->country = $request->country;
                    $breederRec->phone = $request->phone;
                    $breederRec->website = $request->website;
                    $breederRec->fb_url = $request->fb_url;
                    $breederRec->insta_url = $request->insta_url;
                    $breederRec->linkedin_url = $request->linkedin_url;

                    if( $breederRec->isDirty() )
                    {
                        $breederRec->save();
                        $isClean = false;
                    }
                }

                DB::commit();

                if( $isClean == true ){
                    $data['code'] = 304;
                    $data['error'] = false;
                    $data['msg'] = 'Data Not Changed';
                    return $data;
                }

                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'User update successful';
                return $data;
        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }  
    }

    public function delete( Request $request ){
        $data = array();
        $validator = Validator::make($request->all(), 
                [ 
                    'userId' => 'required|numeric'
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
        $userId = $request->userId;
        DB::beginTransaction();   
        try {
                $userObj = User::where( 'id', '=', $userId );
                if( $userObj->count() > 0 ){
                    $userRec = $userObj->first();
                    if( $userRec->usertype == 'Normal' or $userRec->usertype == 'Shelter' or $userRec->usertype == 'Breeder' ){
                        // proceed to delete user.

                        // first begin by removing the Ads
                        $adsArray = Ad::where('user_id', '=', $userId)->pluck( 'id' )->toArray();
                        // delete images 
                        $adObj = AdImage::whereIn( 'ad_id', $adsArray );
                        if( $adObj->count() > 0 ){
                            $adImages = $adObj->get();
                            foreach( $adImages as $adImage ){
                                @unlink( 'storage/app/public/uploads/ads/'. $adImage->filename );
                                @unlink( 'storage/app/public/uploads/ads/thumb/'. $adImage->filename );
                            }
                            $adObj = AdImage::whereIn( 'ad_id', $adsArray )->delete();
                        }

                        //delete selected attributes
                        AdSelectedAttribute::whereIn( 'ad_id', $adsArray )->delete();

                        //delete views and likes
                        AdView::whereIn( 'ad_id', $adsArray )->delete();
                        AdView::where( 'user_id', '=' , $userId )->delete();
                        // delete any chat related to this ad
                        Message::whereIn( 'ad_id', $adsArray )->delete();
                        Message::where( 'user_id', '=' , $userId )->delete();
                        // Paid ads data to be deleted
                        PaidAd::whereIn( 'ad_id', $adsArray )->delete();

                        $adRec = Ad::whereIn( 'id', $adsArray );
                        $adRec->delete();
                        
                        $expectedAdsArray = ExpectedBabie::where('user_id', '=', $userId)->pluck( 'id' )->toArray();
                        ExpectedBabiesSubscribe::whereIn('expected_babies_id', $expectedAdsArray)->delete();
                        ExpectedBabiesSubscribe::where('user_id', '=', $userId)->delete();
                        ExpectedBabie::where('user_id', '=', $userId)->delete();

                        $renewalIds = Renewal::where('user_id', '=', $userId)->pluck( 'id' )->toArray();
                        RenewalsPaymentDetail::whereIn( 'renewals_id', $renewalIds )->delete();
                        Renewal::where('user_id', '=', $userId)->delete();

                        $breederRec = Breeder::where('user_id', '=', $userId)->first();
                        BreederKind::where('breeder_id', '=', $breederRec->id)->delete();
                        BreederReview::where('breeder_id', '=', $breederRec->id)->delete();
                        BreederReview::where('user_id', '=', $userId)->delete();
                        Breeder::where('user_id', '=', $userId)->delete();
                        //finally delete the user
                        User::where( 'id', '=', $userId )->delete();

                    } else {
                        $data['code'] = 422;
                        $data['error'] = true;
                        $data['msg'] = 'Unable to delete the user.';
                        return $data;
                    }
                } else {
                    $data['code'] = 422;
                    $data['error'] = true;
                    $data['msg'] = 'This user seems already deleted.';
                    return $data;
                }
                

                DB::commit();

                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'User deleted successfully';
                return $data;
        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }   
    }

    public function updateAdmin(Request $request) {
        $data = array();
        $userId = Auth::id();
        $validator = Validator::make($request->all(), 
                [ 
                    'name' => 'required',
                    'email' => 'unique:users,email,'.$userId
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
        DB::beginTransaction();   
        try {
                $isClean = true;

                $userRec = User::find( $userId );
                $userRec->name = $request->name;
                $userRec->email = $request->email;
                
                if( $userRec->isDirty() )
                {
                    $userRec->save();
                    $isClean = false;
                }
                
                $breederRec = Breeder::where('user_id', '=', $userId )->first();
                if( $breederRec != null ){
                    $breederRec->company_name = $request->company_name;
                    $breederRec->owner_name = $request->owner_name;
                    $breederRec->company_about = $request->company_about;
                    $breederRec->street = $request->street;
                    $breederRec->city = $request->city;
                    $breederRec->country = $request->country;
                    $breederRec->phone = $request->phone;
                    //$breederRec->website = $request->website;
                    $breederRec->fb_url = $request->fb_url;
                    $breederRec->insta_url = $request->insta_url;
                    $breederRec->linkedin_url = $request->linkedin_url;

                    if( $breederRec->isDirty() )
                    {
                        $breederRec->save();
                        $isClean = false;
                    }
                }

                DB::commit();

                if( $isClean == true ){
                    $data['code'] = 304;
                    $data['error'] = false;
                    $data['msg'] = 'Data Not Changed';
                    return $data;
                }

                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'User update successful';
                return $data;
        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }  
    }

}
