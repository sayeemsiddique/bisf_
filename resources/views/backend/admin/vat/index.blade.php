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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Vat</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.index')}}" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a class="text-muted">All Vat</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            @include('alerts.alerts')
            <!--begin::Card-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Vat List</h3>
                            <div class="d-flex align-items-center">                                    
                                {{-- <input type="text"data-url="{{ route('admin.searchAjax',['type'=> 'designation']) }}" class="form-control form-control-lg form-control-solid ajax-data-search" name="q" placeholder="Enter Designation, Description, Level"> --}}
                                @can('add_vat_type')
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                        Add Vat Type
                                    </button>
                                
                                    <!-- The Modal -->
                                    <div class="modal" id="myModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                        
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Add Vat Type</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                        
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <form action="{{route('admin.vat.store')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="1">
                                                        <div class="form-group">
                                                            <label for="name">Name: <small class="text-danger">*</small></label>
                                                            <input name="name" type="text" class="form-control" placeholder="Enter name" id="name" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="name">Type: <small class="text-danger">*</small></label>
                                                            <select class="form-control" id="sel1" name="type" required>
                                                                <option value="">Select</option>
                                                                <option value="1">Percent</option>
                                                                <option value="2">Flat Rate</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="name">Rate Value: <small class="text-danger">*</small></label>
                                                            <input name="value" type="number" class="form-control" placeholder="Enter rate value" id="value" required>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </form>
                                                </div>
                                        
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                        
                                            </div>
                                        </div>
                                    </div>
                                @endcan

                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive ajax-data-container pt-3">
                                @include('backend.admin.vat.ajax.tableBody')                                    
                            </div>
                            {{$vats->appends($_GET)->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    
@endsection