<?php

class UserTableSeeder extends Seeder {
   public function run()
   {
      // Create the super user
      $user = Sentry::createUser([
         'email'   =>'alanpachuau@gmail.com',
         'password'  => 'pass',
         'activated' => 1,
         'permissions' => ['superuser' => 1]
      ]);

      // Create the super user
      $user = Sentry::createUser([
         'email'   =>'remasailo@gmail.com',
         'password'  => 'pass',
         'activated' => 1,
         'permissions' => ['superuser' => 1]
      ]);

      // Create the super user
      $user = Sentry::createUser([
        'email'   =>'manager@mail.com',
        'password'  => 'pass',
        'activated' => 1,
        'permissions' => ['superuser' => 1]
       ]);
   }

}
