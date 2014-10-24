<?php

class Discounts extends Eloquent
{
    protected $table = "discounts";

    public static $types = ['' => 'Select Discount Type', 'percentage' => 'Percentage', 'fixed' => 'Fixed'];

    public static $statuses = ['' => 'Select Status', 'active' => 'Active', 'inactive' => 'Inactive'];

    public static $rules = [
        'product_id' => 'required',
        'amount' => 'required',
        'discount_type' => 'required',
        'status' => 'required',
    ];

    public static $editRules = [
        'amount' => 'required',
        'discount_type' => 'required',
        'status' => 'required',
    ];

    public function product()
    {
        return $this->hasOne('Products', 'id', 'product_id');
    }

    public static function filter($input, $limit = 24)
    {
        return Discounts::with('product')
            ->where(function ($query) use ($input) {
                if (array_key_exists('product_id', $input) && strlen($input['product_id']))
                    $query->where('product_id', '=', $input['product_id']);

                if (array_key_exists('discount_type', $input) && strlen($input['discount_type']))
                    $query->where('discount_type', '=', $input['discount_type']);

                if (array_key_exists('status', $input) && strlen($input['status']))
                    $query->where('status', '=', $input['status']);
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('status', 'asc')
            ->paginate($limit);
    }

    public static function display($productId)
    {
        $discount = Discounts::whereStatus('active')->whereProductId($productId)->first();

        if($discount) {
             return $discount->discount_type == 'percentage' ? $discount->amount . '%' : $discount->amount;
        }   
        else return null;     
    }

}
