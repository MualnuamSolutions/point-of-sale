@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               @include('suppliers._menu')

               <h3 class="panel-title"><i class="fi-page-edit"></i> Edit Suppliers</h3>
            </div>

            <div class="panel-body">
               {{ Form::open(['url' => route('suppliers.update', $supplier->id), 'method' => 'put', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Supplier Name') }}
                     {{ Form::text('name', $supplier->name, ['class' => 'form-control']) }}
                     <p class="help-block">Enter Supplier name here</p>

                     @if($errors->has('name'))
                     <p class="help-block">{{ $errors->first('name') }}</p>
                     @endif
                  </div>

                  <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                     {{ Form::label('address', 'Address') }}
                     {{ Form::text('address', $supplier->address, ['class' => 'form-control']) }}
                     <p class="help-block">Enter address here</p>

                     @if($errors->has('address'))
                     <p class="help-block">{{ $errors->first('address') }}</p>
                     @endif
                  </div>

                  <div class="form-group {{ $errors->has('contact') ? 'has-error' : '' }}">
                     {{ Form::label('contact', 'Contact') }}
                     {{ Form::text('contact', $supplier->contact, ['class' => 'form-control']) }}
                     <p class="help-block">Enter Contact here</p>

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
