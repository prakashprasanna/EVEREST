<?php

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
    return view('home');
});

Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginPage')->name('login');

Route::group(['middleware' => 'prevent-back-history'],function()
{

      Route::get('/dashboard', 'App\Http\Controllers\Auth\LoginController@showDashBoard');
      //  ->middleware(['auth']);

});

Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
 
Route::get('login/{provider}', 'App\Http\Controllers\Auth\LoginController@auth')
    ->where(['provider' => 'facebook|google|twitter']);
 
Route::get('login/{provider}/callback', 'App\Http\Controllers\Auth\LoginController@login')
    ->where(['provider' => 'facebook|google|twitter']);

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
