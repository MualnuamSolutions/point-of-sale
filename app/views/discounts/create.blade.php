@extends('layout')

@section('content')
   <div class="col-md-8 col-md-offset-2">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('products._menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Create Discount</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('discounts.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group {{ $errors->has('product_id') ? 'has-error' : '' }}">
                           {{ Form::label('product_id', 'Select Product') }}
                           <div class="select2-wrapper">
                            {{ Form::select('product_id', $products, '', ['class' => 'select2']) }}
                           </div>
                           @if($errors->has('product_id'))
                           <p class="help-block">{{ $errors->first('product_id') }}</p>
                           @endif
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('discount_type') ? 'has-error' : '' }}">
                           {{ Form::label('discount_type', 'Discount Type') }}
                           {{ Form::select('discount_type', $discountTypes, '', ['class' => 'form-control']) }}

                           @if($errors->has('discount_type'))
                           <p class="help-block">{{ $errors->first('discount_type') }}</p>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                           {{ Form::label('amount', 'Discount Amount') }}
                           {{ Form::text('amount', '', ['class' => 'form-control']) }}

                           @if($errors->has('amount'))
                           <p class="help-block">{{ $errors->first('amount') }}</p>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                           {{ Form::label('status', 'Status') }}
                           {{ Form::select('status', $statuses, '', ['class' => 'form-control']) }}

                           @if($errors->has('status'))
                           <p class="help-block">{{ $errors->first('status') }}</p>
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
