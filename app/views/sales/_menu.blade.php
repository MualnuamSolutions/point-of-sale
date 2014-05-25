<div class="sub-menu pull-right">
   @if( in_array($current_route, ['sales.create', 'sales.edit']) )
   <a href="{{ route('sales.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To Sales</a>
   @endif

   @if( in_array($current_route, ['sales.index', 'sales.edit']) )
   <a href="{{ route('sales.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New Sale</a>
   @endif

   @if( in_array($current_route, ['sales.index']) )
   <a href="#" class="btn btn-xs btn-primary filter-toggle"><i class="fi-filter"></i> Filter</a>
   @endif
</div>
