@extends('frontend.layout.master')
@section('content')
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
    <!-- Slider Section -->
    <div class="mb-5">
        <div class="bg-img-hero" style="background-image: url({{asset('frontend/assets/img/1920X422/img1.jpg')}});">
            <div class="container min-height-420 overflow-hidden">
                <div class="js-slick-carousel u-slick"
                    data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start mb-3 mb-md-4 offset-xl-3 pl-2 pb-1">
                    <div class="js-slide bg-img-hero-center">
                        <div class="row min-height-420 py-7 py-md-0">
                            <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                                <h1 class="font-size-64 text-lh-57 font-weight-light" data-scs-animation-in="fadeInUp">
                                    BISF 
                                    {{-- <span class="d-block font-size-55">STANDARD</span> --}}
                                </h1>
                                <h6 class="font-size-15 font-weight-bold mb-3" data-scs-animation-in="fadeInUp"
                                    data-scs-animation-delay="200">Bangladesh Insulator & Sanitaryware Factory Limited
                                </h6>
                                {{-- <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    <span class="font-size-13">FROM</span>
                                    <div class="font-size-50 font-weight-bold text-lh-45">
                                        <sup class="">৳</sup>749<sup class="">99</sup>
                                    </div>
                                </div> --}}
                                <a href="{{route('product-detail', 1)}}"
                                    class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                    data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                    Start Buying
                                </a>
                            </div>
                            <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="zoomIn"
                                data-scs-animation-delay="500">
                                <img class="img-fluid" src="{{asset('bisf1.jpg')}}"
                                    alt="Image Description">
                            </div>
                        </div>
                    </div>
                    <div class="js-slide bg-img-hero-center" data-animation-delay="0">
                        <div class="row min-height-420 py-7 py-md-0">
                            <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                                <h1 class="font-size-64 text-lh-57 font-weight-light" data-scs-animation-in="fadeInUp">
                                    BISF
                                    {{-- <span class="d-block font-size-55">STANDARD</span> --}}
                                </h1>
                                <h6 class="font-size-15 font-weight-bold mb-3" data-scs-animation-in="fadeInUp"
                                    data-scs-animation-delay="200">Bangladesh Insulator & Sanitaryware Factory Limited
                                </h6>
                                {{-- <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    <span class="font-size-13">FROM</span>
                                    <div class="font-size-50 font-weight-bold text-lh-45">
                                        <sup class="">৳</sup>749<sup class="">99</sup>
                                    </div>
                                </div> --}}
                                <a href="{{route('product-detail', 1)}}"
                                    class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                    data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                    Start Buying
                                </a>
                            </div>
                            <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="fadeInUp"
                                data-scs-animation-delay="500">
                                <img class="img-fluid" src="{{asset('bisf2.jpg')}}"
                                    alt="Image Description">
                            </div>
                        </div>
                    </div>
                    <div class="js-slide bg-img-hero-center" data-animation-delay="0">
                        <div class="row min-height-420 py-7 py-md-0">
                            <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                                <h1 class="font-size-64 text-lh-57 font-weight-light" data-scs-animation-in="fadeInUp">
                                    BISF
                                    {{-- <span class="d-block font-size-55">STANDARD</span> --}}
                                </h1>
                                <h6 class="font-size-15 font-weight-bold mb-3" data-scs-animation-in="fadeInUp"
                                    data-scs-animation-delay="200">Bangladesh Insulator & Sanitaryware Factory Limited
                                </h6>
                                {{-- <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    <span class="font-size-13">FROM</span>
                                    <div class="font-size-50 font-weight-bold text-lh-45">
                                        <sup class="">৳</sup>749<sup class="">99</sup>
                                    </div>
                                </div> --}}
                                <a href="{{route('product-detail', 1)}}"
                                    class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-15"
                                    data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                    Start Buying
                                </a>
                            </div>
                            <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="fadeInRight"
                                data-scs-animation-delay="500">
                                <img class="img-fluid" src="{{asset('bisf3.jpg')}}"
                                    alt="Image Description">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Section -->
    <div class="container">
        <!-- Banner -->
        <div class="mb-5">
            <div class="row">

            @foreach ($main_categories as $categories)
                <div class="col-md-6 mb-4 mb-xl-0 col-xl-3 category-home">
                    <a href="{{route('store.grid')}}?c[]={{$categories->id}}" class="d-black text-gray-90">
                        <div class="min-height-132 py-1 d-flex bg-gray-1 align-items-center">
                            <div class="col-6 col-xl-5 col-wd-6 pr-0">
                                <img class="img-fluid" src="{{asset('storage/category')}}/{{$categories->image}}"
                                    alt="{{$categories->name}}">
                            </div>
                            <div class="col-6 col-xl-7 col-wd-6">
                                <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                    {{$categories->name}}
                                </div>
                                <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                                    Shop now
                                    <span class="link__icon ml-1">
                                        <span class="link__icon-inner"><i
                                                class="ec ec-arrow-right-categproes"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            </div>
        </div>
        <!-- End Banner -->

    </div>

    <div class="container">
        <!-- Trending Products -->
        @if (count($featured_products) > 0)
        <div class="mb-8 position-relative">
            <div
                class="d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Featured Products</h3>
            </div>
            <div class="js-slick-carousel position-static u-slick u-slick--gutters-1 overflow-hidden u-slick-overflow-visble pt-3 pb-3"
                data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                data-arrow-left-classes="fa fa-angle-left right-1" data-arrow-right-classes="fa fa-angle-right right-0"
                data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">
                @foreach ($featured_products as $featured_product)
                <div class="js-slide">
                    <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                        @foreach ($featured_product as $product)
                        <li
                            class="col-wd-3 col-sm-4 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                            <div class="product-item__outer h-100 w-100">
                                <div class="product-item__inner p-md-3 row no-gutters">
                                    <div class="col col-lg-auto product-media-left">
                                        <a href="{{route('product-detail', $product->id)}}" class="max-width-150 d-block"><img
                                                class="img-fluid" src="{{asset('storage/product')}}/{{$product->image}}"
                                                alt="Image Description"></a>
                                    </div>
                                    <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1">
                                        <div class="mb-4">
                                            <div class="mb-2"><a
                                                    href="{{route('store.grid')}}?c[]={{$product->productCategory->id ?? 0}}"
                                                    class="font-size-12 text-gray-5">{{$product->productBrand->name ?? ''}}</a></div>
                                            <h5 class="product-item__title"><a href="{{route('product-detail', $product->id)}}"
                                                    class="text-blue font-weight-bold">{{$product->name}}</a>
                                            </h5>
                                        </div>
                                        <div class="flex-center-between mb-3">
                                            <div class="prodcut-price">
                                                <div class="text-gray-100">৳
                                                    @if ($product->has_varient == 1)
                                                        {{$product->productVarient->min('price')}}
                                                    @else
                                                        {{$product->price}}
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                <a href="{{route('product-detail', 1)}}"
                                                    class="btn-add-cart btn-primary transition-3d-hover"><i
                                                        class="ec ec-add-to-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="#" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        
                    </ul>
                </div>
                @endforeach
               
            </div>
        </div>
        @endif
        
        <!-- End Trending Products -->


        <!-- main category products -->
        @foreach ($main_categories as $categories)
        @if ($categories->sell_products_count > 0)
        <x-category-product :data="$categories"/>
        @endif
        
        @endforeach
        <!-- main category products -->

    </div>


</main>
<!-- ========== END MAIN CONTENT ========== -->







@endsection
