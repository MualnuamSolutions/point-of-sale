<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksDistributionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('distributions',function($table)
      {
         $table->increments('id');
         $table->integer('stock_id');
         $table->integer('product_id');
         $table->integer('outlet_id');
         $table->integer('quantity');
         $table->integer('in_stock')->default(0);
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
		Schema::drop('distributions');
	}

}
