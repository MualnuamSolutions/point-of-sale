<?php

class StocksController extends \BaseController {
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
		$stocks = Stocks::paginate(20);

      $index = $stocks->getPerPage() * ($stocks->getCurrentPage()-1) + 1;
      return View::make('stocks.index', compact('stocks', 'index'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
      $suppliers = Suppliers::dropdownList();
      $types = Types::dropdownList();
      return View::make('stocks.create', compact('suppliers','types'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Stocks::$rules);

      if($validator->passes()) {
         $stock = new Stocks;
         $stock->supplier_id = Input::get('supplier_id');
         $stock->product_id = Input::get('product_id');
         $stock->in_stock = Input::get('quantity');
         $stock->save();
         $product = Products::find(Input::get('product_id'));
         $product->quantity = $product->quantity + Input::get('quantity');
         $product->save();
         //Products::updateStock($stock->product_id);
         return Redirect::route('stocks.index')
            ->with('success', 'Stock created successfully');
      }
      else {
         return Redirect::route('stocks.create')
            ->withErrors($validator)
            ->withInput(Input::all());
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
		if(!$id)
         return Redirect::route('stocks.index')
            ->with('error', 'Please Provide Stock id');

      $stock = stocks::find($id);

      if(empty($stock))
         return Redirect::route('stocks.index')
            ->with('error', 'Stock not found');
      $suppliers = Suppliers::dropdownList();
      $products = Products::dropdownList();
      return View::make('stocks.edit', compact('stock','suppliers','products'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Stocks::$updaterules);

      if($validator->passes()) {
         $stock = Stocks::find($id);
         $stock->supplier_id = Input::get('supplier_id');
         $stock->cp = Input::get('cp');
         $stock->sp = Input::get('sp');
         $current_sales = $stock->quantity - $stock->in_stock;
         $stock->quantity = Input::get('quantity');
         $stock->in_stock = Input::get('quantity')- $current_sales;
         $stock->save();
         Products::updateStock($stock->product_id);

         return Redirect::route('stocks.index')
            ->with('success', 'Stock updated successfully');
      }
      else {
         return Redirect::route('stocks.edit', $id)
            ->withErrors($validator)
            ->withInput(Input::all());
      }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!$id)
         return Redirect::route('stocks.index')
            ->with('error', 'Please provide Stock id');

      $stock = Stocks::find($id);
      $product_id=$stock->product_id;
      if(empty($stock))
         return Redirect::route('stocks.index')
            ->with('error', 'Stock not found');

      $sales = SalesItems::where('stock_id','=',$id)->count();
      if($sales)
         return Redirect::route('stocks.index')
            ->with('error', 'Stock cannot be delete, since this stock already has sale entry');

      Stocks::destroy($id);

      Products::updateStock($product_id);
      return Redirect::route('stocks.index')
         ->with('success', 'Stock deleted successfully');
	}


}
