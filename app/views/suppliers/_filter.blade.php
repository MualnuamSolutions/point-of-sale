<div class="filter">
   {{ Form::open(['url' => route('suppliers.index'), 'method' => 'get', 'class' => 'form-inline', 'autocomplete' => 'off']) }}
      <div class="form-group">
         {{ Form::text('name', array_key_exists('name', $input)?$input['name']:'', ['class' => 'form-control input-sm', 'placeholder' => 'Search supplier name']) }}
      </div>
      <div class="form-group">
         {{ Form::text('address', array_key_exists('address', $input)?$input['address']:'', ['class' => 'form-control input-sm', 'placeholder' => 'Search supplier address']) }}
      </div>
      <div class="form-group">
         {{ Form::text('contact', array_key_exists('contact', $input)?$input['contact']:'', ['class' => 'form-control input-sm', 'placeholder' => 'Search supplier contact']) }}
      </div>
      <div class="form-group">
         {{ Form::button('Search', ['class' => 'btn btn-sm btn-info', 'type' => 'submit']) }}
      </div>

   {{ Form::close() }}
   <hr>
</div>
