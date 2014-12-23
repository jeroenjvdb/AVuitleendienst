<?php

class Reservation extends Eloquent {

	protected $fillable =['begin','end','reason'];

	public static $rules=[
        'end' => 'required'
    ];

	public function isValid()
    {
    	$validation =Validator::make($this->attributes,static::$rules);
        
        if($validation->passes()) return true;
        
        $this->errors =$validation->messages();
        return false;
    }

    public function saveReservationMaterial($resId,$matId)
    {
    	DB::table('reservationmaterials')->insert(
			    array('fk_materialsid' => $matId,
			     'fk_reservationsid' => $resId)
			);
    }

    public function saveReservationUser($resId,$userId,$type)
    {
    	DB::table('reservationusers')->insert(
			    array('fk_usersid' => $userId,
			     'fk_reservationsid' => $resId,
			     'type' => $type,
			     'usercheckedin' => Auth::id(),
			     'usercheckedout' => Auth::id())
			);
    }
}