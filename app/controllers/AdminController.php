<?php

class AdminController extends BaseController
{
    public function dashboard()
    {   
        die('Welcome to the admin dashboard. <a href="/logout">Logout</a> | '. Auth::user()->email);

    }
}