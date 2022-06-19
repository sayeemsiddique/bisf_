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
										<h5 class="text-dark font-weight-bold my-1 mr-5">Add New Product</h5>
										<!--end::Page Title-->
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
											<li class="breadcrumb-item">
												<a href="{{route('admin.index')}}" class="text-muted">Dashboard</a>
											</li>
											@can('all_department')
												<li class="breadcrumb-item">
													<a href="{{route('admin.department.index')}}" class="text-muted">Manage Product</a>
												</li>
											@endcan
											
											<li class="breadcrumb-item active">
												<a class="text-muted">Add New Product</a>
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
												<h3 class="card-title">Add New Product</h3>
											</div>
											
											
											<!--begin::Form-->
											<form class="form" action="{{route('admin.product.store')}}" method="post" id="kt_form_1" enctype="multipart/form-data">
												@csrf


												<div class="card-body">

													

                                                    <div class="form-group row">
														<label class="col-form-label text-right col-lg-4 col-sm-12">Name: <span class="text-danger">*</span></label>
														<div class="col-lg-5 col-sm-12">
															<input type="text" class="form-control" name="name" placeholder="Enter Product Name" value="{{old('name')}}" required/>
														</div>
													</div>

													<div class="form-group row">
														<label class="col-form-label text-right col-lg-4 col-sm-12">Description: <span class="text-danger"></span></label>
														<div class="col-lg-5 col-sm-12">
															<textarea placeholder="Description" class="form-control summernote" name="description" id="" cols="30" rows="10"></textarea>
														</div>
													</div>

                                                    <div class="form-group row">
														<label class="col-form-label text-right col-lg-4 col-sm-12">Image:</label>
														<div class="col-lg-5 col-sm-12">
															<input type="file" class="form-control" name="image" placeholder="Enter Image"/>
														</div>
													</div>
                                                    
													<div class="form-group row">
														<label class="col-form-label text-right col-lg-4 col-sm-12">Banner:</label>
														<div class="col-lg-5 col-sm-12">
															<input type="file" class="form-control" name="banner" placeholder="Enter Banner"/>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label text-right col-lg-4 col-sm-12">Status:</label>
														<div class="col-lg-5 col-sm-12">
															<span class="switch">
																<label>
																	<input type="checkbox" name="status" value="1" />
																	<span></span>
																</label>
															</span>
														</div>
													</div>

												</div>

												<div class="card-footer">
													<div class="row">
														<div class="col-lg-9 text-right">
															<button type="submit" class="btn btn-primary font-weight-bold" >Save</button>
														</div>
													</div>
												</div>
											</form>
											<!--end::Form-->
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
		$(document).ready(function() {
			$('.summernote').summernote({
				height: 200,
			});
		});
	</script>
	@endpush
					