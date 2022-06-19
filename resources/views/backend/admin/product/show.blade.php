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
										<h5 class="text-dark font-weight-bold my-1 mr-5">Product Details</h5>
										<!--end::Page Title-->
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
											<li class="breadcrumb-item">
												<a href="{{route('admin.index')}}" class="text-muted">Dashboard</a>
											</li>
											@can('all_product')
												<li class="breadcrumb-item">
													<a href="{{route('admin.product.index')}}" class="text-muted">Manage Product</a>
												</li>
											@endcan
											<li class="breadcrumb-item active">
												<a class="text-muted">{{ $product->name }} Product Details</a>
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

								<!--begin::row-->
								<div class="row">
									<div class="col-lg-12">
										<!--begin::Card-->
										<div class="card card-custom">
											<!--begin::Header-->
											<div class="card-header py-3">
												<div class="card-title align-items-start flex-column">
													<h3 class="card-label font-weight-bolder text-dark">{{ $product->name }} Product Details</h3>
													<hr>
												</div>
												

												<div class="example-preview" style="width: 100%">
													<div class="row">
														<div class="col-sm-3">
															<ul class="nav flex-column nav-pills">
																<li class="nav-item mb-2">
																	<a class="nav-link active" id="home-tab-5" data-toggle="tab" href="#home-5">
																		<span class="nav-icon">
																			<i class="flaticon2-chat-1"></i>
																		</span>
																		<span class="nav-text">Product Details</span>
																	</a>
																</li>
																<li class="nav-item mb-2">
																	<a class="nav-link" id="profile-tab-5" data-toggle="tab" href="#profile-5" aria-controls="profile">
																		<span class="nav-icon">
																			<i class="flaticon2-layers-1"></i>
																		</span>
																		<span class="nav-text">Gallery</span>
																	</a>
																</li>
																
																<li class="nav-item">
																	<a class="nav-link" id="contact-tab-5" data-toggle="tab" href="#contact-5" aria-controls="contact">
																		<span class="nav-icon">
																			<i class="flaticon2-rocket-1"></i>
																		</span>
																		<span class="nav-text">Price</span>
																	</a>
																</li>
															</ul>
														</div>
														<div class="col-sm-9">
															<div class="tab-content" id="myTabContent5" style="width: 100%">
																<div class="tab-pane fade show active" id="home-5" role="tabpanel" aria-labelledby="home-tab-5">
																	<table class="table table-bordered table-sm text-left">
																		<tbody>
																		  <tr>
																			<td class="w-25">Product Name:</td>
																			<td class="w-75">{{$product->name}}</td>
																		  </tr>
																		  <tr>
																			<td class="w-25">Product Image:
																			</td>
																			<td class="w-75">
																				<img style="max-width: 200px" src="{{asset('storage/product')}}/{{$product->image}}" alt="">
																			</td>
																		  </tr>
																		  <tr>
																			<td class="w-25">Product Category:</td>
																			<td class="w-75">{{$product->productCategory->name ?? ''}}</td>
																		  </tr>
																		  <tr>
																			<td class="w-25">Sub Product Category:</td>
																			<td class="w-75">{{$product->productSubCategory->name ?? ''}}</td>
																		  </tr>
																		  <tr>
																			<td class="w-25">Product Weight:</td>
																			<td class="w-75">{{$product->weight}}</td>
																		  </tr>
																		  <tr>
																			<td class="w-25">Status:</td>
																			<td class="w-75">
																				@if ($product->status == 1)
																					<p class="text-success">Active</p>
																				@elseif ($product->status == 2)
																				<p class="text-danger">Deleted</p>
																				@elseif ($product->status == 0)
																				<p class="text-warning">Inactive</p>
																				@endif
																			</td>
																		  </tr>
																		  
																		  <tr>
																			<td class="w-25">Product Brand:</td>
																			<td class="w-75">{{$product->productBrand->name ?? ''}}</td>
																		  </tr>
																		  
																		  <tr>
																			<td class="w-25">Product Code:</td>
																			<td class="w-75">{{$product->code}}</td>
																		  </tr>
																		  
																		  <tr>
																			<td class="w-25">Unit:</td>
																			<td class="w-75">
																				@if ($product->unit == 1)
																				KG
																				@elseif ($product->unit == 2)
																				MT
																				@endif
																				
																			</td>
																		  </tr>
																		  
																		  
																		  
																		  
																		  <tr>
																			<td class="w-25">Featured:</td>
																			<td class="w-75">
																				@if ($product->featured == 1)
																					Featured
																				@endif
																			</td>
																		  </tr>
																		  
																		  <tr>
																			<td class="w-25">Description:
																			</td>
																			<td class="w-75">{!!$product->productInfo->description ?? ''!!}</td>
																		  </tr>
																		</tbody>
																	  </table>
																</div>
																<div class="tab-pane fade" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">
																	@foreach ($product->productGallery as $gallery)
																	<img style="max-width: 200px;margin-right: 20px;margin-bottom: 20px;" src="{{asset('storage/gallery')}}/{{$gallery->name}}" alt="">
																	@endforeach
																</div>
																<div class="tab-pane fade" id="contact-5" role="tabpanel" aria-labelledby="contact-tab-5">
																	<table class="table table-bordered table-sm text-left">
																		@if ($product->has_varient == 1)

																		<thead>
																			<th>Varient</th>
																			<th>Initial Quantity</th>
																			<th>Discount type</th>
																			<th>Sale Price</th>
																			<th>Discount</th>
																			<th>Total Sale Price</th>
																		</thead>
																		@foreach ($product->productVarient as $varient)
																			<tbody>
																				<tr>
																					
																					<td>
																						@foreach ($varient->productVarientData as $VarientData)
																							{{$VarientData->data_value}} 
																						@endforeach
																					</td>
																					<td>{{$varient->quantity}}</td>
																					<td>
																						@if ($varient->discount_type == 1)
																							Flat Rate
																						@elseif ($varient->discount_type == 2)
																							Percentage
																						@endif
																					</td>
																					<td>
																						{{$varient->price}}
																					</td>
																					<td>
																						{{$varient->discount}}
																					</td>
																					<td>
																						@php
																							if ($varient->discount_type == 1) {
																								$total_sale_price = $varient->price - (($varient->discount * $varient->price) / 100);
																								
																							} else {
																								$total_sale_price = $varient->price - $varient->discount;
																							}
																							
																						@endphp
																						{{$total_sale_price}}
																					</td>
																				</tr>
																			</tbody>
																		@endforeach
																		@else
																			<tbody>
																				<tr>
																					<td class="w-25">Initial Quantity:</td>
																					<td class="w-75">{{$product->quantity}}</td>
																				</tr>
																				
																				<tr>
																					<td class="w-25">Discount type:</td>
																					<td class="w-75">
																						@if ($product->discount_type == 1)
																						Flat Rate
																						@elseif ($product->discount_type == 2)
																						Percentage
																						@endif
																					</td>
																				</tr>

																				<tr>
																					<td class="w-25">Sale Price:</td>
																					<td class="w-75">{{$product->price}}</td>
																				</tr>

																				<tr>
																					<td class="w-25">Discount:</td>
																					<td class="w-75">{{$product->discount}}</td>
																				</tr>

																				<tr>
																					<td class="w-25">Total Sale Price:</td>
																					<td class="w-75">
																						@php
																							if ($product->discount_type == 1) {
																								$total_sale_price = $product->price - (($product->discount * $product->price) / 100);
																								
																							} else {
																								$total_sale_price = $product->price - $product->discount;
																							}
																							
																						@endphp
																						{{$total_sale_price}}
																					</td>
																				</tr>
																			</tbody>
																		@endif
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>

                                                {{-- @can('product')
                                                <div class="card-toolbar">
													<a href="{{route('admin.product.edit', $product->id)}}" class="btn btn-success mr-2">Edit Product Information</a>
												</div>
                                                @endcan --}}
											</div>
											<!--end::Header-->
                                            
										</div>
										<!--end::Card-->
									</div>
								</div>
                                <!--end::row-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
	@endsection
					