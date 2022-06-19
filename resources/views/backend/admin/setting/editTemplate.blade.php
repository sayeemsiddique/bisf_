@extends('backend.layout.master')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Template</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.index')}}" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a class="text-muted">All Templates</a>
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
                @include('alerts.alerts')
                <!--begin::Card-->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div class="card card-custom example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">Edit Template</h3>

                                <div class="card-toolbar">
                                    <a href="{{url()->previous()}}" class="btn btn-primary btn-xsm mr-2">Back</a>
                                    
                                </div>
                                
                            </div>
                            <form action="{{ route('admin.setting.updateTemplate',$template)}}" method="post" >
                                <div class="card-body">
                                    @csrf
                                    

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">Header <span style="color: red;">*</span></label>
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <textarea name="header" class="form-control summernote"  rows="10">{!! $template->header !!}</textarea>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">Footer <span style="color: red;">*</span></label>
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <textarea name="footer" class="form-control summernote"  rows="10">{!! $template->footer !!}</textarea>
                                            
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">Body <span style="color: red;">*</span></label>
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <textarea name="body" class="form-control summernote"  rows="10">{{$template->body}}</textarea>
                                            
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-9 ml-lg-auto">
                                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
</div>

@endsection
@push('stackScript')
<script src="assets/js/pages/crud/forms/editors/summernote.js"></script>
    <script>
        $(document).ready(function() {
			$('.summernote').summernote({
				height: 200,
			});
		});


        // $(document).ready(function() {
        //     $("#service").change(function() {
        //         var type = this.value;
        //         // $(".single-trip").show();
        //         // $(".round-trip-form").show();
                
        //         if(type == 'certificate')
        //         {
        //             $("#service_type_other").hide();
        //             $("#service_type_certificate").show();
        //             $("#service_item_type_certificate").show();
                    

        //         }
        //         else if(type == 'other')
        //         {
        //             $("#service_type_certificate").hide();
        //             $("#service_item_type_certificate").hide();

        //             $("#service_type_other").show();
        //         }
                

        //     });
        // });
        
    </script>
@endpush