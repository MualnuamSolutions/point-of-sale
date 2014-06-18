<?php
class OutletDeposits extends Eloquent
{
    protected $table = "outlet_deposits";

    public static $rules = [
         'outlet_id' => 'required',
         'deposit' => 'required',
         'refference' => 'required',
   ];

   public static function dropdownList()
      {
         return array('' => 'Select Sales Outlet') +SalesOutlets::orderBy('name', 'asc')->get()->lists('name', 'id');
      }
}
