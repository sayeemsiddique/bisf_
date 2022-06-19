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
										<h5 class="text-dark font-weight-bold my-1 mr-5">User Report</h5>
										<!--end::Page Title-->
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
											<li class="breadcrumb-item">
												<a href="{{route('admin.index')}}" class="text-muted">Dashboard</a>
											</li>
											<li class="breadcrumb-item active">
												<a class="text-muted">User Report</a>
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
												<h3 class="card-title">User Report</h3>
											</div>
											
											<div class="card-body">

												<!--begin::Search Form-->
												<div class="mb-7">
													<form action="{{route('admin.report.user_report')}}" method="get">
													<div class="row align-items-center">
														
															<div class="col-lg-10 col-xl-10">
																<div class="row align-items-center">
																	<div class="col-md-3 my-2 my-md-0">
																		<div class="input-icon">
																			<input type="text" 
																			@if(isset($_GET['q']) and $_GET['q']!='') value="{{$_GET['q']}}" @endif
																			name="q" data-url="{{ route('admin.searchAjax', ['type' => 'userInfoR']) }}" class="form-control" placeholder="Enter Name, mobile, email" id="kt_datatable_search_query" />
																			<span>
																				<i class="flaticon2-search-1 text-muted"></i>
																			</span>
																		</div>
																	</div>
																	
	
																	<div class="col-md-3 my-2 my-md-0">
																		@php
                                                                        $division_str = array();
                                                                        if(isset($_GET['division_id']) and $_GET['division_id'] !=''){ 
                                                                            $division_str = \App\Models\Division::where('id',$_GET['division_id'])->get();


                                                                        }
                                                                            
                                                                        @endphp
																		<div class="d-flex align-items-center">
																			<label class="mr-3 mb-0 d-none d-md-block">Division:</label>
																			<select class="form-control select2" data-select="{{ route('admin.searchAjax', ['type' => 'userDivisionR']) }}" id="division_id" name="division_id">
																				<option value="" label="label">--Select Wing First--</option>
																				@foreach ($division_str as $division_list)
                                                                                    <option selected value="{{$division_list->id}}">
                                                                                        {{$division_list->name}}
                                                                                    </option>
                                                                                @endforeach

																			</select>
																		</div>
																	</div>
	
																	<div class="col-md-3 my-2 my-md-0">
																		<div class="d-flex align-items-center">
																			<label class="mr-3 mb-0 d-none d-md-block">Office:</label>
																			<select class="form-control select2" data-select="{{ route('admin.searchAjax', ['type' => 'userOfficeR']) }}" id="office_id" name="office_id">
																				<option value="" label="label">--Search By Office--</option>
																				@foreach ($offices as $office)
																					<option @if(isset($_GET['office_id']) and  $_GET['office_id'] == $office->id) selected @endif value="{{ $office->id }}">{{ $office->name }}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-2 col-xl-2">
	<button class="btn btn-primary font-weight-bold float-right">
		Search
	</button>
															</div>
														
													</div>
												</form>
												</div>
												<!--end::Search Form-->

												<!--begin::table-->
												<div class="table-responsive ajax-data-container pt-3">
													@include('backend.admin.report.ajax.userAjax')
												</div>
												<!--end::table-->
												
												{{ $users->links() }}
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
					
