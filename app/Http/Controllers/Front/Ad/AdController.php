<?php

namespace App\Http\Controllers\Front\Ad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Front\AdInterface;
use App\Interfaces\Front\UserInterface;
use App\Http\Requests\Front\AdRequest;
use App\Http\Requests\Front\UpdateAdRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Ad;
use App\Models\AdView;
use App\Models\User;
use App\Models\Kind;
use App\Models\Race;
use App\Models\BreederReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe;
use Session;
use Exception;
use Mail;

class AdController extends Controller
{
    protected $adInterface;
    protected $userInterface;
    public function __construct(AdInterface $adInterface, UserInterface $userInterface)
    {
        $this->adInterface = $adInterface;
        $this->userInterface = $userInterface;
    }

    public function listBySlug( Request $request ){
        if( $request->kindSlug != '' ){
            $kindObj = Kind::where('title_slug', '=', $request->kindSlug);
            if( $kindObj->count() > 0 ){
                $kindRec = $kindObj->first();
                $request->merge(["kindId"=>$kindRec->id]); 
            } else {
                return redirect()->route('base_url');;
            }
        }

        if( $request->raceSlug != ''){
            $raceObj = Race::where('title_slug', '=', $request->raceSlug);
            if( $raceObj->count() > 0 ){
                $raceRec = $raceObj->first();
                $request->merge(["options_race"=>$raceRec->id]); 
            } else {
                return redirect()->route('base_url');;
            }
        }

        $data = $this->adInterface->listAdsWithPaginateAndSearch( $request );
        if( $data['code'] == 422 ){
            return redirect()->route('base_url');
        }
        if( isset($request->options_race) and is_numeric( $request->options_race ) ){
            $data['options_race'] = $request->options_race;
        }
        return view('front.ad.list', $data );
    }

    public function list( Request $request ){  // to be obsolete
        $data = $this->adInterface->listAdsWithPaginateAndSearch( $request );
        if( $data['code'] == 422 ){
            return redirect()->route('base_url');
        }
        if( isset($request->options_race) and is_numeric( $request->options_race ) ){
            $data['options_race'] = $request->options_race;
        }
        return view('front.ad.list', $data );
    }

