@if(isset($position) && $position == 'top')
<div class="hidden-xs" id="topbar_menu">
   <ul class="nav navbar-nav navbar-right">

      @if($logged_user->hasAccess('sales.create'))
      <li class="{{ Mualnuam\Menu::isCurrent('sales.create') }}"><a href="{{ route('sales.create') }}">New Sale</a></li>
      @endif

      @if($logged_user->hasAccess('sales.index'))
      <li class="{{ Mualnuam\Menu::isCurrent('sales.index') }}"><a href="{{ route('sales.index') }}">Sales Report</a></li>
      @endif

      @if($logged_user->hasAccess('stocks.index'))
      <li class="{{ Mualnuam\Menu::isCurrent('stocks.index') }}"><a href="{{ route('stocks.index') }}">Stocks</a></li>
      @endif

      @if($logged_user->hasAccess('stockreturns.index'))
      <li class="{{ Mualnuam\Menu::isCurrent('stockreturns.index') }}"><a href="{{ route('stockreturns.index') }}">Stock Return</a></li>
      @endif

      @if($logged_user->hasAccess('products.index'))
      <li class="{{ Mualnuam\Menu::isCurrent('products.index') }}"><a href="{{ route('products.index') }}">Products</a></li>
      @endif

      @if($logged_user->hasAccess('discounts.index'))
      <li class="{{ Mualnuam\Menu::isCurrent('discounts.index') }}"><a href="{{ route('discounts.index') }}">Discounts</a></li>
      @endif

      @if($logged_user->hasAccess('suppliers.index'))
      <li class="{{ Mualnuam\Menu::isCurrent('suppliers.index') }}"><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
      @endif

      @if($logged_user->hasAccess('salesoutlets.index'))
      <li class="{{ Mualnuam\Menu::isCurrent('salesoutlets.index') }}"><a href="{{ route('salesoutlets.index') }}">Outlets</a></li>
      @endif

      @if($logged_user->hasAccess('outletdeposits.index'))
      <li class="{{ Mualnuam\Menu::isCurrent('outletdeposits.index') }}"><a href="{{ route('outletdeposits.index') }}">Outlet Deposit</a></li>
      @endif

      @if($logged_user->hasAccess('distributions.index'))
      <li class="{{ Mualnuam\Menu::isCurrent('distributions.index') }}"><a href="{{ route('distributions.index') }}">Distribution</a></li>
      @endif


      <li class="dropdown {{ Mualnuam\Menu::isCurrent(['customers.index', 'units.index', 'types.index', 'users.index']) }}">
         <a class="dropdown-toggle" data-toggle="dropdown" href="#">System <span class="caret"></span></a>
         <ul class="dropdown-menu">

            @if($logged_user->hasAccess('customers.index'))
            <li class="{{ Mualnuam\Menu::isCurrent('customers.index') }}"><a href="{{ route('customers.index') }}"><i class="fa fa-arrow-right"></i> Customers</a></li>
            @endif

            @if($logged_user->hasAccess('units.index'))
            <li class="{{ Mualnuam\Menu::isCurrent('units.index') }}"><a href="{{ route('units.index') }}"><i class="fa fa-arrow-right"></i> Product Unit</a></li>
            @endif

            @if($logged_user->hasAccess('types.index'))
            <li class="{{ Mualnuam\Menu::isCurrent('types.index') }}"><a href="{{ route('types.index') }}"><i class="fa fa-arrow-right"></i> Product Types</a></li>
            @endif

            @if($logged_user->hasAccess('colors.index'))
            <li class="{{ Mualnuam\Menu::isCurrent('colors.index') }}"><a href="{{ route('colors.index') }}"><i class="fa fa-arrow-right"></i> Colors</a></li>
            @endif

            @if($logged_user->hasAccess('users.index'))
            <li class="{{ Mualnuam\Menu::isCurrent('users.index') }}"><a href="{{ route('users.index') }}"><i class="fa fa-arrow-right"></i> Users</a></li>
            @endif

            @if($logged_user->hasAccess('users.changePassword'))
            <li class="{{ Mualnuam\Menu::isCurrent('users.changePassword') }}"><a href="{{ route('users.changePassword') }}"><i class="fa fa-arrow-right"></i> Change Password</a></li>
            @endif

            @if($logged_user->hasAccess('users.revokePermission'))
            <li class="{{ Mualnuam\Menu::isCurrent('users.revokePermission') }}"><a href="{{ route('users.revokePermission') }}"><i class="fa fa-arrow-right"></i> Revoke Permission</a></li>
            @endif

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
    @if($logged_user->hasAccess('sales.create'))
      <a href="{{ route('sales.create') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> New Sale</a>
    @endif
    @if($logged_user->hasAccess('stocks.index'))  
      <a href="{{ route('sales.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Sales Report</a>
    @endif
    @if($logged_user->hasAccess('stocks.index'))  
      <a href="{{ route('stocks.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Stocks</a>
    @endif
    @if($logged_user->hasAccess('products.index'))  
      <a href="{{ route('products.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Products</a>
    @endif
    @if($logged_user->hasAccess('discounts.index'))  
      <a href="{{ route('discounts.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Discounts</a>
    @endif
    @if($logged_user->hasAccess('suppliers.index'))  
      <a href="{{ route('suppliers.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Suppliers</a>
    @endif
    @if($logged_user->hasAccess('salesoutlets.index'))  
      <a href="{{ route('salesoutlets.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Outlets</a>
    @endif
    @if($logged_user->hasAccess('outletdeposits.index'))  
      <a href="{{ route('outletdeposits.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Outlet Deposit</a>
    @endif
    @if($logged_user->hasAccess('distributions.index'))  
      <a href="{{ route('distributions.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Distribution</a>
    @endif
    @if($logged_user->hasAccess('customers.index'))  
      <a href="{{ route('customers.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Customers</a>
    @endif
    @if($logged_user->hasAccess('units.index'))  
      <a href="{{ route('units.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Product Units</a>
    @endif
    @if($logged_user->hasAccess('types.index'))  
      <a href="{{ route('types.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Product Types</a>
    @endif
    @if($logged_user->hasAccess('colors.index'))  
      <a href="{{ route('colors.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Colors</a>
    @endif
    @if($logged_user->hasAccess('users.index'))  
      <a href="{{ route('users.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Users</a>
    @endif
    @if($logged_user->hasAccess('vats.index'))  
      <a href="{{ route('vats.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Vat</a>
    @endif
    @if($logged_user->hasAccess('users.changePassword'))  
      <a href="{{ route('users.changePassword') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Change Password</a>
    @endif
    @if($logged_user->hasAccess('users.revokePermission'))  
      <a href="{{ route('users.revokePermission') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Revoke Permission</a>
    @endif
      <a href="{{ route('users.logout') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Logout</a>
  
   </div>
</div>
@endif
