<?php
use App\Http\Controllers\Front\Register\RegisterController;
use App\Http\Controllers\Front\Login\LoginController;
use App\Http\Controllers\Front\Ad\AdController;
use App\Http\Controllers\Front\Subscription\SubscriptionController;
use App\Http\Controllers\Front\Upload\UploadFileController;
use App\Http\Controllers\Front\AdAttributes\AdAttributesController;
use App\Http\Controllers\Front\User\UserController;
use App\Http\Controllers\Front\Message\MessageController;
use App\Http\Controllers\Front\ExpectedAd\ExpectedAdController;
use App\Http\Controllers\Front\TestMailController;
use App\Http\Controllers\Front\Review\ReviewController;
use App\Http\Controllers\Front\EmailSubscribe\EmailSubscribeController;
use App\Http\Controllers\Front\SubsNew\SubscriptionNewController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Front\ForgotPassword\ResetPasswordController;
use App\Http\Controllers\Front\PaidAdStripe\PaidAdController;
use App\Http\Controllers\Front\Import\ImportCSVController;
use App\Http\Controllers\Remora_front\Category\CategoryController;
use App\Http\Controllers\Remora_front\Shop\ShopController;

// Route::get('/test', function () {
//     return view('test');
// });

Route::get('/emailtest', function () {
     $arrayToSend = array('title_of_add' => 'Title here', 'seller_name' => 'Seller Name Here');

      Mail::send( 'mailtemplates.testtemplate' , $arrayToSend, function( $message )  {
                            $message->to("sunny.sahijwani@gmail.com" );
                            $message->subject( 'My New Sunject' );
                        } );
      return "sent email";
     //return view("mailtemplates.testtemplate");
});
// import excel related
// Route::get('makeslug',[ImportCSVController::class, 'makeslug'])->name('makeslug');
// Route::get('importcsv',[ImportCSVController::class, 'import'])->name('importcsv');
// Route::get('importconnection',[ImportCSVController::class, 'sellerToAds'])->name('sellerToAds');
// Route::get('importxlsx',[ImportCSVController::class, 'xlsx'])->name('importxlsx');
// Route::get('process_images',[ImportCSVController::class, 'processImages'])->name('processImages');
 //  Route::get('testScript',[ImportCSVController::class, 'testScript'])->name('testScript');
// import excel related

Route::get('register',[RegisterController::class, 'show'])->name('register');
Route::post('registerUser',[RegisterController::class, 'createUserManually'])->name('createuser');
Route::get('emailverify',[RegisterController::class, 'showEmailVerification'])->name('showEmailVerification');
Route::post('emailverify',[RegisterController::class, 'validateEmailVerification'])->name('validateEmailVerification');

