<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationmaterialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservationmaterials', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer("fk_materialsid")->unsigned();
			$table->foreign("fk_materialsid")
						->references("id")
						->on("materials")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->integer("fk_reservationsid")->unsigned();
			$table->foreign("fk_reservationsid")
						->references("id")
						->on("reservations")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->datetime('datecheckedin');
			$table->datetime('datecheckedout');
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
		Schema::drop('reservationmaterials');
	}

}
