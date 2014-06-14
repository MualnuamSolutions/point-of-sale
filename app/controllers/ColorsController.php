<?php

class ColorsController extends \BaseController {
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
      $colors = Colors::paginate(20);
      $index = $colors->getPerPage() * ($colors->getCurrentPage()-1) + 1;
      return View::make('colors.index', compact('colors', 'index'));
   }


   /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
   public function create()
   {
      return View::make('colors.create');   }


   /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
   public function store()
   {
     $validator = Validator::make(Input::all(), Colors::$rules);

      if($validator->passes()) {
         $color = new Colors;
         $color->name = Input::get('name');
         $color->code = Input::get('color');
         $color->save();

         return Redirect::route('colors.index')
            ->with('success', 'Unit created successfully');
      }
      else {
         return Redirect::route('colors.create')
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
         return Redirect::route('colors.index')
            ->with('error', 'Please provide Colour id');

      $color = Colors::find($id);

      if(empty($color))
         return Redirect::route('colors.index')
            ->with('error', 'Colour not found');

      return View::make('colors.edit', compact('color'));   }


   /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function update($id)
   {
      $validator = Validator::make(Input::all(), Colors::$rules);

      if($validator->passes()) {
         $color = Colors::find($id);
         $color->name = Input::get('name');
         $color->code = Input::get('code');
         $color->save();

         return Redirect::route('colors.index')
            ->with('success', 'Colour updated successfully');
      }
      else {
         return Redirect::route('colors.edit', $id)
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
         return Redirect::route('colors.index')
            ->with('error', 'Please provide color id');

      $color = Colors::find($id);

      if(empty($color))
         return Redirect::route('colors.index')
            ->with('error', 'Colour not found');

      Colors::destroy($id);

      return Redirect::route('colors.index')
         ->with('success', 'Colour deleted successfully');



   }


}
