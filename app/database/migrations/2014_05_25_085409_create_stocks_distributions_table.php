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
		Schema::create('stocks_distributions',function($table)
                {
                   $table->increments('id');
                   $table->integer('product_id');
                   $table->integer('outlet_id');
                   $table->float('cp');
                   $table->float('sp');
                   $table->integer('qnty');	
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
		Schema::drop('stocks_distributions');
	}

}
