<?php

class DiscountsController extends \BaseController
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
        $discounts = Discounts::filter(Input::all(), 24);
        $products = Products::dropdownList();
        $discountTypes = Discounts::$types;
        $statuses = Discounts::$statuses;

        $index = $discounts->getPerPage() * ($discounts->getCurrentPage() - 1) + 1;

        return View::make('discounts.index', compact('discounts', 'index', 'input', 'discountTypes', 'products', 'statuses'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $discountTypes = ['' => 'Select Discount Type', 'percentage' => 'Percentage', 'fixed' => 'Fixed'];
        $statuses = Discounts::$statuses;
        $products = Products::dropdownList($excludeDiscounted = true);

        return View::make('discounts.create', compact('discountTypes', 'products', 'statuses'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), Discounts::$rules);

        if ($validator->passes()) {
            $discounts = new Discounts;
            $discounts->product_id = Input::get('product_id');
            $discounts->amount = Input::get('amount');
            $discounts->discount_type = Input::get('discount_type');
            $discounts->status = Input::get('status');
            $discounts->save();

            return Redirect::route('discounts.index')
                ->with('success', 'Discount created successfully');
        } else {
            return Redirect::route('discounts.create')
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
        $discountTypes = ['' => 'Select Discount Type', 'percentage' => 'Percentage', 'fixed' => 'Fixed'];
        $statuses = Discounts::$statuses;
        $discount = Discounts::find($id);
        $product = Products::find($discount->product_id);

        return View::make('discounts.edit', compact('discountTypes', 'product', 'statuses', 'discount'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $validator = Validator::make(Input::all(), Discounts::$editRules);

        if ($validator->passes()) {
            $discount = Discounts::find($id);
            $discount->amount = Input::get('amount');
            $discount->discount_type = Input::get('discount_type');
            $discount->status = Input::get('status');
            $discount->save();

            return Redirect::route('discounts.index')
                ->with('success', 'Discount updated successfully');
        } else {
            return Redirect::route('discounts.edit', $id)
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
            return Redirect::route('discounts.index')
                ->with('error', 'Please provide discount id');

        $discount = Discounts::find($id);

        if (empty($discount))
            return Redirect::route('discounts.index')
                ->with('error', 'Discount not found');

        Discounts::destroy($id);

        return Redirect::route('discounts.index')
            ->with('success', 'Discount deleted successfully');

    }


}
