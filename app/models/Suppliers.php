<?php
class Suppliers extends Eloquent
{
	protected $table = "suppliers";
   public static $rules = [
         'name' => 'required',
         'address' => 'required'
   ];
}
