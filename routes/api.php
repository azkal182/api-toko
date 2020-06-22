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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('user/details', 'Api\UserController@details');
    Route::get('member/index', 'MemberController@index');
    Route::get('member/{id}', 'MemberController@DetailDebt');
    Route::post('member/add', 'MemberController@store');
    Route::post('member/update/{id}', 'MemberController@update');
    Route::post('member/delete/{id}', 'MemberController@destroy');

    // use Guzzlehttp/Client;
    // use GuzzleHttp/Client;

});