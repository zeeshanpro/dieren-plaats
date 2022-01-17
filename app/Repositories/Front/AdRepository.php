<?php 
namespace App\Repositories\Front;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Front\AdInterface;
use App\Http\Requests\Front\AdRequest;
use App\Models\Ad;
use App\Models\User;
use App\Models\Breeder;
use App\Models\BreederReview;
use App\Models\ExpectedBabie;
use App\Models\Race;
use App\Models\Kind;
use App\Models\AdAttribute;
use App\Models\PaidAd;
use App\Models\AdSelectedAttribute;
use Illuminate\Support\Facades\Validator;
use App\Models\AdImage;
use App\Models\AdView;
use App\Models\Renewal;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Exception;
use Mail;


class AdRepository implements AdInterface
{ 
    public function listAds( $limit = 4, $status = 1 ){
        $paidAdsArray = array();
        $paidAdsArray = PaidAd::where('expires_on' , '>=', date('Y-m-d') )
                                        ->pluck('ad_id')
                                        ->toArray();

        $data['result'] = Ad::where( 'status', '=', '1' )
                            ->when( ($status == 0), function ($query) {
                                $query->orWhere('status', '=' , 0);
                                })
                            ->when( count( $paidAdsArray ) , function ($query) use($paidAdsArray) {
                                    $commaSeparatedIds = implode( ',', $paidAdsArray );
                                    $query->orderByRaw(DB::raw("FIELD(id, $commaSeparatedIds) DESC"));
                                })
                                ->withCount(['adViews' => function($query) {
                                        $query->select(DB::raw('SUM(count_views)'));
                                    }
                                ])
                                ->with(['adKind','adRace','adUser','adImages',
                                'adSelectedAttributes.ad_selected_attributeAd_attribute_option.ad_attribute_optionAd_attribute'])
                                ->inRandomOrder()
                                ->limit( $limit )->get(  );
        $data['code'] = 200;
        $data['topAdsArray'] = $paidAdsArray;
        $userId = Auth::id();
        if( $userId > 0 ){
            $userRec = User::find( $userId );
            if( $userRec ) {
                $adIdsRec = AdView::select('user_id', DB::raw('GROUP_CONCAT(ad_id) as adIds'))
                        ->where( 'user_id', '=', $userId )
                        ->where('like_ad', '=', 1)
                        ->groupBy('user_id')
                        ->first();
                if($adIdsRec)
                    $data['savedAdsIds'] = $adIdsRec['adIds'];
            }
        }
        
        return $data;
    }

