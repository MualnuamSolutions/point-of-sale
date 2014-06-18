@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('sales._menu')
               <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> New Sale</h3>
            </div>
            <div class="panel-body sales-create">
               <div class="row">
                  <div class="col-sm-12 cart">

                     @include('sales._search')

                     <h6 class="text-success"><i class="fa fa-cubes"></i> CART ITEMS</h6>
                     <hr>


                     {{ Form::open(['url' => route('sales.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}

                        <div class="well">
                           <table class="table cart-table">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th class="col-xs-4">Name</th>
                                 <th class="col-xs-2">Code</th>
                                 <th class="col-xs-2">Rate</th>
                                 <th class="col-xs-1">Quantity</th>
                                 <th class="col-xs-2">Sub Total</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="cart-empty">
                                 <td colspan="7" class="text-center"><span class="text-danger">Add Items</span></td>
                              </tr>
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th colspan="5" class="text-right">Total</th>
                                 <th colspan="2">
                                    <i class="fa fa-rupee"></i> <span class="cart-total-display">0</span>
                                    <input name="total" type="hidden" class="cart-total form-control input-sm" value="" />
                                 </th>
                              </tr>
                              <tr>
                                 <th colspan="5" class="text-right">Discount</th>
                                 <th colspan="2">
                                    <div class="input-group">
                                       <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                                       <input onblur="calculate()" onchange="calculate()" name="discount" min="0" type="number" class="cart-discount form-control input-sm" value="0" />
                                    </div>
                                 </th>
                              </tr>
                              <tr>
                                 <th colspan="3">
                                    <textarea class="form-control input-sm" name="note" placeholder="Note"></textarea>
                                 </th>
                                 <th colspan="2" class="text-right">Grand Total</th>
                                 <th colspan="2">
                                    <i class="fa fa-rupee"></i> <span class="cart-grandtotal-display">0</span>
                                    <input name="grandtotal" type="hidden" class="cart-grandtotal form-control input-sm" value="" />
                                 </th>
                              </tr>
                           </tfoot>
                        </table>
                        </div>

                        <h6 class="text-success"><i class="fa fa-user"></i> CUSTOMER</h6>
                        <hr>

                        <div class="row">
                           <div class="col-sm-4">
                              <div class="form-group">
                                 {{ Form::label('name', 'Name') }}
                                 {{ Form::text('name', '', ['class' => 'form-control input-sm']) }}
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 {{ Form::label('address', 'Address') }}
                                 {{ Form::text('address', '', ['class' => 'form-control input-sm']) }}
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 {{ Form::label('contact', 'Contact') }}
                                 {{ Form::text('contact', '', ['class' => 'form-control input-sm']) }}
                              </div>
                           </div>
                        </div>

                        <div class="form-group text-right">
                           <div class="pull-left">
                              <h5 class="text-success">Saved</h5>
                           </div>
                           {{ Form::button('<i class="fa fa-check-square"></i> Submit', ['class' => 'btn btn-md btn-primary', 'type' => 'submit']) }}
                           <!-- {{ Form::button('<i class="fa fa-check-square"></i> Save', ['class' => 'btn btn-md btn-success']) }} -->
                        </div>

                     {{ Form::close() }}
                  </div>
               </div>
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
      // autoSelectFirst: true,
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
