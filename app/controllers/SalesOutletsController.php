<?php

class SalesOutletsController extends \BaseController {
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
		$salesoutlets = SalesOutlets::paginate(20);
      $index = $salesoutlets->getPerPage() * ($salesoutlets->getCurrentPage()-1) + 1;
      return View::make('salesoutlets.index', compact('salesoutlets', 'index'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('salesoutlets.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), SalesOutlets::$rules);

      if($validator->passes()) {
         $salesoutlet = new SalesOutlets;
         $salesoutlet->name = Input::get('name');
         $salesoutlet->address = Input::get('address');
         $salesoutlet->contact= Input::get('contact');
         $salesoutlet->save();

         return Redirect::route('salesoutlets.index')
            ->with('success', 'Sales Outlet Created Successfully');
      }
      else {
         return Redirect::route('salesoutlets.create')
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
         return Redirect::route('salesoutlets.index')
            ->with('error', 'Please provide Sales Outlet id');

      $salesoutlet = SalesOutlets::find($id);

      if(empty($salesoutlet))
         return Redirect::route('salesoutlets.index')
            ->with('error', 'Sales Outlet not found');

      return View::make('salesoutlets.edit', compact('salesoutlet'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), SalesOutlets::$rules);

      if($validator->passes()) {
         $salesoutlet = SalesOutlets::find($id);
         $salesoutlet->name = Input::get('name');
         $salesoutlet->address = Input::get('address');
         $salesoutlet->contact = Input::get('contact');
         $salesoutlet->save();

         return Redirect::route('salesoutlets.index')
            ->with('success', 'Sales Outlet updated successfully');
      }
      else {
         return Redirect::route('salesoutlets.edit', $id)
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
         return Redirect::route('salesoutlets.index')
            ->with('error', 'Please provide Sales Outlet id');

      $salesoutlet = SalesOutlets::find($id);

      if(empty($salesoutlet))
         return Redirect::route('salesoutlets.index')
            ->with('error', 'Sales Outlet not found');

      Salesoutlets::destroy($id);

      return Redirect::route('salesoutlets.index')
         ->with('success', 'Sales Outlet deleted successfully');
	}


}
