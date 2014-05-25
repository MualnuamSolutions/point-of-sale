<?php
class Stocks extends Eloquent
{
	protected $table = "stocks";
   public static $rules = [
         'supplier_id' => 'required',
         'product_id' => 'required',
         'cp' => 'required',
         'sp' => 'required',
         'quantity' => 'required',
   ];

   public function supplier()
   {
      return $this->hasOne('Suppliers', 'id', 'supplier_id');
   }

   public function product()
   {
      return $this->hasOne('Products', 'id','product_id');
   }
}
