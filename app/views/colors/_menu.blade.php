<div class="sub-menu pull-right">
   @if( in_array($current_route, ['colors.create', 'colors.edit']) )
   <a href="{{ route('colors.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['colors.index', 'colors.edit']) )
   <a href="{{ route('colors.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New</a>
   @endif
</div>
