<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToSalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sales', function(Blueprint $table){
         $table->string('status')->after('outlet_id')->default('pending'); // pending, completed
         $table->float('total')->after('outlet_id');
         $table->float('paid')->after('outlet_id');
         $table->float('discount')->after('outlet_id')->default(0);
      });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
      Schema::table('sales', function(Blueprint $table){
         $table->dropColumn('status');
         $table->dropColumn('total');
         $table->dropColumn('paid');
         $table->dropColumn('discount');
      });
	}

}
