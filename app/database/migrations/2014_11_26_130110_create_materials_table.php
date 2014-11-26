<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('materials', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('details');
			$table->enum('status',['ok','missing','broken']);
			$table->string('image');
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
		Schema::drop('materials');
	}

}
