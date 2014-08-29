<?php
// HEI HI A PAIH THEIH IN KA HRIA. HE TABLE HI KAN MAMAWH LO IN A LANG
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales_customers',function($table)
      {
         $table->increments('id');
         $table->integer('sales_id');
         $table->integer('customer_id');
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
		Schema::drop('sales_customers');
	}

}
