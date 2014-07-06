<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales_items',function($table)
      {
         $table->increments('id');
         $table->integer('sales_id');
         $table->integer('product_id');
         $table->integer('stock_id');
         $table->float('cp');
         $table->float('sp');
         $table->integer('quantity');
         $table->float('total');
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
		Schema::drop('sales_items');
	}

}
