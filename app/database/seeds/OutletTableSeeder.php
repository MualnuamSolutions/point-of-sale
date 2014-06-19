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
        ['name'=>'Thenzawl', 'address' => '', 'contact' => '1231231232'],
        ['name'=>'Lunglei', 'address' => '', 'contact' => '3131313235'],
        ['name'=>'Lengpui', 'address' => '', 'contact' => '4343434332'],
      ]);

   }

}
