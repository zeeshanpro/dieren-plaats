<?php 
namespace App\Repositories;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\AdInterface;
use App\Http\Requests\AdRequest;
use App\Models\Ad;
use App\Models\Race;
use App\Models\Kind;
use App\Models\User;
use App\Models\AdAttribute;
use App\Models\AdSelectedAttribute;
use Illuminate\Support\Facades\Validator;
use App\Models\AdImage;
use App\Models\AdView;
use App\Models\Message;
use App\Models\PaidAd;
use App\Models\ExpectedBabie;


class AdRepository implements AdInterface
{ 
    public function listAds(){
        $data['result'] = Ad::withCount(['adViews'])
                                ->with(['adKind','adRace','adUser','adImages'])
                                ->orderByRaw('id desc')
                                ->paginate(REC_PER_PAGE);
        $data['code'] = 200;
        return $data;
    }

    public function listPaidAds(){
        $data['result'] = PaidAd::with(['ad', 'ad.adKind', 'ad.adRace' , 'user','ad.adImages'])
                                ->orderByRaw('id desc')
                                ->paginate(REC_PER_PAGE);
        $data['code'] = 200;
        return $data;
    }

    public function searchPaidAds(Request $request){
        $searchFor = $request->get('query');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        if($request->ajax())
        {
            $output="";
            $data['result'] = PaidAd::when( ($searchFor != ''), function ($query) use($searchFor){
                                    $dateArr = explode( '-', $searchFor);
                                    if( count($dateArr) == 3 ){
                                        $query->orWhere('expires_on', '=' , $searchFor);
                                    }
                                })
                                ->with(['ad' => function($query) use($searchFor) {
                                    if( $searchFor != '' ){
                                        $query->where( 'title', 'like', $searchFor );
                                        $query->orWhere( 'amount', '=', $searchFor );
                                    }
                                } , 'ad.adKind', 'ad.adRace' , 'user','ad.adImages'])
                                ->paginate(REC_PER_PAGE);
            $data['code'] = 200; 
            return $data;
        }
    }

    public function searchAds(Request $request){
        $query = $request->get('query');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        if($request->ajax())
        {
            $output="";
            $data['result'] = Ad::where('title', 'like', '%'.$query.'%')
                                ->orWhere('amount' , '=' , $query)
                                ->withCount(['adViews'])
                                ->with(['adKind','adRace','adUser','adImages'])
                                ->paginate(REC_PER_PAGE);
            $data['code'] = 200; 
            return $data;
        }
    }

    public function viewAd( Request $request ){
        $data['result'] = Ad::where('id', '=', $request->adId )  
                                ->withCount(['adViews', 'adViews as likecount' => function($query) {
                                    $query->where('like_ad', '=', 1);
                                }])
                                ->with(['adKind','adRace','adUser.Breeder','adImages'])
                                ->first();
                                

        $arr1 = AdSelectedAttribute::select('ad_attribute_option_id')
                                                    ->where('ad_id', '=', $request->adId )
                                                    ->get()->toArray();
        
        $users_chatting_for_ad = DB::table('messages')
                            ->where( 'ad_id', $request->adId )
                            ->groupBy('user_id')
                            ->pluck( 'user_id' )->toArray();
        if( count( $users_chatting_for_ad ) > 0 ){
            $data[ 'msgUsers' ] = User::select('id', 'name', 'email')
                                            ->whereIn('id', $users_chatting_for_ad)
                                            ->with('Breeder')
                                            ->get();
        } else {
            $data[ 'msgUsers' ] = array();
        }

        //$data[ 'msg' ] =  Message::where( 'ad_id', '=', $request->adId )->get();

        $data['selectedAttributes'] = array_map(function($attr) {
            return $attr['ad_attribute_option_id'];
        }, $arr1);
        
        $data['races'] =  Race::all();
        $data['kinds'] =  Kind::all();
        $data['attributes'] =  AdAttribute::with('ad_attributeAdAttributeOptions')
                                        ->where( 'kind_id', '=' , $data['result']->kind_id )->get();
        $data['code'] = 200;
        
        return $data;
    }