    // this funciton is being used for the overall website search
    public function listSearchAdsWithPaginateAndSearch( Request $request){
        $paidAdsArray = array();
        $paidAdObj = PaidAd::where('expires_on' , '>=', date('Y-m-d') );

        $sqlObj = Ad::where('status', '=', 1)
                        ->withCount(['adViews' => function($query) {
                            $query->select(DB::raw('SUM(count_views)'));
                        }
                    ])
                    ->with(['adKind','adRace','adUser','adImages',
                    'adSelectedAttributes.ad_selected_attributeAd_attribute_option.ad_attribute_optionAd_attribute']);
        
        if( isset($request->q) ){
            /*
            1. find from the Kind
            2. find from the Races
            3. find from the title of the Pet Ad listing
            */
            $query = trim($request->q);
            $kindObj = Kind::where('title', '=', $query)
                                ->where('status', '=', 1);
            if( $kindObj->count() > 0 ){
                $kindRec = $kindObj->first();
                $sqlObj->where( 'kind_id', '=', $kindRec->id );
            } else {
                $raceObj = Race::where('title', '=', $query)
                                ->where('status', '=', 1);
                if( $raceObj->count() > 0 ){
                    $raceRec = $raceObj->first();
                    $sqlObj->where( 'race_id', '=', $raceRec->id );
                } else {
                    $adObj = Ad::where('title', 'like', '%'.$query.'%');
                    if( $adObj->count() > 0 ){
                        $adRec = $adObj->pluck( 'id' )->toArray();
                        $sqlObj->whereIn( 'id', $adRec );
                    }
                } 
            }
        }

        if( isset($request->pricerange) ){
            $priceRangeArr = explode( ',' , $request->pricerange );
            if( count( $priceRangeArr ) == 2 and is_numeric( $priceRangeArr[0] ) and is_numeric( $priceRangeArr[1] ) ){
                if( $priceRangeArr[0] < $priceRangeArr[1] and  $priceRangeArr[1] > 0 ){
                    $sqlObj->whereBetween( 'amount', $priceRangeArr );
                }
            }
        }

        // if race is in the filters
        if( $request->options_race != '' and strlen( $request->options_race ) > 0 ){
            $raceArray = explode(',', $request->options_race);
            //$adsIds = AdSelectedAttribute::select('ad_id')->whereIn('ad_attribute_option_id', $optionsArray )->get()->toArray();
            $sqlObj->whereIn('race_id', $raceArray);

            $paidAdObj->with( [ 'ad' => function($query) use($raceArray) {
                $query->whereIn( 'race_id', '=', $raceArray );
            } ] );
        }
        else if( isset($request->kindId) and is_numeric($request->kindId) ){
            $sqlObj->where( 'kind_id', '=', $request->kindId );
            $data['kind'] = Kind::select('id', 'title')->where('id', '=', $request->kindId)->where('status', '=', '1')->first();

            $paidAdObj->with( [ 'ad' => function($query) use($request) {
                $query->where( 'kind_id', '=', $request->kindId );
            } ] );
        }

        if( $request->options != '' and strlen( $request->options ) > 0 ){
            $optionsArray = explode(',', $request->options);
            $adsIds = AdSelectedAttribute::select('ad_id')->whereIn('ad_attribute_option_id', $optionsArray )->get()->toArray();
            $sqlObj->whereIn('id', $adsIds);

            $paidAdObj->with( [ 'ad.adSelectedAttributes' => function($query) use($adsIds) {
                $query->whereIn( 'ad_attribute_option_id', '=', $adsIds );
            } ] );
        }
        
        $paidAdsArray = $paidAdObj->pluck('ad_id')->toArray();

        if( isset( $request->sortby ) ){
            switch( $request->sortby ){
                case 'datedesc':    
                    $sqlObj->orderByDesc('id','DESC');
                    break;
                case 'dateasc':
                    $sqlObj->sortBy('id','ASC');
                    break;    
                case 'pricedesc':
                    $sqlObj->orderByDesc('amount','DESC');
                    break;
                case 'priceasc':
                    $sqlObj->sortBy('amount','ASC');
                    break;  
                default:
                    //$sqlObj->orderByDesc('id','DESC');
                    if( count( $paidAdsArray ) > 0 ){
                        $commaSeparatedIds = implode( ',', $paidAdsArray );
                        $sqlObj->orderByRaw(DB::raw("FIELD(id, $commaSeparatedIds) DESC, id DESC"));
                    } else {
                        $sqlObj->orderByRaw(DB::raw(" id DESC "));
                    }
                break;
            }
        }  else {
                if( count( $paidAdsArray ) > 0 ){
                    $commaSeparatedIds = implode( ',', $paidAdsArray );
                    $sqlObj->orderByRaw(DB::raw("FIELD(id, $commaSeparatedIds) DESC, id DESC"));
                }else {
                    $sqlObj->orderByRaw(DB::raw(" id DESC "));
                }
        }
            
        $data['topAdsArray'] = $paidAdsArray;

        $data['result'] = $sqlObj->paginate( REC_PER_PAGE );                   
        
        $data['kindId'] = $request->kindId;
        $data['code'] = 200;

        $userId = Auth::id();
        if( $userId > 0 ){
            $userRec = User::find( $userId );
            if( $userRec ) {
                $adIdsRec = AdView::select('user_id', DB::raw('GROUP_CONCAT(ad_id) as adIds'))
                        ->where( 'user_id', '=', $userId )
                        ->where('like_ad', '=', 1)
                        ->groupBy('user_id')
                        ->first();
                if($adIdsRec)
                    $data['savedAdsIds'] = $adIdsRec['adIds'];
            }
        }
           
        return $data;
    }

