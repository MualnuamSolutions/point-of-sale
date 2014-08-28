@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><i class="fi-page-add"></i> Product Discount</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('products.update',$product->id), 'method' => 'put', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                           {{ Form::label('name', 'Product Name') }}
                           {{ Form::label('name', stripslashes($product->name), ['class' => 'form-control']) }}
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group {{ $errors->has('product code') ? 'has-error' : '' }}">
                           {{ Form::label('product code', 'Product Code') }}
                           {{ Form::label('product code', stripslashes($product->product_code), ['class' => 'form-control']) }}
                        </div>
                     </div>
                    
                  </div>      
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group {{ $errors->has('cp_sp') ? 'has-error' : '' }}">
                           {{ Form::label('cp_sp', 'Cost Price / Selling Price') }}
                           {{ Form::label('cp_sp', stripslashes("Rs. ".$product->cp." / Rs. ".$product->sp), ['class' => 'form-control']) }}
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group {{ $errors->has('discount') ? 'has-error' : '' }}">
                           {{ Form::label('discount', 'Discount') }}
                           {{ Form::text('discount', stripslashes($product->discount), ['class' => 'form-control']) }}
                           <p class="help-block">Enter Product discount here</p>

                           @if($errors->has('discount'))
                           <p class="help-block">{{ $errors->first('discount') }}</p>
                           @endif
                        </div>
                     </div>
                  </div>

                  <div class="for-group text-right">
                     {{ Form::hidden('check_update', 2, ['class' => 'form-control']) }}
                     {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                  </div>
               {{ Form::close() }}
            </div>
         </div>
      </div>
   </div>
@stop
