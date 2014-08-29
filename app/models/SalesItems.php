<?php
class SalesItems extends Eloquent
{
	protected $table = "sales_items";

	public function product()
   	{
		return $this->belongsTo('Products', 'product_id');
   	}
}