    // this funciton is being used for the search in specific kind
    public function listAdsWithPaginateAndSearch( Request $request, $createdByUserId = 0 ){
        $data = array();
        $paidAdsArray = array();
        $paidAdObj = PaidAd::where('expires_on' , '>=', date('Y-m-d') );

        $sqlObj = Ad::when( isset($createdByUserId), function ($query) use( $createdByUserId ) {
                            if( $createdByUserId == 0 ){
                                $query->orWhere('status', '=' , 1);
                            }
                        })
                    ->withCount(['adViews' => function($query) {
                            $query->select(DB::raw('SUM(count_views)'));
                        }
                    ])
                    ->with(['adKind','adRace','adUser','adImages',
                    'adSelectedAttributes.ad_selected_attributeAd_attribute_option.ad_attribute_optionAd_attribute']);
        
        if( isset($request->pricerange) ){
            $priceRangeArr = explode( ',' , $request->pricerange );
            if( count( $priceRangeArr ) == 2 and is_numeric( $priceRangeArr[0] ) and is_numeric( $priceRangeArr[1] ) ){
                if( $priceRangeArr[0] < $priceRangeArr[1] and  $priceRangeArr[1] > 0 ){
                    $sqlObj->whereBetween( 'amount', $priceRangeArr );
                }
            }
        }

        // if race is in the filters
        if( $request->options_race != '' and strlen( $request->options_race ) > 0 ){
            $raceArray = explode(',', $request->options_race);
            $sqlObj->whereIn('race_id', $raceArray);
            $paidAdObj->with( [ 'ad' => function($query) use($raceArray) {
                    $query->whereIn( 'race_id', '=', $raceArray );
                } ] );

            if( isset($request->kindId) and is_numeric($request->kindId) ) {
                $kindRec = Kind::select('id', 'title','title_slug')->where('id', '=', $request->kindId)->where('status', '=', '1');
                if( $kindRec->count() > 0 ) {
                    $data['kind'] = $kindRec->first();
                }
            }
        } else if( isset($request->kindId) and is_numeric($request->kindId) ){

            $paidAdObj->with( [ 'ad' => function($query) use($request) {
                                        $query->where( 'kind_id', '=', $request->kindId );
                                    } ] );

            $sqlObj->where( 'kind_id', '=', $request->kindId );
            $kindRec = Kind::select('id', 'title','title_slug')->where('id', '=', $request->kindId)->where('status', '=', '1');
            if( $kindRec->count() > 0 ) {
                $data['kind'] = $kindRec->first();
            } else if( $createdByUserId == 0 ){
                $data['code'] = 422 ;
                return $data;
            }
        } else {
            if( $createdByUserId == 0 ){
                $data['code'] = 422 ;
                return $data;
            }
        }

        if( $request->options != '' and strlen( $request->options ) > 0 ){
            $optionsArray = explode(',', $request->options);
            $adsIds = AdSelectedAttribute::select('ad_id')->whereIn('ad_attribute_option_id', $optionsArray )->get()->toArray();
            $sqlObj->whereIn('id', $adsIds);

            $paidAdObj->with( [ 'ad.adSelectedAttributes' => function($query) use($adsIds) {
                $query->whereIn( 'ad_attribute_option_id', '=', $adsIds );
            } ] );
        }
        
        $paidAdsArray = $paidAdObj->pluck('ad_id')->toArray();

        if( isset( $request->sortby ) ){
            switch( $request->sortby ){
                case 'datedesc':    
                    $sqlObj->orderBy('id','DESC');
                    break;
                case 'dateasc':
                    $sqlObj->orderBy('id','ASC');
                    break;    
                case 'pricedesc':
                    $sqlObj->orderByDesc('amount','DESC');
                    break;
                case 'priceasc':
                    $sqlObj->orderBy('amount','ASC');
                    break;  
                default:
                    if( count( $paidAdsArray ) > 0 ){
                        $commaSeparatedIds = implode( ',', $paidAdsArray );
                        $sqlObj->orderByRaw(DB::raw("FIELD(id, $commaSeparatedIds) DESC, id desc"));
                    } else {
                        $sqlObj->orderByRaw(DB::raw("id desc"));
                    }
                    //$sqlObj->orderByDesc('id','DESC');
                break;
            }
        } else {
            if( count( $paidAdsArray ) > 0 ){
                $commaSeparatedIds = implode( ',', $paidAdsArray );
                $sqlObj->orderByRaw(DB::raw("FIELD(id, $commaSeparatedIds) DESC, id desc"));
            } else {
                $sqlObj->orderByRaw(DB::raw("id desc"));
            }
        }
        
        $data['topAdsArray'] = $paidAdsArray;

        if($createdByUserId == 0 ){
            $data['result'] = $sqlObj->paginate( REC_PER_PAGE );                   
        } else {
            $data['result'] = $sqlObj->where( 'user_id', '=', $createdByUserId )->paginate( REC_PER_PAGE );
        }
        
        $data['kindId'] = $request->kindId;
        $data['code'] = 200;

        $userId = Auth::id();
        if( $userId > 0 ){
            $userRec = User::find( $userId );
            if( $userRec ) {
                $adIdsRec = AdView::select('user_id', DB::raw('GROUP_CONCAT(ad_id) as adIds'))
                        ->where( 'user_id', '=', $userId )
                        ->where('like_ad', '=', 1)
                        ->groupBy('user_id')
                        ->first();
                if($adIdsRec)
                    $data['savedAdsIds'] = $adIdsRec['adIds'];
            }
        }
        $data['code'] == 201 ;
        return $data;
    }

