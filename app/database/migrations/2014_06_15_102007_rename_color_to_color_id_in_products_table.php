<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColorToColorIdInProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table){
         $table->dropColumn('color');
         $table->integer('color_id')->after('name')->nullable();
      });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
      Schema::table('products', function(Blueprint $table){
         $table->string('color')->after('name')->nullable();
         $table->dropColumn('color_id');
      });
	}

}
