<?php

class ProductsController extends \BaseController {
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
      $input = Input::all();
      $products = Products::filter(Input::all(), 24);
      $types = Types::dropdownList();
      $units = Units::dropdownList();

      if(Request::ajax()) {
         return Response::json($products->lists('name','id'))->setCallback(Input::get('callback'));
      }

      $index = $products->getPerPage() * ($products->getCurrentPage()-1) + 1;
      return View::make('products.index', compact('products', 'index', 'input', 'types', 'units'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
      $types = Types::dropdownList();
		$units = Units::dropdownList();
      return View::make('products.create', compact('types','units'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Products::$rules);

      if($validator->passes()) {
         $product = new Products;
         $product->name = Input::get('name');
         $product->product_code = 0;
         $product->type_id = Input::get('type_id');
         $product->unit_id = Input::get('unit_id');
         $product->save();
         $product->setProductCode($product);
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
		if(!$id)
         return Redirect::route('products.index')
            ->with('error', 'Please Provide product id');

      $product = Products::find($id);

      if(empty($product))
         return Redirect::route('products.index')
            ->with('error', 'Product not found');
      $types = Types::dropdownList();
      $units = Units::dropdownList();
      return View::make('products.edit', compact('product','types','units'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Products::$rules);

      if($validator->passes()) {
         $product = Products::find($id);
         $product->name = Input::get('name');
         $product->product_code = 0;
         $product->type_id = Input::get('type_id');
         $product->unit_id = Input::get('unit_id');
         $product->save();
         $product->setProductCode($product);

         return Redirect::route('products.index')
            ->with('success', 'Product updated successfully');
      }
      else {
         return Redirect::route('products.edit', $id)
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
         return Redirect::route('products.index')
            ->with('error', 'Please provide product id');

      $product = Products::find($id);

      if(empty($product))
         return Redirect::route('products.index')
            ->with('error', 'Product not found');

      products::destroy($id);

      return Redirect::route('products.index')
         ->with('success', 'Product deleted successfully');
	}


}
