<nav class="top-row navbar navbar-default" role="navigation">
   <div class="container">
      <div class="navbar-header">
         @if(Sentry::check())
         <a data-toggle="offcanvas" class="toggle-canvas visible-xs hidden-sm pull-right"><i class="fi-list"></i></a>
         @endif

         <a class="navbar-brand" href="{{ route('home') }}">
            <span class="brand">ZOHANDCO</span>
            <span class="sub-brand">Point of Sale</span>
         </a>
      </div>

      @if(Sentry::check())
      @include('partials.menu', ['position' => 'top'])
      @endif

   </div>
</nav>
