<?php

class StocksController extends \BaseController
{
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
        $types = Types::dropdownList();
        $suppliers = Suppliers::dropdownList();
        $supplierTable = (new Suppliers)->getTable();
        $productTable = (new Products)->getTable();

        $stocks = null;
        if ($this->loggedUser()->outlet_id) {
            $outletStockTable = (new OutletsStocks)->getTable();
            
            $stocks = OutletsStocks::join($productTable, $productTable . '.id', '=', $outletStockTable . '.product_id')
                        ->where(function($q) use ($input, $productTable, $outletStockTable){
                            if (array_key_exists('name', $input) && strlen($input['name']))
                                $q->where($productTable . '.name', 'LIKE', "%" . $input['name'] . "%");

                            if (array_key_exists('type', $input) && strlen($input['type']))
                                $q->where('type_id', '=',  $input['type']);

                            if (array_key_exists('entry_from', $input) && strlen($input['entry_from']))
                                $q->where(DB::raw('DATE('.$outletStockTable.'.created_at)'), '>=', date('Y-m-d', strtotime($input['entry_from'])));

                            if (array_key_exists('entry_to', $input) && strlen($input['entry_to']))
                                $q->where(DB::raw('DATE('.$outletStockTable.'.created_at)'), '<=', date('Y-m-d', strtotime($input['entry_to'])));
                
                            if (array_key_exists('barcode', $input) && strlen($input['barcode']))
                                $q->where('product_code', 'LIKE', "%" . trim($input['barcode']) . "%");

                        })
                        ->select($outletStockTable.'.*')
                        ->where('outlet_id', '=', $this->loggedUser()->outlet_id)->paginate(20);
        }
        else {
            $stockTable = (new Stocks)->getTable();
            $stocks = Stocks::join($productTable, $productTable . '.id', '=', $stockTable . '.product_id')
                        ->join($supplierTable, $supplierTable . '.id', '=', $stockTable . '.supplier_id')
                        ->where(function($q) use ($input, $productTable, $stockTable){
                            if (array_key_exists('name', $input) && strlen($input['name']))
                                $q->where($productTable . '.name', 'LIKE', "%" . $input['name'] . "%");

                            if (array_key_exists('type', $input) && strlen($input['type']))
                                $q->where('type_id', '=',  $input['type']);

                            if (array_key_exists('supplier', $input) && strlen($input['supplier']))
                                $q->where('supplier_id', '=',  $input['supplier']);

                            if (array_key_exists('entry_from', $input) && strlen($input['entry_from']))
                                $q->where(DB::raw('DATE('.$stockTable.'.created_at)'), '>=', date('Y-m-d', strtotime($input['entry_from'])));

                            if (array_key_exists('entry_to', $input) && strlen($input['entry_to']))
                                $q->where(DB::raw('DATE('.$stockTable.'.created_at)'), '<=', date('Y-m-d', strtotime($input['entry_to'])));
                
                            if (array_key_exists('barcode', $input) && strlen($input['barcode']))
                                $q->where('product_code', 'LIKE', "%" . trim($input['barcode']) . "%");

                        })
                        ->select($stockTable.'.*')
                        ->paginate(20);
        }

        $index = $stocks->getPerPage() * ($stocks->getCurrentPage() - 1) + 1;
        return View::make('stocks.index', compact('stocks', 'index', 'suppliers', 'types', 'input'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $suppliers = Suppliers::dropdownList();
        $types = Types::dropdownList();
        return View::make('stocks.create', compact('suppliers', 'types'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), Stocks::$rules);

        if ($validator->passes()) {
            $stock = new Stocks;
            $stock->supplier_id = Input::get('supplier_id');
            $stock->product_id = Input::get('product_id');
            $stock->quantity = Input::get('quantity');
            $stock->save();

            $product = Products::find(Input::get('product_id'));
            $product->quantity = $product->quantity + Input::get('quantity');
            $product->save();

            //Products::updateStock($stock->product_id);
            return Redirect::route('stocks.index')
                ->with('success', 'Stock created successfully');
        } else {
            return Redirect::route('stocks.create')
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
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        if (!$id)
            return Redirect::route('stocks.index')
                ->with('error', 'Please Provide Stock id');

        $stock = Stocks::find($id);

        if (empty($stock))
            return Redirect::route('stocks.index')
                ->with('error', 'Stock not found');
        $suppliers = Suppliers::dropdownList();
        $products = Products::dropdownList();
        return View::make('stocks.edit', compact('stock', 'suppliers', 'products'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $validator = Validator::make(Input::all(), Stocks::$updaterules);

        if ($validator->passes()) {
            $stock = Stocks::find($id);
            $stock->supplier_id = Input::get('supplier_id');
            $stock->quantity = Input::get('quantity');
            $stock->save();
            Products::updateStock($stock->product_id);

            return Redirect::route('stocks.index')
                ->with('success', 'Stock updated successfully');
        } else {
            return Redirect::route('stocks.edit', $id)
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
        if (!$id)
            return Redirect::route('stocks.index')
                ->with('error', 'Please provide Stock id');

        $stock = Stocks::find($id);
        $product_id = $stock->product_id;
        if (empty($stock))
            return Redirect::route('stocks.index')
                ->with('error', 'Stock not found');

        $sales = SalesItems::where('stock_id', '=', $id)->count();
        if ($sales)
            return Redirect::route('stocks.index')
                ->with('error', 'Stock cannot be delete, since this stock already has sale entry');

        Stocks::destroy($id);

        Products::updateStock($product_id);
        return Redirect::route('stocks.index')
            ->with('success', 'Stock deleted successfully');
    }


}
