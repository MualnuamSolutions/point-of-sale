<?php

class Sales extends Eloquent
{
    protected $table = "sales";

    public static $rules = [
    ];

    public function items()
    {
        return $this->hasMany('SalesItems', 'sales_id');
    }

    public function customer()
    {
        return $this->belongsTo('Customers', 'customer_id');
    }

    public function outlet()
    {
        return $this->belongsTo('SalesOutlets', 'outlet_id');
    }
}
