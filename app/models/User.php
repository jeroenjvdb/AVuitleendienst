<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';

	protected $fillable =['email','password','firstname','lastname','type'];

	public static $rules=[
        "email"		=>	"required|email|unique:users,email",
		"password" 	=> 	"required|min:6",
		"type"		=>	"required",
		"firstname"	=>	"required",
		"lastname"	=> 	"required"
    ];

    public static $rules_edit=[
		"type"		=>	"required",
		"firstname"	=>	"required",
		"lastname"	=> 	"required"
    ];

	protected $hidden = array('password', 'remember_token');

	public function users()
    {
        return $this->belongsToMany('User','reservationusers','fk_usersid','fk_reservationsid');
    }
    
	public function messages()
    {
        return $this->hasMany('Message');
    }

    public function reservations()
    {
    	return $this->hasMany('Reservation');
    }

    public $errormessages;

    public function isValid($data)
	{
		//Make a validation for my register form
		$validation = Validator::make($data, static::$rules);
		//Check if the validation passes
		if ($validation->passes()) 
		{
			return true;
		}

		//The validation did not pass, so update the error messages en return false
		$this->errormessages = $validation->messages();
		return false;
	}

	public function isValidEdit($data)
	{
		//Make a validation for my register form
		$validation = Validator::make($data, static::$rules_edit);
		//Check if the validation passes
		if ($validation->passes()) 
		{
			return true;
		}

		//The validation did not pass, so update the error messages en return false
		$this->errormessages = $validation->messages();
		return false;
	}

	public function isAdmin()
	{
		if($this->type == 'admin')
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}
