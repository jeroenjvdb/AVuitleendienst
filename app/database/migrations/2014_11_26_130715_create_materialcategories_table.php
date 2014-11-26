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
			$table->integer("fk_categoriesid")->unsigned();
			$table->foreign("fk_categoriesid")
						->references("id")
						->on("categories")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->timestamps();
		});

			DB::table('materialcategories')->insert(array(
	        array('fk_materialsid' => '1',
	        	  'fk_categoriesid' => '1'),
			array('fk_materialsid' => '2',
	        	  'fk_categoriesid' => '1'),
			array('fk_materialsid' => '3',
	        	  'fk_categoriesid' => '2'),
			array('fk_materialsid' => '4',
	        	  'fk_categoriesid' => '2'),
			array('fk_materialsid' => '5',
	        	  'fk_categoriesid' => '3'),
			array('fk_materialsid' => '6',
	        	  'fk_categoriesid' => '3'),
			array('fk_materialsid' => '7',
	        	  'fk_categoriesid' => '4'),
			array('fk_materialsid' => '8',
	        	  'fk_categoriesid' => '4'),
	    	));
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
