@extends('frontend.layout.master_alt')
@section('content')
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">

    <div class="bg-img-hero mb-14" style="background-image: url({{asset('assets/media/stock-900x600/img1.jpg')}});">
        <div class="container">
            <div class="flex-content-center max-width-620-lg flex-column mx-auto text-center min-height-564">
                <h1 class="h1 font-weight-bold">{{$page->title ?? ''}}</h1>
                <p class="text-gray-39 font-size-18 text-lh-default">{{$page->meta_title ?? ''}}</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            {!! $page->meta_description ?? '' !!}
        </div>
    </div>

</main>
<!-- ========== END MAIN CONTENT ========== -->







@endsection
