<?php
class Customers extends Eloquent
{
	protected $table = "customers";
     public static $rules = [
         'name' => 'required',
         'address' => 'required'
   ];
}
