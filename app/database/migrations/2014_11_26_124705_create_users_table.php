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
	        	  'password'=>'$2y$10$F94TqsT0iNEi0vA005jbM.TteEQeK69C0qRyxR2vHFXsmPdOG4hY.',
	        	  'firstname'=>'admin',
	        	  'lastname' => 'admin',
	        	  'type' => 'admin'
	    	),
			array('email'=>'leerkracht@kdg.be',
	        	  'password'=>'$2y$10$u0sGKct7zR5StvNyggucIu.6UNuU8LtibPxP4f2sOAoparNEwSSrm',
	        	  'firstname'=>'leerkracht',
	        	  'lastname' => 'leerkracht',
	        	  'type' => 'teacher'
	    	),
			array('email'=>'student1@kdg.be',
	        	  'password'=>'$2y$10$RJEYygwORfCmw4VgDIk4POM.AeZrZo9igvgYnYtr5ES1FQUyyTXBa',
	        	  'firstname'=>'student1',
	        	  'lastname' => 'student1',
	        	  'type' => 'student'
	    	),
			array('email'=>'student2@kdg.be',
	        	  'password'=>'$2y$10$3QZLxWlssTTVLDWeUTcYH.Arm0.WpTpl6uP74ldtINasc5vauNJRq',
	        	  'firstname'=>'student2',
	        	  'lastname' => 'student2',
	        	  'type' => 'student'
	    	),
			array('email'=>'monitor@kdg.be',
	        	  'password'=>'$2y$10$W2hDFYo.Q1iQDuK8UfKbPuFgyuVREwENyo0wSGPp2VbhCp/oQk3J.',
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
