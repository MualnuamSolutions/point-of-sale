<div class="sub-menu pull-right">
   @if( in_array($current_route, ['users.create', 'users.edit']) )
   <a href="{{ route('users.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['users.index', 'users.edit']) )
   <a href="{{ route('users.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New</a>
   @endif

</div>
