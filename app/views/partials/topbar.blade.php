<nav class="top-row navbar navbar-default" role="navigation">
   <div class="container">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="topbar_menu">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="{{ route('home') }}">
            <span class="brand">ZOHANDCO</span>
            <span class="sub-brand">Point of Sale</span>
         </a>
      </div>

      @if(Sentry::check())
      <div class="hidden-xs visible-sm visible-md visible-lg" id="topbar_menu">
         <ul class="nav navbar-nav navbar-right">
            <li><a class="tooltip-bottom" title="Customers" data-toggle="tooltip" href="{{ route('units.index') }}"><i class="fa fa-users"></i></a></li>
            <li><a class="tooltip-bottom" title="Units" data-toggle="tooltip" href="{{ route('units.index') }}"><i class="fa fa-cube"></i></a></li>
            <li><a class="tooltip-bottom" title="Types" data-toggle="tooltip" href="{{ route('types.index') }}"><i class="fa fa-cubes"></i></a></li>
            <li><a class="tooltip-bottom" title="Log Out" data-toggle="tooltip" href="{{ route('user.logout') }}"><i class="fi-power"></i></a></li>
         </ul>
      </div>
      @endif

   </div>
</nav>
