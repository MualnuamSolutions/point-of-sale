<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveStockIdFromSales extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sales_items', function(Blueprint $table){
			$table->dropColumn('stock_id');
			$table->string('discount_type')->after('total');
			$table->float('discount_amount')->after('total');
			$table->float('discount_total')->after('total');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sales_items', function(Blueprint $table){
			$table->integer('stock_id');
			$table->dropColumn('discount_type');
			$table->dropColumn('discount_amount');
			$table->dropColumn('discount_total');
		});
	}

}
