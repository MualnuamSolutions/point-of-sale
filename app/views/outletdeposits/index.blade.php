@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               @include('outletdeposits._menu')

               <h3 class="panel-title"><i class="fi-page-multiple"></i> Outlet Amount Deposit History</h3>
            </div>

            <div class="panel-body">

               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-2">Deposit Amount</th>
                        <th class="col-md-2">Balanced Amount</th>
                        <th class="col-md-2">Bank Refference No</th>
                        <th class="col-md-2">Date</th>
                        <th class="col-md-2">Status</th>
                        <th class="col-md-4"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($outletdeposits as $key => $deposit)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>{{ $deposit->deposit_amt }}</td>
                        <td>{{ 'to be calculate from sales...' }}</td>
                        <td>{{ $deposit->refference_no }}</td>
                        <td>{{ $deposit->updated_at }}</td>
                        <td>
                           <?php
                           if($deposit->status==0)
                           {
                           ?>
                           <a href="{{ route('outletdeposits.approve', $deposit->id ) }}" class="btn btn-sm btn-warning"><i class="fi-pencil"></i>Pending</a>
                           <?php
                           }
                           else
                           {
                           ?>
                           <a href="{{ route('outletdeposits.not_approve', $deposit->id ) }}" class="btn btn-sm btn-success"><i class="fi-pencil"></i>Approved</a>
                           <?php
                           }
                           ?>
                        </td>
                        <td class="actions">

                           <a href="{{ route('outletdeposits.edit', $deposit->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>

                           {{ Form::open(['url' => route('outletdeposits.destroy', $deposit->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit', 'onclick' => 'return confirm("Are you sure you want to delete?")']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $outletdeposits->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
