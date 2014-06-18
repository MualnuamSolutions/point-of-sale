<div class="sub-menu pull-right">
   @if( in_array($current_route, ['outletdeposits.create', 'outletdeposits.edit']) )
   <a href="{{ route('outletdeposits.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['outletdeposits.index', 'outletdeposits.edit']) )
   <a href="{{ route('outletdeposits.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New Deposit</a>
   @endif

   @if( in_array($current_route, ['outletdeposits.index']) )
   <a href="#" class="btn btn-xs btn-primary filter-toggle"><i class="fi-filter"></i> Filter</a>
   @endif
</div>
