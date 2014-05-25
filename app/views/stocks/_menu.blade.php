<div class="sub-menu pull-right">
   @if( in_array($current_route, ['stocks.create', 'stocks.edit']) )
   <a href="{{ route('stocks.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['stocks.index', 'stocks.edit']) )
   <a href="{{ route('stocks.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New</a>
   @endif
</div>
