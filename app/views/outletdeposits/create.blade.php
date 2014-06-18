@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('outletdeposits._menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Create New Deposit</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('outletdeposits.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}

                  <div class="form-group {{ $errors->has('outlet_id') ? 'has-error' : '' }}">
                     {{ Form::label('outlet_id', 'Sale Outlet') }}
                     {{ Form::select('outlet_id', $outlets, '', ['class' => 'form-control']) }}
                     @if($errors->has('outlet_id'))
                     <p class="help-block">{{ $errors->first('outlet_id') }}</p>
                     @endif
                  </div>

                  <div class="form-group {{ $errors->has('deposit') ? 'has-error' : '' }}">
                     {{ Form::label('deposit', 'Deposit Amount') }}
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                        {{ Form::text('deposit', '', ['class' => 'form-control']) }}
                     </div>
                     @if($errors->has('deposit'))
                     <p class="help-block">{{ $errors->first('deposit') }}</p>
                     @endif
                  </div>

                  <div class="form-group {{ $errors->has('refference') ? 'has-error' : '' }}">
                     {{ Form::label('refference', 'Refference No') }}
                     {{ Form::text('refference', '', ['class' => 'form-control']) }}
                     <p class="help-block">Enter Refference No</p>

                     @if($errors->has('refference'))
                     <p class="help-block">{{ $errors->first('refference') }}</p>
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
