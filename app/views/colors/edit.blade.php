@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('colors._menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Edit Color</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('colors.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Colour Name') }}
                     {{ Form::text('name', $color->name, ['class' => 'form-control']) }}
                     <p class="help-block">Enter Color name here</p>

                     @if($errors->has('code'))
                     <p class="help-block">{{ $errors->first('name') }}</p>
                     @endif
                  </div>
                  <div class="form-group {{ $errors->has('color') ? 'has-error' : '' }}">
                           {{ Form::label('color', 'Color') }}
                           {{ Form::text('color', $color->code, ['class' => 'form-control pick-a-color']) }}
                           @if($errors->has('color'))
                           <p class="help-block">{{ $errors->first('color') }}</p>
                           @endif
                        </div>

                  <div class="for-group text-right">
                     {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                  </div>
               {{ Form::close() }}
            </div>
         </div>
      </div>
   </div>
@stop
