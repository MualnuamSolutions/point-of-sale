@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('products._menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Create Product</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('products.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Product Name') }}
                     {{ Form::text('name', '', ['class' => 'form-control']) }}
                     <p class="help-block">Enter Product name here</p>

                     @if($errors->has('name'))
                     <p class="help-block">{{ $errors->first('name') }}</p>
                     @endif
                  </div>

                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('color') ? 'has-error' : '' }}">
                           {{ Form::label('color', 'Color') }}
                           {{ Form::text('color', '444444', ['class' => 'form-control pick-a-color']) }}
                           @if($errors->has('color'))
                           <p class="help-block">{{ $errors->first('color') }}</p>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('type_id') ? 'has-error' : '' }}">
                           {{ Form::label('type_id', 'Type') }}
                           {{ Form::select('type_id', $types, '', ['class' => 'form-control']) }}
                           @if($errors->has('type_id'))
                           <p class="help-block">{{ $errors->first('type_id') }}</p>
                           @endif
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('unit_id') ? 'has-error' : '' }}">
                           {{ Form::label('unit_id', 'Unit') }}
                           {{ Form::select('unit_id', $units, '', ['class' => 'form-control']) }}
                           @if($errors->has('unit_id'))
                           <p class="help-block">{{ $errors->first('unit_id') }}</p>
                           @endif
                        </div>
                     </div>
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
