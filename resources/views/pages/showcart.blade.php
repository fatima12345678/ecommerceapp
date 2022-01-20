@extends('layouts.app')

@section('content')
@include('layouts.menubar')
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_responsive.css')}}">

	<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Shopping Cart</div>
						<div class="cart_items">
							<ul class="cart_list">
                            
                                @if($cart !=Null)
                                @foreach($cart as $row)
								<li class="cart_item clearfix">
									<div class="cart_item_image"><img src="{{ asset ($row->options->image)}}" alt=""></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text">{{$row->name}}</div>
										</div>
                                        @if($row->options->color !=Null)
                                        <div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Color</div>
											<div class="cart_item_text">{{$row->options->color}}</div>
										</div>
                                        @endif
                                        @if($row->options->size !=Null)
                                        <div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Size</div>
											<div class="cart_item_text">{{$row->options->size}}</div>
										</div>
                                        @endif
									
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Quantity


                                            </div><br>


										    <form action="{{url('update/cart/'.$row->rowId)}}" method="post" >
                                            @csrf
                                            <input  type="number"  value="{{$row->qty}}" name="qty" style="width:50px;">
                                            <button type="submit" class=" btn btn-sm btn-success "> <i class= "fas fa-check-square"></i></button>

                                                </form>
										</div>

                                   

										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text">${{ $row->price}}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Total</div>
											<div class="cart_item_text">${{$row->qty * $row->price }}</div>
										</div>
                                        <div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Action</div><br>
											<a href="{{url('remove/cart/'.$row->rowId)}}" class=" btn btn-sm btn-danger">X</a>
										</div>
									</div>
								</li>
                                @endforeach
                                @endif
							</ul>
						</div>
						
						<!-- Order Total -->
						@if(Session::has('coupon'))
						@else
						<div class="order_total_content">

							<form action="{{ url('apply/coupon')}}" method="post" >
								@csrf
								<div class="from group col-lg-4" style="padding:15px;">
								<h5 style="">Apply Coupon</h5>
									<input type="text" class="from-control" name="coupon" requierd="" placeholder="Enter Your Coupon">
									<br>
								
								</div>

                                      <button type="submit" class="btn btn-danger ml-2">Submit </button>
							</form>
							</div>
						@endif
							@php
							$setting=DB::table('settings')->first();

							@endphp
							<br>
						<ul class="list-group col-lg-4" style="float:right;">
							@if(Session::has('coupon'))
						
							<li class="list-group-item" >SubTotal: <span style="float:right;">${{ Session::get('coupon')['blance'] }}</span></li>
							<li class="list-group-item" >Coupon:({{ Session::get('coupon')['name'] }}) <a href="{{url('coupon/remove')}}" class="btn btn-danger btn-sm">X</a> <span style="float:right;">${{ Session::get('coupon')['discount'] }}</span></li>
							@else
							<li class="list-group-item" >SubTotal: <span style="float:right;">${{Cart::Subtotal()}}</span></li>
							
							@endif
							<li class="list-group-item" >Shinping Charge: <span style="float:right;">${{$setting->shipping_charge}}</span></li>
							<li class="list-group-item" >Vat: <span style="float:right;">${{$setting->vat}}</span></li>
							@if(Session::has('coupon'))
							<li class="list-group-item" >Total: <span style="float:right;">${{ Session::get('coupon')['blance']+$setting->shipping_charge+$setting->vat }}</span></li>
							@else
							<li class="list-group-item" >Total: <span style="float:right;">${{ Cart::Subtotal()+$setting->shipping_charge+$setting->vat }}</span></li>
						
							@endif
						</ul>
						    </div>
							</div>
							</div>

						<div class="cart_buttons">
							<button type="button" class="button cart_button_clear">All Cancel </button>
							<a href="{{url('checkout/user')}}" class="button cart_button_checkout">Checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <script src="{{asset('frontend/js/cart_custom.js')}}"></script>
@endsection