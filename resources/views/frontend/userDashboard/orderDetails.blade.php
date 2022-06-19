@extends('frontend.layout.master_alt')

@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="cart-page">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Order Details</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container account-page">
            <div class="mb-8">
                @if ($user->type == 3)
                    <h1 class="text-center">Dealer Account</h1>
                @elseif ($user->type == 2)
                    <h1 class="text-center">Corporate Consumer Account</h1>
                @else
                    <h1 class="text-center">Customer Account</h1>
                @endif
            </div>

            <div class="tab tab-vertical row gutter-lg">

                @include('frontend.layout.accountMenu')

                <div class="tab-content mb-6">
                    
                    <div class="tab-pane mb-4 active in" id="account-orders">
                        <div class="icon-box icon-box-side icon-box-light">
                            <span class="icon-box-icon icon-orders">
                                <i class="w-icon-orders"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title text-capitalize ls-normal mb-0" style="font-weight: 600;">Order Details</h4>
                            </div>
                        </div>

                        @include('alerts.alerts')

                        <table class="address-table table table-responsive">
                            <tbody>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>

                                    <th>Order Date:</th>
                                    <td>{{ date('d M Y', strtotime($orderDetails->created_at)) }}</td>
                                </tr>

                                @if ($user->corporation_name)
                                    <tr>
                                        <th>Company:</th>
                                        <td>{{ $user->corporation_name }}</td>
                                    </tr> 
                                @endif

                                <tr>
                                    <th>Order No:</th>
                                    <td>{{ $orderDetails->tracking_code ?? '' }}</td>

                                    <th>Shipping Address:</th>
                                    <td>{{ $user->present_address ?? '' }}</td>
                                </tr>
                                <tr class="order-status">
                                    <th>Order Status</th>
                                    <td>
                                        @if ($orderDetails->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-success">Complete</span>
                                        @endif
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>

                        <table class="shop-table account-orders-table mb-6 table table-responsive" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="order-id">Product</th>
                                    <th class="order-date">Price</th>
                                    <th class="order-status">Quantity</th>
                                    <th class="order-status">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subTotal = 0;
                                    $totalPrice = 0;
                                    $discountPrice = 0;
                                    $shippingPrice = 0;
                                    $discount = 0;
                                @endphp
                                @foreach ($orderDetails->orderDetails as $order)
                                    <tr>
                                        <td class="order-id">{{$order->product ? $order->product->name : ''}}</td>
                                        <td class="order-date">৳ {{ $order->price ?? 0 }}</td>
                                        <td class="order-date">{{ $order->quantity ?? 0 }}</td>
                                        <td class="order-date">
                                            @php
                                                $price = $order->price ?? 0;
                                                $quantity = $order->quantity ?? 0;
                                                $totalPrice = $price * $quantity;
                                            @endphp
                                            ৳ {{number_format($totalPrice, 2,'.','')}}
                                        </td>
                                    </tr>
                                    @php
                                        $subTotal += $totalPrice;
                                    @endphp
                                @endforeach

                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Subtotal</th>
                                    <th>৳ {{number_format($subTotal, 2,'.','')}}</th>
                                </tr>
                                @php
                                    if($user->type == 2){
                                        $discount = $setting->consumer_discount_percent ?? 0;
                                    }elseif($user->type == 3){
                                        $discount = $setting->dealer_discount_percent ?? 0;
                                    }else{
                                        $discount = 0;
                                    }
                                @endphp
                                @if ($user->type == 2 || $user->type == 3)
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Discount</th>
                                        <th>{{$discount}} %</th>
                                        @php
                                            $discountPrice = $subTotal * ((100 - $discount) / 100 );
                                        @endphp
                                    </tr>
                                @else
                                    @php
                                        $discountPrice = $subTotal * ((100 - $discount) / 100 );
                                    @endphp
                                @endif
                                
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Vat</th>
                                    <th>
                                        {{$vat = $setting->vat ?? 0}} %
                                    </th>
                                    @php
                                        $vatAmount = ($discountPrice * $vat) / 100;
                                        $vatPrice = $discountPrice + $vatAmount;
                                    @endphp
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Tax</th>
                                    <th>
                                        {{$tax = $setting->tax ?? 0}} %
                                    </th>
                                    @php
                                        $taxAmount = ($discountPrice * $tax) / 100;
                                        $taxPrice = $vatPrice + $taxAmount;
                                    @endphp
                                </tr>
                                
                                @php
                                    if($orderDetails->shipping_area == 1){
                                        $shippingCharge = $setting->courier_inside_dhaka ?? 0;
                                    }elseif($orderDetails->shipping_area == 2){
                                        $shippingCharge = $setting->courier_outside_dhaka ?? 0;
                                    }else{
                                        $shippingCharge = 0;
                                    }
                                @endphp
                                @if ($orderDetails->shipping_area == 1 || $orderDetails->shipping_area == 2)
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Shipping Charge</th>
                                        <th>৳ {{number_format($shippingCharge, 2, '.','')}}</th>
                                        @php
                                            $shippingPrice = $taxPrice + $shippingCharge;
                                        @endphp
                                    </tr>
                                @else
                                    @php
                                        $shippingPrice = $taxPrice + $shippingCharge;
                                    @endphp
                                @endif


                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th>৳ {{number_format($shippingPrice, 2,'.', '')}}</th>
                                </tr>
                                
                            </tbody>
                        </table>
                        
                    </div>

                </div>
                
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection

@push('script')
    <script>
        function previewFiles() {
            var preview = document.querySelector('img#imagePreview1');
            var file = document.querySelector('input#imageUpload1').files[0];
            var reader = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush