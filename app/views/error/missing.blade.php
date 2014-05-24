@extends('layout.main')

@section('content')
<div class="col-md-6 col-md-offset-3">
	<h2><i class="fa fa-search"></i> {{_('Page Not Found')}}</h2>
	<hr>	
	<p>{{_('The page you are trying to access was not found.')}}</p>
</div>
@stop