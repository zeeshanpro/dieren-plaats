<?php

namespace App\Http\Controllers\Front\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kind;
use App\Models\Ad;
use App\Models\AdView;
use App\Models\Breeder;
use App\Models\Renewal;
use App\Models\BreederReview;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Front\UserInterface;
use App\Interfaces\Front\AdInterface;
use Session;
use App\Interfaces\Front\ExpectedBabieInterface;
use Mail;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $userInterface;
    protected $adInterface;
    protected $expected_babies_subscribeInterface;

    public function __construct(UserInterface $userInterface, 
                                AdInterface $adInterface, 
                                ExpectedBabieInterface $expected_babies_subscribeInterface )
    {
        $this->userInterface = $userInterface;
        $this->adInterface = $adInterface;
        $this->expected_babies_subscribeInterface = $expected_babies_subscribeInterface;
    }

    public function showCompleteRegistration( Request $request ){
        $userId = Auth::id();
        if( $userId > 0 ){
            $userRec = User::where('id','=', $userId )->first();
            if( $userRec ) {
                return view('front.complete-registration', ['email' => $userRec->email, 'name' => $userRec->name ] );
            }
        } else {
            Auth::logout();
            return redirect()->route('base_url');
        }
    }

    public function saveCompleteRegistration( Request $request ){
        $data = $this->userInterface->completeRegistration( $request );
        if( $data['code'] == 201 )
        {
            Session::flash('message', $data['msg']);
            return redirect()->route('base_url');
        } else if( $data['code'] == 422 ){
            return redirect()->back()
                        ->withErrors($data['msg']);
        } else if( $data['code'] == 423 ){
            return redirect()->back()
                        ->withErrors($data['validator'])->withInput();
        }
        return redirect()->back();
    }

    public function showprofileform( Request $request ){
        $userId = Auth::id();
        if( $userId > 0 ){
            $userRec['data'] = User::where('id','=', $userId )->with('Breeder.breederKind')->first();
            if( $userRec ) {
                $userRec['kinds'] = Kind::where('status', '=',  1)->orderBy('title', 'ASC')->get();
                return view('front.userpanel.editProfile', ($userRec) );
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function saveprofileform( Request $request ){
        $data = $this->userInterface->updateUser( $request );
        if( $data['code'] == 201 )
        {
            Session::flash('message', "Profile information Updated Successfuly");
        } else if( $data['code'] == 422 ){
            return redirect()->back()
                        ->withErrors($data['msg']);
        }
        return redirect()->back()->withInput($request->input());
    }

    public function showProfile( Request $request ){
        $data = $this->adInterface->listAdsWithPaginateAndSearch( $request, $request->userId );
        $data['Breeder'] = Breeder::where( 'user_id', '=', $request->userId )->with('breederKind.breeder_kindKind')->first();
        $data['User'] = User::where( 'id', '=', $request->userId )
                                ->select('id', 'name','usertype')
                                ->withCount(['userAds','userBreederReviews'])->first();
        $data['alreadyReviewed'] = false;

        $adIds = Ad::where( 'user_id', '=', $request->userId )->pluck( 'id' )->toArray();

        $data['views'] = AdView::whereIn('ad_id', $adIds)->sum('count_views');
        

        $breederRec = Breeder::where( 'user_id', '=', $request->userId )->first();
        if( $breederRec == null ){
            redirect()->route('listBreeders');
        } else {

            $reviewReport = BreederReview::where( 'breeder_id', '=', $breederRec->id );
            $sellerReviewReport = array();
            $sellerReviewReport['avg_rating'] = round($reviewReport->avg( 'rating' ), 1 );
            $sellerReviewReport['no_of_reviews'] = $reviewReport->count();
            $data['sellerReport'] = $sellerReviewReport;
            $userId = Auth::id();
            if( $userId > 0 ){    
                $breederReviewed = BreederReview::where( 'breeder_id', '=', $breederRec->id )
                                                ->where( 'user_id', '=', $userId )->count();
                if( $breederReviewed > 0 ){
                    $data['alreadyReviewed'] = true;
                }             
            }
        }
        
        return view('front.profile.breedershelter', $data);
    }

    public function listBreeders( Request $request ){
        $result = $this->userInterface->getBreedersBySearchAndPaginate( $request );
        return view('front.profile.breederList' , $result );
    }

    public function search_breeders( Request $request ){
        $result = $this->userInterface->getBreedersBySearchAndPaginate( $request );
        // apply if conditions based on code send back data
        return view('front.layout.components.breederListBridge',$result)->render(); 
    }

    public function show_site_contactus_form(Request $request){
        return view('front.contactus'); 
    }

    public function save_site_contactus_form( Request $request ){
        $okayToProceed = true;
        $msg = '';
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $msg = 'Please provide a valid email address.';
            $okayToProceed = false;
        }
        if( $request->message == '' ) {
            $msg = 'Please enter message to send';
            $okayToProceed = false;
        }

        if( $request->name == '' ) {
            $msg = 'Please enter your name.';
            $okayToProceed = false;
        }

        if( $request->message != '' and $okayToProceed == true ){
            $siteUser = User::select('email')
                            ->where('id', '=', 1)
                            ->where('usertype', '=', 'Admin')->first();
            if( $siteUser ) {
                $arrayToSend = array('email' => $request->email, 'msg' => $request->message,'name' => $request->name, 'date' => date('d-M-Y') );
                Mail::send( 'mailtemplates.contactus_website' , $arrayToSend, function( $msg ) use( $request, $siteUser ) {
                    $msg->to( $siteUser->email );
                    $msg->subject( 'Contactformulier bericht ontvangen' ); //config("app.name")
                } );
                Session::flash('message', "Bedankt voor je bericht! We beantwoorden je vraag spoedig.");
            }
        } else {
            return redirect()->back()->withInput()
                        ->withErrors( $msg );
        }
        
        return view('front.contactus'); 
    }

    public function show_contactus_form( Request $request ){
        return view('front.userpanel.contactus'); 
    }

    public function save_contactus_form( Request $request ){
        if( $request->message != '' ){
            $siteUser = User::select('email')
                            ->where('id', '=', 1)
                            ->where('usertype', '=', 'Admin')->first();
            $user = Auth::user();
            if( $user ) {
                $arrayToSend = array('email' => $user->email, 'msg' => $request->message,'name' => $user->name);
                Mail::send( 'mailtemplates.contactusMatter' , $arrayToSend, function( $msg ) use( $user, $siteUser ) {
                    $msg->to( $siteUser->email );
                    $msg->subject( config("app.name") . ': Contacted By ' . $user->name );
                } );
                Session::flash('message', "Your message has been submitted successfuly. We will get back with you shortly.");
            }
        } else {
            return redirect()->back()
                        ->withErrors( 'Please fill the message and send.' );
        }
        
        return view('front.userpanel.contactus'); 
    }

    public function show_logindetails_form( Request $request ){
        return view('front.userpanel.pwdsetting'); 
    }

    public function show_subscription_history( Request $request ){
        $result = array();
        $userId = Auth::id();
        $userRec = User::find( $userId );
        $result['usertype'] = $userRec->usertype;
        if($userRec->usertype == 'Normal'){
            $result['pricing'] = '€0.00 / month';
            $result['renewal_date'] = '-';
        } else {
            $renewal = Renewal::where( 'user_id', '=', $userId )
                        ->orderByDesc('id')
                        ->first();

            if( $renewal ){
                $result['renewal_date'] = date('d M Y', strtotime($renewal->renewal_date) );
                $price = $renewal->total / 100;
                $result['pricing'] = '€'.number_format($price,2).' / month';
            } else {
                $result['renewal_date'] = 'Yet to start subscription';
                if( $userRec->usertype == 'Breeder' ){
                    $result['pricing'] = '€4.95 / month';
                } else { // for shelter
                    $result['pricing'] = '€1.00 / month';
                }
            } 
        }
        return view('front.userpanel.subscriptionhistory', $result ); 
    }

    public function update_logindetails( Request $request ){
        $data = $this->userInterface->update_logindetails( $request );
        if( $data['code'] == 201 )
        {
            Session::flash('message', $data['msg']);
        } else if( $data['code'] == 422 ){
            return redirect()->back()
                        ->withErrors($data['msg']);
        }
        return redirect()->back();
    }

    public function showExpectedBabiesOfProfile( Request $request ){
        if( isset($request->userId) and is_numeric($request->userId) ){
            $data = $this->expected_babies_subscribeInterface->showExpectedBabiesOfProfile( $request->userId );
            if( $data['code'] == 201 ){
                return view('front.profile.breedershelterExpectedBabies' , $data );
            } else {
                redirect()->route('listBreeders');
            }
        } else {
            redirect()->route('listBreeders');
        }
    }

    public function showMyAds( Request $request ){
        $userId = Auth::id();
        $data = $this->adInterface->listAdsWithPaginateAndSearch( $request, $userId );
        $data['Breeder'] = Breeder::where( 'user_id', '=', $userId )->with('breederKind.breeder_kindKind')->first();
        $data['User'] = User::where( 'id', '=', $userId )
                                ->select('id', 'name','usertype')
                                ->withCount(['userAds','userBreederReviews'])->first();
        
        $breederRec = Breeder::where( 'user_id', '=', $userId )->first();
        if( $breederRec == null ){
            redirect()->route('listBreeders');
        } else {

            $reviewReport = BreederReview::where( 'breeder_id', '=', $breederRec->id );
            $sellerReviewReport = array();
            $sellerReviewReport['avg_rating'] = round($reviewReport->avg( 'rating' ), 1 );
            $sellerReviewReport['no_of_reviews'] = $reviewReport->count();
            $data['sellerReport'] = $sellerReviewReport;
        }

        $adIds = Ad::where( 'user_id', '=', $userId )->pluck( 'id' )->toArray();
        $data['views'] = AdView::whereIn('ad_id', $adIds)->sum('count_views');

        return view('front.userpanel.myads', $data );
    }

    public function showMyExpectedBabies( Request $request ){
        $userId = Auth::id();
        if( is_numeric( $userId ) ){
            $data = $this->expected_babies_subscribeInterface->showMyExpectedBabies();
            if( $data['code'] == 201 ){
                return view( 'front.userpanel.myexpectedbabies' , $data );
            } else {
                redirect()->route('listBreeders');
            }
        } else {
            redirect()->route('listBreeders');
        }
    }
}