<?php
class Products extends Eloquent
{
	protected $table = "products";
     public static $rules = [
         'name' => 'required',
         'type_id' => 'required',
         'cp' => 'required',
         'sp' => 'required',
         'quantity' => 'required',
         'unit_id' => 'required'
   ];
   public static $rules2 = [
         'name' => 'required',
         'type_id' => 'required',
         'unit_id' => 'required'
   ];

   public function setProductCode($product)
   {
      $product->product_code = "ZHC" . str_pad($product->type_id, 3, 0, STR_PAD_LEFT) . str_pad($product->id, 6, 0, STR_PAD_LEFT);
      $product->save();
   }

   public static function updateStock($productId)
   {
      $product = Products::find($productId);
      $in_stockQuantity = Stocks::whereProductId($productId)->sum('in_stock');
      $product->quantity =  $in_stockQuantity;
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

   public function stocks()
   {
      return $this->hasMany('Stocks', 'product_id');
   }

   public function color()
   {
      return $this->hasOne('Colors', 'id','color_id');
   }

   public static function dropdownList()
   {
      return array('' => 'Select Product') + Products::orderBy('name', 'asc')->get()->lists('name', 'id');
   }

   public static function filter($input, $limit = 24)
   {
      return Products::where(function($query) use ($input) {

         if(array_key_exists('name', $input) && strlen($input['name']) )
            $query->where('name', 'LIKE', "%" . $input['name'] . "%");

         if(array_key_exists('name_code', $input) && strlen($input['name_code']) ) {
            $query->where(function($query) use ($input){
               $query->where('name', 'LIKE', "%" . $input['name_code'] . "%");
               $query->orWhere('product_code', 'LIKE', "%" . $input['name_code'] . "%");
            });
         }

         if(array_key_exists('type', $input) && strlen($input['type']) )
            $query->whereTypeId($input['type']);

         if(array_key_exists('unit', $input) && strlen($input['unit']) )
            $query->whereTypeId($input['unit']);

         if(array_key_exists('barcode', $input) && strlen($input['barcode']) )
            $query->where('product_code', 'LIKE', "%" . $input['barcode'] . "%");

      })
      ->select('products.*', DB::raw('CONCAT(name, " - Rs. ", cp , " / Rs. " , sp) as nameprice'))
      ->orderBy('name', 'asc')->paginate($limit);
   }

}
