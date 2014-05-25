@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               @include('types._menu')

               <h3 class="panel-title"><i class="fi-page-multiple"></i> Types</h3>
            </div>

            <div class="panel-body">
               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-8">Type Name</th>
                        <th class="col-md-3"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($types as $key => $type)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>{{ $type->name }}</td>
                        <td class="actions">
                           <a href="{{ route('types.edit', $type->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           {{ Form::open(['url' => route('types.destroy', $type->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit', 'onclick' => 'return confirm("Are you sure you want to delete?")']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $types->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
