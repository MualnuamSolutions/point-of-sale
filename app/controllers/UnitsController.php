<?php

class UnitsController extends \BaseController {
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
		$units = Units::paginate(20);
      $index = $units->getPerPage() * ($units->getCurrentPage()-1) + 1;
      return View::make('units.index', compact('units', 'index'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('units.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Units::$rules);

      if($validator->passes()) {
         $type = new Units;
         $type->name = Input::get('name');
         $type->save();

         return Redirect::route('units.index')
            ->with('success', 'Unit created successfully');
      }
      else {
         return Redirect::route('units.create')
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
         return Redirect::route('units.index')
            ->with('error', 'Please provide unit id');

      $unit = Units::find($id);

      if(empty($unit))
         return Redirect::route('units.index')
            ->with('error', 'Unit not found');

      return View::make('units.edit', compact('unit'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Units::$rules);

      if($validator->passes()) {
         $unit = Units::find($id);
         $unit->name = Input::get('name');
         $unit->save();

         return Redirect::route('units.index')
            ->with('success', 'Unit updated successfully');
      }
      else {
         return Redirect::route('units.edit', $id)
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
         return Redirect::route('units.index')
            ->with('error', 'Please provide unit id');

      $unit = Units::find($id);

      if(empty($unit))
         return Redirect::route('units.index')
            ->with('error', 'Unit not found');

      Units::destroy($id);

      return Redirect::route('units.index')
         ->with('success', 'Unit deleted successfully');

	}


}
