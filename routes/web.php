<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Http;

// $coba = Http::get('http://127.0.0.1:8000/tes');
// dd($coba);

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/tes', 'MemberController@index');
Route::get('/tes2', 'MemberController@index2');
Route::get('/tes3', 'MemberController@index3');

