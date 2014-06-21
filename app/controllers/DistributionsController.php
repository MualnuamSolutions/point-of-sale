<?php

class DistributionsController extends \BaseController {

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
      $distributions = Distributions::with('outlet')->where(function($query) use ($input){
         if(isset($input['outlet']) && $input['outlet'])
            $query->where('outlet_id', '=', $input['outlet']);
      })->paginate(20);
      $outlets = SalesOutlets::dropdownList();

      return View::make('distributions.index', compact('distributions', 'index', 'input', 'outlets'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$input = Input::all();
      $products = Products::filter($input, 25);
      $types = Types::dropdownList();
      $outlets = SalesOutlets::dropdownList();

      return View::make('distributions.create', compact('products', 'types', 'input', 'outlets'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Distributions::$rules);

      if($validator->passes()) {
         foreach(Input::get('cart') as $stockId => $item) {
            $distribution = new Distributions;
            $distribution->product_id = $item['product_id'];
            $distribution->outlet_id = Input::get('outlet_id');
            $distribution->stock_id = $stockId;
            $distribution->quantity = $item['quantity'];
            $distribution->in_stock = $item['quantity'];
            $distribution->save();
         }

         return Redirect::route('distributions.create')
            ->with('success', 'New distribution sent');
      }
      else {
         return Redirect::route('distributions.create')
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
