<div class="filter">
   {{ Form::open(['url' => route('sales.index'), 'method' => 'get', 'class' => 'form-inline', 'autocomplete' => 'off']) }}

      @if ($logged_user->isSuperUser() || ($logged_user && $logged_user->inGroup($Manager)) )
      <div class="form-group">
         {{ Form::select('outlet', $outlets, Input::get('outlet', null), ['class' => 'form-control input-sm']) }}
      </div>
      @endif

      <div class="form-group">
         {{ Form::select('status', ['' => 'All', 'completed' => 'Completed', 'credit' => 'Credit'], Input::get('status', null), ['class' => 'form-control input-sm']) }}
      </div> 

      <div class="form-group">
         {{ Form::text('from', '', array('class' => 'datepicker-from form-control','placeholder' => 'Select Date From')) }}
      </div>

      <div class="form-group">
         {{ Form::text('to', '', array('class' => 'datepicker-to form-control','placeholder' => 'Select Date To')) }}
      </div>

      <div class="form-group">
         {{ Form::button('Search', ['class' => 'btn btn-sm btn-info', 'type' => 'submit']) }}
      </div>

   {{ Form::close() }}
   <hr>
</div>
