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
         $table->string('product_code');
         $table->string('name');
         $table->integer('color_id')->nullable();
         $table->float('cp');
         $table->float('sp');
         $table->integer('type_id');
         $table->integer('unit_id');
         $table->integer('quantity')->default(0);
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
