<?php

class AdminController extends \AdminBaseController
{
    public function dashboard()
    {   


        return View::make('admin.dashboard');
        //die('Welcome to the admin dashboard. <a href="/logout">Logout</a> | '. Auth::user()->email);

    }
}