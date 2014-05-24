<div class="top-row">
   <div class="container">
      <div class="col-md-12">
         <div class="row">
            <div class="navbar-header">
               <h3>ZOHANDCO</h3>
               <h5>Point of Sale</h5>
            </div>

            @if(Sentry::check())
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                     </ul>
                  </li>
                  <li><a href="{{ route('user.logout') }}"><i class="fi-power"></i></a></li>
               </ul>
            </div>
            @endif
         </div>
      </div>
   </div>
</div>
