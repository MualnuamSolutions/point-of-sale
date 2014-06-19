<div class="filter">
   {{ Form::open(['url' => route('sales.index'), 'method' => 'get', 'class' => 'form-inline', 'autocomplete' => 'off']) }}

      @if ($logged_user->isSuperUser() || ($logged_user && $logged_user->inGroup($Manager)) )
      <div class="form-group">
         {{ Form::select('outlet', $outlets, array_key_exists('outlet', $input) ? $input['outlet']:'', ['class' => 'form-control input-sm']) }}
      </div>
      @endif

      <div class="form-group">
         {{ Form::button('Search', ['class' => 'btn btn-sm btn-info', 'type' => 'submit']) }}
      </div>

   {{ Form::close() }}
   <hr>
</div>
