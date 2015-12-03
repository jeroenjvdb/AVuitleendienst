<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('firstname');
			$table->string('lastname');
			$table->enum('type',['admin','teacher','student','monitor']);
			$table->timestamps();
			$table->rememberToken();
		});

		DB::table('users')->insert(array(
	        array('email'=>'admin@kdg.be',
	        	  'password'=>Hash::make('root'),
	        	  'firstname'=>'admin',
	        	  'lastname' => 'admin',
	        	  'type' => 'admin'
	    	),
			array('email'=>'leerkracht@kdg.be',
	        	  'password'=>Hash::make('root'),
	        	  'firstname'=>'leerkracht',
	        	  'lastname' => 'leerkracht',
	        	  'type' => 'teacher'
	    	),
			array('email'=>'student1@kdg.be',
	        	  'password'=>Hash::make('root'),
	        	  'firstname'=>'student1',
	        	  'lastname' => 'student1',
	        	  'type' => 'student'
	    	),
			array('email'=>'student2@kdg.be',
	        	  'password'=>Hash::make('root'),
	        	  'firstname'=>'student2',
	        	  'lastname' => 'student2',
	        	  'type' => 'student'
	    	),
			array('email'=>'monitor@kdg.be',
	        	  'password'=>Hash::make('root'),
	        	  'firstname'=>'monitor',
	        	  'lastname' => 'monitor',
	        	  'type' => 'monitor'
	    	)
	    	));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
