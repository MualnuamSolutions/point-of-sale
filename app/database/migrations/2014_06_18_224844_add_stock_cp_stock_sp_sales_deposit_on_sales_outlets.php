<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStockCpStockSpSalesDepositOnSalesOutlets extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sales_outlets', function(Blueprint $table){
         $table->float('stock_cp')->default(0);
         $table->float('stock_sp')->default(0);
         $table->float('sales')->default(0);
         $table->float('deposit')->default(0);
      });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
      Schema::table('sales_outlets', function(Blueprint $table){
         $table->dropColumn('stock_cp');
         $table->dropColumn('stock_sp');
         $table->dropColumn('sales');
         $table->dropColumn('deposit');
      });
	}

}
