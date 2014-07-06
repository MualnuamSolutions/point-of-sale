<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table){
         $table->dropColumn('first_name');
         $table->dropColumn('last_name');
         $table->string('name');
         $table->string('phone')->nullable();
         $table->text('address')->nullable();
         $table->integer('outlet_id')->default(0);
      });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
      Schema::table('users', function(Blueprint $table){
         $table->dropColumn('name');
         $table->dropColumn('phone');
         $table->dropColumn('address');
         $table->dropColumn('outlet_id');
         $table->string('first_name')->nullable();
         $table->string('last_name')->nullable();
      });
	}

}
