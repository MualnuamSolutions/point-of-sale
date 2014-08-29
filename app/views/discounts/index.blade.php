@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               @include('discounts._menu')

               <h3 class="panel-title"><i class="fi-page-multiple"></i> Discounts</h3>
            </div>

            <div class="panel-body">
               @include('discounts._filter')

               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-3">Product</th>
                        <th class="col-md-2">Type</th>
                        <th class="col-md-2">Amount</th>
                        <th class="col-md-2">Status</th>
                        <th class="col-md-3"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($discounts as $key => $discount)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>
                           {{ Mualnuam\TextUtility::highlightString(Input::get('name'), stripslashes($discount->product->name)) }}
                        </td>
                        <td>{{ ucwords($discount->discount_type) }}</td>
                        <td>{{ $discount->amount}}</td>
                        <td>
                           @if ($discount->status == 'active')
                           <span class="label label-success">
                           @elseif ($discount->status == 'inactive')
                           <span class="label label-danger">
                           @endif
                           {{ strtoupper($discount->status) }}
                           </span>
                        </td>
                        <td class="actions">
                           <a href="{{ route('discounts.edit', $discount->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           {{ Form::open(['url' => route('discounts.destroy', $discount->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit', 'onclick' => 'return confirm("Are you sure you want to delete?")']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $discounts->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
