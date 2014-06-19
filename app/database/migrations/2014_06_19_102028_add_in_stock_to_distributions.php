<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInStockToDistributions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('distributions', function(Blueprint $table){
         $table->dropColumn('cp');
         $table->dropColumn('sp');
         $table->integer('stock_id')->after('id');
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
      Schema::table('distributions', function(Blueprint $table){
         $table->float('cp');
         $table->float('sp');
         $table->dropColumn('stock_id');
         $table->dropColumn('in_stock');
      });
	}

}
