<?php

class OptionTableSeeder extends Seeder {

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('options')->truncate();


      DB::table('options')->insert(array(
         array('option_key'=>'site_title', 'option_title'=>'Site Title', 'option_data'=>'ZOHANDCO Point of Sale'),
         array('option_key'=>'site_name', 'option_title'=>'Site Name', 'option_data'=>'ZOHANDCO PoS'),
         ));

   }

}
