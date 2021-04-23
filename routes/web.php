<?php

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
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Auth::routes();
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', 'HomeController@index')->name('users');
    Route::post('/send_request', 'HomeController@create')->name('sendrequest');
    Route::post('/accept_request', 'HomeController@accept')->name('accept_request');
    Route::get('/requests', 'HomeController@requests')->name('requests');
    Route::get('/friends', 'HomeController@friends')->name('friends');
    Route::get('/profile', 'UserController@edit_profile')->name('profile');
    Route::resource('user', 'UserController');
});
