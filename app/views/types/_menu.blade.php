<div class="sub-menu pull-right">
   @if( in_array($current_route, ['types.create', 'types.edit']) )
   <a href="{{ route('types.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['types.index', 'types.edit']) )
   <a href="{{ route('types.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New</a>
   @endif
</div>