Route::get('forgot_password',[RegisterController::class, 'show_forgot_password'])->name('show_forgot_password');
Route::post('forgot_password',[RegisterController::class, 'send_forgot_password_email'])->name('send_forgot_password_email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'show_reset_password_screen'])->name('showresetpasswordscreen');
Route::post('reset-password', [ResetPasswordController::class, 'update_forgot_password'])->name('update_forgot_password');

// no more required routes start
Route::get('confirm_subscription',[SubscriptionController::class, 'showBankSelection'])->name('confirm_subscription');
Route::post('order-subscription',[SubscriptionController::class, 'processSubscription'])->name('order-subscription');
Route::get('subscription_successful',[SubscriptionController::class, 'onSuccessfulConfirmation'])->name('subscription_successful');
Route::get('subscription-plan',[SubscriptionController::class, 'showSelectionLocal'])->name('subscription-plan');
Route::post('order-subscription_local',[SubscriptionController::class, 'processSubscriptionLocal'])->name('order-subscription_local');
// no more required routes ends

// new controller for subcsription here
Route::get('subscription-showform',[SubscriptionNewController::class, 'showform'])->name('subscription-showform');
Route::get('subscription-success',[SubscriptionNewController::class, 'successResponse'])->name('subscription-success');
Route::post('subscription-success',[SubscriptionNewController::class, 'customerPortal'])->name('subscription-customerPortal');
Route::get('subscription-canceled',[SubscriptionNewController::class, 'cancelResponse'])->name('subscription-canceled');
Route::stripeWebhooks('stripe-webhook');
// new controller for subcsription ends

// static content here starts
Route::get('hond-te-koop', function() {
    return view('front.landingpages.index');
})->name('hond-te-koop');

Route::get('fokker-hond-vinden', function() {
    return view('front.landingpages.fokker-hond-vinden');
})->name('fokker-hond-vinden');

Route::get('fokker-katten', function() {
    return view('front.landingpages.fokker-katten');
})->name('fokker-katten');

Route::get('hond-kopen', function() {
    return view('front.landingpages.hond-kopen');
})->name('hond-kopen');

Route::get('hond-online-verkopen', function() {
    return view('front.landingpages.hond-online-verkopen');
})->name('hond-online-verkopen');

Route::get('hond-verkopen', function() {
    return view('front.landingpages.hond-verkopen');
})->name('hond-verkopen');

Route::get('kat-kopen', function() {
    return view('front.landingpages.kat-kopen');
})->name('kat-kopen');

Route::get('kat-te-koop', function() {
    return view('front.landingpages.kat-te-koop');
})->name('kat-te-koop');

Route::get('kitten-kopen', function() {
    return view('front.landingpages.kitten-kopen');
})->name('kitten-kopen');

Route::get('kitten-verkopen', function() {
    return view('front.landingpages.kitten-verkopen');
})->name('kitten-verkopen');

Route::get('puppy-kopen', function() {
    return view('front.landingpages.puppy-kopen');
})->name('puppy-kopen');

Route::get('puppy-verkopen', function() {
    return view('front.landingpages.puppy-verkopen');
})->name('puppy-verkopen');

Route::get('rashond-kopen', function() {
    return view('front.landingpages.rashond-kopen');
})->name('rashond-kopen');

Route::get('rashond-verkopen', function() {
    return view('front.landingpages.rashond-verkopen');
})->name('rashond-verkopen');

Route::get('raskat-kopen', function() {
    return view('front.landingpages.raskat-kopen');
})->name('raskat-kopen');

Route::get('raskat-verkopen', function() {
    return view('front.landingpages.raskat-verkopen');
})->name('raskat-verkopen');
// static content here ends

Route::get('login',[LoginController::class, 'showLogin'])->name('login');
Route::post('login',[LoginController::class, 'loginManually'])->name('loginManually');
Route::get('adlistings/{kindSlug}',[AdController::class, 'listBySlug'])->name('listads_byslug'); // main working
Route::get('adlistings/{kindSlug}/{raceSlug}',[AdController::class, 'listBySlug'])->name('listads_kind_race_slug');

// Route::get('adlistings/{kindSlug?}/{kindId?}',[AdController::class, 'list'])->where('kindId', '[0-9]+')->name('listads_slug');
// Route::get('adlistings/{kindSlug?}/{kindId}/{raceSlug}/{options_race}',[AdController::class, 'list'])->where('kindId', '[0-9]+')->name('listads_race_slug');

Route::get('search-adlistings',[AdController::class, 'search_adlistings'])->name('search_adlistings');

Route::get('allkinds', function() {
    return view('front.kind.showall');
})->name('listkinds');

Route::get('searchads',[AdController::class, 'searchads'])->name('searchads');
Route::get('searchads-adlistings',[AdController::class, 'searchads_adlistings'])->name('searchads_adlistings');
Route::get('ad/{kindSlug?}/{adSlug?}',[AdController::class, 'showAdBySlug'])->name('ads_slug'); // main
Route::get('ad/{adId}/{title?}',[AdController::class, 'showAdDetail'])->where('adId', '[0-9]+')->name('ad_detail_page');
Route::get('ad/{kind}/{adId}/{title?}',[AdController::class, 'showAdDetail'])->where('adId', '[0-9]+')->name('ad_detail_page_slug');
Route::post('ad/saveforlater',[AdController::class, 'saveforlater'])->name('saveforlater');

//Expected babies related functinality
Route::post('expectedad/subscribe',[ExpectedAdController::class, 'subscribe'])->name('expectedAdSubscribe');
Route::get('expectedbabies',[ExpectedAdController::class, 'showAll'])->name('show_expectedbabies');
Route::get('search-expectedbabies',[ExpectedAdController::class, 'search_expectedbabies'])->name('search_ebListings');

Route::get('breeders',[UserController::class, 'listBreeders'])->name('listBreeders');
// search breeder filters
Route::get('search-breeders',[UserController::class, 'search_breeders'])->name('search_breeders');


Route::get('privacy_policy', function(){
    return view('front.privacypolicy');
});
Route::get('term_of_service', function(){
    return view('front.termofservice');
});
Route::get('benefit_of_paid_ads', function(){
    return view('front.paidadbenefits');
});

Route::get('auth/google', [GoogleController::class,'redirectToGoogle'])->name('overtogoogle');
Route::get('auth/googlecallback', [GoogleController::class,'handleGoogleCallback'])->name('googlecallback');

Route::get('contactus',[UserController::class, 'show_site_contactus_form'])->name('website_contactus');
Route::post('contactus',[UserController::class, 'save_site_contactus_form'])->name('website_save_contactus');

Route::get('get_races_by_kind',[AdAttributesController::class, 'get_races_by_kind'])->name('get_races_by_kind');

//Email Subscription create
Route::post('email_subscribe',[EmailSubscribeController::class, 'create'])->name('email_subscribe');

Route::get('profile/{userId}/{title?}',[UserController::class, 'showProfile'])->name('showProfile');
Route::get('profile/expectedbabies/{userId}/{title?}',[UserController::class, 'showExpectedBabiesOfProfile'])->name('showExpectedBabiesOfProfile');

Route::group(['middleware' => ['auth','permitteduser']], function () {

    Route::get('complete-registration',[UserController::class, 'showCompleteRegistration'])->name('showCompleteRegistration');
    Route::post('complete-registration',[UserController::class, 'saveCompleteRegistration'])->name('saveCompleteRegistration');

    Route::get('createad/choosekind',[AdController::class, 'showkinds'])->name('createad_showkinds');
    Route::get('createad/{kindId}/filldetails',[AdController::class, 'showform'])->name('showform');
    Route::post('createad/filldetails',[AdController::class, 'saveform'])->name('saveadformdetails');
    Route::post('uploadadfiles',[UploadFileController::class, 'upload'])->name('uploadadfile');
    Route::get('createad/{adId}/chooseattributes',[AdAttributesController::class, 'showattributespage'])->name('showattributespage');
    Route::post('updatead/saveattributesoptions',[AdController::class, 'saveAttributesOptions'])->name('saveAttributesOptions');
    Route::get('createad/{adId}/previewad',[AdController::class, 'previewad'])->name('previewad');
    Route::post('createad/{adId}/publish',[AdController::class, 'publishad'])->name('publishad');
    // on paid ad success
    Route::get('paidad_success/{adEncoded}',[PaidAdController::class, 'success'])->name('paidad_success');
    // on paid ad cancel
    Route::get('paidad_cancel',[PaidAdController::class, 'cancel'])->name('paidad_cancel');

    // to update the Ad
    Route::get('updatead/{adId}',[AdController::class, 'showAdUpdateForm'])->name('showAdUpdateForm');
    Route::post('updatead/details',[AdController::class, 'updateAdForm'])->name('updateadformdetails');
    // play and pause the Ad
    Route::post('ad/playpause',[AdController::class, 'playpause'])->name('playpause');

    //user panel
    Route::get('user/editprofile',[UserController::class, 'showprofileform'])->name('showprofileform');
    Route::post('user/editprofile',[UserController::class, 'saveprofileform'])->name('saveprofileform');
    Route::get('savedads',[AdController::class, 'showsavedads'])->name('showsavedads');

    Route::get('user/contactus',[UserController::class, 'show_contactus_form'])->name('userpanel_contactus');
    Route::post('user/contactus',[UserController::class, 'save_contactus_form'])->name('userpanel_save_contactus');

    Route::get('user/updatelogindetails',[UserController::class, 'show_logindetails_form'])->name('show_logindetails_form');
    Route::post('user/updatelogindetails',[UserController::class, 'update_logindetails'])->name('update_logindetails');

    Route::get('user/subscription-history',[UserController::class, 'show_subscription_history'])->name('show_subscription_history');

    Route::get('myads',[UserController::class, 'showMyAds'])->name('showMyAds');
    //Expected babies related functinality
    Route::post('expectedad/create',[ExpectedAdController::class, 'create'])->name('expectedAdCreate');
    Route::post('expectedad/update',[ExpectedAdController::class, 'update'])->name('expectedAdUpdate');
    Route::post('expectedad/delete',[ExpectedAdController::class, 'delete'])->name('expectedAdDelete');
    Route::get('myexpectedbabies',[UserController::class, 'showMyExpectedBabies'])->name('showMyExpectedBabies');

    Route::post('createreview',[ReviewController::class, 'create'])->name('createreview');

    // change user type action that takes user to stripe and on its way back update the user type
    Route::post('proceedToChangeUserType',[SubscriptionNewController::class, 'proceedToChangeUserType'])->name('proceedToChangeUserType');

    // messages shared between users
    Route::get('messages/{adId?}',[MessageController::class, 'listMessages'])->name('messages');
    Route::post('getConversationDetails',[MessageController::class, 'getConversationsWithUser'])->name('get_conversation_details');    
    Route::post('sendConversationMsg',[MessageController::class, 'create'])->name('send_conversation_msg');    
    Route::post('getLatestConversationMsg',[MessageController::class, 'getLatest'])->name('get_latest_conversation_msg');    
    Route::post('deleteConversation',[MessageController::class, 'deleteConversation'])->name('delete_conversation');
});


Route::get('category/{slug}',[CategoryController::class, 'index'])->name('category_byslug'); // main working
Route::get('shop/{category}/{subcategory}',[ShopController::class, 'index'])->name('shop');

// Route::get('shop/{slug}/{slug2}', function(){
//     return view('front_new.shop');
// });

Route::get('product/{slug}', function(){
    return view('front_new.products.product_detail');
});