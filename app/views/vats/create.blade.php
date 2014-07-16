@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><i class="fi-page-add"></i> Create New Vat</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('vats.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="form-group {{ $errors->has('vat') ? 'has-error' : '' }}">
                     {{ Form::label('vat', 'VAT %') }}
                     {{ Form::text('vat', '', ['class' => 'form-control']) }}
                     <p class="help-block">Enter VAT % here</p>

                     @if($errors->has('vat'))
                     <p class="help-block">{{ $errors->first('vat') }}</p>
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
