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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Order Setting</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.index')}}" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a class="text-muted">Order Setting</a>
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
                                <h3 class="card-title">Order Setting</h3>
                                
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.setting.setting_update', $setting->id ?? 1)}}" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        @csrf
                                            
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Dealer Discount (Flat): <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="number" step="0.01" name="dealer_discount_flat" class="form-control" value="{{ $setting->dealer_discount_flat ?? '0' }}" required>
                                            </div>

                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Dealer Discount (Percentage): <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="text" step="0.01" name="dealer_discount_percent" class="form-control" value="{{ $setting->dealer_discount_percent ?? '0' }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Corporate Consumer Discount (Flat): <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="number" step="0.01" name="consumer_discount_flat" class="form-control" value="{{ $setting->consumer_discount_flat ?? '0' }}" required>
                                            </div>

                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Corporate Consumer Discount (Percentage): <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="number" step="0.01" name="consumer_discount_percent" class="form-control" value="{{ $setting->consumer_discount_percent ?? '0' }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">VAT (Percentage): <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="number" step="0.01" name="vat" class="form-control" value="{{ $setting->vat ?? '0' }}" required>
                                            </div>

                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Tax (Percentage): <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="number" step="0.01" name="tax" class="form-control" value="{{ $setting->tax ?? '0' }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Error (Flat in gram): <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="number" step="0.01" name="error_flat" class="form-control" value="{{ $setting->error_flat ?? '0' }}" required>
                                            </div>

                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Error (Percentage): <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="number" step="0.01" name="error_percent" class="form-control" value="{{ $setting->error_percent ?? '0' }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Courier Charge (Inside Dhaka): <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="number" step="0.01" name="courier_inside_dhaka" class="form-control" value="{{ $setting->courier_inside_dhaka ?? '0' }}" required>
                                            </div>

                                            <label class="col-form-label col-lg-2 col-sm-12 text-right">Courier Charge (Outside Dhaka): <span style="color: red;">*</span></label>
                                            <div class="col-lg-4 col-sm-12">
                                                <input type="number" step="0.01" name="courier_outside_dhaka" class="form-control" value="{{ $setting->courier_outside_dhaka ?? '0' }}" required>
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

