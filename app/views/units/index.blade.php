@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><i class="fi-page-multiple"></i> Units</h3>
            </div>
            <div class="panel-body">
               <table class="table condence">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-9">Unit Name</th>
                        <th class="col-md-3"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($units as $key => $unit)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>{{ $unit->name }}</td>
                        <td class="actions">
                           <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           {{ Form::open(['url' => route('units.destroy', $unit->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $units->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
