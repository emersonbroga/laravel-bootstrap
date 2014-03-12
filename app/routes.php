<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Home
Route::get('/', 'HomeController@showWelcome');

// Auth routes
Route::get('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::post('/login', 'AuthController@postLogin');
Route::get('/remind', 'AuthController@remind');
Route::post('/remind', 'AuthController@postRemind');
Route::get('/password/reset/{token?}', 'AuthController@reset');
Route::post('/password/reset/{token?}', 'AuthController@postReset');

// Protected Routes
Route::group(array('before' => 'auth'), function(){

    // put your protected routes here
    // Route::get('/admin', 'AdminController@dashboard');


});



