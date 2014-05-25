<?php

class TypeTableSeeder extends Seeder {

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('types')->truncate();


      DB::table('types')->insert([
        ['name'=>'Handloom'],
        ['name'=>'Handicraft'],
      ]);

   }

}
