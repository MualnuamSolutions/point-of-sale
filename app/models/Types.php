<?php
class Types extends Eloquent
{
	protected $table = "types";

   public static $rules = [
         'name' => 'required'
   ];
}
