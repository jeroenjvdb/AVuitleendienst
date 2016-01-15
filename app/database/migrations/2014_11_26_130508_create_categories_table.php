<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->softDeletes();
			$table->timestamps();
		});

		DB::table('categories')->insert(array(
	        array('name'=>'microfoons'),
			array('name'=>"camera's"),
			array('name'=>'statieven'),
			array('name'=>'kabelset'),
	    	));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
