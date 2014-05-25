@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('stocks._menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Create Stock</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('stocks.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group {{ $errors->has('type_id') ? 'has-error' : '' }}">
                           {{ Form::label('supplier_id', 'Supplier') }}
                           {{ Form::select('supplier_id', $suppliers, '', ['class' => 'form-control']) }}
                           @if($errors->has('supplier_id'))
                           <p class="help-block">{{ $errors->first('supplier_id') }}</p>
                           @endif
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group {{ $errors->has('product_id') ? 'has-error' : '' }}">
                           {{ Form::label('product_id', 'Product') }}
                           {{ Form::select('product_id', $products, '', ['class' => 'form-control']) }}
                           @if($errors->has('product_id'))
                           <p class="help-block">{{ $errors->first('product_id') }}</p>
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
                              {{ Form::text('cp', '', ['class' => 'form-control']) }}
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
                              {{ Form::text('sp', '', ['class' => 'form-control']) }}
                           </div>
                           @if($errors->has('sp'))
                           <p class="help-block">{{ $errors->first('sp') }}</p>
                           @endif
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                           {{ Form::label('quantity', 'Quantity') }}
                           {{ Form::text('quantity', '', ['class' => 'form-control']) }}
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
