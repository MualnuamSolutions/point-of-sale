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
      })->paginate($limit);
   }
}
