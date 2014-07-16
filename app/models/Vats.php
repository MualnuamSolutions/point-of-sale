<?php
class Vats extends Eloquent
{
   protected $table = "vats";

   public static $rules = [
         'vat' => 'required',
   ];



}
