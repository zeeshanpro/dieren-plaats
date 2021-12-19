<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Race\RaceController;
use App\Http\Controllers\Admin\Kind\KindController;
use App\Http\Controllers\Admin\AdAttribute\AdAttributeController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Ad\AdController;
use App\Http\Controllers\Admin\ExpectedBabie\ExpectedBabieController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Subscription\SubscriptionController;
use App\Http\Controllers\Admin\AdMessage\AdMessageController;
use App\Http\Controllers\Admin\PaidAds\PaidAdsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/clear-cache', function() { $exitCode = Artisan::call('cache:clear'); }); // return what you want });
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('front.index');
})->name('base_url');

Route::get('/logout', function () {
    return redirect('/admin');
});

Route::get('/admin', function () {
    return view('admin.login');
});
Route::get('/admin/login', function () {
    return view('admin.login');
});
Route::get('/admin/logout', function () {
    return view('admin.login');
});
Route::get('/home', function () {
    return redirect('/admin/dashboard');
});
Auth::routes();

Route::post('/admin/check-admin',[AdminController::class,'loginCheck'])->name('check-admin');

// to be included in the middleware later
Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'show'] )->name('admin-dashboard');
    Route::get('/admin/listusers',[UserController::class, 'list'])->name('admin-listusers');
    Route::get('/admin/search_users',[UserController::class, 'search'])->name('admin-search_users');
    Route::get('/admin/view_user/{userId?}',[UserController::class, 'viewUser'])->name('admin-view_user');
    Route::post('/admin/update_user',[UserController::class, 'updateUser'])->name('admin-update_user');
    Route::post('/admin/delete_user',[UserController::class, 'deleteUser'])->name('admin-delete_user');

    // update login settings
    Route::get('/admin/adminsettings',[UserController::class, 'showSettingsForm'])->name('admin-view_settings');
    Route::post('/admin/adminsettings',[UserController::class, 'saveSettingsForm'])->name('admin-save_settings');

    //subcription related
    Route::get('/admin/listsubscription',[SubscriptionController::class, 'list'])->name('admin-listsubscription');
    Route::get('/admin/search_subscriptions',[SubscriptionController::class, 'search'])->name('admin-search_subscriptions');

    //paid Ads related
    Route::get('/admin/listpromotedads',[PaidAdsController::class, 'list'])->name('admin-listpromotedads');
    Route::get('/admin/search_promotedad',[PaidAdsController::class, 'search'])->name('admin-search_promotedad');

    Route::get('/admin/listads',[AdController::class, 'list'])->name('admin-listads');
    Route::get('/admin/search_ads',[AdController::class, 'search'])->name('admin-search_ads');
    Route::post('/admin/update_ad',[AdController::class, 'update'])->name('admin-update_ad');
    Route::post('/admin/deletead',[AdController::class, 'delete'])->name('admin-delete_ad'); // delete ad
    Route::get('/admin/adsdetail/{adId?}',[AdController::class, 'viewAd'])->name('admin-adsdetail');
    Route::post('/admin/update_ad/remove_adImage',[AdController::class, 'deleteImage'])->name('admin-ads_delete_image');
    Route::get('/admin/adsdetail_getmsg',[AdMessageController::class, 'get_msgs'])->name('admin-get_msgs_by_ad');

    Route::get('/admin/listexpectedads',[ExpectedBabieController::class,'list'])->name('admin-list_expectedads');
    Route::get('/admin/search_expectedads',[ExpectedBabieController::class,'search'])->name('admin-search_expectedads');
    Route::get('/admin/expectedad_detail/{adId}',[ExpectedBabieController::class,'view'])->name('admin-expectedad_detail');
    Route::post('/admin/update_expected_ad',[ExpectedBabieController::class,'update'])->name('admin-update_expectedads');
    
    Route::post('/admin/create_race',[RaceController::class, 'create'])->name('admin-create_race');
    Route::get('/admin/listrace',[RaceController::class, 'list'])->name('admin-listrace');
    Route::post('/admin/update_race',[RaceController::class, 'update'])->name('admin-update_race');
    Route::get('/admin/search_races',[RaceController::class, 'search'])->name('admin-search_races');
    Route::post('/admin/delete_race',[RaceController::class, 'delete'])->name('admin-delete_races');

    // kind management in admin
    Route::get('/admin/listkind',[KindController::class, 'list'])->name('admin-listkind');
    Route::post('/admin/create_kind',[KindController::class, 'create'])->name('admin-addkind');
    Route::post('/admin/update_kind',[KindController::class, 'update'])->name('admin-update_kind');
    Route::get('/admin/search_kind',[KindController::class, 'search'])->name('admin-search_kind');
    Route::post('/admin/delete_kind',[KindController::class, 'delete'])->name('admin-delete_kind');

    Route::get('/admin/listattributes',[AdAttributeController::class, 'list'])->name('admin-listattributes');
    Route::get('/admin/search_attributes',[AdAttributeController::class, 'search'])->name('admin-search_attributes');
    Route::post('/admin/create_attributes',[AdAttributeController::class, 'create'])->name('admin-create_attributes');
    Route::post('/admin/update_attribute_add_option',[AdAttributeController::class, 'add_options'])->name('admin-update_attribute_add_option');
    Route::post('/admin/attribute_delete_option',[AdAttributeController::class, 'delete_option'])->name('admin-attribute_delete_option');
    Route::post('/admin/attribute_update_option',[AdAttributeController::class, 'update_option'])->name('admin-attribute_update_option');
    Route::post('/admin/attribute_delete',[AdAttributeController::class, 'delete_attribute'])->name('admin-attribute_delete');
    Route::post('/admin/attribute_update',[AdAttributeController::class, 'update_attribute'])->name('admin-attribute_update');
});
    