    public function createAd( AdRequest $request ){
        
        DB::beginTransaction();   
        try { 
                $newAd = new Ad;
                $newAd->title = $request->title;
                $newAd->desc = $request->desc;
                $newAd->amount = $request->amount;
                $newAd->race_id = $request->race_id;
                $newAd->kind_id = $request->kind_id;
                $newAd->save();
        
                DB::commit();
                return [
                    'code' => 201,
                    'msg' => "Ad created",
                    'order_id'  => $newAd->id,
                    'error' => false,
                    'request' => $request->all(),
                ];

        } catch(\Exception $e) {
            DB::rollBack();
            $this->error($e->getMessage(), $e->getCode());
        }
    }
    
    public function updateAd( Request $request ){
        $data = array();

        $validator = Validator::make($request->all(), 
                [ 
                    //'attributeOptionsId' => 'required|array|min:1',
                    'title' => 'required',
                    'desc' => 'required',
                    'amount' => 'required',
                    'raceid' => 'required|numeric',
                    'kindid' => 'required|numeric'
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
                $adRec = Ad::find( $request->adId );
                $adRec->title = $request->title;
                $adRec->desc = $request->desc;
                $adRec->amount = $request->amount;
                $adRec->race_id = $request->raceid;
                $adRec->kind_id = $request->kindid;

                if($request->status == 1){
                    $adRec->status = 1;
                } else {
                    $adRec->status = 0;
                }

                if($adRec->isClean())
                {
                    $data['code'] = 304;
                    $data['error'] = false;
                    $data['msg'] = 'Data Not Changed';
                    return $data;
                }

                $adRec->save();
                if( isset( $request->attributeOptionsId ) and count( $request->attributeOptionsId ) > 0 ) {
                    $ad_options_data = array();
                    AdSelectedAttribute::where( 'ad_id', '=', $request->adId )->delete();
                    for( $cnt = 0 ; $cnt < count( $request->attributeOptionsId ) ; $cnt++ ) {
                        $ad_options_data[] = [ 'ad_id' => $request->adId , 'ad_attribute_option_id' => $request->attributeOptionsId[ $cnt ]  ];
                    }
                    AdSelectedAttribute::insert( $ad_options_data );
                }
                
                DB::commit();

                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'Ad update successful';
                return $data;
        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }        
    }

    public function deleteImage(Request $request){
        $data = array();

        $validator = Validator::make($request->all(), 
                [ 
                    'adId' => 'required|numeric',
                    'imageId' => 'required|numeric'
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

        $adImage = AdImage::find( $request->imageId );
        if( $adImage !== null ){
            @unlink( 'storage/app/public/uploads/ads/'. $adImage->filename );
            @unlink( 'storage/app/public/uploads/ads/thumb/'. $adImage->filename );
            DB::beginTransaction();   
            try {
                    $adImage = AdImage::find( $request->imageId );
                    $adImage->delete();        
                    DB::commit();
                    $data['code'] = 201;
                    $data['error'] = false;
                    $data['msg'] = 'Image deleted successful';
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
            $data['msg'] = 'Ad does not exists';
            return $data;
        }
    }

    public function deleteAd( Request $request ){
        $data = array();
        $validator = Validator::make($request->all(), 
                [ 
                    'adId' => 'required|numeric'
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
        $adId = $request->adId;
        DB::beginTransaction();   
        try {
                // delete images 
                $adObj = AdImage::where( 'ad_id', '=', $adId );
                if( $adObj->count() > 0 ){
                    $adImages = $adObj->get();
                    foreach( $adImages as $adImage ){
                        @unlink( 'storage/app/public/uploads/ads/'. $adImage->filename );
                        @unlink( 'storage/app/public/uploads/ads/thumb/'. $adImage->filename );
                    }
                    $adObj = AdImage::where( 'ad_id', '=', $adId )->delete();
                }

                //delete selected attributes
                AdSelectedAttribute::where( 'ad_id', '=', $adId )->delete();

                //delete views and likes
                AdView::where( 'ad_id', '=', $adId )->delete();

                // delete any chat related to this ad
                Message::where( 'ad_id', '=', $adId )->delete();

                // Paid ads data to be deleted
                PaidAd::where( 'ad_id', '=', $adId )->delete();

                $adRec = Ad::find( $request->adId );
                $adRec->delete();

                DB::commit();

                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'Ad deleted successfully';
                return $data;
        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }   
    }

    public function showCountsForLeftBar(){
        $result['adCount'] = Ad::get()->count();
        $result['expectedBabieCount'] = ExpectedBabie::get()->count();
        $result['userCount'] = User::whereIn( 'usertype', [ 'Normal', 'Shelter', 'Breeder' ] )->get()->count();
        return $result;
    }
}
