<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Print Invoice</title>
	<link href="{{ asset('font-awesome-4.1.0/css/font-awesome.min.css') }}" media="screen, projection,print" rel="stylesheet" type="text/css" />
	<style>
	*{
		margin:0;
	}
	body{
		padding:0 1%;
		margin:1% 0;
		font-family: Arial;
		font-size: 12px;
	}
	.text-center{
		text-align: center;
	}
	.text-right{
		text-align: right;
	}
	.fr{
		float: right;
	}
	.fl{
		float: left;
	}
	.clear{
		clear: both;
	}
	.underline{
		text-decoration: underline;
	}
	.header{
		border-bottom:2px solid #000;
		padding-bottom: 20px;
		height: 55px;
	}
	.header h1 {
	    text-align: center;
	}
	.header p{
		margin:0;
	}
	.header .invoice-detail{
		width: 250px;
	}
	.header .invoice-detail p{
		margin-top: 4px;
		margin-left: 10px;	
		font-family:Arial;
		font-size: 10px;
		text-transform: uppercase;
	}
	.body{
		padding-top: 10px;
		margin-top: 1px;
		border-top: 1px solid #000;
	}
	.customer{
		margin-bottom:20px;
		/*text-transform: uppercase;*/
	}
	.customer span {
		display: block;
		clear: both;
		font-weight: bold;
		font-family: Arial;
		font-size: 11px;
		text-transform: capitalize;
	}
	.customer span.to {
		margin: 0 0 13px;
	}
	table{
		border-spacing:0;
    	border-collapse:collapse;
		width: 100%;
		border:1px solid #000;
		font-size: 10px;
		font-family: Arial;
	}
	table tr td,
	table tr th{
		padding:4px;
		margin:0;
		border-bottom: 1px solid #ddd;
		border-left: 1px solid #000;
	}
	table thead tr th{
		border-bottom: 1px solid #000;
	}
	table tr td:first-child,
	table tr th:first-child{
		border-left: 0;
	}
	table tfoot tr:first-child th,
	table tfoot tr:last-child th{
		border-top: 1px solid #000;
		border-bottom: 1px solid #000;
	}
	table tr:last-child td{
		border-bottom: 0;
	}
	.footer{
		margin-top: 160px;
		padding-bottom: 20px
	}
	.seal{
		padding-right: 50px
	}
	.footer-text {
		border-top:1px solid #111111;
		margin:25px 0 0;
		padding: 3px 0 0;
	}
	</style>
</head>
<body>
	<div class="header">
		<div class="fr invoice-detail">
			<p><strong>Invoice Date:</strong> <time datetime="{{date('d.m.Y',strtotime($sale->created_at))}}">{{date('d/m/Y',strtotime($sale->created_at))}}</time></p>
			<br>
			<div class="barcode-holder"></div>
		</div>
		<div class="fl outlet-detail">
            <p>ZOHANDCO<br>{{ $sale->outlet ? $sale->outlet->name : null }}<br> {{ $sale->outlet? $sale->outlet->address : null }}</p>
            <p><i class="fa fa-phone"></i> {{ $sale->outlet? $sale->outlet->contact : null }}</p>
            <div class="clear"></div>
		</div>
		<h1>CASH MEMO</h1>
	</div>
	<div class="body">
		<div class=" customer">
		@if($sale->customer && isset($sale->customer->id))
			<span class="to">To,</span>
			<span>{{$sale->customer->name}},</span>
			<span>{{$sale->customer->address}}</span>
		@endif
		</div>
		<table>
			<thead>
				<tr>
					<th width="5%" class="text-center">#</th>
					<th width="35%">Item Name</th>
					<th width="15%">Qty</th>
					<th width="15%">Rate</th>
					<th width="15%">Discount</th>
					<th width="15%">Cost</th>
				</tr>
			</thead>
			<tbody>
				@foreach($sale->items as $key=>$item)
				<?php $p = $item->product; ?>
				<tr>
					<td  class="text-center">{{++$key}}</td>
					<td>{{$p ? $p->name : null}}</td>
					<td class="text-right">{{$item->quantity}}</td>
					<td class="text-right">&#8377; {{$p ? $p->sp : null}}</td>
					<td>{{ $item->discount_type == 'percentage' ? $item->discount_amount . '%' : '<i class="fa fa-rupee"></i> ' .$item->discount_amount }}</td>
					<td><i class="fa fa-rupee"></i> <span class="subtotal">{{ $item->total }}</span></td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th colspan="5" class="text-right">Total</th>
					<th colspan="1" class="text-right">&#8377; {{ $sale->total + $sale->discount }}</th>
				</tr>
				<tr>
					<th colspan="5" class="text-right">Discount Total</th>
					<th colspan="1" class="text-right">&#8377; {{$sale->discount}}</th>
				</tr>
				<tr>
					<th colspan="5" class="text-right">Grand Total</th>
					<th colspan="1" class="text-right">&#8377; {{$sale->total}}</th>
				</tr>
				<tr>
					<th colspan="5" class="text-right">Paid</th>
					<th colspan="1" class="text-right">&#8377; {{$sale->paid}}</th>
				</tr>
				<tr>
					<th colspan="5" class="text-right" style="border-bottom:1px solid #000;">Balance</th>
					<th colspan="1" class="text-right" style="border-bottom:1px solid #000;">&#8377; {{ $sale->total - $sale->paid }}</th>
				</tr>

				<th colspan="6" class="text-left" align="left">
					<strong>Notes:</strong> <span style="font-weight:normal">{{$sale->notes}}</span>
				</th>
			</tfoot>
		</table>
	</div>
	<div class="footer">
		<div class="fr seal">
			Manager
		</div>
		<div class="clear"></div>
		<div class="footer-text text-center">
            &copy; ZOHANDCO
		</div>
	</div>

    <script src="{{ asset('jquery/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-barcode.min.js') }}"></script>
	<script type="text/javascript">
	$(function(){
        window.print();
        setTimeout("window.close()", 1);

		$(".barcode-holder").barcode('{{$sale->reference_no}}', 'code128', {barHeight:22, fontSize:12});
	});
    </script>
</body>
</html>