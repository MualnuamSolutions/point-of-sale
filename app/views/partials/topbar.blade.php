<nav class="top-row navbar navbar-default" role="navigation">
   <div class="container">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="#">
            <span class="brand">ZOHANDCO</span>
            <span class="sub-brand">Point of Sale</span>
         </a>
      </div>

      @if(Sentry::check())
      <div class="collapse navbar-collapse" id="topbar">
         <ul class="nav navbar-nav navbar-right">
            <li><a class="tooltip-bottom" title="Types" data-toggle="tooltip" href="{{ route('user.logout') }}"><i class="fi-power"></i></a></li>
            <li><a class="tooltip-bottom" title="Log Out" data-toggle="tooltip" href="{{ route('user.logout') }}"><i class="fi-power"></i></a></li>
         </ul>
      </div>
      @endif

   </div>
</nav>
