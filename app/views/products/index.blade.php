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
                        <th class="col-md-2">Product</th>
                        <th class="col-md-1">Main Color</th>
                        <th class="col-md-1">Type</th>
                        <th class="col-md-2">Unit</th>
                        <th class="col-md-1">Quantity</th>
                        <th class="col-md-1">In Stock</th>
                        <th class="col-md-2">Discount</th>
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
                           <small>CP:{{ $product->cp}} / SP:{{ $product->sp}}</small>
                        </td>
                        <td>
                           @if ($product->color)
                           <span class="label" style="background-color: #{{ $product->color->code }}"><i class="fa fa-ellipsis-h"></i></span>
                           <small>{{ $product->color->name }}</small>
                           @endif
                        </td>
                        <td>{{ $product->type->name}}</td>
                        <td>{{ $product->unit->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->stocks->sum('quantity') }}</td>
                        <td>{{ $product->discount }} %</td>
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

               {{ $products->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
