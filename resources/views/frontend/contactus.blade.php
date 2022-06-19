@extends('frontend.layout.master_alt')
@section('content')
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Contact-v1</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->
    <div class="mb-8">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2581.125839907461!2d90.34965734873781!3d23.80923910587086!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe4b005516040ab0a!2sBangladesh%20Insulator%20%26%20Sanitaryware%20Factory!5e0!3m2!1sen!2sbd!4v1654510100359!5m2!1sen!2sbd" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="container">
        <div class="row mb-10">
            {!! $page->meta_description ?? '' !!}
        </div>
        
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->


@endsection
