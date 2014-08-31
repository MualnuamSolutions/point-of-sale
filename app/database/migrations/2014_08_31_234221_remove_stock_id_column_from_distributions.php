<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveStockIdColumnFromDistributions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('distributions',function(Blueprint $table){
    	 	$table->dropColumn('stock_id');
	 	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('distributions',function(Blueprint $table){
    	 	$table->integer('stock_id');
	 	});
	}

}
