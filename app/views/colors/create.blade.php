@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('colors._menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Create Product</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('colors.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Color Name') }}
                     {{ Form::text('name', '', ['class' => 'form-control']) }}
                     <p class="help-block">Enter Color name here</p>

                     @if($errors->has('name'))
                     <p class="help-block">{{ $errors->first('name') }}</p>
                     @endif
                  </div>
                  <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                           {{ Form::label('code', 'Code') }}
                           {{ Form::text('code', '444444', ['class' => 'form-control pick-a-code']) }}
                           @if($errors->has('code'))
                           <p class="help-block">{{ $errors->first('code') }}</p>
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
