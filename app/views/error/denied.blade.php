@extends('layout')

@section('title')
<h4><i class="fi-lock"></i> {{_('Access Denied')}}</h4>
@stop

@section('content')
<div class="alert-box secondary">
	@if(isset($route_name) && $route_name != '')
	<p>You are trying to access <strong>{{ route($route_name) }}</strong> page.</p>
	@endif

	<p>{{_('You are not allowed to access this page. Please contact administrator.')}}</p>
</div>
@stop
