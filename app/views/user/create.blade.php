@extends('layout')

@section('alert')
   @include('partials.alert')
@stop

@section('title')
   <h4><i class="fi-page-add"></i> Create User</h4>
@stop

@section('content')
   {{ Form::open(['url' => route('user.store'), 'method' => 'post']) }}
   <fieldset>
      <div class="row">
         <div class="large-6 columns">
            {{ Form::label('name', 'Full Name', ['class' => $errors->has('name')?'error':'']) }}
            {{ Form::text('name', '', ['placeholder' => 'You must enter full name', 'class' => $errors->has('name')?'error':'']) }}
            @if($errors->has('name'))
            <small class="error">{{ $errors->first('name') }}</small>
            @endif

            {{ Form::label('email', 'Email Address', ['class' => $errors->has('email')?'error':'']) }}
            {{ Form::text('email', '', ['placeholder' => 'You must enter email address', 'class' => $errors->has('email')?'error':'']) }}
            @if($errors->has('email'))
            <small class="error">{{ $errors->first('email') }}</small>
            @endif

            {{ Form::label('password', 'Password', ['class' => $errors->has('password')?'error':'']) }}
            {{ Form::password('password', ['placeholder' => 'Password for login', 'class' => $errors->has('password')?'error':'']) }}
            @if($errors->has('password'))
            <small class="error">{{ $errors->first('password') }}</small>
            @endif

            {{ Form::label('password_confirmation', 'Confirm Password', ['class' => $errors->has('password_confirmation')?'error':'']) }}
            {{ Form::password('password_confirmation', ['placeholder' => 'Confirm password for login', 'class' => $errors->has('password_confirmation')?'error':'']) }}
            @if($errors->has('password_confirmation'))
            <small class="error">{{ $errors->first('password_confirmation') }}</small>
            @endif

         </div>
         <div class="large-6 columns">
            {{ Form::label('address', 'Address', ['class' => $errors->has('address')?'error':'']) }}
            {{ Form::textarea('address', '', ['rows' => '', 'placeholder' => 'Address is optional']) }}
            @if($errors->has('address'))
            <small class="error">{{ $errors->first('address') }}</small>
            @endif

            {{ Form::label('phone', 'Contact Number', ['class' => $errors->has('phone')?'error':'']) }}
            {{ Form::text('phone', '', ['placeholder' => 'Contact number is optional']) }}
            @if($errors->has('phone'))
            <small class="error">{{ $errors->first('phone') }}</small>
            @endif

            {{ Form::label('role', 'Role', ['class' => $errors->has('role')?'error':'']) }}
            {{ Form::select('role', User::$roles) }}
            @if($errors->has('role'))
            <small class="error">{{ $errors->first('role') }}</small>
            @endif

            {{ Form::radio('activated', 1, true, ['id' => 'activated']) }}
            {{ Form::label('activated', 'Activated') }}

            {{ Form::radio('activated', 0, false, ['id' => 'deactivated']) }}
            {{ Form::label('deactivated', 'Deactivated') }}
         </div>
      </div>
      <div class="row">
         <div class="large-12 columns text-right">
            {{ Form::button('Submit', ['class' => 'small', 'type' => 'submit']) }}
         </div>
      </div>
   </fieldset>
   {{ Form::close() }}
@stop
