@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('salesoutlets._menu')
               <h3 class="panel-title"><i class="fi-page-multiple"></i> Sales Outlets</h3>
            </div>
            <div class="panel-body">
               <table class="table condence">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-3">Sale Outlet</th>
                        <th class="col-md-3">Address</th>
                        <th class="col-md-3">Contact</th>
                        <th class="col-md-3"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($salesoutlets as $key => $salesoutlet)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>{{ $salesoutlet->name }}</td>
                        <td>{{ $salesoutlet->address }}</td>
                        <td>{{ $salesoutlet->contact }}</td>
                        <td class="actions">
                           <a href="{{ route('salesoutlets.edit', $salesoutlet->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           {{ Form::open(['url' => route('salesoutlets.destroy', $salesoutlet->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $salesoutlets->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
