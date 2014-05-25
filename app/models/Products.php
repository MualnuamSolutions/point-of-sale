<?php
class Products extends Eloquent
{
	protected $table = "products";
     public static $rules = [
         'name' => 'required',
         'type_id' => 'required',
         'unit_id' => 'required',
         'cp' => 'required',
         'sp' => 'required',
         'quantity' => 'required'
   ];

   public function setProductCode($product)
   {
      $product->product_code = "ZHC" . str_pad($product->type_id, 3, 0, STR_PAD_LEFT) . str_pad($product->id, 6, 0, STR_PAD_LEFT);
      $product->save();
   }

   public function type()
   {
      return $this->hasOne('Types', 'id', 'type_id');
   }
   public function unit()
      {
         return $this->hasOne('Units', 'id','unit_id');
      }
}
