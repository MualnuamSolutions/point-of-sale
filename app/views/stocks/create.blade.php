@extends('layout')

@section('content')
   <div class="col-md-8 col-md-offset-2">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('stocks._menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Create Stock</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('stocks.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('type_id') ? 'has-error' : '' }}">
                           {{ Form::label('type_id', 'Product type') }}
                           {{ Form::select('type_id', $types, '', ['class' => 'form-control']) }}
                           @if($errors->has('type_id'))
                           <p class="help-block">{{ $errors->first('type_id') }}</p>
                           @endif
                        </div>
                     </div>

                     <div class="col-md-8">
                        <div class="form-group {{ $errors->has('product_id') ? 'has-error' : '' }}">
                           {{ Form::label('product_id', 'Product') }}
                           {{ Form::select('product_id', [], '', ['class' => 'form-control']) }}
                           @if($errors->has('product_id'))
                           <p class="help-block">{{ $errors->first('product_id') }}</p>
                           @endif
                        </div>
                     </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                        <div id="quantity" class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                           {{ Form::label('quantity', 'Quantity') }}
                           <div class="input-group">
                              {{ Form::text('quantity', '', ['class' => 'form-control']) }}
                              <span class="input-group-addon">-</span>
                           </div>
                           @if($errors->has('quantity'))
                           <p class="help-block">{{ $errors->first('quantity') }}</p>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : '' }}">
                           {{ Form::label('supplier_id', 'Supplier') }}
                           {{ Form::select('supplier_id', $suppliers, '', ['class' => 'form-control']) }}
                           @if($errors->has('supplier_id'))
                           <p class="help-block">{{ $errors->first('supplier_id') }}</p>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="for-group text-right">
                     {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                  </div>
               {{ Form::close() }}
            </div>
         </div>
      </div>
   </div>
@stop

@section('script')
<script type="text/javascript">
$(function(){
   if($('#type_id').val() != "")
      fetchProducts($('#type_id').val());

   $('#type_id').on('change', function(){
      fetchProducts($(this).val());
   });

   if($('#product_id').val() != "")
      fetchUnit($('#product_id').val());

   $('#product_id').on('change', function(){
      fetchUnit($(this).val());
   });
});

function fetchUnit (productId) {
   if(productId) {
      $.ajax({
         url: '{{ url('products') }}/' + productId,
         type: 'get',
         dataType: 'jsonp',
         beforeSend: function(){
            $("#quantity .input-group-addon").html('<i class="fa fa-spinner fa-spin"></i>');
         }
      })
      .done(function(data, xhr, textStatus){
         if(typeof data.unit != "undefined")
            $("#quantity .input-group-addon").html(data.unit.name);
         else
            $("#quantity .input-group-addon").html('-');
      });
   }
   else
      $("#quantity .input-group-addon").html('-');
}

function fetchProducts (typeId) {

   $.ajax({
      url: '{{ route('products.index') }}',
      type: 'get',
      dataType: 'jsonp',
      data: {type: typeId},
      beforeSend: function(){
         $("#product_id").append('<option value="">Fetching products...</option>');
      }
   })
   .done(function(data, xhr, textStatus){
      var html = '<option value="">No Products</option>';
      var options = "";

      var productId = 0;
      $.each(data, function(key, name){
         if(productId == 0)
            productId = key;

         options += '<option value="' + key + '">' + name + '</option>';
      });

      fetchUnit (productId);

      if(options != "")
         html = options;

      $("#product_id").html(html);

   });
}s
</script>
@stop
