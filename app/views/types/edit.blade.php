@extends('layout')

@section('content')
   <div class="col-md-4 col-md-offset-4">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><i class="fi-page-edit"></i> Edit Type</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('types.update', $type->id), 'method' => 'put', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Type Name') }}
                     {{ Form::text('name', $type->name, ['class' => 'form-control']) }}
                     <p class="help-block">Enter type name here</p>

                     @if($errors->has('name'))
                     <p class="help-block">{{ $errors->first('name') }}</p>
                     @endif
                  </div>

                  <div class="for-group text-right">
                     {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                  </div>
               {{ Form::close() }}
            </div>
         </div>
      </div>
   </div>
@stop
