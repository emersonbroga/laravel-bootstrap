<?php

class AuthController extends Controller 
{
	/**
	 * Display the login view.
	 *
	 * @return Response
	 */
	public function login()
	{
		return View::make('auth.login');
	}

	/**
	 * Handle a POST request to sign in the user.
	 *
	 * @return Response
	 */
	public function postLogin()
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::action('AuthController@login')
            	->withErrors($validator)
            	->withInput();
        }

        $email = Input::get('email');
        $password = Input::get('password');
        $remember = Input::get('remember-me', 0);
        
        if(Auth::attempt(array('email' => $email, 'password' => $password), $remember))
        {	
        	// redirects the user to the admin dashboard.
            // return Redirect::intended('admin/dashboard');
            die('Welcome to the admin dashboard.');
        }

        return Redirect::action('AuthController@login')
        	->with('error', 'Invalid Credentials')
        	->withInput();

    }

	/**
	 * Logout the user and redirect to the login views
	 *
	 * @return Response
	 */
	public function logout()
    {
    	Auth::logout();
        return Redirect::action('AuthController@login')
        	->with('success', 'Successfully‎ logout. See you soon.');
    }

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function remind()
	{
		return View::make('auth.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$response = Password::remind(Input::only('email'), function($message)
		{
		    $message->subject('Password Reminder');
		});

		switch ($response)
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::back()->with('success', Lang::get($response));
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function reset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('auth.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::action('AuthController@login')
        				->with('success', 'Password changed successfully‎');
		}
	}

}