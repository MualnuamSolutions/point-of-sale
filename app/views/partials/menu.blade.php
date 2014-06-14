@if(isset($position) && $position == 'top')
<div class="hidden-xs" id="topbar_menu">
   <ul class="nav navbar-nav navbar-right">
      <li><a class="tooltip-bottom" title="Create New Sale" data-toggle="tooltip" href="{{ route('sales.create') }}">New Sale</a></li>
      <li><a class="tooltip-bottom" title="Sales Records" data-toggle="tooltip" href="{{ route('sales.index') }}">Sales</a></li>
      <li><a class="tooltip-bottom" title="Stocks" data-toggle="tooltip" href="{{ route('stocks.index') }}">Stocks</a></li>
      <li><a class="tooltip-bottom" title="Products" data-toggle="tooltip" href="{{ route('products.index') }}">Products</a></li>
      <li><a class="tooltip-bottom" title="Suppliers" data-toggle="tooltip" href="{{ route('suppliers.index') }}">Suppliers</a></li>
      <li><a class="tooltip-bottom" title="Customers" data-toggle="tooltip" href="{{ route('customers.index') }}">Customers</a></li>
      <li><a class="tooltip-bottom" title="Sales Outlets" data-toggle="tooltip" href="{{ route('home') }}">Outlet</a></li>
      <li><a class="tooltip-bottom" title="Outlets Distribution" data-toggle="tooltip" href="{{ route('home') }}">Distribution</a></li>
      <li><a class="tooltip-bottom" title="Product Units" data-toggle="tooltip" href="{{ route('units.index') }}">Unit</a></li>
      <li><a class="tooltip-bottom" title="Product Types" data-toggle="tooltip" href="{{ route('types.index') }}">Types</a></li>
      <li><a class="tooltip-bottom" title="Users" data-toggle="tooltip" href="{{ route('user.index') }}">Users</a></li>
      <li><a class="tooltip-bottom" title="Log Out" data-toggle="tooltip" href="{{ route('user.logout') }}"><i class="fi-power"></i></a></li>
   </ul>
</div>
@endif

@if(isset($position) && $position == 'sidebar')
<div class="visible-xs col-xs-6 sidebar-offcanvas" id="sidebar">
   <div class="list-group">
      <a href="{{ route('sales.create') }}" class="list-group-item"><i class="fi-shopping-cart"></i> New Sale</a>
      <a href="{{ route('sales.index') }}" class="list-group-item"><i class="fa fa-bank"></i> Sales</a>
      <a href="{{ route('stocks.index') }}" class="list-group-item"><i class="fi-database"></i> Stocks</a>
      <a href="{{ route('products.index') }}" class="list-group-item"><i class="glyphicon glyphicon-gift"></i> Products</a>
      <a href="{{ route('suppliers.index') }}" class="list-group-item"><i class="fa fa-truck"></i> Suppliers</a>
      <a href="{{ route('customers.index') }}" class="list-group-item"><i class="fi-torsos-all"></i> Customers</a>
      <a href="{{ route('home') }}" class="list-group-item"><i class="fi-home"></i> Sales Outlets</a>
      <a href="{{ route('home') }}" class="list-group-item"><i class="fa fa-truck"></i> Outlets Distribution</a>
      <a href="{{ route('units.index') }}" class="list-group-item"><i class="fa fa-cube"></i> Units</a>
      <a href="{{ route('types.index') }}" class="list-group-item"><i class="fa fa-cubes"></i> Types</a>
      <a href="{{ route('user.index') }}" class="list-group-item"><i class="fi-torsos"></i> Users</a>
      <a href="{{ route('user.logout') }}" class="list-group-item"><i class="fi-power"></i> Logout</a>
   </div>
</div>
@endif
