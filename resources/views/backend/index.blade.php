@extends('backend.layout.master')

	@section('content')
		<!--begin::Content-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--begin::Subheader-->
			<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<!--begin::Info-->
					<div class="d-flex align-items-center flex-wrap mr-2">
						<!--begin::Page Title-->
						<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Hello, {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}</h5>
						
						<!--end::Page Title-->
					</div>
					<!--end::Info-->
				</div>
			</div>
			<!--end::Subheader-->
			<!--begin::Entry-->
			<div class="d-flex flex-column-fluid">
				<!--begin::Container-->
				<div class="container-fluid">
					<!--begin::Dashboard-->

					<!--begin::Row-->
					<div class="row">

						

						

						

						@can('total_questions')
						<div class="col-lg-3 col-xxl-3">
							<!--begin::Stats Widget 12-->
							<div class="card card-custom gutter-b dash-count-card w3-cyan">
								<!--begin::Body-->
								<div class="card-body p-0 ">
									<a href="#" class="dash-click-card"> 
										<div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
											<i class="icon-xl fas fa-question fa-4x mr-2 w3-text-white"></i>
											<div class="d-flex flex-column text-right">
												<span class="font-weight-bolder font-size-h2">5</span>
												<span class="font-weight-bolder font-size-h6 mt-2 w3-text-white">Total Questions</span>		
											</div>
										</div>
									</a>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Stats Widget 12-->
						</div>
						@endcan

						@can('total_faqs')
						<div class="col-lg-3 col-xxl-3">
							<!--begin::Stats Widget 12-->
							<div class="card card-custom gutter-b dash-count-card w3-purple">
								<!--begin::Body-->
								<div class="card-body p-0 ">
									<a href="#" class="dash-click-card"> 
										<div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
											<i class="icon-xl fas fa-comment-alt fa-4x mr-2 w3-text-white"></i>
											<div class="d-flex flex-column text-right">
												<span class="font-weight-bolder font-size-h2">5</span>
												<span class="font-weight-bolder font-size-h6 mt-2 w3-text-white">Total FAQs</span>		
											</div>
										</div>
									</a>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Stats Widget 12-->
						</div>
						@endcan

						@can('total_wings')
						<div class="col-lg-3 col-xxl-3">
							<!--begin::Stats Widget 12-->
							<div class="card card-custom gutter-b dash-count-card w3-light-green">
								<!--begin::Body-->
								<div class="card-body p-0 ">
									<a href="#" class="dash-click-card"> 
										<div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
											<i class="icon-xl fas fa-puzzle-piece fa-4x mr-2 w3-text-white"></i>
											<div class="d-flex flex-column text-right">
												<span class="font-weight-bolder font-size-h2">5</span>
												<span class="font-weight-bolder font-size-h6 mt-2 w3-text-white">Total Wings</span>		
											</div>
										</div>
									</a>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Stats Widget 12-->
						</div>
						@endcan

						@can('total_divisions')
						<div class="col-lg-3 col-xxl-3">
							<!--begin::Stats Widget 12-->
							<div class="card card-custom gutter-b dash-count-card w3-blue-grey">
								<!--begin::Body-->
								<div class="card-body p-0 ">
									<a href="#" class="dash-click-card"> 
										<div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
											<i class="icon-xl fas fa-list-ul fa-4x mr-2 w3-text-white"></i>
											<div class="d-flex flex-column text-right">
												<span class="font-weight-bolder font-size-h2">55</span>
												<span class="font-weight-bolder font-size-h6 mt-2 w3-text-white">Total Divisions</span>		
											</div>
										</div>
									</a>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Stats Widget 12-->
						</div>
						@endcan

						@can('total_office_count')
						<div class="col-lg-3 col-xxl-3">
							<!--begin::Stats Widget 12-->
							<div class="card card-custom gutter-b dash-count-card w3-pink">
								<!--begin::Body-->
								<div class="card-body p-0 ">
									<a href="#" class="dash-click-card"> 
										<div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
											<i class="icon-xl fas fa-building fa-4x mr-2 w3-text-white"></i>
											<div class="d-flex flex-column text-right">
												<span class="font-weight-bolder font-size-h2">55</span>
												<span class="font-weight-bolder font-size-h6 mt-2 w3-text-white">Total Offices</span>		
											</div>
										</div>
									</a>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Stats Widget 12-->
						</div>
						@endcan


					</div>
					<!--end::row-->
					<!--end::Dashboard-->
				</div>
				<!--end::Container-->
			</div>
			<!--end::Entry-->
		</div>
		<!--end::Content-->
	@endsection
					
