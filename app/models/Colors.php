<?php
class Colors extends Eloquent
{
   protected $table = "colors";

   public static $rules = [
         'name' => 'required',
         'code' => 'required',
   ];

   public static function dropdownList()
   {
      return array(0 => 'No Color') + self::orderBy('name', 'asc')->get()->lists('name', 'id');
   }

}
