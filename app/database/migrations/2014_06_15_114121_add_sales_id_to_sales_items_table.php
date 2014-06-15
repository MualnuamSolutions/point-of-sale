<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalesIdToSalesItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sales_items', function(Blueprint $table){
         $table->integer('sales_id')->after('id');
         $table->float('total')->after('quantity');
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
         $table->dropColumn('sales_id');
         $table->dropColumn('total');
      });
	}

}
