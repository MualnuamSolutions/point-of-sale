@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               @include('products._menu')

               <h3 class="panel-title"><i class="fi-page-multiple"></i> Products</h3>
            </div>

            <div class="panel-body">
               @include('products._filter')

               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-4">Product</th>
                        <th class="col-md-1">Type</th>
                        <th class="col-md-1">Quantity</th>
                        <th class="col-md-1">In Stock</th>
                        <th class="col-md-1">Discount</th>
                        <th class="col-md-2">Entry</th>
                        <th class="col-md-2"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($products as $key => $product)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>
                           {{ Mualnuam\TextUtility::highlightString(array_key_exists('name', $input)?$input['name']:null, stripslashes($product->name)) }}<br />
                           <small>{{ $product->product_code}}</small> <br />
                           <small>CP:{{ $product->cp}} / SP:{{ $product->sp}}</small> <br />
                           @if ($product->color)
                           <small>Color: {{ $product->color->name }} <span class="label" style="background-color: #{{ $product->color->code }}"><i class="fa fa-ellipsis-h"></i></span></small> <br />
                           @endif
                           <small>Unit: {{ $product->unit->name }}</small>
                        </td>
                        <td>{{ $product->type->name}}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->stocks->sum('quantity') }}</td>
                        <td>{{ Discounts::display($product->id) }}</td>
                        <td>{{ date('d/m/Y h:iA', strtotime($product->created_at)) }}</td>
                        <td class="actions">
                           <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           {{ Form::open(['url' => route('products.destroy', $product->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit', 'onclick' => 'return confirm("Are you sure you want to delete?")']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               <?php
               $input = Input::all();
               if(isset($input['page']))
                  unset($input['page']);
               ?>

               {{ $products->appends($input)->links() }}
            </div>
         </div>
      </div>
   </div>
@stop

@section('script')
<script type="text/javascript">
var entry_from;
var entry_from_picker;
var entry_to;
var entry_to_picker;

$(document).ready(function () {
   entry_from = $('.datepicker-from').pickadate();
   entry_to = $('.datepicker-to').pickadate(); 
   entry_from_picker = entry_from.pickadate('picker');
   entry_to_picker = entry_to.pickadate('picker');

   $('.datepicker-from').on('blur', function(){
      setMin();
   });

   if($('.datepicker-from').val().length)
      setMin();
});

function setMin()
{
   entry_to_picker.set('min', entry_from_picker.get());
}   
</script>
@stop
