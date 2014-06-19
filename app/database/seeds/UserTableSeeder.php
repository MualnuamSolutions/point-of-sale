<?php

class UserTableSeeder extends Seeder {
   public function run()
   {
      $manager = Sentry::findGroupByName('Manager');
      $storeManager = Sentry::findGroupByName('Store Manager');
      $salesPerson = Sentry::findGroupByName('Sales Person');

      // Create the super user
      $user = Sentry::createUser([
         'email' =>'alanpachuau@gmail.com',
         'name' =>'Alan Pachuau',
         'password'  => 'pass',
         'activated' => 1,
         'permissions' => ['superuser' => 1]
      ]);

      // Create the super user
      $user = Sentry::createUser([
         'email' => 'remasailo@gmail.com',
         'name' => 'Rema Sailo',
         'password' => 'pass',
         'activated' => 1,
         'permissions' => ['superuser' => 1]
      ]);

      $user = Sentry::createUser([
         'email' => 'larislhmar@gmail.com',
         'name' => 'Lalrinsanga',
         'password' => 'pass',
         'activated' => 1,
         'permissions' => ['superuser' => 1]
      ]);

      $user = Sentry::createUser([
         'email' => 'manager@mail.com',
         'name' => 'Manager',
         'password' => 'pass',
         'activated' => 1,
         'permissions' => []
      ]);
      $user->addGroup($manager);

      $user = Sentry::createUser([
         'email' => 'storemanager@gmail.com',
         'name' => 'Store Manager',
         'password' => 'pass',
         'outlet_id' => 1,
         'activated' => 1,
         'permissions' => []
      ]);
      $user->addGroup($storeManager);

      $user = Sentry::createUser([
         'email' => 'salesperson@gmail.com',
         'name' => 'Sales Manager',
         'password' => 'pass',
         'outlet_id' => 1,
         'activated' => 1,
         'permissions' => []
      ]);
      $user->addGroup($salesPerson);
   }

}
