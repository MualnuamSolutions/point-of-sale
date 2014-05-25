<?php

class SuppliersController extends \BaseController {
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
		$suppliers = Suppliers::filter(Input::all(), 24);

      $index = $suppliers->getPerPage() * ($suppliers->getCurrentPage()-1) + 1;
      return View::make('suppliers.index', compact('suppliers', 'index', 'input'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('suppliers.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Suppliers::$rules);

      if($validator->passes()) {
         $supplier = new Suppliers;
         $supplier->name = Input::get('name');
         $supplier->address = Input::get('address');
         $supplier->contact= Input::get('contact');
         $supplier->save();

         return Redirect::route('suppliers.index')
            ->with('success', 'Supplier created successfully');
      }
      else {
         return Redirect::route('suppliers.create')
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
         return Redirect::route('suppliers.index')
            ->with('error', 'Please provide Supplier id');

      $supplier = suppliers::find($id);

      if(empty($supplier))
         return Redirect::route('Suppliers.index')
            ->with('error', 'Supplier not found');

      return View::make('suppliers.edit', compact('supplier'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Suppliers::$rules);

      if($validator->passes()) {
         $supplier = Suppliers::find($id);
         $supplier->name = Input::get('name');
         $supplier->address = Input::get('address');
         $supplier->contact = Input::get('contact');
         $supplier->save();

         return Redirect::route('suppliers.index')
            ->with('success', 'Supplier updated successfully');
      }
      else {
         return Redirect::route('suppliers.edit', $id)
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
         return Redirect::route('suppliers.index')
            ->with('error', 'Please provide Supplier id');

      $supplier = Suppliers::find($id);

      if(empty($supplier))
         return Redirect::route('suppliers.index')
            ->with('error', 'Supplier not found');

      Suppliers::destroy($id);

      return Redirect::route('suppliers.index')
         ->with('success', 'Supplier deleted successfully');
	}


}
