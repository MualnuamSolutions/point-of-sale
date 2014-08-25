<?php
class OutletsStocksReturns extends Eloquent
{
	protected $table = "outlets_stocks_returns";
	public static $returnrules = [
         'quantity' => 'required',
         'comments' => 'required'
   ];

   public function product()
   {
      return $this->hasOne('Products', 'id','product_id');
   }

   public function outlet()
   {
      return $this->hasOne('SalesOutlets', 'id','outlet_id');
   }
	//public $timestamps = false;
   /*public static $rules = [
         'name' => 'required',
         'address' => 'required'
   ];

   public static function dropdownList()
   {
      return array('' => 'Select Outlet') + self::orderBy('name', 'asc')->get()->lists('name', 'id');
   }

    public function product()
   {
      return $this->hasOne('Products', 'id','product_id');
   }*/
}
