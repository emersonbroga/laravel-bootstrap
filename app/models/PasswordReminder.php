<?php

class PasswordReminder extends Base
{
    protected $table = 'password_reminders';

    protected $guarded = array();

    public $timestamps = false;
}
