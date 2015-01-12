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
                                 <th class="col-xs-3">Name</th>
                                 <th class="col-xs-2">Code</th>
                                 <th class="col-xs-2">Rate</th>
                                 <th class="col-xs-1">Discount</th>
                                 <th class="col-xs-1">Quantity</th>
                                 <th class="col-xs-2">Sub Total</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="cart-empty">
                                 <td colspan="8" class="text-center"><span class="text-danger">Add Items</span></td>
                              </tr>
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th colspan="6" class="text-right">Total</th>
                                 <th colspan="2">
                                    <i class="fa fa-rupee"></i> <span class="cart-total-display">0</span>
                                    <input name="total" type="hidden" class="cart-total form-control input-sm" value="" />
                                 </th>
                              </tr>
                              <tr>
                                 <th colspan="6" class="text-right">Discount Total</th>
                                 <th colspan="2">
                                    <i class="fa fa-rupee"></i> <span class="cart-discount-total-display">0</span>
                                    <input onblur="calculate()" onchange="calculate()" name="discount" type="hidden" class="cart-discount form-control input-sm" value="0" />
                                 </th>
                              </tr>
                              <tr>
                                 <th colspan="6" class="text-right">Grand Total</th>
                                 <th colspan="2">
                                    <i class="fa fa-rupee"></i> <span class="cart-grandtotal-display">0</span>
                                    <input name="grandtotal" type="hidden" class="cart-grandtotal form-control input-sm" value="" />
                                 </th>
                              </tr>
                              <tr class="cart-balance-row">
                                 <th colspan="6" class="text-right">Balance</th>
                                 <th colspan="2">
                                    <i class="fa fa-rupee"></i> <span class="cart-balance-display">0</span>
                                 </th>
                              </tr>
                              <tr>
                                 <th colspan="3">
                                    <textarea class="form-control input-sm" name="notes" placeholder="Note"></textarea>
                                 </th>
                                 <th colspan="3" class="text-right">Paid</th>
                                 <th colspan="2">
                                    <div class="input-group">
                                       <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                                       <input name="paid" min="0" type="number" class="cart-paid form-control input-sm" value="0" />
                                    </div>
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
                           <!-- <div class="pull-left">
                              <h5 class="text-success">Saved</h5>
                           </div> -->
                           {{ Form::button('<i class="fa fa-check-square"></i> Submit', ['class' => 'btn btn-md btn-primary cart-submit-button', 'type' => 'submit']) }}
                           {{ Form::button('<i class="fa fa-check-square"></i> Credit', ['class' => 'btn btn-md btn-danger hidden credit-button', 'type' => 'submit']) }}
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
<tr id="cart-row-{id}">
   <td></td>
   <td>{productName}</td>
   <td>{productCode}</td>
   <td><i class="fa fa-rupee"></i> {rate}</td>
   <td>{discount}</td>
   <td>
      <input name="cart[{id}][quantity]" onblur="calculate()" onchange="calculate()" step="0.1" type="number" min="1" max="{inStock}" class="cart-row-quantity form-control input-sm" value="{quantity}"  />
      <input name="cart[{id}][cp]" type="hidden" class="cart-row-cp" value="{cp}"  />
      <input name="cart[{id}][sp]" type="hidden" class="cart-row-sp" value="{rate}"  />
      <input name="cart[{id}][discount_type]" type="hidden" class="cart-row-discount-type" value="{discountType}"  />
      <input name="cart[{id}][discount_amount]" type="hidden" class="cart-row-discount-amount" value="{discountAmount}"  />
   </td>
   <td><i class="fa fa-rupee"></i> <span class="subtotal">{subTotal}</span></td>
   <td>
      <button onclick="return removeCartItem({id})" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
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
         if(data == null)
            var data = $.parseJSON(suggestion.nodiscount);

         addToCart(data);
      },
      autoSelectFirst: true,
      onSearchComplete: function (query, suggestions) {
         $('.autocomplete-spinner').hide();
         if(suggestions.length == 1) {
            var data = $.parseJSON(suggestions[0].data);
            if(data == null)
               var data = $.parseJSON(suggestions[0].nodiscount);

            if (data.product_code.trim() == query.trim()) {
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

   $('.cart-paid').on('change', function(){
      checkCredit();
   });

});

function addToCart (data) {
   // console.log("Adding to cart..." + data.product_code);
   $(".cart-empty").hide();
   $(".cart-table tfoot").show();
   $('#query-stocks').val('');

   var row = $("#cart-row-" + data.id);
   var quantity = parseFloat(row.find('.cart-row-quantity').val());

   if(row.size()) {
      // updateCart(data, 0);
      // console.log('Update');
   }
   else if(data.in_stock > 0) {
      var discount = '';
      var subTotal = data.sp;

      if(data.discount_type == 'percentage') {
         discount = data.discount + '%';
         // var unitDiscount = (data.discount / 100) * subTotal;
         // subTotal = parseFloat(subTotal) - parseFloat(unitDiscount);
      }
      else if(data.discount_type == 'fixed') {
         discount = '<i class="fa fa-rupee"></i> ' + data.discount;
         // subTotal = parseFloat(subTotal) - parseFloat(data.discount);
      }

      var newRow = $("#cart-row").html();

      newRow = newRow.replace(/\{id\}/gi, data.id);
      newRow = newRow.replace(/\{productName\}/gi, data.name);
      newRow = newRow.replace(/\{productCode\}/gi, data.product_code);
      newRow = newRow.replace(/\{rate\}/gi, data.sp);
      newRow = newRow.replace(/\{cp\}/gi, data.cp);
      newRow = newRow.replace(/\{quantity\}/gi, 1);
      newRow = newRow.replace(/\{inStock\}/gi, data.in_stock);
      newRow = newRow.replace(/\{subTotal\}/gi, subTotal);
      newRow = newRow.replace(/\{discount\}/gi, discount);
      newRow = newRow.replace(/\{discountType\}/gi, data.discount_type);
      newRow = newRow.replace(/\{discountAmount\}/gi, data.discount);

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
   $('.cart-paid').val(grandtotal).attr('max', grandtotal);

   checkCredit();

   return true;
}

function calculateRows()
{
   var total = 0;
   var discount = 0;
   var totalDiscount = 0;

   $("table.cart-table tbody tr").not(".cart-empty").each(function(key, val){
      var qty = parseFloat($(this).find('.cart-row-quantity').val());
      var rate = parseFloat($(this).find('.cart-row-sp').val());
      var discount_type = $(this).find('.cart-row-discount-type').val();
      var discount_amount = parseFloat($(this).find('.cart-row-discount-amount').val());
      
      total += subtotal = (qty * rate);

      if(discount_type == 'percentage') {
         totalDiscount += discount = ((discount_amount / 100) * subtotal);
      }
      else if(discount_type == 'fixed') {
         totalDiscount += discount = parseFloat(discount_amount) * qty;
      }
      subtotal = parseFloat(subtotal) - discount;
      
      $(this).find('.subtotal').text(subtotal);
   });

   $('.cart-discount').val(totalDiscount);
   $('.cart-discount-total-display').text(totalDiscount);

   return total;// - parseFloat(totalDiscount);
}

function checkCredit()
{
   var total = parseFloat($('.cart-grandtotal').val());
   var paid = parseFloat($('.cart-paid').val());
   var discount = parseFloat($('.cart-discount').val());

   if(paid < total) {
      $('.cart-submit-button').addClass('hidden');
      $('.credit-button').removeClass('hidden');
      $('.cart-balance-display').text(total - paid);
      $('.cart-balance-row').addClass('text-danger');
   }
   else {
      $('.cart-submit-button').removeClass('hidden');
      $('.credit-button').addClass('hidden');
      $('.cart-balance-display').text(0);
      $('.cart-balance-row').removeClass('text-danger');
   }
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
