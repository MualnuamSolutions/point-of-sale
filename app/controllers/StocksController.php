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
		$products = Products::dropdownList();
      $suppliers = Suppliers::dropdownList();
      $types = Types::dropdownList();
      return View::make('stocks.create', compact('products','suppliers','types'));
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
         $stock->cp = Input::get('cp');
         $stock->sp = Input::get('sp');
         $stock->quantity = Input::get('quantity');
         $stock->save();
         Products::updateStock($stock->product_id);
         return Redirect::route('products.index')
            ->with('success', 'Product created successfully');
      }
      else {
         return Redirect::route('products.create')
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
