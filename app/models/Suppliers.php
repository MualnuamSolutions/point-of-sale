<?php
class Suppliers extends Eloquent
{
	protected $table = "suppliers";
   public static $rules = [
         'name' => 'required',
         'address' => 'required'
   ];

   public static function filter($input, $limit = 24)
   {
      return Suppliers::where(function($query) use ($input) {
         if(array_key_exists('name', $input) && strlen($input['name']) )
            $query->where('name', 'LIKE', "%" . $input['name'] . "%");

         if(array_key_exists('address', $input) && strlen($input['address']) )
            $query->where('address', 'LIKE', "%" . $input['address'] . "%");

         if(array_key_exists('contact', $input) && strlen($input['contact']) )
            $query->where('contact', 'LIKE', "%" . $input['contact'] . "%");
      })->paginate($limit);
   }
}
