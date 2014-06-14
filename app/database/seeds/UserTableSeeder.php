<?php

class UserTableSeeder extends Seeder {
   public function run()
   {
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
   }

}
