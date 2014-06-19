<?php
class GroupTableSeeder extends Seeder
{
   public function run()
   {
      DB::table('groups')->truncate();

      $admin = Sentry::createGroup(
         array(
         'name'        => 'Manager',
         'permissions' => []
      ));

      $staff = Sentry::createGroup(
         array(
         'name'        => 'Store Manager',
         'permissions' => []
      ));

      $staff = Sentry::createGroup(
         array(
         'name'        => 'Sales Person',
         'permissions' => []
      ));

      \Mualnuam\Permission::revoke();
   }
}
