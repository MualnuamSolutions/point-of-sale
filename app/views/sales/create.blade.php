@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('sales._menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Create Stock</h3>
            </div>
            <div class="panel-body sales-create">
               <div class="row">
                  <div class="col-sm-6">
                     @include('sales._product_filter')

                     <table class="table table-condensed">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th class="col-xs-7 col-sm-6 col-md-6">Name</th>
                              <th class="col-xs-1 col-md-2">Stock</th>
                              <th class="col-xs-4 col-sm-4 col-md-4"></th>
                           </tr>
                        </thead>
                        <tbody>
                           @include('sales._loop_product', ['products' => $products])
                        </tbody>
                     </table>

                  </div>

                  <div class="col-md-5 col-md-offset-1 cart">
                     <h5>Cart</h5>
                     <hr>
                     {{ Form::open(['url' => route('sales.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                     <table class="table table-condensed cart-table">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th class="col-xs-8">Name</th>
                              <th class="col-xs-4">Quantity</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>

                     <hr>

                     <div class="row">
                        <div class="col-sm-4">
                           <div class="form-group">
                              {{ Form::label('name', 'Customer Name') }}
                              {{ Form::text('name', '', ['class' => 'form-control input-sm']) }}
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              {{ Form::label('address', 'Customer Address') }}
                              {{ Form::text('address', '', ['class' => 'form-control input-sm']) }}
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              {{ Form::label('contact', 'Customer Contact') }}
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
<script type="text/javascript">
var cartSize = 0;

$(function(){
});

function addToCart (productId) {
   var row = $("#product_" + productId);
   var name = row.find('.name').text();
   var instock = parseInt(row.find('.quantity').text());
   var quantity = parseInt(row.find('.sales-product-quantity').val());

   if($(".cart-table tr#cart_product_" + productId).size()) {
      updateCart(productId, 0);
   }
   else if(instock > 0) {
      if(quantity <= instock) {

         var cartRow = '<tr id="cart_product_' + productId + '">';
         cartRow += '<td>' + (++cartSize) + '</td>';
         cartRow += '<td>' + name + '</td>';
         cartRow += '<td>';
         cartRow += '<input name="quantity[' + productId + ']" type="hidden" class="cart-product-quantity form-control input-sm" value="' + quantity + '"  />';
         cartRow += '<a onclick="return updateCart(' + productId + ', 1)" class="btn btn-xs"><i class="fa fa-minus"></i></a>';
         cartRow += '<span class="cart-value btn btn-xs">' + quantity + '</span>';
         cartRow += '<a onclick="return updateCart(' + productId + ', 2)" class="btn btn-xs"><i class="fa fa-plus"></i></a>';
         cartRow += '</td>';
         cartRow += '<td><a href="#" onclick="return removeCartItem(' + productId + ')" class="text-danger"><i class="fa fa-times"></i></a></td>';
         cartRow += '</tr>';

         $(".cart-table tbody").append(cartRow);
      }
      else {
         alert('You cannot add more than stock quantity');
      }
      row.find('.sales-product-quantity').val('');
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
