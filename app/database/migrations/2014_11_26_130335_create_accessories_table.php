<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accessories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer("fk_mastermaterial")->unsigned();
			$table->foreign("fk_mastermaterial")
						->references("id")
						->on("materials")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->integer("fk_slavematerial")->unsigned();
			$table->foreign("fk_slavematerial")
						->references("id")
						->on("materials")
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
		Schema::drop('accessories');
	}

}
