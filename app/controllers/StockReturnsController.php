<?php

class StockReturnsController extends \BaseController {
public function __construct()
      {
         $this->beforeFilter('sentry');
      }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	  $returnsStocks = OutletsStocksReturns::where('id','>=',1)->orderBy('created_at','desc')->get();
	  //var_dump($returnsStocks);exit();
      return View::make('stockreturns.index', compact('returnsStocks'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	//Stock Return 
	public function returnStock($id)
	{
		$outletsstocks = OutletsStocks::find($id);
		return View::make('stocks.createreturn', compact('outletsstocks', 'id'));
	}

	public function approve($id)
	{
		$outletsStocksReturns = OutletsStocksReturns::find($id);
		//echo $outletsStocksReturns->product_id;exit();
		 if($outletsStocksReturns)
		 {
		 	$product = Products::where('id','=', $outletsStocksReturns->product_id)->first();
		 	$product->quantity = $product->quantity + $outletsStocksReturns->quantity;
		 	$product->save();

		 	$outletsStocks = OutletsStocks::where('product_id','=',$outletsStocksReturns->product_id)->where('outlet_id','=',$outletsStocksReturns->outlet_id)->first();
		 	$outletsStocks->quantity = $outletsStocks->quantity - $outletsStocksReturns->quantity;
		 	$outletsStocks->save();

		 	$outletsStocksReturns->status = "Approved";
		 	$outletsStocksReturns->save();

		 	return Redirect::route('stockreturns.index')
	            ->with('success', 'Stock Return Completed');
		 }
		 else
		 {
		 	return Redirect::route('stockreturns.index')
            ->with('error', 'Product not found in Outlets Stocks Returns Table');
		 }
	}

	public function reject($id)
	{
		$outletsStocksReturns = OutletsStocksReturns::find($id);
		 if(!$outletsStocksReturns)
		 {
		 	return Redirect::route('stockreturns.index')
            ->with('error', 'Product not found in Outlets Stocks Returns Table');
		 	
		 }
		 else if($outletsStocksReturns->status == "Pending...")
		 {
		 	$outletsStocksReturns->status = "Rejected";
		 	$outletsStocksReturns->save();

		 	return Redirect::route('stockreturns.index')
	            ->with('success', 'Stock Return Rejected');
		 }
		 else
		 {
		 	$stock = Stocks::where('product_id','=', $outletsStocksReturns->product_id)->first();
		 	$stock->quantity = $stock->quantity - $outletsStocksReturns->quantity;
		 	$stock->save();

		 	$outletsStocks = OutletsStocks::where('product_id','=',$outletsStocksReturns->product_id)->where('outlet_id','=',$outletsStocksReturns->outlet_id)->first();
		 	$outletsStocks->quantity = $outletsStocks->quantity + $outletsStocksReturns->quantity;
		 	$outletsStocks->save();

		 	$outletsStocksReturns->status = "Rejected";
		 	$outletsStocksReturns->save();

		 	return Redirect::route('stockreturns.index')
	            ->with('success', 'Stock Return Rejected');
		 }
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), OutletsStocksReturns::$returnrules);
		$outletsStocks = OutletsStocks::where('product_id','=',Input::get('product_id'))->where('outlet_id','=',Input::get('outlet_id'))->first();
		$stockId = Input::get('stock_id');
	    if(Input::get('quantity') <= $outletsStocks->quantity)
	    { 
	      if($validator->passes()) {
	         $stockreturn = new OutletsStocksReturns;
	         $stockreturn->product_id = Input::get('product_id');
	         $stockreturn->outlet_id = Input::get('outlet_id');
	         $stockreturn->quantity = Input::get('quantity');
	         $stockreturn->status = "Pending...";
	         $stockreturn->comment = Input::get('comments');
	         $stockreturn->save();
	         
	         return Redirect::route('stocks.index')
	            ->with('success', 'Stock Return created successfully');
	      }
	      else {
	         return Redirect::route('stockreturns.return', $stockId)
	            ->withErrors($validator)
	            ->withInput(Input::all());
	      }
	}
	else
	{
		return Redirect::route('stocks.index')
            ->with('error', 'RETURN ERROR : Return Quantity is more than Stock Quantity');
	}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
