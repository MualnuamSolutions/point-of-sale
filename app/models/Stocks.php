<?php
class Stocks extends Eloquent
{
	protected $table = "stocks";

   public static $rules = [
         'supplier_id' => 'required',
         'product_id' => 'required',
         'quantity' => 'required',
   ];
   public static $updaterules = [
         'supplier_id' => 'required',
         'cp' => 'required',
         'sp' => 'required'
   ];

   

   public function supplier()
   {
      return $this->hasOne('Suppliers', 'id', 'supplier_id');
   }

   public function product()
   {
      return $this->hasOne('Products', 'id','product_id');
   }

   
   public static function searchProductStock($query = null)
   {
      if( $query == null )
         return null;

      $productTable = (new Products)->getTable();

      return self::join( $productTable, $productTable . '.id', '=', (new self)->getTable() . '.product_id' )
         ->where(function($select) use ($query) {
            $select->where('name', 'LIKE', '%' . $query . '%');
            $select->orWhere('product_code', 'LIKE', '%' . $query . '%');
         })
         ->where('in_stock', '>=', 1);
   }

   public static function autocompleteSearchProductStock($query = null)
   {
      $productTable = (new Products)->getTable();
      $stockTable = (new self)->getTable();

      $products = self::searchProductStock($query)
               ->select(
                  DB::raw("CONCAT(name, ' Rs ', sp, ' - In stock (', in_stock, ')') as value"),
                  DB::raw("CONCAT(
                        '{\"id\":\"', {$stockTable}.id, '\"',
                        ',\"product_code\":\"', {$productTable}.product_code, '\"',
                        ',\"product_id\":\"', {$productTable}.id, '\"',
                        ',\"name\":\"', name, '\"',
                        ',\"sp\":\"', sp, '\"',
                        ',\"cp\":\"', cp, '\"',
                        ',\"in_stock\":\"', in_stock, '\"}'
                     ) as data")
                  )
               ->get();

      $result = [
         'query' => $query,
         'suggestions' => $products->toArray()
      ];

      return $result;
   }

}
