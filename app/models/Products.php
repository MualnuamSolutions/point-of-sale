<?php
class Products extends Eloquent
{
	protected $table = "products";

   public function generateProductCode($type_id, $product)
   {
      return "ZHC" . str_pad($type_id, 3, 0, STR_PAD_LEFT) . str_pad($product->id, 6, 0, STR_PAD_LEFT);
   }

   public function type()
   {
      return $this->hasOne('Types', 'type_id');
   }
}
