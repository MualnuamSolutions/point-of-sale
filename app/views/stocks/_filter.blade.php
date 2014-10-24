<div class="filter">
   {{ Form::open(['url' => route('stocks.index'), 'method' => 'get', 'class' => 'form-inline', 'autocomplete' => 'off']) }}
      <div class="form-group">
         {{ Form::select('type', $types, array_key_exists('type', $input)?$input['type']:'', ['class' => 'form-control input-sm']) }}
      </div>
      @if(!$logged_user->inGroup($SalesPerson))
      <div class="form-group">
         {{ Form::select('supplier', $suppliers, array_key_exists('supplier', $input)?$input['supplier']:'', ['class' => 'form-control input-sm']) }}
      </div>
      @endif
      <div class="form-group">
         {{ Form::text('name', array_key_exists('name', $input)?$input['name']:'', ['class' => 'form-control input-sm', 'placeholder' => 'Search product name']) }}
      </div>
      <div class="form-group">
         {{ Form::text('barcode', array_key_exists('barcode', $input)?$input['barcode']:'', ['class' => 'form-control input-sm', 'placeholder' => 'Search product barcode']) }}
      </div>
      
      @if(!$logged_user->inGroup($SalesPerson))
      <div class="form-group">
         {{ Form::text('entry_from', array_key_exists('entry_from', $input)?$input['entry_from']:'', ['class' => 'datepicker-from form-control input-sm', 'placeholder' => 'Entry date From']) }}
      </div>
      <div class="form-group">
         {{ Form::text('entry_to', array_key_exists('entry_to', $input)?$input['entry_to']:'', ['class' => 'datepicker-to form-control input-sm', 'placeholder' => 'Entry date To']) }}
      </div>
      @endif

      <div class="form-group">
         {{ Form::button('Search', ['class' => 'btn btn-sm btn-info', 'type' => 'submit']) }}
      </div>

   {{ Form::close() }}
   <hr>
</div>