<?php namespace Mualnuam;
use Sentry;
class Permission
{
   public static function getPermissions($type = null)
   {
      $permissions = [
         'Manager' => [
            'sales.index' => 1,
            'sales.edit' => 1,
            'sales.remove' => 1,
            'stocks.index' => 1,
            'home' => 1,
         ],

         'Store Manager' => [
            'sales.create' => 1,
            'sales.index' => 1,
            'sales.edit' => 1,
            'sales.remove' => 1,
            'stocks.create' => 1,
            'stocks.index' => 1,
            'products.index' => 1,
         ],

         'Sales Person' => [
            'sales.create' => 1,
            'sales.index' => 1,
            'sales.edit' => 1
         ]
      ];

      return $permissions;
   }

   public static function revoke()
   {
      $lists = self::getPermissions();

      foreach($lists as $groupName => $list) {
         $group = Sentry::findGroupByName($groupName);
         $group->permissions = $list;
         $group->save();
      }

      return $lists;
   }
}
