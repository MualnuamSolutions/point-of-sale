<div class="filter">
   {{ Form::open(['url' => route('suppliers.index'), 'method' => 'get', 'class' => 'form-inline']) }}
      <div class="row">
         <div class="col-xs-12 col-md-4">
               <div class="input-group">
                  {{ Form::text('name', array_key_exists('name', $input)?$input['name']:'', ['class' => 'form-control input-sm', 'placeholder' => 'Search supplier name']) }}
                  <span class="input-group-btn">
                     {{ Form::button('Search', ['class' => 'btn btn-sm btn-info', 'type' => 'submit']) }}
                  </span>
               </div>
         </div>
      </div>

   {{ Form::close() }}
   <hr>
</div>
