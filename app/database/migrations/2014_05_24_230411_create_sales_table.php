<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales',function($table)
      {
         $table->increments('id');
         $table->string('reference_no');
         $table->integer('customer_id')->nullable()->default(0);
         $table->integer('outlet_id');
         $table->string('status')->default('pending'); // pending, completed
         $table->float('total');
         $table->float('paid');
         $table->float('discount')->default(0);
         $table->text('notes')->nullable();
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
		Schema::drop('sales');
	}

}
