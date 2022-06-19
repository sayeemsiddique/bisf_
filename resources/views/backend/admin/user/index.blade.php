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
										<h5 class="text-dark font-weight-bold my-1 mr-5">All Users List</h5>
										<!--end::Page Title-->
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
											<li class="breadcrumb-item">
												<a href="{{route('admin.index')}}" class="text-muted">Dashboard</a>
											</li>
											@can('all_users')
												<li class="breadcrumb-item">
													<a href="{{route('admin.user.index')}}" class="text-muted">User Management</a>
												</li>
											@endcan
											<li class="breadcrumb-item active">
												<a class="text-muted">All Users List</a>
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
												<h3 class="card-title">All Users List</h3>
											</div>
											
											<div class="card-body">

												<!--begin::Search Form-->
												<div class="mb-7">
													<div class="row align-items-center">
														<div class="col-lg-10 col-xl-10">
															<div class="row align-items-center">
																<div class="col-md-3 my-2 my-md-0">
																	<div class="input-icon">
																		<input type="text" name="q" data-url="{{ route('admin.searchAjax', ['type' => 'user']) }}" class="form-control ajax-data-search" placeholder="Enter Name, mobile, email" id="kt_datatable_search_query" />
																		<span>
																			<i class="flaticon2-search-1 text-muted"></i>
																		</span>
																	</div>
																</div>
																<div class="col-md-3 my-2 my-md-0">
																	<div class="d-flex align-items-center">
																		<label class="mr-3 mb-0 d-none d-md-block">Role:</label>
																		<select class="form-control select2 ajax-data-search" data-select="{{ route('admin.searchAjax', ['type' => 'userRole']) }}" id="role_id" name="role_id">
																			<option label="label">--Search By Role--</option>
																			@foreach ($roles as $role)
																				<option value="{{ $role->id }}">{{ $role->name }}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
																
																<div class="col-md-3 my-2 my-md-0">
																	<div class="d-flex align-items-center">
																		<label class="mr-3 mb-0 d-none d-md-block">Designation:</label>
																		<select class="form-control ajax-data-search select2" data-select="{{ route('admin.searchAjax', ['type' => 'userDesignation']) }}" id="designation_id" name="designation_id">
																			<option label="label">--Search By Designation--</option>
																			@foreach ($designations as $designation)
																				<option value="{{ $designation->id }}">{{ $designation->name }}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!--end::Search Form-->

												<!--begin::table-->
												<div class="table-responsive ajax-data-container pt-3">
													@include('backend.admin.user.ajax.tableBody')
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
					
