<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products',function($table)
      {
         $table->increments('id');
         $table->string('barcode');
         $table->string('name');
         $table->integer('type_id');
         $table->integer('unit_id');
         $table->float('cp');
         $table->float('sp');
         $table->integer('quantity');
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
		Schema::drop('products');
	}

}
