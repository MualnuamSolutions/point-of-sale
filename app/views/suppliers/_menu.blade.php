<div class="sub-menu pull-right">
   @if( in_array($current_route, ['suppliers.create', 'suppliers.edit']) )
   <a href="{{ route('suppliers.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['suppliers.index', 'suppliers.edit']) )
   <a href="{{ route('suppliers.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New</a>
   @endif

   @if( in_array($current_route, ['suppliers.index']) )
   <a href="#" class="btn btn-xs btn-primary filter-toggle"><i class="fi-filter"></i> Filter</a>
   @endif
</div>
