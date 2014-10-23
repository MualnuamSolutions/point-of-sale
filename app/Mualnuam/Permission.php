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
                'products.show' => 1,
                'products.search' => 1,
                'products.edit' => 1,
                'products.update' => 1,
                'discounts.index' => 1,
                'discounts.create' => 1,
                'discounts.store' => 1,
                'discounts.edit' => 1,
                'discounts.update' => 1,
                'discounts.destroy' => 1,
                'distributions.index' => 1,
                'distributions.create' => 1,
                'distributions.store' => 1,
                'distributions.edit' => 1,
                'distributions.update' => 1,
                'distributions.destroy' => 1,
                'suppliers.index' => 1,
                'suppliers.create' => 1,
                'suppliers.store' => 1,
                'suppliers.edit' => 1,
                'suppliers.update' => 1,
                'suppliers.destroy' => 1,
                'salesoutlets.index' => 1,
                'salesoutlets.create' => 1,
                'salesoutlets.store' => 1,
                'salesoutlets.edit' => 1,
                'salesoutlets.update' => 1,
                'salesoutlets.destroy' => 1,
                'outletdeposits.index' => 1,
                'outletdeposits.create' => 1,
                'outletdeposits.store' => 1,
                'outletdeposits.edit' => 1,
                'outletdeposits.update' => 1,
                'outletdeposits.destroy' => 1,
                'outletdeposits.approve' => 1,
                'outletdeposits.reject' => 1,
                'stockreturns.index' => 1,
                'stockreturns.create' => 1,
                'stockreturns.store' => 1,
                'stockreturns.edit' => 1,
                'stockreturns.update' => 1,
                'stockreturns.destroy' => 1,
                'units.index' => 1,
                'users.index' => 1,
                'users.edit' => 1,
                'users.update' => 1,
                'users.create' => 1,
                'users.store' => 1,
                'home' => 1,
            ],

            'Store Manager' => [
                'products.search' => 1,
                'sales.create' => 1,
                'sales.store' => 1,
                'sales.index' => 1,
                'sales.edit' => 1,
                'sales.remove' => 1,
                'sales.returnitem' => 1,
                'distributions.index' => 1,
                'distributions.create' => 1,
                'distributions.store' => 1,
                'distributions.edit' => 1,
                'distributions.update' => 1,
                'distributions.destroy' => 1,
                'stocks.create' => 1,
                'stocks.store' => 1,
                'stocks.index' => 1,
                'stocks.edit' => 1,
                'stocks.update' => 1,
                'products.index' => 1,
                'products.create' => 1,
                'products.store' => 1,
                'products.edit' => 1,
                'products.update' => 1,
                'products.destroy' => 1,
                'stockreturns.edit' => 1,
                'discounts.index' => 1,
                'home' => 1,

            ],

            'Sales Person' => [
                'products.search' => 1,
                'sales.create' => 1,
                'sales.store' => 1,
                'sales.index' => 1,
                'sales.returnitem' => 1,
                'sales.edit' => 1,
                'sales.update' => 1,
                'sales.show' => 1,
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
