@extends('backend.layout.master')

	@section('content')
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Subheader-->
            <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5">Contact Us</h5>
                            <!--end::Page Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.index')}}" class="text-muted">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <a class="text-muted">Contact Us</a>
                                </li>
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            <!--end::Subheader-->
            <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--session msg-->
                    @include('alerts.alerts')

                    <!--begin::Card-->
                    <div class="row">
                        <div class="col-lg-12">
                            <!--begin::Card-->
                            <div class="card card-custom example example-compact">
                                <div class="card-header">
                                    <h3 class="card-title">Contact Us page</h3>
                                </div>
                                
                                <div class="card-body">

                                    <!--begin::Form-->
                                    <form class="form" action="{{route('admin.page.updateContactus')}}" method="POST" id="kt_form_1" enctype="multipart/form-data">
                                        @csrf

                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-form-label text-right col-lg-4 col-sm-12">Description: <span class="text-danger">*</span></label>
                                                <div class="col-lg-5 col-sm-12">
                                                    <textarea class="form-control summernote" name="description" placeholder="Enter Long description for About-Us page">{{$page->meta_description ?? ''}}</textarea>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-lg-9 text-right">
                                                        <button type="submit" class="btn btn-primary font-weight-bold">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                    

                                </div>
                            </div>
                            <!--end::Card-->
                        </div>
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>
        <!--end::Content-->
	@endsection
					
    @push('stackScript')
        <script src="assets/js/pages/crud/forms/editors/summernote.js"></script>
        <script>
            $(document).ready(function () {
                $('.summernote').summernote({
                    height: 200,
                });
            });
        </script>
    @endpush