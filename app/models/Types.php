<?php
class Types extends Eloquent
{
	protected $table = "types";

   public static $rules = [
         'name' => 'required'
   ];

   public static function dropdownList()
   {
      return array('' => 'Select Type') +Types::orderBy('name', 'asc')->get()->lists('name', 'id');
   }

}
