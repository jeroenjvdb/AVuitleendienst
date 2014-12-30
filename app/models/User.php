<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';

	protected $fillable =['email','password','firstname','lastname','type'];

	public static $rules = [
		"email"		=>	"required|unique:users,email",
		"password" 	=> 	"required|min:6",
		"firstname" => 	"required",
		"lastname" 	=> 	"required",
		"type"		=>	"required"
	];

	protected $hidden = array('password', 'remember_token');

	//Relatie met tabel messages
	public function messages()
    {
        return $this->hasMany('Message');
    }

    public $errormessages;

    public function isValid($data)
	{
		$validation = Validator::make($data, static::$rules);
		if ($validation->passes()) 
		{
			return true;
		}
		$this->errormessages = $validation->messages();
		return false;
	}


}
