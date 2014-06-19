<div class="sub-menu pull-right">
   @if( in_array($current_route, ['distributions.create', 'distributions.edit']) )
   <a href="{{ route('distributions.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To Sales</a>
   @endif

   @if( in_array($current_route, ['distributions.index', 'distributions.edit']) )
   <a href="{{ route('distributions.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New Sale</a>
   @endif

   @if( in_array($current_route, ['distributions.index']) )
   <a href="#" class="btn btn-xs btn-primary filter-toggle"><i class="fi-filter"></i> Filter</a>
   @endif
</div>
