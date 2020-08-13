<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest:api')->post('/otp/request', 'OtpController@requestOtp');
Route::middleware('guest:api')->post('/otp/verify', 'OtpController@verifyOtp');

Route::middleware('auth:sanctum')->post('/upload/avatar', 'UserController@uploadAvatar');

Route::middleware('auth:sanctum')->post('/feedback/send', 'FeedbackController@send');

Route::middleware('auth:sanctum')->get('/categories/all', 'CategoryController@getCategories');

Route::middleware('auth:sanctum')->get('/notifications/all', 'NotificationController@getNotifications');
Route::middleware('auth:sanctum')->post('/notifications/read', 'NotificationController@markAsRead');

Route::middleware('auth:sanctum')->post('/users/token', 'UserController@setToken');
Route::middleware('auth:sanctum')->post('/users/update', 'UserController@updateProfile');
Route::middleware('auth:sanctum')->get('/users/me', 'UserController@me');

Route::middleware('auth:sanctum')->post('/subscriptions/update', 'SubscriptionController@update');

Route::get('/test/users', 'TestController@testUsers');
Route::get('/test/auth', 'TestController@testAuth');
Route::get('/test/notification', 'TestController@testNotification');
