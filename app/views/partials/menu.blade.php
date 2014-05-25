@if(isset($position) && $position == 'top')
<div class="hidden-xs" id="topbar_menu">
   <ul class="nav navbar-nav navbar-right">
      <li><a class="tooltip-bottom" title="Products" data-toggle="tooltip" href="{{ route('products.index') }}"><i class="fa fa-gift"></i></a></li>
      <li><a class="tooltip-bottom" title="Suppliers" data-toggle="tooltip" href="{{ route('suppliers.index') }}"><i class="fa fa-truck"></i></a></li>
      <li><a class="tooltip-bottom" title="Customers" data-toggle="tooltip" href="{{ route('customers.index') }}"><i class="fa fa-users"></i></a></li>
      <li><a class="tooltip-bottom" title="Units" data-toggle="tooltip" href="{{ route('units.index') }}"><i class="fa fa-cube"></i></a></li>
      <li><a class="tooltip-bottom" title="Types" data-toggle="tooltip" href="{{ route('types.index') }}"><i class="fa fa-cubes"></i></a></li>
      <li><a class="tooltip-bottom" title="Log Out" data-toggle="tooltip" href="{{ route('user.logout') }}"><i class="fi-power"></i></a></li>
   </ul>
</div>
@endif

@if(isset($position) && $position == 'sidebar')
<div class="visible-xs col-xs-6 sidebar-offcanvas" id="sidebar">
   <div class="list-group">
      <a href="{{ route('products.index') }}" class="list-group-item"><i class="fa fa-gift"></i> Products</a>
      <a href="{{ route('suppliers.index') }}" class="list-group-item"><i class="fa fa-truck"></i> Suppliers</a>
      <a href="{{ route('customers.index') }}" class="list-group-item"><i class="fa fa-users"></i> Units</a>
      <a href="{{ route('units.index') }}" class="list-group-item"><i class="fa fa-users"></i> Units</a>
      <a href="{{ route('types.index') }}" class="list-group-item"><i class="fa fa-users"></i> Types</a>
      <a href="{{ route('user.logout') }}" class="list-group-item"><i class="fi-power"></i> Logout</a>
   </div>
</div>
@endif
