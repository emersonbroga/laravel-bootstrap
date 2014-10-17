<?php

class AdminBaseController extends \BaseController
{ 
    protected $user;
    /**
      * Check the CSRF filter before the post, delete and put requests
      * @return void
      */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));

        $this->user = Auth::user();
    }

    /**
      * Setup the layout used by the controller.
      * @return void
      */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

}
