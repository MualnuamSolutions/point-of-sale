<?php

class SalesController extends \BaseController
{

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
        $outlets = SalesOutlets::dropdownList();

        $sales = Sales::with('items', 'customer')
            ->where(function ($query) use ($input) {
                if (array_key_exists('outlet', $input) && $input['outlet'] != '') {
                    if(is_numeric($input['outlet']))
                    {
                        $query->where('outlet_id', '=', $input['outlet']);
                    }
                    else
                    {
                        $query->where('outlet_id', '>=', 0);
                    }
                    
                }
                else
                {
                    $query->where('outlet_id', '=', $this->user->outlet_id);
                }

                if (array_key_exists('status', $input) && $input['status'] != '')
                    $query->where('status', '=', $input['status']);
            })
            ->paginate(20);

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

        if ($validator->passes()) {

            // Create customer if required
            $customer = new Customers;
            if (Input::get('name')) {
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
            $sale->paid = Input::get('paid');
            $sale->total = Input::get('grandtotal');
            $sale->notes = Input::get('notes');
            $sale->status = Input::get('paid') == Input::get('grandtotal') ? 'completed' : 'credit';

            if ($sale->save()) {
                $sale->reference_no = 'SALE-' . date('Ymd') . '-' . str_pad($sale->id, 3, 0, STR_PAD_LEFT);
                $sale->save();

                foreach (Input::get('cart') as $productId => $item) {

                    $itemDiscount = 0;
                    if ($item['discount_type'] == 'fixed')
                        $itemDiscount = $item['discount_amount'] * $item['quantity'];
                    elseif ($item['discount_type'] == 'percentage')
                        $itemDiscount = (($item['discount_amount'] / 100) * $item['sp']) * $item['quantity'];


                    $salesItem = new SalesItems;
                    $salesItem->sales_id = $sale->id;
                    $salesItem->product_id = $productId;
                    $salesItem->cp = $item['cp'];
                    $salesItem->sp = $item['sp'];
                    $salesItem->quantity = $item['quantity'];
                    $salesItem->total = ($item['quantity'] * $item['sp']) - $itemDiscount;
                    $salesItem->discount_type = $item['discount_type'];
                    $salesItem->discount_amount = $item['discount_amount'];
                    $salesItem->discount_total = $itemDiscount;
                    $salesItem->save();

                    if($this->user->outlet_id != 0) {
                        $outletstock = OutletsStocks::where('product_id','=',$productId)
                            ->where('outlet_id','=',$this->user->outlet_id)
                            ->first();
                        $outletstock->quantity = $outletstock->quantity - $salesItem->quantity;
                        $outletstock->save();
                    }
                    else {
                        // Update product stock
                        $product = Products::find($productId);
                        $product->quantity = $product->quantity - $salesItem->quantity;
                        $product->save();
                    }
                }
            }

            return Redirect::route('sales.edit', $sale->id)
                ->with('success', 'New sale added successfully');
        } else {
            return Redirect::route('sales.create')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $sale = Sales::with('customer', 'items')->find($id);

        return View::make('sales.show', compact('sale'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $sale = Sales::with('customer', 'items')->find($id);

        return View::make('sales.edit', compact('sale'));
    }

    public function returnitem($id)
    {
        $sales = SalesItems::where('sales_id','=',$id)->get();
        if($sales)
        {    
            foreach ($sales as $sale) 
            {
                
                if($this->user->outlet_id != 0)
                {
                    
                    $outletstock = OutletsStocks::where('product_id','=',$sale->product_id)
                        ->where('outlet_id','=',$this->user->outlet_id)
                        ->first();
                    if($outletstock)
                    {
                        $outletstock->quantity = $outletstock->quantity + $sale->quantity;
                        $outletstock->save();
                        SalesItems::destroy($sale->id);
                    }
                }
                else
                {
                    $product = Products::find($sale->product_id);
                    if($product)
                    {
                       // var_dump($product);exit();
                        $product->quantity = $product->quantity + $sale->quantity;
                        $product->save();
                        SalesItems::destroy($sale->id);
                    }
                }
                
            }
        Sales::destroy($id);
        return Redirect::route('sales.index')
                ->with('success', 'Item successfully return');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $validator = Validator::make(Input::all(), Sales::$rules);

        if ($validator->passes()) {
            $customerId = Input::get('customer_id', null);
            // Create customer if required
            $customer = new Customers;
            
            if ($customerId)
            {
                $customer = Customers::find($customerId);
            }
            if (Input::get('name')) {
                $customer->name = Input::get('name');
                $customer->address = Input::get('address');
                $customer->contact = Input::get('contact');
                $customer->save();
            }


            $sale = Sales::find($id);
            $sale->customer_id = $customer->id ? $customer->id : 0;
            $sale->outlet_id = $this->user->outlet_id;
            $sale->paid = Input::get('paid');
            $sale->notes = Input::get('notes');
            $sale->status = Input::get('paid') == Input::get('grandtotal') ? 'completed' : 'credit';
            $sale->save();

            return Redirect::route('sales.edit', $id)
                ->with('success', 'Sale updated successfully');
        } else {
            return Redirect::route('sales.edit', $id)
                ->withErrors($validator)
                ->withInput(Input::all());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}
