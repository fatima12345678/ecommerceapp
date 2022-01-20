@extends('layouts.app')

@section('content')
@include('layouts.menubar')
@php
$cart=Cart::content();
@endphp
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_responsive.css')}}">

<div class="contact_form">
	<div class="container">
		<div class="row">


		    <div class="col-lg-7 " style="border:1px solid grey;padding 20px; border-radius:25px;">
					<div class="contact_form_container">
					<div class="contact_form_title text-center">Cart Product</div>

					<div class="cart_items">
							<ul class="cart_list">
                            
                                @if($cart !=Null)
                                @foreach($cart as $row)
								<li class="cart_item clearfix">
									
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										
                                    <div class="cart_item_name cart_info_col">
											<div class="cart_item_title"><p>Image</p></div>
											<div class="cart_item_text"><img src="{{ asset ($row->options->image)}}" alt="" style="width:70px;hieght:70px;"></div>
										</div>
                                    <div class="cart_item_name cart_info_col">
											<div class="cart_item_title"><p>Name</p></div>
											<div class="cart_item_text">{{$row->name}}</div>
										</div>
                                        @if($row->options->color !=Null)
                                        <div class="cart_item_color cart_info_col">
											<div class="cart_item_title"><p>Color</p></div>
											<div class="cart_item_text"></span>{{$row->options->color}}</div>
										</div>
                                        @endif
                                        @if($row->options->size !=Null)
                                        <div class="cart_item_color cart_info_col">
											<div class="cart_item_title"><p>Size</p></div>
											<div class="cart_item_text">{{$row->options->size}}</div>
										</div>
                                        @endif
									
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title"><p>Quantity</p>


                                            </div>
                                            <div class="cart_item_text">${{ $row->qty}}</div>
										</div>

                                   

										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title"><p>Price</p></div>
											<div class="cart_item_text">${{  $row->price}}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title"><p>Total</p></div>
											<div class="cart_item_text">${{$row->qty * $row->price }}</div>
										</div>
                                      
									</div>
								</li>
                                @endforeach
                                @endif
							</ul>
                    </div>
                            @php
							$setting=DB::table('settings')->first();

							@endphp
                            <div class="cart_items">
                         <ul class="list-group col-lg-8" style="float:right;">
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

                <div class="col-lg-5 " style="border:1px solid grey;padding 20px; border-radius:25px;">
					<div class="contact_form_container">
					<div class="contact_form_title text-center">Shinping Charge</div>

	
                       

					</div>
				</div>

		</div>
	</div>
	<div class="panel"></div>
</div>
@endsection
