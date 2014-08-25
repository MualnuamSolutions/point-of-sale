@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               <!-- @include('stocks._menu') -->

               <h3 class="panel-title"><i class="fi-page-multiple"></i> Stocks Return</h3>
            </div>

            <div class="panel-body">
               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-2">Return From</th>
                        <th class="col-md-2">Product</th>
                        <th class="col-md-2">Quantity</th>
                        <th class="col-md-1">Comment</th>
                        <th class="col-md-1">Status</th>
                        <th class="col-md-2"></th>
                        <th class="col-md-2"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($returnsStocks as $returnstock)
                     <tr>
                        <td>{{ $returnstock->id }}</td>
                        <td><a href="{{ route('stockreturns.show', $returnstock->id) }}">{{ stripslashes($returnstock->outlet->name) }}</a></td>
                        <td>
                           <a href="{{ route('stockreturns.show', $returnstock->product->id) }}">{{ stripslashes($returnstock->product->name) }}</a><br />
                           <small>{{ $returnstock->product->product_code}}</small>
                        </td>
                        <td>{{ $returnstock->quantity }}</td>
                        <td>{{ $returnstock->comment }}</td>
                        <td>{{ $returnstock->status }}</td>
                        <td>
                           @if($logged_user->outlet_id == 0 && ($returnstock->status == "Pending..." || $returnstock->status == "Rejected"))
                           <a href="{{ route('stockreturns.approve', $returnstock->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Approve Return</a>
                           @endif
                        </td>
                        <td>
                           @if($logged_user->outlet_id == 0 && ($returnstock->status == "Pending..." || $returnstock->status == "Approved"))
                           <a href="{{ route('stockreturns.reject', $returnstock->id) }}" class="btn btn-sm btn-danger"><i class="fi-pencil"></i> Reject Return </a>
                           @endif
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

            </div>
         </div>
      </div>
   </div>
@stop
