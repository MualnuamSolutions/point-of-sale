<div class="sub-menu pull-right">
   @if( in_array($current_route, ['units.create', 'units.edit']) )
   <a href="{{ route('units.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['units.index', 'units.edit']) )
   <a href="{{ route('units.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New</a>
   @endif
</div>
