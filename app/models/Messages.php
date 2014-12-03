<?php

class Message extends Eloquent {

	protected $fillable =['title','message','status','fk_usersid','fk_materialsid'];
}