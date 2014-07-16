<?php

class VatsController extends \BaseController {
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
		$vats = Vats::all();
      return View::make('vats.index', compact('vats'));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('vats.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Vats::$rules);

      if($validator->passes()) {
         $vat = new Vats;
         $vat->vat = Input::get('vat');
         $vat->save();

         return Redirect::route('vats.index')
            ->with('success', 'Vat created successfully');
      }
      else {
         return Redirect::route('vats.create')
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
         return Redirect::route('vats.index')
            ->with('error', 'Please provide Vat id');

      $vat = Vats::find($id);

      if(empty($vat))
         return Redirect::route('vats.index')
            ->with('error', 'VAT not found');

      return View::make('vats.edit', compact('vat'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Vats::$rules);

      if($validator->passes()) {
         $vat = Vats::find($id);
         $vat->vat = Input::get('vat');
         $vat->save();

         return Redirect::route('vats.index')
            ->with('success', 'VAT updated successfully');
      }
      else {
         return Redirect::route('vats.edit', $id)
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
         return Redirect::route('vats.index')
            ->with('error', 'Please provide VAT id');

      $vat = Vats::find($id);

      if(empty($vat))
         return Redirect::route('vats.index')
            ->with('error', 'VAT not found');

      Vats::destroy($id);

      return Redirect::route('vats.index')
         ->with('success', 'VAT deleted successfully');


	}


}
