<?php
class Units extends Eloquent
{
	protected $table = "units";

   public static $rules = [
         'name' => 'required'
   ];
}
