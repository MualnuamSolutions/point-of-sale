<div class="sub-menu pull-right">
   @if( in_array($current_route, ['vats.create', 'vats.edit']) )
   <a href="{{ route('vats.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['vats.index', 'vats.edit']) )
   <a href="{{ route('vats.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New VAT</a>
   @endif
</div>
