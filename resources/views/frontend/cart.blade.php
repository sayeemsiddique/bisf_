@extends('frontend.layout.master_alt')

@section('content')
@php
    $product_total_price = 0;
    $discount_amount = 0;
@endphp
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="cart-page">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-4">
                <h1 class="text-center">Cart</h1>
            </div>
            @if (count($carts) > 0)
            <div class="mb-10 cart-table">
                <form class="mb-4" action="{{route('update_cart')}}" method="post">
                    @csrf
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity w-lg-15">Quantity</th>
                                <th class="product-subtotal">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr class="">
                                <td class="text-center">
                                    <a href="#" class="text-gray-32 font-size-26 remove-cart-alt" data-cart_id="{{$cart->id}}">×</a>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <a href="{{route('product-detail', $cart->product_id)}}"><img class="img-fluid max-width-100 p-1 border border-color-1" src="{{asset('storage/product')}}/{{$cart->productInfo->image ?? ''}}" alt="Image Description"></a>
                                </td>

                                <td data-title="Product">
                                    <a href="{{route('product-detail', $cart->product_id)}}" class="text-gray-90">{{$cart->productInfo->name ?? ''}}</a>
                                </td>

                                <td data-title="Price">
                                    
                                    <span class="">৳@if ($cart->variation_id == 0){{$cart->productInfo->discount_price ?? ''}} @else {{$cart->varientInfo->discount_price ?? 0}} @endif</span>
                                </td>

                                <td data-title="Quantity">
                                    <span class="sr-only">Quantity</span>
                                    <!-- Quantity -->
                                    @php
                                        $in_stock = $cart->stockInfo($cart->product_id, $cart->variation_id)->quantity;
                                        if(!$in_stock){
                                            $in_stock = 0;
                                        }
                                    @endphp
                                    <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                        <div class="js-quantity row align-items-center">
                                            <div class="col">
                                                <input type="hidden" name="cart_id[]" value="{{$cart->id}}">
                                                <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="{{$cart->quantity}}" autocomplete="off" readonly name="quantity[]">
                                            </div>
                                            <div class="col-auto pr-1">
                                                <a onclick="js_minus_action(this)" class="js-minus-action btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                </a>
                                                <a data-stock_quantity="{{$in_stock}}" onclick="js_plus_action(this)" class="js-plus-action btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Quantity -->
                                </td>

                                <td data-title="Total">
                                    <span class="total_amount">
                                        ৳@if ($cart->variation_id == 0)
                                            @php
                                                $product_total_price +=  ($cart->productInfo->discount_price ?? 0)  * $cart->quantity;
                                            @endphp
                                            {{number_format((($cart->productInfo->discount_price ?? 0)  * $cart->quantity),2,".","")}}
                                            
                                        @else
                                            @php
                                                $product_total_price +=  ($cart->varientInfo->discount_price ?? 0)  * $cart->quantity;
                                            @endphp
                                            {{number_format((($cart->varientInfo->discount_price ?? 0) * $cart->quantity),2,".","")}}
                                            
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" class="border-top space-top-2 justify-content-center">
                                    <div class="pt-md-3">
                                        <div class="d-block d-md-flex flex-center-between">
                                            <div class="mb-3 mb-md-0 w-xl-40">
                                                <!-- Apply coupon Form -->
                                                
                                                    {{-- <label class="sr-only" for="subscribeSrEmailExample1">Coupon code</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="text" id="subscribeSrEmailExample1" placeholder="Coupon code" aria-label="Coupon code" aria-describedby="subscribeButtonExample2" required="">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-block btn-dark px-4" type="button" id="subscribeButtonExample2"><i class="fas fa-tags d-md-none"></i><span class="d-none d-md-inline">Apply coupon</span></button>
                                                        </div>
                                                    </div> --}}
                                                
                                                <!-- End Apply coupon Form -->
                                            </div>
                                            <div class="d-md-flex">
                                                <button type="submit" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto">Update cart</button>
                                                <a href="{{route('checkout')}}" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block">Proceed to checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="mb-8 cart-total">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                        <div class="border-bottom border-color-1 mb-3">
                            <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Cart totals</h3>
                        </div>
                        <table class="table mb-3 mb-md-0">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td data-title="Subtotal"><span class="amount">৳{{number_format($product_total_price,2,".","")}}</span></td>
                                </tr>
                                @if (auth()->check() and in_array(auth()->user()->type,[2,3]))
                                    <tr class="shipping">
                                        <th>Discount</th>
                                        <td data-title="Shipping">
                                            @php
                                                if (auth()->user()->type == 2) {
                                                    $user_discount_percent = $setting->consumer_discount_percent ?? 0;
                                                } else {
                                                    $user_discount_percent = $setting->dealer_discount_percent ?? 0;
                                                }
                                                $discount_amount = ($product_total_price * $user_discount_percent)/100;
                                            @endphp
                                            <span class="amount">৳{{number_format($discount_amount,2,".","")}} <small>({{$user_discount_percent}}%)</small></span>
                                            
                                        </td>
                                    </tr>
                                @endif
                                <tr class="order-vat">
                                    <th>Vat</th>
                                    <td data-title="Vat">
                                        
                                            <span class="amount">
                                                @php
                                                    $total_vat = 0;
                                                    $in_total = $product_total_price - $discount_amount;
                                                    if ($setting->vat > 0) {
                                                        $total_vat = ($in_total * $setting->vat) / 100;
                                                    }
                                                @endphp
                                                {{$setting->vat}} %
                                            </span>
                                        
                                    </td>
                                </tr>
                                
                                <tr class="order-tax">
                                    <th>Tax</th>
                                    <td data-title="Tax">
                                        
                                            <span class="amount">
                                                @php
                                                    $total_tax = 0;
                                                    if ($setting->tax > 0) {
                                                        $total_tax = (($in_total * $setting->tax) / 100);
                                                    }
                                                @endphp
                                                {{$setting->tax}} %
                                            </span>
                                        
                                    </td>
                                </tr>
                                
                                <tr class="order-total">
                                    <th>Total</th>
                                    <td data-title="Total"><strong><span class="amount">৳{{number_format(($in_total + $total_tax + $total_vat),2,".","")}}</span></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{route('checkout')}}" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-md-none">Proceed to checkout</a>
                    </div>
                </div>
            </div>
            @else
            <h2 class="text-center mb-5">
                Your cart is empty
            </h2>
            @endif
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

{{-- data-cart_id --}}
<script>
    $(".remove-cart-alt").click(function () {
        if (confirm('Are you sure to remove this item from your cart')) {
            var cart_id = $(this).attr('data-cart_id');
            var url = "{{route('remove_cart_item')}}?id="+cart_id;
            window.location.replace(url);
        }
    });

    function js_minus_action(that){
        var quantity = $(that).closest(".js-quantity").find('.js-result').val();
        
        if (quantity > 1 ) {
            $(that).closest(".js-quantity").find('.js-result').val(Number(quantity) - 1);
        } else if (quantity == 1) {
            alertify.error("Quantity can't be bellow 1");
        }
    }
    
    function js_plus_action(that){
        
        // console.log(data);
        // stock_quantity
        var quantity = $(that).closest(".js-quantity").find('.js-result').val();
        var in_stock = $(that).closest(".js-quantity").find('.js-plus-action').attr('data-stock_quantity');
        
        if (Number(quantity) >= Number(in_stock) ) {
            alertify.error("Stock exit");
            
        } else {
            $(that).closest(".js-quantity").find('.js-result').val(Number(quantity) + 1);
        }
    }
</script>
@endpush