<?php
class SalesOutlets extends Eloquent
{
	protected $table = "sales_outlets";
   public static $rules = [
         'name' => 'required',
         'address' => 'required'
   ];
}
