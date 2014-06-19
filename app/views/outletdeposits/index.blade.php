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
                        <th class="col-md-2">Outlet</th>
                        <th class="col-md-1">Deposit Amount</th>
                        <th class="col-md-1">Balanced Amount</th>
                        <th class="col-md-2">Refference No</th>
                        <th class="col-md-1">Date</th>
                        <th class="col-md-1">Status</th>
                        <th class="col-md-6"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($outletdeposits as $key => $deposit)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>{{ $deposit->outlet->name }}</td>
                        <td>{{ $deposit->deposit_amt }}</td>
                        <td>{{ '---' }}</td>
                        <td>{{ $deposit->refference_no }}</td>
                        <td>{{ $deposit->updated_at }}</td>
                        <td>
                           <?php
                           if($deposit->status=='Pending')
                           {
                              echo "<span  class=\"btn btn-sm btn-warning\">Pending</span>";
                           }
                           else if($deposit->status=='Approved')
                           {
                              echo "<span  class=\"btn btn-sm btn-success\">Approved</span>";
                           }
                           else if($deposit->status=='Reject')
                           {
                              echo "<span  class=\"btn btn-sm btn-danger\">Rejected</span>";
                           }
                           ?>
                        </td>
                        <td class="actions">

                           <?php
                           if($deposit->status == 'Pending' || $deposit->status=='Reject')
                           {
                           ?>
                           <a href="{{ route('outletdeposits.approve', $deposit->id ) }}" class="btn btn-sm btn-success"><i class="fi-pencil"></i> Approved</a>
                           <?php
                           }
                           if($deposit->status == 'Pending' || $deposit->status=='Approved')
                           {
                           ?>
                           <a href="{{ route('outletdeposits.reject', $deposit->id ) }}" class="btn btn-sm btn-warning"><i class="fi-pencil"></i> Reject</a>
                           <?php
                           }
                           if($deposit->status == 'Pending')
                           {
                           ?>
                           <a href="{{ route('outletdeposits.edit', $deposit->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           <?php
                           }
                           ?>

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
