@extends('layout')

@section('content')
   <div class="col-md-8 col-md-offset-2">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('stocks._menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Create Stock Return</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('stockreturns.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  {{ Form::hidden('stock_id', $id) }}
                  <div class="row">
                    <div class="col-md-4">
                        <div id="quantity" class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                           {{ Form::label('quantity', 'Quantity') }}
                           <div class="input-group">
                              {{ Form::text('quantity', '', ['class' => 'form-control']) }}
                              <span class="input-group-addon">-</span>
                           </div>
                           @if($errors->has('quantity'))
                           <p class="help-block">{{ $errors->first('quantity') }}</p>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div id="comments" class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                           {{ Form::label('comments', 'Comments') }}
                           <div class="input-group">
                              {{ Form::text('comments', '', ['class' => 'form-control']) }}
                              <span class="input-group-addon">-</span>
                           </div>
                           @if($errors->has('comments'))
                           <p class="help-block">{{ $errors->first('comments') }}</p>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="for-group text-right">
                     {{ Form::hidden('outlet_id', $outletsstocks->outlet_id, ['class' => 'form-control']) }}
                     {{ Form::hidden('product_id', $outletsstocks->product_id, ['class' => 'form-control']) }}
                     {{ Form::submit('Return', ['class' => 'btn btn-primary']) }}
                  </div>
               {{ Form::close() }}
            </div>
         </div>
      </div>
   </div>
@stop

