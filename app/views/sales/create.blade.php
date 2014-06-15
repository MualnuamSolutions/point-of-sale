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
                                 <th class="col-xs-2">Quantity</th>
                                 <th class="col-xs-2">Sub Total</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="cart-empty">
                                 <td colspan="7" class="text-center"><span class="text-danger">Add Items</span></td>
                              </tr>
                           </tbody>
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
                           {{ Form::button('<i class="fa fa-check"></i> Submit', ['class' => 'btn btn-md btn-primary']) }}
                           {{ Form::button('<i class="fa fa-check-square"></i> Save', ['class' => 'btn btn-md btn-success']) }}
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
   <td>{stockId}</td>
   <td>{productName}</td>
   <td>{productCode}</td>
   <td>{rate}</td>
   <td>
      <input name="cart[{stockId}]" type="number" min="1" max="{inStock}" class="cart-row-quantity form-control input-sm" value="{quantity}"  />
   </td>
   <td>{subTotal}</td>
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
         console.log('complete');
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
         return "<i class='fa fa-caret-right'></i> " + result + "<i class='fa fa-shopping-cart pull-right'></i>";
      }
   };
   a = $('#query-stocks').autocomplete(options);
});

function addToCart (data) {
   // console.log("Adding to cart..." + data.product_code);
   $(".cart-empty").hide();
   $('#query-stocks').val('');

   var row = $("#cart-row-" + data.id);
   var quantity = parseInt(row.find('.cart-row-quantity').val());

   if(row.size()) {
      // updateCart(data, 0);
      console.log('Update');
   }
   else if(data.in_stock > 0) {
      var newRow = $("#cart-row").html();
      newRow = newRow.replace(/\{stockId\}/gi, data.id);
      newRow = newRow.replace(/\{productId\}/gi, data.product_id);
      newRow = newRow.replace(/\{productName\}/gi, data.name);
      newRow = newRow.replace(/\{productCode\}/gi, data.product_code);
      newRow = newRow.replace(/\{rate\}/gi, data.sp);
      newRow = newRow.replace(/\{quantity\}/gi, 1);
      newRow = newRow.replace(/\{inStock\}/gi, data.in_stock);
      newRow = newRow.replace(/\{subTotal\}/gi, data.sp);

      $(".cart-table tbody").append(newRow);
   }

   return false;
}

function updateCart (productId, type) {
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
}
</script>
@stop
