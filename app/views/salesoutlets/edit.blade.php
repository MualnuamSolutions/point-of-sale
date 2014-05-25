@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               @include('salesoutlets._menu')

               <h3 class="panel-title"><i class="fi-page-edit"></i> Edit Sales Outlet</h3>
            </div>

            <div class="panel-body">
               {{ Form::open(['url' => route('salesoutlets.update', $salesoutlet->id), 'method' => 'put', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'salesoutlet Name') }}
                     {{ Form::text('name', $salesoutlet->name, ['class' => 'form-control']) }}
                     @if($errors->has('name'))
                     <p class="help-block">{{ $errors->first('name') }}</p>
                     @endif
                  </div>

                  <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                     {{ Form::label('address', 'Address') }}
                     {{ Form::text('address', $salesoutlet->address, ['class' => 'form-control']) }}
                     @if($errors->has('address'))
                     <p class="help-block">{{ $errors->first('address') }}</p>
                     @endif
                  </div>

                  <div class="form-group {{ $errors->has('contact') ? 'has-error' : '' }}">
                     {{ Form::label('contact', 'Contact') }}
                     {{ Form::text('contact', $salesoutlet->contact, ['class' => 'form-control']) }}

                     @if($errors->has('contact'))
                     <p class="help-block">{{ $errors->first('contact') }}</p>
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
