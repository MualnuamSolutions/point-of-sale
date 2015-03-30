@extends('layout')

@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('products._menu')
                <h3 class="panel-title"><i class="fi-page-lock"></i> Change Pasword</h3>
            </div>

            <div class="panel-body">
                {{ Form::model($user, ['url' => route('users.updatePassword'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            {{ Form::label('password', 'New Password') }}
                            {{ Form::password('password', ['class' => 'form-control']) }}

                            @if($errors->has('password'))
                                <p class="help-block">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            {{ Form::label('password_confirmation', 'Confirm Password') }}
                            {{ Form::password('password_confirmation', ['class' => 'form-control']) }}

                            @if($errors->has('password_confirmation'))
                                <p class="help-block">{{ $errors->first('password_confirmation') }}</p>
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
