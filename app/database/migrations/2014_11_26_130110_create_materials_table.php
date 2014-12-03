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
			$table->string('barcode')->unique();
			$table->timestamps();
		});

		DB::table('materials')->insert(array(
	        array('name'=>'micro 1',
	        	  'details'=>'dit is de eerste microfoon',
	        	  'status'=>'ok',
	        	  'image' => 'micro.png',
	        	  'barcode' => '4568'
	    	),
			array('name'=>'micro 2',
	        	  'details'=>'dit is de tweede microfoon',
	        	  'status'=>'ok',
	        	  'image' => 'micro.png',
	        	  'barcode' => '5689'
	    	),
			array('name'=>'camera 1',
	        	  'details'=>'dit is de eerste camera',
	        	  'status'=>'ok',
	        	  'image' => 'camera.png',
	        	  'barcode' => '1234'
	    	),
			array('name'=>'camera 2',
	        	  'details'=>'dit is de tweede camera',
	        	  'status'=>'ok',
	        	  'image' => 'camera.png',
	        	  'barcode' => '2345'
	    	),
			array('name'=>'statief 1',
	        	  'details'=>'dit is het eerste statief',
	        	  'status'=>'ok',
	        	  'image' => 'statief.png',
	        	  'barcode' => '3456'
	    	),
	    	array('name'=>'statief 2',
	        	  'details'=>'dit is het tweede statief',
	        	  'status'=>'ok',
	        	  'image' => 'statief.png',
	        	  'barcode' => '9456'
	    	),
	    	array('name'=>'kabelset 1',
	        	  'details'=>'bevat verschillende kabels',
	        	  'status'=>'ok',
	        	  'image' => 'kabelset.png',
	        	  'barcode' => '1956'
	    	),
	    	array('name'=>'kabelset 2',
	        	  'details'=>'bevat verschillende kabels',
	        	  'status'=>'ok',
	        	  'image' => 'kabelset.png',
	        	  'barcode' => '7556'
	    	),
	    	));
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
