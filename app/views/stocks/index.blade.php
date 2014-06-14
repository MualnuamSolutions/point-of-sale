@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               @include('stocks._menu')

               <h3 class="panel-title"><i class="fi-page-multiple"></i> Stocks</h3>
            </div>

            <div class="panel-body">
               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-4">Product</th>
                        <th class="col-md-2">Supplier</th>
                        <th class="col-md-2">CP/SP</th>
                        <th class="col-md-2">Quantity</th>
                        <th class="col-md-2"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($stocks as $key => $stock)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>
                           <a href="{{ route('products.show', $stock->product->id) }}">{{ $stock->product->name }}</a><br />
                           <small>{{ $stock->product->product_code}}</small>
                        </td>
                        <td><a href="{{ route('suppliers.show', $stock->supplier->id) }}">{{ $stock->supplier->name}}</a></td>
                        <td><i class="fa fa-rupee"></i> {{ $stock->cp }} / <i class="fa fa-rupee"></i> {{ $stock->sp}}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td class="actions">
                           <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           {{ Form::open(['url' => route('stocks.destroy', $stock->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit', 'onclick' => 'return confirm("Are you sure you want to delete?")']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $stocks->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
