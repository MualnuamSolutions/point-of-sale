<?php
class Units extends Eloquent
{
	protected $table = "units";

   public static $rules = [
         'name' => 'required'
   ];
   public static function dropdownList()
   {
      return array('' => 'Select Unit') +Units::orderBy('name', 'asc')->get()->lists('name', 'id');
   }
}
