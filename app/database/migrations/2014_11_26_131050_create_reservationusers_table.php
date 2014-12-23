<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationusersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservationusers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer("fk_usersid")->unsigned();
			$table->foreign("fk_usersid")
						->references("id")
						->on("users")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->integer("fk_reservationsid")->unsigned();
			$table->foreign("fk_reservationsid")
						->references("id")
						->on("reservations")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->enum('type',['Hoofdverantwoordelijk','verantwoordelijk']);
			$table->integer("usercheckedin")->unsigned();
			$table->foreign("usercheckedin")
						->references("id")
						->on("users")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->integer("usercheckedout")->unsigned();
			$table->foreign("usercheckedout")
						->references("id")
						->on("users")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reservationusers');
	}

}