    public function searchAds(Request $request){
        $query = $request->get('query');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        if($request->ajax())
        {
            $output="";
            $data['result'] = Ad::where('status', '=', 1)
                                ->where( function ($query) {
                                        $query->where('title', 'like', '%'.$query.'%')
                                            ->orWhere('amount' , '=' , $query);
                                } )
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

        $data['selectedAttributes'] = array_map(function($attr) {
            return $attr['ad_attribute_option_id'];
        }, $arr1);
        
        $data['races'] =  Race::all();
        $data['kinds'] =  Kind::all();
        $data['attributes'] =  AdAttribute::with('ad_attributeAdAttributeOptions')->get();
        $data['code'] = 200;
        
        return $data;
    }
    
    public function ifUserIsAllowedToCreateAds(){
        $result = array();
        $userId = Auth::id();
        $userRec = User::find( $userId );
        if( $userRec->usertype == 'Normal' ){
            $ads = Ad::where('user_id', '=', $userId)
                        ->where( 'status', '=', 1 )
                        ->where( 'expires_on' , '>=' , date('Y-m-d') )
                        ->get()->count();
            if( $ads < 3 ){
                $result['code'] = 200;
                $result['OkToProceed'] = true;
                $result['msg'] = 'You may please proceed with creating the Ad';
            } else {
                $result['code'] = 422;
                $result['OkToProceed'] = false;
                $result['msg'] = 'Sorry!! You already have 3 active Ads.';
            }       
        } else if( $userRec->usertype == 'Shelter' or $userRec->usertype == 'Breeder' ){
            $renewalRec = Renewal::where( 'user_id', '=', $userId )
                        ->where( 'renewal_date', '>=', date('Y-m-d') )->first();
            if( $renewalRec ){
                $result['code'] = 200;
                $result['OkToProceed'] = true;
                $result['msg'] = 'You may please proceed with creating the Ad';
            } else {
                $result['code'] = 422;
                $result['OkToProceed'] = false;
                $result['msg'] = 'Sorry!! Please proceed to become a paid subscriber.';
            }
        }

        return $result;
    }

    public function createAd(AdRequest $request){
        $userId = Auth::id();
        $userRec = User::find( $userId );
        $result = $this->ifUserIsAllowedToCreateAds();
        if( $userRec and $result['OkToProceed'] == true ) {
            DB::beginTransaction();   
            try {
                $titleSlug = Str::slug($request->title);
                $adObj = Ad::where( 'title_slug', '=', $titleSlug );
                if( $adObj->count() > 0 ){
                    $counter = 1;
                    do {  
                        $testSlug = $titleSlug . '-'.$counter;
                        $adObj = Ad::where( 'title_slug', '=', $testSlug );
                    } while( $adObj->count() > 0 );
                    $titleSlug = $testSlug;
                }

                $newAd = new Ad;
                $newAd->title = $request->title;
                $newAd->title_slug = $titleSlug;
                $newAd->desc = $request->desc;
                $newAd->amount = $request->amount;
                $newAd->race_id = $request->race;
                $newAd->kind_id = $request->kind;
                $newAd->user_id = $userId ;
                $newAd->expires_on = date('Y-m-d', strtotime("+6 months", strtotime( date('Y-m-d' ) ) ) );
                $newAd->save();
                $adImages = array();
                
                for ($i = 0; $i < count($request->filename); $i++) {
                    $filename = $request->filename[$i];
                    //echo storage_path( 'app/public/uploads/temp/' . $filename);
                    if( File::exists( storage_path( 'app/public/uploads/temp/' . $filename ) ) ){
                        File::move(storage_path( 'app/public/uploads/temp/' . $filename ), storage_path( 'app/public/uploads/ads/' . $filename ) );
                        File::move(storage_path( 'app/public/uploads/temp/thumb/' . $filename ), storage_path( 'app/public/uploads/ads/thumb/' . $filename ) );
                        $adImages[] = [ 'ad_id' => $newAd->id, 'filename' => $filename ];
                    }
                }
    
                AdImage::insert( $adImages );
    
                DB::commit();
                $data['code'] = 201;
                $data['insertId'] = $newAd->id;
                $data['error'] = false;
                $data['msg'] = 'Ad Saved Successfully';
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
            if( $result['OkToProceed'] == true ){
                $data['msg'] = $result['msg'];
            } else {
                $data['msg'] = 'Please log out and log back in and try again';
            }
            
            return $data;
        }
        
    }

    public function updateAd(Request $request){
        $userId = Auth::id();
        $userRec = User::find( $userId );
        if( $userRec ) {
            DB::beginTransaction();   
            try {
                $newAd = Ad::where( 'user_id', '=', $userId  )
                            ->where( 'id', '=', $request->adId )->first();
                if( $newAd ){
                    $newAd->title = $request->title;
                    $newAd->desc = $request->desc;
                    $newAd->amount = $request->amount;
                    $newAd->race_id = $request->race;
                    $newAd->kind_id = $request->kind;
                    $newAd->save();
                    $adImages = array();

                    if( isset( $request->filename ) ){
                        for ($i = 0; $i < count($request->filename); $i++) {
                            $filename = $request->filename[$i];
                            if( File::exists( storage_path( 'app/public/uploads/temp/' . $filename ) ) ){
                                File::move(storage_path( 'app/public/uploads/temp/' . $filename ), storage_path( 'app/public/uploads/ads/' . $filename ) );
                                File::move(storage_path( 'app/public/uploads/temp/thumb/' . $filename ), storage_path( 'app/public/uploads/ads/thumb/' . $filename ) );
                                $adImages[] = [ 'ad_id' => $request->adId, 'filename' => $filename ];
                            }
                        }
                        if( count($request->filename) > 0 ) {
                            AdImage::insert( $adImages );
                        }
                    }
                    
                    if( isset( $request->delete_file_id ) ){
                        $arrOfFileIds = explode( ',', $request->delete_file_id );
                        if( count( $arrOfFileIds ) > 0 ){
                            $adImageRec = AdImage::where( 'ad_id', '=', $request->adId )
                                        ->whereIn( 'id', $arrOfFileIds )->get();
                            foreach( $adImageRec as $adImage ){
                                deleteImage( $adImage->filename, 'app/public/uploads/ads' );
                                AdImage::where('id', '=', $adImage->id )->delete();
                            }
                        }                        
                    }

        
                    DB::commit();
                    $data['code'] = 201;
                    $data['insertId'] = $newAd->id;
                    $data['error'] = false;
                    $data['msg'] = 'Ad Saved Successfully';
                    return $data;
                } else {
                    $data['code'] = 422;
                    $data['adId'] = $newAd->id;
                    $data['error'] = true;
                    $data['msg'] = 'Please check the details and update carefully.';
                    return $data;
                }
                
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
        
    }

    public function saveAttributesOptions(Request $request){
        $data = array();
        $validator = Validator::make($request->all(), 
                [ 
                    'options' => 'required',
                    'options.*' => 'required|numeric',
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

        $adData = Ad::where( [ 
                    [ 'id' , '=', $request->adId ],
                    [ 'user_id' , '=', Auth::id() ]
                ])->first();

        if( $adData ){
            DB::beginTransaction();   
            try {
                    AdSelectedAttribute::where('ad_id', '=' , $request->adId )->delete();
                    $selectedOptions = array();
                    for ($i = 0; $i < count($request->options); $i++) {
                        $selectedOptions[] = [ 'ad_id' => $request->adId, 'ad_attribute_option_id' => $request->options[$i] ];
                    }
                    AdSelectedAttribute::insert( $selectedOptions );
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
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'Please check details and try again';
            return $data;
        }          
    }

    public function saveforlater( Request $request ){
        $data = array();
        $validator = Validator::make($request->all(), 
                [ 
                    'adId' => 'required|numeric',
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
                    $adViewRec = AdView::where('ad_id' , '=' , $request->adId )
                                        ->where('user_id' , '=' , $userId )
                                        ->first();
                    if( $adViewRec ){
                        if($adViewRec->like_ad == 1){
                            $adViewRec->like_ad = 0 ;
                        } else {
                            $adViewRec->like_ad = 1 ;
                        }
                        $adViewRec->update();
                    } else {
                        $newAdView = new AdView;
                        $newAdView->user_id = $userId;
                        $newAdView->ad_id = $request->adId;
                        $newAdView->like_ad = 1 ;
                        $newAdView->count_views = 1 ;
                        $newAdView->save();
                    }
    
                    DB::commit();
                    $data['code'] = 201;
                    $data['error'] = false;
                    $data['msg'] = 'Ad Saved Successfully';
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

    public function playPause( Request $request ){
        $data = array();
        $validator = Validator::make($request->all(), 
                [ 
                    'adId' => 'required|numeric',
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
            $result = $this->ifUserIsAllowedToCreateAds();
            if( $result['OkToProceed'] == true ){
                $userId = Auth::id();
                $userRec = User::find( $userId );
                if( $userRec ) {
                    DB::beginTransaction();   
                    try {
                        $adViewRec = Ad::where('id' , '=' , $request->adId )
                                            ->where('user_id' , '=' , $userId )
                                            ->first();
                        if( $adViewRec ){
                            if($adViewRec->status == 1){
                                $adViewRec->status = 0 ;
                                $data['status'] = 0;
                            } else {
                                $adViewRec->status = 1 ;
                                $data['status'] = 1;
                            }
                            $adViewRec->update();
                            $data['code'] = 201;
                            $data['error'] = false;
                            $data['msg'] = 'Ad Updated successfully!';
                        } else {
                            $data['status'] = -1;
                            $data['code'] = 422;
                            $data['error'] = true;
                            $data['msg'] = 'Not authorised to update this Ad!!';
                        }
        
                        DB::commit();
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
                $userId = Auth::id();
                $userRec = User::find( $userId );
                if( $userRec ) {
                    DB::beginTransaction();   
                    try {
                                $adViewRec = Ad::where('id' , '=' , $request->adId )
                                            ->where('user_id' , '=' , $userId )
                                            ->first();
                                if( $adViewRec ){
                                    if($adViewRec->status == 1){
                                        $adViewRec->status = 0 ;
                                        $adViewRec->update();

                                        $data['status'] = 0;
                                        $data['code'] = 201;
                                        $data['error'] = false;
                                        $data['msg'] = 'Ad Updated successfully!';
                                    } else {
                                        $data['code'] = 422;
                                        $data['error'] = true;
                                        $data['msg'] = $result['msg'];
                                        return $data;
                                    } 
                                }             
                                DB::commit();
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
                    $data['msg'] = $result['msg'];
                    return $data;
                }                
            }
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'Invalid call';
            return $data;
        }
    }

    public function publishAd( Request $request ){
        
        $data = array();
        $validator = Validator::make($request->all(), 
                [ 
                    'adId' => 'required|numeric',
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

            $userId = Auth::id();
            $userRec = User::find( $userId );
            if( $userRec ) {
                DB::beginTransaction();   
                try {
                    $adViewRec = Ad::where('id' , '=' , $request->adId )
                                        ->where('user_id' , '=' , $userId )
                                        ->with('adKind')
                                        ->first();
                    if( $adViewRec ){
                        if($adViewRec->status == 0){
                            $adViewRec->status = 1 ;
                            $data['status'] = 1;
                        } 
                        $adViewRec->update();
                        $data['code'] = 201;
                        $data['error'] = false;
                        $data['msg'] = 'Ad Published successfully!';
                        $data['adId'] = $request->adId;
                    } else {
                        $data['code'] = 422;
                        $data['error'] = true;
                        $data['msg'] = 'Not authorised to update this Ad!!';
                    }
                    
                    // send email to user for publishing the Ad
                    $adLink = route('ad_detail_page_slug', [ 'adId' => $adViewRec->id, 'title' => Str::slug($adViewRec->title), 'kind' => Str::slug($adViewRec->adKind->title) ] );
                    $newAdLink = route('createad_showkinds');
                    $profileLink = route('showprofileform');
                    $arrayToSend = array('customer' => $userRec->name, 'title_of_add' => $adViewRec->title, 
                        'link' => $adLink, 'link_to_new_ad' => $newAdLink, 'link_to_profile' => $profileLink);
                    Mail::send( 'mailtemplates.ad_placed' , $arrayToSend, function( $message ) use( $userRec ) {
                    $message->to( $userRec->email );
                    $message->subject( 'Je advertentie is geplaatst' );
                    } );

                    DB::commit();
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
    }

    
    public function deleteImage(Request $request){}
}
