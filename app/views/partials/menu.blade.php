@if(isset($position) && $position == 'top')
<div class="hidden-xs" id="topbar_menu">
   <ul class="nav navbar-nav navbar-right">
      <li><a href="{{ route('sales.create') }}">New Sale</a></li>
      <li><a href="{{ route('sales.index') }}">Sales</a></li>
      <li><a href="{{ route('stocks.index') }}">Stocks</a></li>
      <li><a href="{{ route('products.index') }}">Products</a></li>
      <li><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
      <li><a href="{{ route('salesoutlets.index') }}">Outlets</a></li>
      <li><a href="{{ route('home') }}">Distribution</a></li>
      <li class="dropdown">
         <a class="dropdown-toggle" data-toggle="dropdown" href="#">System <span class="caret"></span></a>
         <ul class="dropdown-menu">
            <li><a href="{{ route('customers.index') }}">Customers</a></li>
            <li><a href="{{ route('units.index') }}">Product Unit</a></li>
            <li><a href="{{ route('types.index') }}">Product Types</a></li>
            <li><a href="{{ route('user.index') }}">Users</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('user.logout') }}">Logout</a></li>
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
      <a href="{{ route('customers.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Customers</a>
      <a href="{{ route('salesoutlets.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Sales Outlets</a>
      <a href="{{ route('home') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Outlets Distribution</a>
      <a href="{{ route('units.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Units</a>
      <a href="{{ route('types.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Types</a>
      <a href="{{ route('user.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Users</a>
      <a href="{{ route('user.logout') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Logout</a>
   </div>
</div>
@endif
