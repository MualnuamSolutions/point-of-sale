@if(Session::has('error'))
<div data-alert class="alert-box alert">
   {{ Session::get('error') }}
   <a href="#" class="close">&times;</a>
</div>
@endif

@if(Session::has('success'))
<div data-alert class="alert-box success">
   <i class="fi-check"></i>
   {{ Session::get('success') }}
   <a href="#" class="close">&times;</a>
</div>
@endif

@if(Session::has('warning'))
<div data-alert class="alert-box warning">
   {{ Session::get('warning') }}
   <a href="#" class="close">&times;</a>
</div>
@endif

@if(Session::has('info'))
<div data-alert class="alert-box secondary">
   {{ Session::get('info') }}
   <a href="#" class="close">&times;</a>
</div>
@endif
