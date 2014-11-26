<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('message');
			$table->enum('status',['solved','unsolved']);
			$table->integer("fk_usersid")->unsigned();
			$table->foreign("fk_usersid")
						->references("id")
						->on("users")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->integer("fk_materialsid")->unsigned();
			$table->foreign("fk_materialsid")
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
		Schema::drop('messages');
	}

}
