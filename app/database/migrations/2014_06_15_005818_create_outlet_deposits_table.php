<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletDepositsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('outlet_deposits',function($table)
      {
         $table->increments('id');
         $table->integer('outlet_id');
         $table->float('deposit_amt');
         $table->float('refference_no')->nullable();
         $table->enum('status', array('Pending', 'Approved','Reject'))->default('Pending');// approval for manager (approved/not approved)
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
		Schema::drop('outlet_deposits');
	}

}
