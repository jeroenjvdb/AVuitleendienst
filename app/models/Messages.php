<?php

class Message extends Eloquent {

	protected $fillable =['title','message','status','fk_usersid','fk_materialsid'];

	public function users()
    {
        return $this->belongsTo('User', 'fk_usersid');
    }

    public function materials()
    {
        return $this->belongsTo('Material', 'fk_materialsid');
    }
}