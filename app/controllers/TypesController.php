<?php

class TypesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
      $types = Types::paginate(20);
      $index = $types->getPerPage() * ($types->getCurrentPage()-1) + 1;
		return View::make('types.index', compact('types', 'index'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('types.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Types::$rules);

      if($validator->passes()) {
         $type = new Types;
         $type->name = Input::get('name');
         $type->save();

         return Redirect::route('types.index')
            ->with('success', 'Type created successfully');
      }
      else {
         return Redirect::route('types.create')
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
         return Redirect::route('types.index')
            ->with('error', 'Please provide type id');

      $type = Types::find($id);

      if(empty($type))
         return Redirect::route('types.index')
            ->with('error', 'Type not found');

		return View::make('types.edit', compact('type'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Types::$rules);

      if($validator->passes()) {
         $type = Types::find($id);
         $type->name = Input::get('name');
         $type->save();

         return Redirect::route('types.index')
            ->with('success', 'Type updated successfully');
      }
      else {
         return Redirect::route('types.edit', $id)
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
         return Redirect::route('types.index')
            ->with('error', 'Please provide type id');

      $type = Types::find($id);

      if(empty($type))
         return Redirect::route('types.index')
            ->with('error', 'Type not found');

      Types::destroy($id);

      return Redirect::route('types.index')
         ->with('success', 'Type deleted successfully');
	}


}
