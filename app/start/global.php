<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/
App::error(function(Exception $exception, $code){

	Log::error($exception);

    // assumes you have app/views/errors/401.blade.php, etc
    $view = "errors/$code";

    if (!View::exists($view)){
    	$view = 'errors/404';
    }

    $data = array('code' => $code, 'exception' => $exception);

    switch ($code) {
		case 401:
		return Response::view($view, $data, $code);

		case 403:
		return Response::view($view, $data, $code);

		case 500:
		return Response::view($view, $data, $code);

		case 404:
		default:
		return Response::view($view, $data, $code);
	}

});

App::error(function(\Illuminate\Session\TokenMismatchException $exception, $code){
	$data = array();
	return Response::view('errors/token', $data, $code);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';
require app_path().'/helpers.php';
require app_path().'/bind.php';


// locale
App::setLocale(Session::get('locale', Config::get('app.locale')));
