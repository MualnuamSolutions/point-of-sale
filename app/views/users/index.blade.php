@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               @include('users._menu')

               <h3 class="panel-title"><i class="fi-page-users"></i> Users</h3>
            </div>

            <div class="panel-body">
               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-2">Email</th>
                        <th class="col-md-2">Role</th>
                        <th class="col-md-2">Contact</th>
                        <th class="col-md-2">Outlet</th>
                        <th class="col-md-2">Status</th>
                        <th class="col-md-2"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($users as $key => $user)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ implode('', $user->groups->lists('name')) }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->outlet ? $user->outlet->name : null }}</td>
                        <td>{{ $user->activated ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' }}</td>
                        <td class="actions">
                           <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           {{ Form::open(['url' => route('users.destroy', $user->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit', 'onclick' => 'return confirm("Are you sure you want to delete?")']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $users->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
