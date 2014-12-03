<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';

	protected $fillable =['email','password','firstname','lastname','type'];

	protected $hidden = array('password', 'remember_token');

	public function messages()
    {
        return $this->hasMany('Message');
    }

}
