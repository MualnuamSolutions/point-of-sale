@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('colors._menu')
               <h3 class="panel-title"><i class="fi-page-multiple"></i> Create New Color</h3>
            </div>
            <div class="panel-body">
               <table class="table condence">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-5">Color Name</th>
                        <th class="col-md-3">Color code</th>
                        <th class="col-md-4"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($colors as $key => $color)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>{{ $color->name }}</td>
                        <td>
                           <span style="display:block;height:20px;background-color: #{{ $color->code}}"></span>
                           <small>{{ $color->code ? '#' . $color->code : ''}}</small>
                        </td>
                        <td class="actions">
                           <a href="{{ route('colors.edit', $color->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           {{ Form::open(['url' => route('colors.destroy', $color->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $colors->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
