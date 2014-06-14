@if(isset($position) && $position == 'top')
<div class="hidden-xs" id="topbar_menu">
   <ul class="nav navbar-nav navbar-right">
      <li class="{{ Mualnuam\Menu::isCurrent('sales.create') }}"><a href="{{ route('sales.create') }}">New Sale</a></li>
      <li class="{{ Mualnuam\Menu::isCurrent('sales.index') }}"><a href="{{ route('sales.index') }}">Sales</a></li>
      <li class="{{ Mualnuam\Menu::isCurrent('stocks.index') }}"><a href="{{ route('stocks.index') }}">Stocks</a></li>
      <li class="{{ Mualnuam\Menu::isCurrent('products.index') }}"><a href="{{ route('products.index') }}">Products</a></li>
      <li class="{{ Mualnuam\Menu::isCurrent('suppliers.index') }}"><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
      <li class="{{ Mualnuam\Menu::isCurrent('salesoutlets.index') }}"><a href="{{ route('salesoutlets.index') }}">Outlets</a></li>
      <li><a href="{{ route('home') }}">Distribution</a></li>
      <li class="dropdown {{ Mualnuam\Menu::isCurrent(['customers.index', 'units.index', 'types.index', 'users.index']) }}">
         <a class="dropdown-toggle" data-toggle="dropdown" href="#">System <span class="caret"></span></a>
         <ul class="dropdown-menu">
            <li class="{{ Mualnuam\Menu::isCurrent('customers.index') }}"><a href="{{ route('customers.index') }}"><i class="fa fa-arrow-right"></i> Customers</a></li>
            <li class="{{ Mualnuam\Menu::isCurrent('units.index') }}"><a href="{{ route('units.index') }}"><i class="fa fa-arrow-right"></i> Product Unit</a></li>
            <li class="{{ Mualnuam\Menu::isCurrent('types.index') }}"><a href="{{ route('types.index') }}"><i class="fa fa-arrow-right"></i> Product Types</a></li>
            <li class="{{ Mualnuam\Menu::isCurrent('users.index') }}"><a href="{{ route('users.index') }}"><i class="fa fa-arrow-right"></i> Users</a></li>
            <li class="{{ Mualnuam\Menu::isCurrent('users.revokePermission') }}"><a href="{{ route('users.revokePermission') }}"><i class="fa fa-arrow-right"></i> Revoke Permission</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('users.logout') }}"><i class="fi-power"></i> Logout</a></li>
         </ul>
      </li>
   </ul>
</div>
@endif

@if(isset($position) && $position == 'sidebar')
<div class="visible-xs col-xs-6 sidebar-offcanvas" id="sidebar">
   <div class="list-group">
      <a href="{{ route('sales.create') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> New Sale</a>
      <a href="{{ route('sales.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Sales</a>
      <a href="{{ route('stocks.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Stocks</a>
      <a href="{{ route('products.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Products</a>
      <a href="{{ route('suppliers.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Suppliers</a>
      <a href="{{ route('salesoutlets.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Sales Outlets</a>
      <a href="{{ route('home') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Outlets Distribution</a>
      <a href="{{ route('customers.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Customers</a>
      <a href="{{ route('units.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Units</a>
      <a href="{{ route('types.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Types</a>
      <a href="{{ route('users.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Users</a>
      <a href="{{ route('users.revokePermission') }}"><i class="fa fa-arrow-right"></i> Revoke Permission</a>
      <a href="{{ route('users.logout') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Logout</a>
   </div>
</div>
@endif
