<?php
class OutletsStocks extends Eloquent
{
	protected $table = "outlets_stocks";
	public $timestamps = false;
   /*public static $rules = [
         'name' => 'required',
         'address' => 'required'
   ];

   public static function dropdownList()
   {
      return array('' => 'Select Outlet') + self::orderBy('name', 'asc')->get()->lists('name', 'id');
   }*/
   
    public function product()
   {
      return $this->hasOne('Products', 'id','product_id');
   }

   
}
