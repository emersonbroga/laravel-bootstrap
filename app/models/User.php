<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Base implements UserInterface, RemindableInterface {

	const ROLE_USER = 1;
	//you can place other roles here.
	const ROLE_ADMIN = 100;


    protected $guarded = array();
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function isRoot()
    {
    	return ($this->role == self::ROLE_ADMIN);
    }

    public static function getRoleOptions()
    {
    	$options = array();
    	$reflection = new ReflectionClass('User');
    	$constants = $reflection->getConstants();

    	foreach($constants as $key => $value){
    		if(starts_with( $key, 'ROLE_')){
    			$key = str_replace('ROLE_', '', $key);
    			$key = str_replace('_', ' ', $key);
    			$options[$value] = ucwords(strtolower($key));
    		}
    	}
    	return $options;
	}

}