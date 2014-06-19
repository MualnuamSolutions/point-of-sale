<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

      $this->call('OptionTableSeeder');
      $this->call('GroupTableSeeder');
		$this->call('OutletTableSeeder');
      $this->call('TypeTableSeeder');
      $this->call('UserTableSeeder');
	}

}
