<?php

class Reservation extends Eloquent {

	protected $fillable =['begin','end','reason'];

	public static $rules=[
        'end' => 'required|after:begin'
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

    public function getMaterialStatus($id)
    {
        $results = DB::table('reservationmaterials')
                ->join('reservations','reservationmaterials.fk_reservationsid','=','reservations.id')
                ->join('reservationusers','reservationusers.fk_reservationsid','=','reservations.id')
                ->join('users','reservationusers.fk_usersid','=','users.id')
                ->select('reservations.begin','reservations.end','users.firstname','users.lastname')
                ->where('reservationmaterials.fk_materialsid','=',$id)
                ->where('reservationusers.type','=','Hoofdverantwoordelijk')
                ->get();
        $reservations  = array();
        foreach($results as $result)
        {
            for($startDate = $result->begin; $startDate <= $result->end;$startDate = date("Y-m-d H:i:s", strtotime('+30 minutes', strtotime($startDate))))
            {
               $reservations[$startDate] = array($result->firstname.' '.$result->lastname); 
            }
            
        }
        return $reservations;
    }

    public function getAllReservedDatesArray($id)
    {
        $results = $this->getAllReservedDates($id);
        $reservations  = array();
        foreach($results as $result)
        {
            for($startDate = $result->begin; $startDate <= $result->end;$startDate = date("Y-m-d H:i:s", strtotime('+30 minutes', strtotime($startDate))))
            {
               $reservations[] =  $startDate;
            }
            
        }
        return $reservations;
    }

    public function getAllReservedDates($id)
    {
        return DB::table('reservationmaterials')
                ->join('reservations','reservationmaterials.fk_reservationsid','=','reservations.id')
                ->join('reservationusers','reservationusers.fk_reservationsid','=','reservations.id')
                ->join('users','reservationusers.fk_usersid','=','users.id')
                ->select('reservations.begin','reservations.end')
                ->where('reservationmaterials.fk_materialsid','=',$id)
                ->get();
    }

    public function checkReservationCollision($begin,$end,$id)
    {
        $reservedDates = $this->getAllReservedDates($id);
        $collision = false;
        foreach($reservedDates as $reservedDate)
        {
            if(($begin > $reservedDate->begin && $begin < $reservedDate->end) ||
                ($end > $reservedDate->begin && $end < $reservedDate->end) ||
                ($begin > $reservedDate->begin && $end < $reservedDate->end) ||
                ($begin < $reservedDate->begin && $end > $reservedDate->end))
            {
                $collision = true;
            }
        }

        return $collision;
    }
}