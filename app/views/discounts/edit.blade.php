@extends('layout')

@section('content')
   <div class="col-md-8 col-md-offset-2">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('products._menu')
               <h3 class="panel-title"><i class="fi-page-edit"></i> Edit Discount - {{ $product->name }}</h3>
            </div>
            <div class="panel-body">
               {{ Form::model($discount, ['route' => ['discounts.update', $discount->id], 'method' => 'put', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}

                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('discount_type') ? 'has-error' : '' }}">
                           {{ Form::label('discount_type', 'Discount Type') }}
                           {{ Form::select('discount_type', $discountTypes, null, ['class' => 'form-control']) }}

                           @if($errors->has('discount_type'))
                           <p class="help-block">{{ $errors->first('discount_type') }}</p>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                           {{ Form::label('amount', 'Discount Amount') }}
                           {{ Form::text('amount', null, ['class' => 'form-control']) }}

                           @if($errors->has('amount'))
                           <p class="help-block">{{ $errors->first('amount') }}</p>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                           {{ Form::label('status', 'Status') }}
                           {{ Form::select('status', $statuses, null, ['class' => 'form-control']) }}

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
