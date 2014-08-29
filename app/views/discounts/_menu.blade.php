<div class="sub-menu pull-right">
   @if( in_array($current_route, ['discounts.create', 'discounts.edit']) )
   <a href="{{ route('discounts.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['discounts.index', 'discounts.edit']) )
   <a href="{{ route('discounts.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New</a>
   @endif

   @if( in_array($current_route, ['discounts.index']) )
   <a href="#" class="btn btn-xs btn-primary filter-toggle"><i class="fi-filter"></i> Filter</a>
   @endif
</div>
