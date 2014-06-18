<?php

class SalesController extends \BaseController {

   public function __construct()
   {
      $this->beforeFilter('sentry');
      $this->user = Sentry::getUser();
   }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
      $input = Input::all();
		$sales = Sales::with('items', 'customer')->paginate(20);
      $outlets = SalesOutlets::dropdownList();

      return View::make('sales.index', compact('sales', 'index', 'input', 'outlets'));
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

      return View::make('sales.create', compact('products', 'types', 'input'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Sales::$rules);

      if($validator->passes()) {
         // Create customer if required
         $customer = new Customers;
         if(Input::get('name')) {
            $customer->name = Input::get('name');
            $customer->address = Input::get('address');
            $customer->contact = Input::get('contact');
            $customer->save();
         }


         $sale = new Sales;
         $sale->reference_no = '';
         $sale->customer_id = $customer->id ? $customer->id : 0;
         $sale->outlet_id = $this->user->outlet_id;
         $sale->discount = Input::get('discount');
         $sale->paid = Input::get('grandtotal');
         $sale->total = Input::get('total');
         $sale->status = 'completed';

         if($sale->save()) {
            $sale->reference_no = 'SALE-' . date('Ymd') . '-' . str_pad($sale->id, 3, 0, STR_PAD_LEFT);
            $sale->save();

            foreach(Input::get('cart') as $stockId => $item) {
               $salesItem = new SalesItems;
               $salesItem->sales_id = $sale->id;
               $salesItem->product_id = $item['product_id'];
               $salesItem->stock_id = $stockId;
               $salesItem->cp = $item['cp'];
               $salesItem->sp = $item['sp'];
               $salesItem->quantity = $item['quantity'];
               $salesItem->total = $item['quantity'] * $item['sp'];
               $salesItem->save();

               // Update stock
               $stock = Stocks::find($stockId);
               $stock->in_stock = $stock->in_stock - $salesItem->quantity;
               $stock->save();
            }
         }

         return Redirect::route('sales.create')
            ->with('success', 'New sale added successfully');
      }
      else {
         return Redirect::route('sales.create')
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
