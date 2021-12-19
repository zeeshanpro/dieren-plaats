<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\AuthController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\Transaction\TransactionController;
use App\Http\Controllers\API\GiftType\GiftTypeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('verify_otp', [App\Http\Controllers\AuthController::class, 'mobileOtpVerify']);
Route::get('gift_types', GiftTypeController::class);
Route::middleware('auth:api')->group(function() {
    Route::get('profile', [UserController::class, 'getProfile']);
    Route::post('transaction/create', [TransactionController::class, 'create']);
});

//Route::post('login', 'AuthController@login');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
