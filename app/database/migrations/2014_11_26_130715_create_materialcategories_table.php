<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialcategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('materialcategories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer("fk_materialsid")->unsigned();
			$table->foreign("fk_materialsid")
						->references("id")
						->on("materials")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->integer("categories")->unsigned();
			$table->foreign("categories")
						->references("id")
						->on("categories")
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
		Schema::drop('materialcategories');
	}

}
