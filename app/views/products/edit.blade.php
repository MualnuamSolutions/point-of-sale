@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('products._menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Edit Product</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('products.update',$product->id), 'method' => 'put', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Product Name') }}
                     {{ Form::text('name', $product->name, ['class' => 'form-control']) }}
                     <p class="help-block">Enter Product name here</p>

                     @if($errors->has('name'))
                     <p class="help-block">{{ $errors->first('name') }}</p>
                     @endif
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group {{ $errors->has('type_id') ? 'has-error' : '' }}">
                           {{ Form::label('type_id', 'Type') }}
                           {{ Form::select('type_id', $types, $product->type_id, ['class' => 'form-control']) }}
                           @if($errors->has('type_id'))
                           <p class="help-block">{{ $errors->first('type_id') }}</p>
                           @endif
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group {{ $errors->has('unit_id') ? 'has-error' : '' }}">
                           {{ Form::label('unit_id', 'Unit') }}
                           {{ Form::select('unit_id', $units, $product->unit_id, ['class' => 'form-control']) }}
                           @if($errors->has('unit_id'))
                           <p class="help-block">{{ $errors->first('unit_id') }}</p>
                           @endif
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('cp') ? 'has-error' : '' }}">
                           {{ Form::label('cp', 'Cost Price') }}

                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                              {{ Form::text('cp', $product->cp , ['class' => 'form-control']) }}
                           </div>

                           @if($errors->has('cp'))
                           <p class="help-block">{{ $errors->first('cp') }}</p>
                           @endif
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('sp') ? 'has-error' : '' }}">
                           {{ Form::label('sp', 'Selling Price') }}
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                              {{ Form::text('sp', $product->sp , ['class' => 'form-control']) }}
                           </div>

                           @if($errors->has('sp'))
                           <p class="help-block">{{ $errors->first('sp') }}</p>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                           {{ Form::label('quantity', 'Product Quantity') }}
                           {{ Form::text('quantity', $product->quantity , ['class' => 'form-control']) }}
                           @if($errors->has('quantity'))
                           <p class="help-block">{{ $errors->first('quantity') }}</p>
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
