<?php

class Reservationmaterial extends Eloquent {

	protected $fillable =['fk_materialsid','fk_reservationsid','datecheckedin', 'datecheckedout'];
}