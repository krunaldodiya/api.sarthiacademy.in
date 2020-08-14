<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:api')->post('/otp/request', 'OtpController@requestOtp');
Route::middleware('guest:api')->post('/otp/verify', 'OtpController@verifyOtp');

Route::middleware('auth:sanctum')->post('/upload/avatar', 'UserController@uploadAvatar');

Route::middleware('auth:sanctum')->post('/feedback/send', 'FeedbackController@send');

Route::middleware('auth:sanctum')->get('/courses/all', 'CourseController@getCourses');
Route::middleware('auth:sanctum')->get('/courses/materials', 'CourseController@getCourseMaterials');

Route::middleware('auth:sanctum')->get('/notifications/all', 'NotificationController@getNotifications');
Route::middleware('auth:sanctum')->post('/notifications/read', 'NotificationController@markAsRead');

Route::middleware('auth:sanctum')->post('/users/token', 'UserController@setToken');
Route::middleware('auth:sanctum')->post('/users/update', 'UserController@updateProfile');
Route::middleware('auth:sanctum')->get('/users/me', 'UserController@me');

Route::middleware('auth:sanctum')->post('/subscriptions/update', 'SubscriptionController@update');
