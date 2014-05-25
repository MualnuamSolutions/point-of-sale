@extends('layout')

@section('content')
   <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li><a href="#">Library</a></li>
      <li class="active">Data</li>
   </ol>

   <h4 class="title">Form</h4>
   <hr>
   <div class="form-group has-success has-feedback">
      <label class="control-label" for="inputSuccess2">Input with success</label>
      <input type="text" class="form-control" id="inputSuccess2">
      <span class="glyphicon glyphicon-ok form-control-feedback"></span>
   </div>
   <div class="form-group has-warning has-feedback">
      <label class="control-label" for="inputWarning2">Input with warning</label>
      <input type="text" class="form-control" id="inputWarning2">
      <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
   </div>
   <div class="form-group has-error has-feedback">
      <label class="control-label" for="inputError2">Input with error</label>
      <input type="text" class="form-control" id="inputError2">
      <span class="glyphicon glyphicon-remove form-control-feedback"></span>
   </div>

   <h4>Tables</h4>

@stop
