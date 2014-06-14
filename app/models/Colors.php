<?php
class Colors extends Eloquent
{
   protected $table = "colors";
     public static $rules = [
         'name' => 'required',
         'color' => 'required',
   ];

   // public static $rules = [
   //       'name' => 'required'
   // ];

   // public static function dropdownList()
   // {
   //    return array('' => 'Select Type') +Types::orderBy('name', 'asc')->get()->lists('name', 'id');
   // }

}
