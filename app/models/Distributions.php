<?php
class Distributions extends Eloquent
{
	protected $table = "distributions";

   public static $rules = [
      'outlet_id' => 'required'
   ];

   public function outlet()
   {
      return $this->belongsTo('SalesOutlets', 'outlet_id');
   }

   public function stock()
   {
      return $this->belongsTo('Stocks', 'stock_id');
   }

   public function product()
   {
      return $this->belongsTo('Products', 'product_id');
   }
}
