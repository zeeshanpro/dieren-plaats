<?php

namespace App\Http\Controllers\Front\PaidAdStripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
use Session;
use Exception;
use Mail;
use App\Models\PaidAd;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Support\Str;

class PaidAdController extends Controller
{
    public function success( Request $request, $adEncoded ){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        $customer = \Stripe\Customer::retrieve($session->customer);
        $adId = base64_decode($adEncoded);
        $user = User::where( 'email', '=', $customer->email )->first();
        if( $user ){
            $adDetailCnt = Ad::where('id', '=', $adId)
                            ->where('user_id', '=', $user->id )
                            ->with( 'adKind' )->count();
            if( $adDetailCnt > 0 ){
                $adDetail = Ad::where('id', '=', $adId)
                            ->where('user_id', '=', $user->id )
                            ->with( 'adKind' )->first();
                $alreadyExisting = PaidAd::where('ad_id', '=', $adId)
                                            ->where( 'user_id', '=', $user->id )
                                            ->where( 'payment_intent' , '=', $session->payment_intent )
                                            ->count();

                if($alreadyExisting < 1 ){
                    if( $session->payment_status == 'paid' ){
                        $newPaidAd = new PaidAd;
                        $newPaidAd->user_id = $user->id;
                        $newPaidAd->ad_id = $adId;
                        $newPaidAd->amount_subtotal = $session->amount_subtotal;
                        $newPaidAd->amount_total = $session->amount_total;
                        $newPaidAd->stripe_customer = $session->customer;
                        $newPaidAd->payment_intent = $session->payment_intent;
                        $newPaidAd->payment_status = $session->payment_status;
                        $newPaidAd->expires_on = date( 'Y-m-d' , strtotime( date( 'Y-m-d' ) . ' + 7 days') );
                        $newPaidAd->save();

                        $adDetail->status = 1;
                        $adDetail->save();
                        $adLink = route('ad_detail_page_slug', [ 'adId' => $adId, 'title' => Str::slug($adDetail->title), 'kind' => Str::slug($adDetail->adKind->title) ] );
                        $newAdLink = route('createad_showkinds');
                        $profileLink = route('showprofileform');
                        $arrayToSend = array('customer' => $user->name, 'title_of_add' => $adDetail->title, 
                        'link' => $adLink, 'link_to_new_ad' => $newAdLink, 'link_to_profile' => $profileLink);
                        Mail::send( 'mailtemplates.ad_placed' , $arrayToSend, function( $message ) use( $user ) {
                        $message->to( $user->email );
                        $message->subject( 'Je advertentie is geplaatst' );
                        } );

                        return view('front.paidad.success', [ 'adTitle' => $adDetail->title, 'adId' => $adDetail->id, 'kind' => $adDetail->adKind->title ] );    
                    } else {
                        // it did not get paid 
                    }
                } else {
                    //already exsiting in DB.
                    return view('front.paidad.success', [ 'adTitle' => $adDetail->title, 'adId' => $adDetail->id, 'kind' => $adDetail->adKind->title ] );    
                }
            } else {
                // means user may be came directly on this page
            }                 
        } else {
            // user is not logged in and came here accidently. 
        }
    }

    public function cancel( Request $request ){
        return redirect()->route('showMyAds');
    }
}
