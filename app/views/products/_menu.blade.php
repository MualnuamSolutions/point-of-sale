<div class="sub-menu pull-right">
   @if( in_array($current_route, ['products.create', 'products.edit']) )
   <a href="{{ route('products.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['products.index', 'products.edit']) )
   <a href="{{ route('products.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New</a>
   @endif
</div>
