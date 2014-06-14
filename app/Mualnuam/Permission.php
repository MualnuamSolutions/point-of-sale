<?php namespace Mualnuam;
class Permission
{
   public static function list($type = null)
   {
      $permissions = [
         'Manager' => [

         ],

         'Store Manager' => [
            'sales.create' => 1,
            'sales.index' => 1,
            'sales.edit' => 1,
            'sales.remove' => 1,
         ],

         'Sales Person' => [
            'sales.create' => 1,
            'sales.index' => 1,
            'sales.edit' => 1
         ]
      ];
   }
}
