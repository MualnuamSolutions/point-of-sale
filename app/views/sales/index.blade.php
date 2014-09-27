@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('sales._menu')
               <h3 class="panel-title"><i class="fi-page-multiple"></i> Sales</h3>
            </div>
            <div class="panel-body sales-list">
               @include('sales._filter')

               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-2">Reference No</th>
                        <th class="col-md-1">Total</th>
                        <th class="col-md-1">Discount</th>
                        <th class="col-md-1">Paid</th>
                        <th class="col-md-1">Balance</th>
                        <th class="col-md-1">Items</th>
                        <th class="col-md-1">Status</th>
                        <th class="col-md-5"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($sales as $key => $sale)
                     <tr>
                        <td>{{ $sales->getFrom() + $key }}</td>
                        <td>{{ $sale->reference_no }}</td>
                        <td><i class="fa fa-rupee"></i> {{ $sale->total }}</td>
                        <td><i class="fa fa-rupee"></i> {{ $sale->discount }}</td>
                        <td><i class="fa fa-rupee"></i> {{ $sale->paid }}</td>
                        <td><i class="fa fa-rupee"></i> {{ $sale->total - $sale->paid }}</td>
                        <td>{{ $sale->items->count() }}</td>
                        <td>
                           @if($sale->status == 'completed')
                           <span class="label label-success">
                           @elseif($sale->status == 'credit')
                           <span class="label label-danger">
                           @endif
                           {{ strtoupper($sale->status) }}
                           </span>
                        </td>
                        <td class="actions">
                           @if($logged_user->hasAccess('sales.show'))
                           <a target="_blank" href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-success"><i class="fi-print"></i> Print</a>
                           @endif

                           @if($logged_user->hasAccess('sales.edit'))
                           <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           @endif

                           @if($logged_user->hasAccess('sales.returnitem'))
                           <a href="{{ route('sales.returnitem', $sale->id) }}" class="btn btn-sm btn-warning"><i class="fi-minus"></i> Return Item</a>
                           @endif

                           @if($logged_user->hasAccess('sales.destroy'))
                           {{ Form::open(['url' => route('sales.destroy', $sale->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']) }}
                           {{ Form::close() }}
                           @endif
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $sales->links() }}

            </div>
         </div>
      </div>
   </div>
@stop

@section('script')
<script type="text/javascript" src="{{ asset('jquery/jquery.autocomplete.js') }}"></script>
<script type="text/template" id="cart-row">
<tr id="cart-row-{stockId}">
   <td></td>
   <td>{productName}</td>
   <td>{productCode}</td>
   <td><i class="fa fa-rupee"></i> {rate}</td>
   <td>
      <input name="cart[{stockId}][quantity]" onblur="calculate()" onchange="calculate()" type="number" min="1" max="{inStock}" class="cart-row-quantity form-control input-sm" value="{quantity}"  />
      <input name="cart[{stockId}][product_id]" type="hidden" class="cart-row-product-id" value="{productId}"  />
      <input name="cart[{stockId}][cp]" type="hidden" class="cart-row-cp" value="{cp}"  />
      <input name="cart[{stockId}][sp]" type="hidden" class="cart-row-sp" value="{rate}"  />
   </td>
   <td><i class="fa fa-rupee"></i> <span class="subtotal">{subTotal}</span></td>
   <td>
      <button onclick="return removeCartItem({stockId})" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
   </td>
</tr>
</script>

<script type="text/javascript">
var options, a;
var cartSize = 0;

jQuery(function(){
   options = {
      serviceUrl:'{{ route('products.search') }}',
      minChars: 2,
      onSelect: function(suggestion){
         var data = $.parseJSON(suggestion.data);
         addToCart(data);
      },
      autoSelectFirst: true,
      onSearchComplete: function (query, suggestions) {
         $('.autocomplete-spinner').hide();
         if(suggestions.length == 1) {
            var data = $.parseJSON(suggestions[0].data);
            if (data.product_code == query) {
               addToCart(data);
            }
         }
      },
      onSearchStart: function(query){
         $('.autocomplete-spinner').show();
      },
      formatResult: function(suggestion, currentValue){
         var reEscape = new RegExp('(\\' + ['/', '.', '*', '+', '?', '|', '(', ')', '[', ']', '{', '}', '\\'].join('|\\') + ')', 'g');
         var pattern = '(' + currentValue.replace(reEscape, '\\$1') + ')';
         var result = suggestion.value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');
         return "<i class='fa fa-caret-right'></i> " + stripslashes(result) + "<i class='fa fa-shopping-cart pull-right'></i>";
      }
   };
   a = $('#query-stocks').autocomplete(options);

});

function addToCart (data) {
   // console.log("Adding to cart..." + data.product_code);
   $(".cart-empty").hide();
   $(".cart-table tfoot").show();
   $('#query-stocks').val('');

   var row = $("#cart-row-" + data.id);
   var quantity = parseInt(row.find('.cart-row-quantity').val());

   if(row.size()) {
      // updateCart(data, 0);
      // console.log('Update');
   }
   else if(data.in_stock > 0) {
      var newRow = $("#cart-row").html();
      newRow = newRow.replace(/\{stockId\}/gi, data.id);
      newRow = newRow.replace(/\{productId\}/gi, data.product_id);
      newRow = newRow.replace(/\{productName\}/gi, data.name);
      newRow = newRow.replace(/\{productCode\}/gi, data.product_code);
      newRow = newRow.replace(/\{rate\}/gi, data.sp);
      newRow = newRow.replace(/\{cp\}/gi, data.cp);
      newRow = newRow.replace(/\{quantity\}/gi, 1);
      newRow = newRow.replace(/\{inStock\}/gi, data.in_stock);
      newRow = newRow.replace(/\{subTotal\}/gi, data.sp);

      $(".cart-table tbody").append(newRow);
   }

   setSerialNo();
   calculate();

   return false;
}

function removeCartItem(stockId)
{
   $("#cart-row-" + stockId).remove();
   setSerialNo();
   calculate();
}

function setSerialNo()
{
   var count = $("table.cart-table tbody tr").not(".cart-empty").size();
   $("table.cart-table tbody tr").not(".cart-empty").each(function(key, val){
      $(val).find('td:first').text(++key);
   });
}

function calculate()
{
   var total = calculateRows();
   $('.cart-total').val(total);
   $('.cart-total-display').text(total);

   var grandtotal = total - parseFloat($('.cart-discount').val());
   $('.cart-grandtotal-display').text(grandtotal);
   $('.cart-grandtotal').val(grandtotal);
   return true;
}

function calculateRows()
{
   var total = 0;
   $("table.cart-table tbody tr").not(".cart-empty").each(function(key, val){
      var qty = parseFloat($(this).find('.cart-row-quantity').val());
      var rate = parseFloat($(this).find('.cart-row-sp').val());
      total += subtotal = (qty * rate);
      $(this).find('.subtotal').text(subtotal);
   });

   return total;
}

/*function updateCart (productId, type) {
   var productRow = $("#product_" + productId);
   var instock = parseInt(productRow.find('.quantity').text());
   var quantity = parseInt(productRow.find('.sales-product-quantity').val());
   var cartRow = $(".cart-table tr#cart_product_" + productId);
   var cartQuantity = cartRow.find('.cart-product-quantity').val();

   if(type == 1) {
      quantity = -1;
   }
   else if(type == 2) {
      quantity = 1;
   }

   var newCartQuantity = parseInt(cartQuantity) + parseInt(quantity);
   if(newCartQuantity > 0) {

      if(newCartQuantity <= instock) {
         cartRow.find('.cart-product-quantity').val(newCartQuantity);
         cartRow.find('.cart-value').text(newCartQuantity);
      }
      else {
         alert('You cannot add more than stock quantity');
         return false;
      }
   }

   productRow.find('.sales-product-quantity').val('');
}*/
</script>
@stop
