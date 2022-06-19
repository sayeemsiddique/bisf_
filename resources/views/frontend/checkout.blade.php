@extends('frontend.layout.master_alt')
@section('content')
@php
    $product_total_price = 0;
    $discount_amount = 0;
@endphp
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="checkout-page">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">Checkout</h1>
        </div>
        <form action="{{route('checkout_complete')}}" id="save_checkout"  method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
                <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                    <div class="pl-lg-3 ">
                        <div class="bg-gray-1 rounded-lg">
                            <!-- Order Summary -->
                            <div class="p-4 mb-4 checkout-table">
                                <!-- Title -->
                                <div class="border-bottom border-color-1 mb-5">
                                    <h3 class="section-title mb-0 pb-2 font-size-25">Your order</h3>
                                </div>
                                <!-- End Title -->

                                <!-- Product Content -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $cart)
                                            <tr class="cart_item">
                                                <td>{{$cart->productInfo->name ?? ''}}<strong class="product-quantity">× {{$cart->quantity}}</strong></td>
                                                <td>
                                                    ৳@if ($cart->variation_id == 0)
                                                    @php
                                                        $product_total_price +=  ($cart->productInfo->discount_price ?? 0)  * $cart->quantity;
                                                    @endphp
                                                        {{number_format(($cart->productInfo->discount_price ?? 0)  * $cart->quantity, 2,".","")}}
                                                    @else
                                                    @php
                                                        $product_total_price +=  ($cart->varientInfo->discount_price ?? 0)  * $cart->quantity;
                                                    @endphp
                                                        {{number_format(($cart->varientInfo->discount_price ?? 0)  * $cart->quantity,2,".","")}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td>
                                                ৳{{number_format($product_total_price,2,".","")}}
                                            </td>
                                        </tr>
                                        @if (auth()->check() and in_array(auth()->user()->type,[2,3]))
                                        <tr>
                                            <th>Discount</th>
                                            <td>
                                                @php
                                                    if (auth()->user()->type == 2) {
                                                        $user_discount_percent = $setting->consumer_discount_percent ?? 0;
                                                    } else {
                                                        $user_discount_percent = $setting->dealer_discount_percent ?? 0;
                                                    }
                                                    $discount_amount = ($product_total_price * $user_discount_percent)/100;
                                                @endphp
                                                ৳{{number_format($discount_amount,2,".","")}} <small>({{$user_discount_percent}}%)</small>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>Vat</th>
                                            <td>
                                                @php
                                                    $total_vat = 0;
                                                    $in_total = $product_total_price - $discount_amount;
                                                    if ($setting->vat > 0) {
                                                        $total_vat = ($in_total * $setting->vat) / 100;
                                                    }
                                                @endphp
                                                <input type="hidden" name="vat" value="{{$setting->vat}}">
                                                {{$setting->vat}} %
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tax</th>
                                            <td>
                                                @php
                                                    $total_tax = 0;
                                                    if ($setting->tax > 0) {
                                                        $total_tax = (($in_total * $setting->tax) / 100);
                                                    }
                                                @endphp
                                                <input type="hidden" name="tax" value="{{$setting->tax}}">
                                                {{$setting->tax}} %
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td>
                                                <span class="inside_outside_cost">0.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td>
                                                <input type="hidden" class="total_price" name="total_price" value="{{$in_total+ $total_tax + $total_vat}}">
                                                <input type="hidden" name="discount_amount" value="{{$discount_amount}}">
                                                <strong class="in_total">৳{{number_format(($in_total+ $total_tax + $total_vat),2,".","")}}</strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- End Product Content -->
                                <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                    <!-- Basics Accordion -->
                                    <div id="basicsAccordion1">
                                        <!-- Card -->
                                        <div class="border-bottom border-color-1 border-dotted-bottom">
                                            <div class="p-3" id="basicsHeadingOne">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="stylishRadio1" name="stylishRadio" value="1" checked>
                                                    <label class="custom-control-label form-label" for="stylishRadio1"
                                                        data-toggle="collapse"
                                                        data-target="#basicsCollapseOnee"
                                                        aria-expanded="true"
                                                        aria-controls="basicsCollapseOnee">
                                                        Bank Payment
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="basicsCollapseOnee" class="collapse show border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                aria-labelledby="basicsHeadingOne"
                                                data-parent="#basicsAccordion1">
                                                <div class="p-4">
                                                    <div class="form-group">
                                                        <label for="sel1">Select account: <small class="text-danger">*</small></label>
                                                        <select class="form-control" id="sel1" name="bank_id">
                                                            <option value="">Select</option>
                                                            @foreach ($banks as $bank)
                                                                <option value="{{$bank->id}}">{{$bank->account_no}} @ {{$bank->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Document: <small class="text-danger">*</small></label>
                                                        <input type="file" class="form-control" name="document">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->

                                        <!-- Card -->
                                        <div class="border-bottom border-color-1 border-dotted-bottom">
                                            <div class="p-3" id="basicsHeadingTwo">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="FourstylishRadio2" name="stylishRadio" value="2">
                                                    <label class="custom-control-label form-label" for="FourstylishRadio2"
                                                        data-toggle="collapse"
                                                        data-target="#basicsCollapseTwo"
                                                        aria-expanded="false"
                                                        aria-controls="basicsCollapseTwo">
                                                        Bkash / Nagad
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="basicsCollapseTwo" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                aria-labelledby="basicsHeadingTwo"
                                                data-parent="#basicsAccordion1">
                                                <div class="p-4">
                                                    <div class="form-group">
                                                        <label for="">Sender Mobile No: <small class="text-danger">*</small></label>
                                                        {{-- mb = mobile banking --}}
                                                        <input type="number" class="form-control" name="mb_sender_no">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Receiver Mobile No: <small class="text-danger">*</small></label>
                                                        {{-- mb = mobile banking --}}
                                                        <input type="number" class="form-control" name="mb_receiver_no">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Document: <small class="text-danger">*</small></label>
                                                        <input type="file" class="form-control" name="mb_document">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->

                                        <!-- Card -->
                                        <div class="border-bottom border-color-1 border-dotted-bottom">
                                            <div class="p-3" id="basicsHeadingFour">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="FourstylishRadio1" name="stylishRadio" value="3">
                                                    <label class="custom-control-label form-label" for="FourstylishRadio1"
                                                        data-toggle="collapse"
                                                        data-target="#basicsCollapseFour"
                                                        aria-expanded="false"
                                                        aria-controls="basicsCollapseFour">
                                                        SSL 
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="basicsCollapseFour" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                aria-labelledby="basicsHeadingFour"
                                                data-parent="#basicsAccordion1">
                                                <div class="p-4">
                                                    Pay via SSL, Work in progress
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->
                                    </div>
                                    <!-- End Basics Accordion -->
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck10" required
                                            data-msg="Please agree terms and conditions."
                                            data-error-class="u-has-error"
                                            data-success-class="u-has-success">
                                        <label class="form-check-label form-label" for="defaultCheck10">
                                            I have read and agree to the website <a href="#" class="text-blue">terms and conditions </a>
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Place order</button>
                            </div>
                            <!-- End Order Summary -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 order-lg-1">
                    <div class="pb-7 mb-7">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Billing details</h3>
                        </div>
                        <!-- End Title -->

                        <!-- Billing Form -->
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            First name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="firstName" placeholder="First name" aria-label="First name" required="" data-msg="Please enter your frist name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off" value="{{auth()->user()->first_name}}" required readonly>
                                    </div>
                                    <!-- End Input -->
                                </div>
    
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Last name
                                            
                                        </label>
                                        <input type="text" class="form-control" name="lastName" placeholder="Last name" aria-label="Last name" required="" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success" required value="{{auth()->user()->last_name}}" readonly>
                                    </div>
                                    <!-- End Input -->
                                </div>
    
                                <div class="w-100"></div>

                                <div class="col-md-12">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Address
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="streetAddress" placeholder="Address" aria-label="Address" required="" data-msg="Please enter a valid address." data-error-class="u-has-error" data-success-class="u-has-success" value="{{auth()->user()->present_address}}" readonly>
                                    </div>
                                    <!-- End Input -->
                                </div>
    
                                <div class="w-100"></div>
    
                                
    
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Email address
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control" name="emailAddress" placeholder="Your email"  required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success" value="{{auth()->user()->email}}" readonly>
                                    </div>
                                    <!-- End Input -->
                                </div>
    
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Phone
                                        </label>
                                        <input type="text" class="form-control" placeholder="Mobile" aria-label="Mobile" data-msg="Please enter your last name." data-error-class="u-has-error" value="{{auth()->user()->mobile}}" data-success-class="u-has-success" readonly>
                                    </div>
                                    <!-- End Input -->
                                </div>
    
                                <div class="w-100"></div>
                            </div>
                            <!-- Accordion -->
                            <div id="shopCartAccordion3" class="accordion rounded mb-5">
                                <!-- Card -->
                                <div class="card border-0">
                                    <div id="shopCartHeadingFour" class="custom-control custom-checkbox d-flex align-items-center">
                                        <input type="checkbox" class="custom-control-input" id="shippingdiffrentAddress" name="shippingdiffrentAddress" autocomplete="off" value="1">
                                        <label class="custom-control-label form-label" for="shippingdiffrentAddress" data-toggle="collapse" data-target="#shopCartfour" aria-expanded="false" aria-controls="shopCartfour">
                                            Ship to a different address?
                                        </label>
                                    </div>
                                    <div id="shopCartfour" class="collapse mt-5" aria-labelledby="shopCartHeadingFour" data-parent="#shopCartAccordion3" style="">
                                        <!-- Shipping Form -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Input -->
                                                <div class="js-form-message mb-6">
                                                    <label class="form-label">
                                                        Shipping Address
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="shipping_address" placeholder="Shipping Address" aria-label="Shipping Address"  data-msg="Please enter your shipping address." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                                                </div>
                                                <!-- End Input -->
                                            </div>

                                            <div class="w-100"></div>
                                        </div>
                                        <!-- End Shipping Form -->
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <!-- End Accordion -->

                            <div class="row">
                                {{-- <div class="col-12">
                                    <div class="border-bottom border-color-1 mb-5">
                                        <h3 class="section-title mb-0 pb-2 font-size-25">Shipping details</h3>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                          <input type="checkbox" class="form-check-input" name="personal_vehicle" value="1" autocomplete="off"><strong>I will use my vehicle for shipment</strong>
                                        </label>
                                        <br>
                                        <br>
                                    </div>

                                    <div class="w-100 conditional_area">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" data-cost="{{$setting->courier_inside_dhaka}}" name="shipping_area" value="1"><strong>Inside Dhaka</strong>
                                            </label>
                                          </div>
                                          
                                          <div class="form-check">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" data-cost="{{$setting->courier_outside_dhaka}}" name="shipping_area" value="2"><strong>Outside Dhaka</strong>
                                            </label>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                        
                        <!-- End Billing Form -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
@endsection

@push('script')
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
<script>
    $('input[name="personal_vehicle"]').click(function() {
        if($(this).is(":checked")) {
            $(".conditional_area").hide();
            $(".inside_outside_cost").text("0.00");
            $(".in_total").text($(".total_price").val());
            $('input[name="shipping_area"]').removeAttr('checked');
        } else {
            $(".conditional_area").show();
        }
    });

    $('input[name="shipping_area"]').click(function() {
            var cost = $(this).attr("data-cost");
            
            if($(this).is(":checked")) {
                $(".inside_outside_cost").text(Number(cost));
                
                $(".in_total").text(Number(cost) + Number($(".total_price").val()));
            } else {
                $(".inside_outside_cost").text("0.00");
                $(".in_total").text(Number($(".total_price").val()));
            }
    });

    

    // $('input[name="shipping_area"]').on('click', function() {
    //     $(this).siblings('input[name="shipping_area"]').not(this).prop('checked', false);
    // });

    $('input[name="shipping_area"]').on('change', function() {
        $('input[name="shipping_area"]').not(this).prop('checked', false);
    });

    $('#save_checkout').on('submit',function(e){
        // e.preventDefault();

        // var formData = new FormData(this);

        if ($('input#shippingdiffrentAddress').is(':checked')) {
            if($("input[name='shipping_address']").val() == ""){
                alertify.error("Please add shipping address");
                e.preventDefault();
                return false;
            }
        }
        
        if ($('input[name="personal_vehicle"]').is(':checked')) {
            
        } else {
            if($("input[name='shipping_area']").is(':checked')) {
                
            } else {
                alertify.error("Please choose your shipment area");
                e.preventDefault();
                return false;
            }
        }

        var payment_method = $('input[name="stylishRadio"]:checked').val();

        if (payment_method == 1) {
            
            if ($("input[name='bank_id']:selected").val() == "") {
                alertify.error("Please choose bank account");
                e.preventDefault();
                return false;
            }
            
            if ($("input[name='document']").val() == "") {
                alertify.error("Bank info document is required");
                e.preventDefault();
                return false;
            }
        }
        
        if (payment_method == 2) {
            
            if ($("input[name='mb_sender_no']").val() == "") {
                alertify.error("Sender mobile no is required");
                e.preventDefault();
                return false;
            }
            
            if ($("input[name='mb_receiver_no']").val() == "") {
                alertify.error("Receiver mobile no is required");
                e.preventDefault();
                return false;
            }
            
            if ($("input[name='mb_document']").val() == "") {
                alertify.error("Mobile banking document is required");
                e.preventDefault();
                return false;
            }
        }

        // $.ajax({
		// 	url: "{{route('checkout_complete')}}",
		// 	type: "post",
		// 	data: formData,
		// 	processData: false,
		// 	contentType: false,
		// 	success: function (response) {

		// 		// window.location.href = "{{route('admin.product.stock')}}/?complete=1";					
		// 	},
		// 	error: function(jqXHR, textStatus, errorThrown) {
				

		// 		// var errors = $.parseJSON(jqXHR.responseText);
		// 		// $.each(errors, function (key, val) {
		// 		// 	if (key == 'errors') {
		// 		// 		var res = Object.entries(val).map(([name, obj]) => ({ name, ...obj }));
		// 		// 		$.each(res, function (key1, val1) {
		// 		// 			Swal.fire(
		// 		// 				'Error!',
		// 		// 				val1[0],
		// 		// 				'success'
		// 		// 			)
		// 		// 		})
		// 		// 	}
		// 		// });
			
			
		// 	}
		// });
    });
    
</script>
@endpush

@push('css')
    <style>
        .conditional_area {
  margin-left: 20px;
}
    </style>
@endpush