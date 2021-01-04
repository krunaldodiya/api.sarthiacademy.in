<?php

use App\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    User::where('username', null)->update(['username' => Illuminate\Support\Str::random(8)]);
    return 'test';
});

Route::get('/exports/{table}', "ExportController@handle");

Route::get('/media/{media}', 'HomeController@getMediaFile');
