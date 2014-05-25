@extends('layout')

@section('content')
   <div class="col-md-4 col-md-offset-4">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('customers._menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Create Customer</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('customers.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Customer Name') }}
                     {{ Form::text('name', '', ['class' => 'form-control']) }}
                     <p class="help-block">Enter Customer name here</p>

                     @if($errors->has('name'))
                     <p class="help-block">{{ $errors->first('name') }}</p>
                     @endif
                  </div>

                  <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                     {{ Form::label('address', 'Address') }}
                     {{ Form::text('address', '', ['class' => 'form-control']) }}
                     <p class="help-block">Enter Customer address here</p>

                     @if($errors->has('address'))
                     <p class="help-block">{{ $errors->first('address') }}</p>
                     @endif
                  </div>

                  <div class="form-group {{ $errors->has('contact') ? 'has-error' : '' }}">
                     {{ Form::label('contact', 'Contact') }}
                     {{ Form::text('contact', '', ['class' => 'form-control']) }}
                     <p class="help-block">Enter Customer Contact here</p>

                     @if($errors->has('contact'))
                     <p class="help-block">{{ $errors->first('contact') }}</p>
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
