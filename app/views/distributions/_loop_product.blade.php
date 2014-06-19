<?php $index = $products->getPerPage() * ($products->getCurrentPage()-1) + 1; ?>

@foreach($products as $key => $product)
<tr id="product_{{ $product->id }}">
   <td>{{ $key+$index }}</td>
   <td>
      <span class="name">{{ $product->name }}</span><br>
      <small class="text-info">{{ $product->product_code }}</small>
   </td>
   <td class="quantity">{{ $product->quantity }}</td>
   <td>
      @if($product->quantity)

      {{ Form::open(['url' => route('sales.store'), 'method' => 'post', 'class' => 'form-inline', 'autocomplete' => 'off']) }}
         {{ Form::hidden('action', 'add_to_cart') }}
         <div class="form-group">
            <input name="quantity[{{ $product->id }}]" type="number" min="1" max="{{ $product->quantity }}" class="sales-product-quantity form-control input-sm" value=""  />
         </div>
         <div class="form-group">
            <button type="submit" onclick="return addToCart({{ $product->id }})" class="btn btn-sm add-to-cart">
               <i class="fi-shopping-cart"></i>
            </button>
         </div>
      {{ Form::close() }}

      @else
      <span class="text-danger">Out of Stock</span>
      @endif
   </td>
</tr>
@endforeach
