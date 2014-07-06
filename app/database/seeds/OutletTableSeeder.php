<?php

class OutletTableSeeder extends Seeder {

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('sales_outlets')->truncate();


      DB::table('sales_outlets')->insert([
        ['name'=>'Chaltlang Main Office', 'address' => 'Chaltlang', 'contact' => '1231231232'],
        ['name'=>'Millenium Centre', 'address' => 'Dawpui AizAWL', 'contact' => '1231231232'],
        ['name'=>'Thenzawl', 'address' => 'Thenzawl', 'contact' => '1231231232'],
        ['name'=>'Lunglei', 'address' => 'Lunglei', 'contact' => '3131313235'],
        ['name'=>'Lengpui Airport', 'address' => 'Lengpui', 'contact' => '4343434332'],
      ]);

   }

}
