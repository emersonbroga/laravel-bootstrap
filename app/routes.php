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
Route::get('/', 'HomeController@');
Route::get('/', array('uses' => 'HomeController@showWelcome', 'as' => 'home.welcome'));


// Auth routes
Route::get('/login', array('uses' => 'AuthController@login', 'as' => 'auth.login'));
Route::get('/logout', array('uses' => 'AuthController@logout', 'as' => 'auth.logout'));
Route::post('/login', array('uses' => 'AuthController@postLogin', 'as' => 'auth.postLogin'));
Route::get('/remind', array('uses' => 'AuthController@remind', 'as' => 'auth.remind'));
Route::post('/remind', array('uses' => 'AuthController@postRemind', 'as' => 'auth.postRemind'));
Route::get('/password/reset/{token?}', array('uses' => 'AuthController@reset', 'as' => 'auth.reset'));
Route::post('/password/reset/{token?}', array('uses' => 'AuthController@postReset', 'as' => 'auth.postReset'));

// Protected Routes
Route::group(array('before' => 'auth', 'prefix' => 'admin'), function(){

    // put your protected routes here
    Route::get('/', array('uses' => 'AdminController@dashboard', 'as' => 'admin.dashboard'));

    // users
    Route::resource('users', 'AdminUsersController', array('names' => array(
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    )));


});



