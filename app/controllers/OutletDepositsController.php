<?php

class OutletDepositsController extends \BaseController {
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
		$outletdeposits = OutletDeposits::paginate(20);
      $index = $outletdeposits->getPerPage() * ($outletdeposits->getCurrentPage()-1) + 1;
      return View::make('outletdeposits.index', compact('outletdeposits', 'index'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
      $outlets = OutletDeposits::dropdownList();
		return View::make('outletdeposits.create',compact('outlets'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), OutletDeposits::$rules);

      if($validator->passes()) {
         $outletdeposits = new OutletDeposits;
         $outletdeposits->outlet_id = Input::get('outlet_id');
         $outletdeposits->deposit_amt = Input::get('deposit');
         $outletdeposits->refference_no = Input::get('refference');
         $outletdeposits->save();

         return Redirect::route('outletdeposits.index')
            ->with('success', 'Amount Deposited');
      }
      else {
         return Redirect::route('outletdeposits.create')
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
         return Redirect::route('outletdeposits.index')
            ->with('error', 'Please Provide Outlet Deposit id');

      $deposit = OutletDeposits::find($id);

      if(empty($deposit))
         return Redirect::route('outletdeposits.index')
            ->with('error', 'Deposit not found');

      return View::make('outletdeposits.edit', compact('deposit'));
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

   public function approve($id)
   {
      $deposit = OutletDeposits::find($id);
      $deposit->status = 'Approved';
      $deposit->save();

      return Redirect::route('outletdeposits.index')
         ->with('success', 'Deposit Amount Approved');
   }

   public function pending($id)
   {
      $deposit = OutletDeposits::find($id);
      $deposit->status = 'Pending';
      $deposit->save();

      return Redirect::route('outletdeposits.index')
         ->with('success', 'Deposit Amount Pending');
   }

   public function not_approve($id)
	{
		$deposit = OutletDeposits::find($id);
      $deposit->status = 'Reject';
      $deposit->save();

      return Redirect::route('outletdeposits.index')
         ->with('success', 'Deposit Amount Rejected');
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
