<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletStockReturnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('outlets_stocks_returns',function($table)
      {
         $table->increments('id');
         $table->integer('product_id');
         $table->integer('outlet_id');
         $table->integer('quantity');
         $table->enum('status', array('Pending...','Approved', 'Rejected'));
         $table->string('comment');
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
		Schema::drop('outlets_stocks_returns');
	}

}
