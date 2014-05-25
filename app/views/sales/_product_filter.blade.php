<div class="filter">
   {{ Form::open(['url' => route('sales.create'), 'method' => 'get', 'class' => 'form-inline', 'autocomplete' => 'off']) }}
      <div class="form-group">
         {{ Form::select('type', $types, array_key_exists('type', $input)?$input['type']:'', ['class' => 'form-control input-sm']) }}
      </div>
      <div class="form-group">
         {{ Form::text('name_code', array_key_exists('name_code', $input)?$input['name_code']:'', ['class' => 'form-control input-sm', 'placeholder' => 'Product name or code']) }}
      </div>
      <div class="form-group">
         {{ Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-sm btn-info', 'type' => 'submit']) }}
      </div>

   {{ Form::close() }}
   <hr>
</div>
