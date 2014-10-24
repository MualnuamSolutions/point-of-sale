@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('sales._menu')
               <h3 class="panel-title">Edit Distribution</h3>
            </div>
            <div class="panel-body sales-create">

               {{ Form::open(['url' => route('distributions.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group {{ $errors->has('outlet_id') ? 'has-error' : '' }}">
                        {{ Form::label('outlet_id', 'Select Destination Outlet') }}
                        {{ Form::select('outlet_id', $outlets, '', ['class' => 'form-control input-sm']) }}

                        @if($errors->has('outlet_id'))
                        <p class="help-block">{{ $errors->first('outlet_id') }}</p>
                        @endif
                     </div>
                  </div>

                  <div class="form-group text-right">
                     {{ Form::button('<i class="fa fa-check-square"></i> Submit', ['class' => 'btn btn-md btn-primary', 'type' => 'submit']) }}
                  </div>
               </div>
               {{ Form::close() }}

            </div>
         </div>
      </div>
   </div>
@stop

@section('script')
@stop
