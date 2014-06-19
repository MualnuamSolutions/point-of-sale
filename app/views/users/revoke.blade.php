@extends('layout')

@section('title')
   <h4><i class="fa fa-user"></i> Revoke Permissions</h4>
@stop

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               <h3 class="panel-title"><i class="fa fa-key"></i> Revoke Permission</h3>
            </div>

            <div class="panel-body">
               <p class="alert alert-success">Group permissions revoked</p>
               <pre><?php print_r($permissions); ?></pre>
            </div>
         </div>
      </div>
   </div>
@stop
