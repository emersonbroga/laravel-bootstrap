<?php

// display view names
// View::composer('*', function($view){
// 	print_r($view->getName());
// });

View::composer(['admin.*'], function($view)
{
	$user = (Auth::check()) ? Auth::user() : null;
	$view->with(compact('user','isRoot'));

});