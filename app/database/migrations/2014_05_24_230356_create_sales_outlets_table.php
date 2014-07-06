<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOutletsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales_outlets',function($table)
      {
         $table->increments('id');
         $table->string('name');
         $table->string('address');
         $table->string('contact');
         $table->float('stock_cp')->default(0);
         $table->float('stock_sp')->default(0);
         $table->float('sales')->default(0);
         $table->float('deposit')->default(0);
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
		Schema::drop('sales_outlets');
	}

}
