<div class="filter">
   {{ Form::open(['url' => route('products.index'), 'method' => 'get', 'class' => 'form-inline', 'autocomplete' => 'off']) }}
      <div class="form-group">
         {{ Form::select('type', $types, array_key_exists('type', $input)?$input['type']:'', ['class' => 'form-control input-sm']) }}
      </div>
      <div class="form-group">
         {{ Form::select('unit', $units, array_key_exists('unit', $input)?$input['unit']:'', ['class' => 'form-control input-sm']) }}
      </div>
      <div class="form-group">
         {{ Form::text('name', array_key_exists('name', $input)?$input['name']:'', ['class' => 'form-control input-sm', 'placeholder' => 'Search product name']) }}
      </div>
      <div class="form-group">
         {{ Form::text('barcode', array_key_exists('barcode', $input)?$input['barcode']:'', ['class' => 'form-control input-sm', 'placeholder' => 'Search product barcode']) }}
      </div>
      <div class="form-group">
         {{ Form::button('Search', ['class' => 'btn btn-sm btn-info', 'type' => 'submit']) }}
      </div>

   {{ Form::close() }}
   <hr>
</div>
