<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInStockToStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('stocks', function(Blueprint $table){
         $table->integer('in_stock')->after('quantity')->default(0);
      });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('stocks', function(Blueprint $table){
         $table->dropColumn('in_stock');
      });
	}

}
