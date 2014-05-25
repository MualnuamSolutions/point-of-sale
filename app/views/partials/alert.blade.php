@if(Session::has('error'))
<div data-alert class="alert alert-dismissable alert-danger">
   {{ Session::get('error') }}
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
@endif

@if(Session::has('success'))
<div data-alert class="alert alert-dismissable alert-success">
   <i class="fi-check"></i>
   {{ Session::get('success') }}
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
@endif

@if(Session::has('warning'))
<div data-alert class="alert alert-dismissable alert-warning">
   {{ Session::get('warning') }}
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
@endif

@if(Session::has('info'))
<div data-alert class="alert alert-dismissable alert-info">
   {{ Session::get('info') }}
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
@endif
