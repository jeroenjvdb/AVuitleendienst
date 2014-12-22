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

		DB::table('accessories')->insert(array(
	        array('fk_mastermaterial' => '1',
	        	  'fk_slavematerial' => '7'),
			array('fk_mastermaterial' => '1',
	        	  'fk_slavematerial' => '8'),
			array('fk_mastermaterial' => '2',
	        	  'fk_slavematerial' => '7'),
			array('fk_mastermaterial' => '2',
	        	  'fk_slavematerial' => '8'),
			array('fk_mastermaterial' => '3',
	        	  'fk_slavematerial' => '5'),
			array('fk_mastermaterial' => '3',
	        	  'fk_slavematerial' => '6'),
			array('fk_mastermaterial' => '4',
	        	  'fk_slavematerial' => '5'),
			array('fk_mastermaterial' => '4',
	        	  'fk_slavematerial' => '6'),
			array('fk_mastermaterial' => '7',
	        	  'fk_slavematerial' => '1'),
			array('fk_mastermaterial' => '8',
	        	  'fk_slavematerial' => '1'),
			array('fk_mastermaterial' => '7',
	        	  'fk_slavematerial' => '2'),
			array('fk_mastermaterial' => '8',
	        	  'fk_slavematerial' => '2'),
			array('fk_mastermaterial' => '5',
	        	  'fk_slavematerial' => '3'),
			array('fk_mastermaterial' => '6',
	        	  'fk_slavematerial' => '3'),
			array('fk_mastermaterial' => '5',
	        	  'fk_slavematerial' => '4'),
			array('fk_mastermaterial' => '6',
	        	  'fk_slavematerial' => '4'),
	    	));
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
