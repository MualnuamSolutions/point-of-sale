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
                'stocks.create' => 1,
                'stocks.index' => 1,
                'stocks.edit' => 1,
                'stocks.store' => 1,
                'stocks.update' => 1,
                'stocks.destroy' => 1,
                'products.index' => 1,
                'discounts.index' => 1,
                'discounts.create' => 1,
                'discounts.store' => 1,
                'discounts.edit' => 1,
                'discounts.update' => 1,
                'discounts.destroy' => 1,
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
                'stockreturns.edit' => 1,
                'discounts.index' => 1,
                'home' => 1,

            ],

            'Sales Person' => [
                'sales.create' => 1,
                'sales.index' => 1,
                'sales.edit' => 1,
                'stockreturns.index' => 1,
                'stockreturns.edit' => 1,
                'stockreturns.return' => 1,
                'stockreturns.store' => 1,
                'stocks.index' => 1,
                'discounts.index' => 1,
                'home' => 1,
            ]
        ];

        return $permissions;
    }

    public static function revoke()
    {
        $lists = self::getPermissions();

        foreach ($lists as $groupName => $list) {
            $group = Sentry::findGroupByName($groupName);
            $group->permissions = $list;
            $group->save();
        }

        return $lists;
    }
}
