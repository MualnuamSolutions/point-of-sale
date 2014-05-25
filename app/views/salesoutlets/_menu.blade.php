<div class="sub-menu pull-right">
   @if( in_array($current_route, ['salesoutlets.create', 'salesoutlets.edit']) )
   <a href="{{ route('salesoutlets.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['salesoutlets.index', 'salesoutlets.edit']) )
   <a href="{{ route('salesoutlets.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New</a>
   @endif
</div>
