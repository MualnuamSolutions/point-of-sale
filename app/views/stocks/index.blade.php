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
                        <th class="col-md-3">Product</th>
                        @if($logged_user->outlet_id == 0)
                           <th class="col-md-3">Supplier</th>
                        @endif
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
                           <a href="{{ route('products.show', $stock->product->id) }}">{{ stripslashes($stock->product->name) }}</a><br />
                           <small>{{ $stock->product->product_code}}</small>
                        </td>
                        @if($logged_user->outlet_id == 0)
                           <td><a href="{{ route('suppliers.show', $stock->supplier->id) }}">{{ $stock->supplier->name}}</a></td>
                        @endif
                        <td><i class="fa fa-rupee"></i> {{ $stock->product->cp }} / <i class="fa fa-rupee"></i> {{ $stock->product->sp}}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>
                           @if($logged_user->hasAccess('stockreturns.edit'))   
                           <a href="{{ route('stockreturns.return', $stock->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Return Stock Item</a>
                           @endif   
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
