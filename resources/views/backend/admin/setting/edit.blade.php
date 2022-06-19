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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Setting</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.index')}}" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a class="text-muted">Setting</a>
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
                                <h3 class="card-title">Setting</h3>
                                
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.setting.update', $setting->id ?? 1)}}" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        @csrf
                                            
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Title: <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="text" name="title" class="form-control" value="{{ $setting->title ?? '' }}" placeholder="Enter Title (English)" required>
                                            </div>

                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Sub-Title: <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="text" name="sub_title" class="form-control" value="{{ $setting->sub_title ?? '' }}" placeholder="Enter Sub-Title (English)" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Logo: <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <img alt="Logo" class="mt-2" src="{{ asset('storage/setting') }}/{{$setting->logo ?? ''}}" style="max-height: 45px;"/>

                                                <input type="file" name="logo" class="form-control mt-2">
                                            </div>

                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Address: <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <textarea name="address" class="form-control" rows="4" required>{{$setting->address ?? ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Phone: <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="text" name="phone" class="form-control" value="{{$setting->phone ?? ''}}" placeholder="Enter Phone Number" required>
                                            </div>

                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Alternative Phone:</label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="text" name="alt_phone" class="form-control" value="{{$setting->alt_phone ?? ''}}" placeholder="Enter Alternative Phone Number">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Mobile: <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="text" name="mobile" class="form-control" value="{{$setting->mobile ?? ''}}" placeholder="Enter Mobile Number" required>
                                            </div>

                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Alternative Mobile:</label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="text" name="alt_mobile" class="form-control" value="{{$setting->alt_mobile ??''}}" placeholder="Enter Alternative Mobile Number">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Email: <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="email" name="email" class="form-control" value="{{$setting->email ?? ''}}" placeholder="Enter Email" required>
                                            </div>

                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Alternative Email:</label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="email" name="alt_email" class="form-control" value="{{$setting->alt_email ?? ''}}" placeholder="Enter Alternative Email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Copyright Text: <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="text" name="copyright" class="form-control" value="{{$setting->copyright ?? ''}}" placeholder="Enter Copyright Text" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-lg-12 float-right">
                                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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



@endsection

