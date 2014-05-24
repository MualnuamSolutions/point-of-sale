<?php
class GroupTableSeeder extends Seeder
{
   public function run()
   {
      DB::table('groups')->truncate();

      $admin = Sentry::createGroup(
         array(
         'name'        => 'Admin',
         'permissions' => []
      ));

      $staff = Sentry::createGroup(
         array(
         'name'        => 'Manager',
         'permissions' => []
      ));

      $staff = Sentry::createGroup(
         array(
         'name'        => 'Sales',
         'permissions' => []
      ));

      $staff = Sentry::createGroup(
         array(
         'name'        => 'Public',
         'permissions' => [
            'user.login' => 1,
            'user.doLogin' => 1
         ]
      ));
   }
}