    public function showAdBySlug( Request $request ){
        $adObject = Ad::where( 'title_slug', '=', $request->adSlug );
        if( $adObject->count() > 0 ){
            $adId = $adObject->select('id')->first();
            $request->merge(["adId"=>$adId->id]); 
        } else {
            return redirect()->route('base_url');;
        }
        
        $adData['adData'] = Ad::where( [ 
            [ 'id' , '=', $request->adId ]
        ])->with(['adUser', 'adUser.Breeder', 'adImages','adSelectedAttributes.ad_selected_attributeAd_attribute_option.ad_attribute_optionAd_attribute'])
        ->first();

        if( is_null( $adData['adData'] ) ){
            return redirect('/');
        }

        $userDetails = User::where( 'id', '=', $adData['adData']->user_id )
                                ->with('Breeder')
                                ->withCount(['userAds'])->first();
        $adData['postCreator'] = $userDetails;

        $adData['breederReviews'] = BreederReview::where( 'breeder_id', '=', $userDetails['Breeder']->id )
                                        ->with( ['breeder_reviewUser' => function($query) {
                                            $query->select('id','name');
                                        },'breeder_reviewUser.Breeder' ])
                                        ->orderBy('id', 'DESC')->limit(6)->get();

        
        $reviewReport = BreederReview::where( 'breeder_id', '=', $userDetails['Breeder']->id );
        $sellerReviewReport = array();
        $sellerReviewReport['avg_rating'] = round($reviewReport->avg( 'rating' ), 1 );
        $sellerReviewReport['no_of_reviews'] = $reviewReport->count();
        $adData['sellerReport'] = $sellerReviewReport;

        $adViewRows =  AdView::select( [ DB::raw("SUM(like_ad) as cntLikes"), DB::raw("SUM(count_views) as cntView") ] )
                    ->where('ad_id', '=', $request->adId)
                    ->groupBy('ad_id')
                    ->first();

        //dd($adData);

        if( $adViewRows ){
            $adData['reporting'] = $adViewRows;
        }
        $adData['alreadyReviewed'] = false;
        $userId = Auth::id();
        if( $userId > 0 ){
            $adView = AdView::firstOrCreate([ 'ad_id' => $request->adId, 'user_id' => $userId ], 
            [ 'count_views' => 1, 'like_ad' => 0 ]);
            $adView->count_views = $adView->count_views + 1;
            $adView->save();

            $userRec = User::find( $userId );
            if( $userRec ) {
                $adIdsRec = AdView::select('like_ad' )
                        ->where( 'user_id', '=', $userId )
                        ->where('ad_id', '=', $request->adId)
                        ->first();
                if($adIdsRec)
                    $adData['watchLater'] = $adIdsRec['like_ad'];

                $breederReviewed = BreederReview::where( 'breeder_id', '=', $userDetails['Breeder']->id )
                                                ->where( 'user_id', '=', $userId )->count();    
                if( $breederReviewed > 0 ){
                    $adData['alreadyReviewed'] = true;
                } 
            }
        }
        
        $shareComponent = \Share::page(
            'https://dieren-plaats.nl/ad/'.$request->adId.'/'.Str::slug($adData['adData']->title, '-'),
            $adData['adData']->title,
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit()
        ->getRawLinks();
        $adData['shareComponent'] = $shareComponent ;

        if( $adData ){
            return view('front.ad.ad_detail', $adData);
        } else {
            return redirect('/');
        }
    }

    public function search_adlistings( Request $request ){
        $data = $this->adInterface->listAdsWithPaginateAndSearch( $request );
        return view('front.layout.components.adListBridge',$data)->render(); 
    }

    public function showkinds(){
        $data = $this->userInterface->ifUserIsAllowedToCreateAds();
        return view('front.ad.createad_showkinds', $data );
    }

    public function showform( Request $request ){
        $data = $this->userInterface->ifUserIsAllowedToCreateAds();
        $data['kindId'] = $request->kindId;
        return view('front.ad.createad_filldetails', $data );
    }

    public function showAdUpdateForm( Request $request ){
        $userId = Auth::id();
        $adRecord = Ad::where( 'user_id', '=', $userId  )
                    ->where( 'id', '=', $request->adId )
                    ->with('adImages')->first();
        return view('front.ad.update_ad_filldetails', [ 'adRecord' => $adRecord ] );
    }

    public function updateAdForm( UpdateAdRequest $request ){
        
        $data = $this->adInterface->updateAd( $request );
        
        if( $data['code'] == 201 )
        {
            $adId = $request->adId;
            
            return redirect( '/createad/'.$adId.'/chooseattributes' );
        } else if( $data['code'] == 422 ){
            return redirect()->back()
                        ->withErrors($data['msg']);
        }

        return view('front.ad.createad_showattributes');
    }

    public function saveform( AdRequest $request ){
        
        $data = $this->adInterface->createAd( $request );
        if( $data['code'] == 201 )
        {
            $adId = $data['insertId'];
            return redirect( '/createad/'.$adId.'/chooseattributes' );
        } else if( $data['code'] == 422 ){
            return redirect()->back()
                        ->withErrors($data['msg']);
        }

        return view('front.ad.createad_showattributes');
    }

    public function saveAttributesOptions( Request $request ){
        $data = $this->adInterface->saveAttributesOptions( $request );
        if( $data['code'] == 201 )
        {
            return redirect('createad/'.$request->adId.'/previewad');
        } else if( $data['code'] == 422 ){
            return redirect()->back()
                        ->withErrors($data['msg']);
        }
        return redirect('createad/'.$request->adId.'/chooseattributes');
    }

    public function previewad( Request $request ) {
        $adData['adData'] = Ad::where( [ 
            [ 'id' , '=', $request->adId ],
            [ 'user_id' , '=', Auth::user()->id ]
        ])->with(['adImages','adSelectedAttributes.ad_selected_attributeAd_attribute_option.ad_attribute_optionAd_attribute'])->first();
        
        if( $adData ){
            return view('front.ad.ad_preview', $adData);
        } else {
            return redirect('/');
        }
    }

    public function publishad( Request $request ){
        if( $request->has( 'promotead' ) ){
            if( $request->promotead == 1 ){
                // make payment and then publish the Ad
                ///Stripe product ID is prod_Kj22GZ6rRjVCUw
                    $user = User::with('Breeder')->find(Auth::id());
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    if( $user ) {
                        if (is_null($user->stripe_id)) {
                            $options = array('address' => [
                                'line1' => $user->Breeder->street,
                                'city' => $user->Breeder->city,
                                //'state' => 'JV',
                                'country' => $user->Breeder->country, //'NL',
                                'postal_code' => $user->Breeder->postal_code
                            ]);
                            $stripeCustomer = $user->createAsStripeCustomer($options);
                        }

                        $checkout_session = \Stripe\Checkout\Session::create([
                            'success_url' => route('base_url') . '/paidad_success/'.base64_encode($request->adId).'?session_id={CHECKOUT_SESSION_ID}', //?session_id={CHECKOUT_SESSION_ID}
                            'cancel_url' => route('base_url') . '/paidad_cancel',
                            'payment_method_types' => ['ideal', 'card'], //'sepa_debit'
                            'mode' => 'payment',
                            'customer' => $user->stripe_id,
                            //'billing_address_collection' => $user->Breeder->street.', '.$user->Breeder->city
                              //                                  .', '.$user->Breeder->postal_code.', '.$user->Breeder->country ,
                            //'customer_email' => $user->email,
                            //'automatic_tax' => ['enabled' => true],
                            'line_items' => [[
                                'price' => STRIPE_AD_PROMOTION_PLAN, //'prod_Kj22GZ6rRjVCUw', //$user->stripe_product_id ,//'price_1JxxPNCaEIG4B93yTxn1GsRe',
                                'quantity' => 1,
                            ]]
                        ]);

                        return redirect()->to( $checkout_session->url );
                    }
            }
        } else {
            $data = $this->adInterface->publishAd( $request );
            if( $data['code'] == 201 )
            {
                $adId = $data['adId'];
                return redirect()->route('showMyAds');
            } else if( $data['code'] == 422 ){
                return redirect()->back()
                            ->withErrors($data['msg']);
            }
        }
        
        return view( 'front.ad.createad_showattributes' );
    }

    public function showAdDetail( Request $request ){
        

        $adData['adData'] = Ad::where( [ 
            [ 'id' , '=', $request->adId ]
        ])->with(['adUser', 'adImages','adSelectedAttributes.ad_selected_attributeAd_attribute_option.ad_attribute_optionAd_attribute'])
        ->first();

        if( is_null( $adData['adData'] ) ){
            return redirect('/');
        }

        $userDetails = User::where( 'id', '=', $adData['adData']->user_id )
                                ->with('Breeder')
                                ->withCount(['userAds'])->first();
        $adData['postCreator'] = $userDetails;

        $adData['breederReviews'] = BreederReview::where( 'breeder_id', '=', $userDetails['Breeder']->id )
                                        ->with( ['breeder_reviewUser' => function($query) {
                                            $query->select('id','name');
                                        },'breeder_reviewUser.Breeder' ])
                                        ->orderBy('id', 'DESC')->limit(6)->get();

        
        $reviewReport = BreederReview::where( 'breeder_id', '=', $userDetails['Breeder']->id );
        $sellerReviewReport = array();
        $sellerReviewReport['avg_rating'] = round($reviewReport->avg( 'rating' ), 1 );
        $sellerReviewReport['no_of_reviews'] = $reviewReport->count();
        $adData['sellerReport'] = $sellerReviewReport;

        $adViewRows =  AdView::select( [ DB::raw("SUM(like_ad) as cntLikes"), DB::raw("SUM(count_views) as cntView") ] )
                    ->where('ad_id', '=', $request->adId)
                    ->groupBy('ad_id')
                    ->first();

        //dd($adData);

        if( $adViewRows ){
            $adData['reporting'] = $adViewRows;
        }
        $adData['alreadyReviewed'] = false;
        $userId = Auth::id();
        if( $userId > 0 ){
            $adView = AdView::firstOrCreate([ 'ad_id' => $request->adId, 'user_id' => $userId ], 
            [ 'count_views' => 1, 'like_ad' => 0 ]);
            $adView->count_views = $adView->count_views + 1;
            $adView->save();

            $userRec = User::find( $userId );
            if( $userRec ) {
                $adIdsRec = AdView::select('like_ad' )
                        ->where( 'user_id', '=', $userId )
                        ->where('ad_id', '=', $request->adId)
                        ->first();
                if($adIdsRec)
                    $adData['watchLater'] = $adIdsRec['like_ad'];

                $breederReviewed = BreederReview::where( 'breeder_id', '=', $userDetails['Breeder']->id )
                                                ->where( 'user_id', '=', $userId )->count();    
                if( $breederReviewed > 0 ){
                    $adData['alreadyReviewed'] = true;
                } 
            }
        }
        
        $shareComponent = \Share::page(
            'https://dieren-plaats.nl/ad/'.$request->adId.'/'.Str::slug($adData['adData']->title, '-'),
            $adData['adData']->title,
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit()
        ->getRawLinks();
        $adData['shareComponent'] = $shareComponent ;

        if( $adData ){
            return view('front.ad.ad_detail', $adData);
        } else {
            return redirect('/');
        }
    }

    public function saveforlater( Request $request ){
        $data = $this->adInterface->saveforlater( $request );
        return response()->json( $data );
    }

    public function playpause( Request $request ){
        $data = $this->adInterface->playPause( $request );
        return response()->json( $data );
    }

    public function showsavedads( Request $request ){
        $userId = Auth::id();
        if( $userId > 0 ){
            $userRec = User::find( $userId );
            if( $userRec ) {
                $savedAds['savedAds'] = Ad::whereIn('id', function($query){
                    $query->select('ad_id')
                    ->from( 'ad_views' )
                    ->where('user_id', '=', Auth::id() )
                    ->where('like_ad' , '=', '1');
                })->withCount(['adViews'])
                ->with(['adKind','adRace','adUser','adImages',
                'adSelectedAttributes.ad_selected_attributeAd_attribute_option.ad_attribute_optionAd_attribute'])
                ->get();

                if( $savedAds ){
                    return view('front.userpanel.savedAds', $savedAds);
                }
            }
        }
        
        return redirect('/');
    }

    public function searchads( Request $request ){
        $data = $this->adInterface->listSearchAdsWithPaginateAndSearch( $request );
        $data['query'] = $request->q;
        //dd($data, $request);
        return view('front.ad.searchads', $data );
        //return view('front.layout.components.adListBridge',$data)->render(); 
    }

    public function searchads_adlistings( Request $request ){
        $data = $this->adInterface->listSearchAdsWithPaginateAndSearch( $request );
        return view('front.layout.components.adListBridge',$data)->render(); 
    }
    
}
