@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('distributions._menu')
               <h3 class="panel-title"><i class="fi-page-multiple"></i> Distributions</h3>
            </div>
            <div class="panel-body distributions-list">
               @include('distributions._filter')

               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-2">Outlet</th>
                        <th class="col-md-3">Product ID</th>
                        <th class="col-md-1">Quantity</th>
                        <th class="col-md-1">In Stock</th>
                        <th class="col-md-2">Distribution Date</th>
                        <th class="col-md-3"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($distributions as $key => $distribution)
                     <tr>
                        <td>{{ $distributions->getFrom() + $key }}</td>
                        <td>{{ $distribution->outlet->name }}</td>
                        <td>{{ $distribution->product->name }}</td>
                        <td>{{ $distribution->quantity }}</td>
                        <td>{{ $distribution->in_stock }}</td>
                        <td>{{ date('d M Y h:iA', strtotime($distribution->created_at)) }}</td>
                        <td class="actions">
                           <!-- <a href="{{ route('distributions.edit', $distribution->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a> -->
                           {{ Form::open(['url' => route('distributions.destroy', $distribution->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $distributions->links() }}

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
