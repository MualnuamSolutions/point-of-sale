<div class="filter">
   {{ Form::open(['url' => route('discounts.index'), 'method' => 'get', 'class' => 'form-inline', 'autocomplete' => 'off']) }}
      <div class="form-group">
         {{ Form::select('product_id', $products, Input::get('product_id', null), ['class' => 'select2 input-sm']) }}
      </div>
      <div class="form-group">
         {{ Form::select('discount_type', $discountTypes, Input::get('discount_type', null), ['class' => 'form-control input-sm']) }}
      </div>
      <div class="form-group">
         {{ Form::select('status', $statuses, Input::get('status', null), ['class' => 'form-control input-sm']) }}
      </div>
   {{ Form::close() }}
   <hr>
</div>
