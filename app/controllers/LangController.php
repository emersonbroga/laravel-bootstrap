<?php

class LangController extends BaseController
{
    public function change($lang)
    {   
        Session::put('locale', $lang);
        App::setLocale($lang);
        return Redirect::back();
    }
}