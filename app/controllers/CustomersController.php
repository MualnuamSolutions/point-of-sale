<?php

class CustomersController extends \BaseController {
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
		$customers = Customers::paginate(20);
      $index = $customers->getPerPage() * ($customers->getCurrentPage()-1) + 1;
      return View::make('customers.index', compact('customers', 'index'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('customers.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Customers::$rules);

      if($validator->passes()) {
         $customer = new Customers;
         $customer->name = Input::get('name');
         $customer->address = Input::get('address');
         $customer->contact= Input::get('contact');
         $customer->save();

         return Redirect::route('customers.index')
            ->with('success', 'Customer created successfully');
      }
      else {
         return Redirect::route('customers.create')
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
         return Redirect::route('customers.index')
            ->with('error', 'Please provide Customer id');

      $customer = Customers::find($id);

      if(empty($customer))
         return Redirect::route('customers.index')
            ->with('error', 'Customer not found');

      return View::make('customers.edit', compact('customer'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Customers::$rules);

      if($validator->passes()) {
         $customer = Customers::find($id);
         $customer->name = Input::get('name');
         $customer->address = Input::get('address');
         $customer->contact = Input::get('contact');
         $customer->save();

         return Redirect::route('customers.index')
            ->with('success', 'Customer updated successfully');
      }
      else {
         return Redirect::route('customers.edit', $id)
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
         return Redirect::route('customers.index')
            ->with('error', 'Please provide customer id');

      $customer = customers::find($id);

      if(empty($customer))
         return Redirect::route('customers.index')
            ->with('error', 'Customer not found');

      Customers::destroy($id);

      return Redirect::route('customers.index')
         ->with('success', 'Customer deleted successfully');
	}


}
