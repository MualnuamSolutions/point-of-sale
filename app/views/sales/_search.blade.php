<div class="search">
   {{ Form::open(['method' => 'get', 'class' => 'form-horizontal', 'onsubmit' => 'return false;']) }}
      <div class="form-group has-feedback">
         <div class="col-sm-12">
            {{ Form::text('query', '', ['class' => 'form-control input-md', 'placeholder' => 'Enter Product Code or Product Name', 'id' => 'query-stocks']) }}
            <span style="display:none" class="autocomplete-spinner fa fa-circle-o-notch fa-spin form-control-feedback"></span>
         </div>
      </div>
   {{ Form::close() }}
   <hr>
</div>
