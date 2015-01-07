<?php

class Reservationuser extends Eloquent {

	protected $fillable =['fk_usersid','fk_reservationsid','usercheckedin', 'usercheckedout'];
}