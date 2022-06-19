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
							<h5 class="text-dark font-weight-bold my-1 mr-5">Order Details</h5>
							<!--end::Page Title-->
							<!--begin::Breadcrumb-->
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item">
									<a href="{{route('admin.index')}}" class="text-muted">Dashboard</a>
								</li>

								@can('all_order')
									<li class="breadcrumb-item">
										<a href="{{route('admin.order.index')}}" class="text-muted">All Order</a>
									</li>
								@endcan

								<li class="breadcrumb-item active">
									<a class="text-muted">Order Details</a>
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
										<h3 class="card-label font-weight-bolder text-dark">Order Details</h3>
									</div>

								</div>
								<!--end::Header-->
								<div class="card-body p-0">
									<!-- begin: Invoice-->
									<!-- begin: Invoice header-->
									<div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
										<div class="col-md-10">
											<div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
												<h3 class="display-4 font-weight-boldest mb-10">
													Ordered By: <a href="{{route('admin.customer.show', $order->orderUserInfo->id ?? 0)}}">
														{{$order->orderUserInfo->first_name ?? ""}} {{$order->orderUserInfo->last_name ?? ""}}
													</a>
												</h3>
												<div class="d-flex flex-column align-items-md-end px-0">
													<!--begin::Logo-->
													<a href="#" class="mb-5">
														<img style="width: 100px" src="{{asset('storage/users')}}/{{$order->orderUserInfo->image ?? ""}}" alt="">
													</a>
													<!--end::Logo-->
													<span class="d-flex flex-column align-items-md-end opacity-80">
														
														<span>{{$order->orderUserInfo->present_address ?? ''}}</span>
														<span>{{$order->orderUserInfo->email ?? ''}}</span>
														<span>{{$order->orderUserInfo->mobile ?? ''}}</span>
													</span>
												</div>
											</div>
											<div class="border-bottom w-100"></div>
											<div class="d-flex justify-content-between pt-6">
												<div class="d-flex flex-column flex-root">
													<span class="font-weight-bolder mb-2">ORDER DATE</span>
													<span class="opacity-80">{{$order->created_at->format("M d, Y")}}</span>
												</div>
												<div class="d-flex flex-column flex-root">
													<span class="font-weight-bolder mb-2">ORDER NO.</span>
													<span class="opacity-80">{{$order->tracking_code}}</span>
												</div>
												<div class="d-flex flex-column flex-root">
													<span class="font-weight-bolder mb-2">ORDER STATUS</span>
													<span class="opacity-100">
														@if ($order->status == 1)
															<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#orderStatus">Complete</button>
														@elseif($order->status == 0)
															<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#orderStatus">Pending</button>
														@elseif($order->status == 2)
															<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#orderStatus">Failed</button>
														@else
															<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#orderStatus">Status Error</button>
														@endif
													</span>
												</div>
												<div class="d-flex flex-column flex-root">
													<span class="font-weight-bolder mb-2">DELIVERY STATUS</span>
													<span class="opacity-100">
														@if ($order->delivery_status == 1)
															<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#deliveryStatus">Delivered</button>
														@elseif($order->delivery_status == 0)
															<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#deliveryStatus">Pending</button>
														@elseif($order->delivery_status == 2)
															<button type="button" class="btn btn-sm btn-light-success" data-toggle="modal" data-target="#deliveryStatus">On Delivery</button>
														@elseif($order->delivery_status == 3)
															<button type="button" class="btn btn-sm btn-light-danger" data-toggle="modal" data-target="#deliveryStatus">Delivery Failed</button>
														@else
															<button type="button" class="btn btn-sm btn-light-danger" data-toggle="modal" data-target="#deliveryStatus">Status Error</button>
														@endif
													</span>
												</div>
											</div>
										</div>
									</div>
									<!-- end: Invoice header-->
									<!-- begin: Invoice body-->
									<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
										<div class="col-md-10">
											<div class="table-responsive">
												<table class="table table-responseve">
													<thead>
														<tr>
															<th class="pl-0 font-weight-bold text-muted text-uppercase text-left">Ordered Items</th>
															<th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
															<th class="text-right font-weight-bold text-muted text-uppercase">Unit Price</th>
															<th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
														</tr>
													</thead>
													<tbody>
														@php
															$subTotal = 0;
															$orderUserType = 0;
															$discount = 0;
															$discountPrice = 0;
															$vatAmount = 0;
															$taxAmount = 0;
															$shippingArea = 0;
															$shippingCharge = 0;
															$shippingPrice = 0;
														@endphp
														@foreach ($order->orderDetails as $order_detail)
														<tr class="font-weight-boldest">
															<td class="border-0 pl-0 pt-7 d-flex align-items-center">
																<!--begin::Symbol-->
																<div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
																	<div class="symbol-label" style="background-image: url('{{asset('storage/product')}}/{{$order_detail->productInfo->image ?? ""}}')"></div>
																</div>
																<!--end::Symbol-->
																{{$order_detail->productInfo->name ?? ''}}
															</td>
															<td class="text-right pt-7 align-middle">
																{{$order_detail->quantity}}
															</td>
															<td class="text-right pt-7 align-middle">
																{{$order_detail->price}}
															</td>
															<td class="text-primary pr-0 pt-7 text-right align-middle">
																{{number_format($subTotal += $order_detail->price * $order_detail->quantity,2,".","")}}
															</td>
														</tr>
														
														@endforeach

														{{-- Show sub-total --}}
														<tr>
															<th class="text-right" colspan="3">Subtotal</th>
															<th class="text-right">{{number_format($subTotal, 2, '.','')}}</th>
														</tr>

														{{-- Show user wise discount percentage --}}
														<tr>
															@php
																$orderUserType = $order->orderUserIngo ? $order->orderUserInfo : 0;
															@endphp

															@if ($orderUserType == 2)
																<th class="text-right" colspan="3">Discount</th>
																<th class="text-right">{{$discount = $setting->consumer_discount_percent}} %</th>
															@elseif($orderUserType == 3)
																<th class="text-right" colspan="3">Discount</th>
																<th class="text-right">{{$discount = $setting->dealer_discount_percent}} %</th>
															@endif
															
															{{-- Calculate discount price --}}
															@php
																$discountPrice = $subTotal * ((100-$discount)/100);
															@endphp
														</tr>

														{{-- Show vat percentage --}}
														<tr>
															<th class="text-right" colspan="3">Vat</th>
															<th class="text-right">{{ $vat = $setting->vat ?? 0 }} %</th>

															{{-- Calculate vat and store plus vat amount --}}
															@php
																$vatAmount = ($discountPrice * $vat) / 100;
																$vatPrice = $discountPrice + $vatAmount;
															@endphp
														</tr>

														{{-- Show tax percentage --}}
														<tr>
															<th class="text-right" colspan="3">Tax</th>
															<th class="text-right">{{ $tax = $setting->tax ?? 0 }} %</th>

															{{-- Calculate vat and store plus vat amount --}}
															@php
																$taxAmount = ($discountPrice * $tax) / 100;
																$taxPrice = $vatPrice + $taxAmount;
															@endphp
														</tr>

														{{-- Show area wise shipping charge --}}
														<tr>
															@php
																$shippingArea = $order->shipping_area ? $order->shipping_area : 0;
															@endphp

															@if ($shippingArea == 1)
																<th class="text-right" colspan="3">Shipping Charge</th>
																<th class="text-right">৳ {{ $shippingCharge = $setting->courier_inside_dhaka ?? 0 }}</th>
															@elseif($shippingArea == 2)
																<th class="text-right" colspan="3">Shipping Charge</th>
																<th class="text-right">৳ {{ $shippingCharge = $setting->courier_outside_dhaka ?? 0 }}</th>
															@endif

															{{-- calculate shipping price and show total --}}
															@php
																$shippingPrice = $taxPrice + $shippingCharge;
															@endphp
														</tr>

														{{-- Show total price --}}
														<tr>
															<th class="text-right" colspan="3">Total</th>
															<th class="text-right">{{$shippingPrice}}</th>
														</tr>
														
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- end: Invoice body-->
									<!-- begin: Invoice footer-->
									<div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
										<div class="col-md-10">
											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th class="font-weight-bold text-muted text-uppercase">PAYMENT TYPE</th>
															<th class="font-weight-bold text-muted text-uppercase">PAYMENT STATUS</th>
														</tr>
													</thead>
													<tbody>
														<tr class="font-weight-bolder">
															<td>
																@if ($order->paymentInfo ? $order->paymentInfo->payment_method : 0)
																	@if ($order->paymentInfo->payment_method == 1)
																		Bank Payment																	
																	@elseif($order->paymentInfo->payment_method == 2)
																		Mobile Banking
																	@elseif($order->paymentInfo->payment_method == 3)
																		SSLCOMMERZ
																	@else
																		Error on Payment
																	@endif
																@endif
															</td>
															<td>
																@if ($order->payment_status == 1)
																	<button class="btn btn-sm btn-success">Complete</button>
																@elseif($order->payment_status == 0)
																	<button class="btn btn-sm btn-warning btn-sm">Pending</button>
																@elseif($order->payment_status == 2)
																	<button class="btn btn-sm btn-danger">Failed</button>
																@else
																	<button class="btn btn-sm btn-danger">Status Error</button>
																@endif
															</td>
														</tr>
														<tr>
															<td>
																<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#checkPayment">Check Payment</button>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- end: Invoice footer-->
									<!-- begin: Invoice action-->
									<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
										<div class="col-md-10">
											<div class="d-flex justify-content-between">
												<button type="button" class="btn btn-primary btn-sm font-weight-bold" onclick="window.print();">Print Order Details</button>
											</div>
										</div>
									</div>
									<!-- end: Invoice action-->
									<!-- end: Invoice-->
								</div>
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


		{{-- check payment modal --}}

		<div class="modal fade" id="checkPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Payment Document</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<form action="{{route('admin.order.paymentUpdate')}}" method="POST">
						@csrf
						{{-- Hidden file --}}
						<input type="hidden" name="orderId" value="{{$order->id}}" required>

						<div class="form-group row">
						  
							@if(empty($payment->payment_method))
								<label class="col-sm-4 col-form-label">Caution</label>
								<div class="col-sm-8">
									<p style="color:red">Error Payment Method</p>
								</div>
							@elseif ($payment->payment_method == 1)
								<label class="col-sm-4 col-form-label">Uploaded Document</label>
								<div class="col-sm-8">
									<a href="{{asset('storage/document/'.$payment->document)}}" download>
										<i class="las la-file-invoice" style="font-size: 60px; color:blue;"></i>
									</a>
									<small>Click to Download</small>
								</div>
							@elseif($payment->payment_method == 2)
								<label class="col-sm-4 col-form-label">Sender Mobile Number</label>
								<div class="col-sm-8">
									<input class="form-control" type="text" value="{{$payment->mb_sender_no ?? 'N/A'}}" readonly/>
								</div>
								<label class="col-sm-4 col-form-label">Receiver Mobile Number</label>
								<div class="col-sm-8">
									<input class="form-control" type="text" value="{{$payment->mb_receiver_no ?? 'N/A'}}" readonly/>
								</div>
								<label class="col-sm-4 col-form-label">Uploaded Document</label>
								<div class="col-sm-8">
									@if (empty($payment->mb_document))
										<p>No Document Found</p>
									@else
										<a href="{{asset('storage/mb_document/'.$payment->mb_document)}}" download>
											<i class="las la-file-invoice" style="font-size: 60px; color:blue;"></i>
										</a>
										<small>Click to Download</small>
									@endif
								</div>
							@endif
							
							
						  
						</div>
						<div class="form-group row">
						  <label for="inputPassword" class="col-sm-4 col-form-label">Status</label>
						  <div class="col-sm-8">
							<select class="form-control" name="paymentStatus" required>
								@if ($order->payment_status == 0)
									<option value="0" selected>Pending</option>
									<option value="1">Success</option>
									<option value="2">Failed</option>
								@elseif($order->payment_status == 1)
									<option value="1" selected readonly>Success</option>
								@elseif($order->payment_status == 2)
									<option value="2" selected readonly>Failed</option>
								@else
									<option value="">--Select an Option--</option>
									<option value="0">Pending</option>
									<option value="1">Success</option>
									<option value="2">Failed</option>
								@endif
								
							</select>
						  </div>
						</div>
						<div class="row">
							@if ($order->payment_status == 1 || $order->payment_status == 2)
								<div class="col-sm-4">
									<button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
								</div>	
							@else
								<div class="col-sm-8">
									<button type="submit" class="btn btn-success float-right">Update</button>
								</div>
								<div class="col-sm-4">
									<button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
								</div>
							@endif
						</div>
					</form>
				</div>
				<div class="modal-footer">
				{{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button> --}}
				</div>
			</div>
			</div>
		</div>


		{{-- order status modal --}}

		<div class="modal fade" id="orderStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Order Status</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<form action="{{route('admin.order.orderUpdate')}}" method="POST">
						@csrf
						{{-- Hidden file --}}
						<input type="hidden" name="orderId" value="{{$order->id}}" required>

						<div class="form-group row">
						  <label for="inputPassword" class="col-sm-4 col-form-label">Order Status</label>
						  <div class="col-sm-8">
							<select class="form-control" name="orderStatus" required>
								
								@if ($order->status == 0)
									<option value="0" selected>Pending</option>
									<option value="1">Complete</option>
									<option value="2">Failed</option>
								@elseif($order->status == 1)
									<option value="1" selected readonly>Complete</option>
								@elseif($order->status == 2)
									<option value="2" selected readonly>Failed</option>
								@else
									<option value="">--Select an Option--</option>
									<option value="0">Pending</option>
									<option value="1">Complete</option>
									<option value="2">Failed</option>
								@endif
								
							</select>
						  </div>
						</div>
						<div class="row">
							@if ($order->status == 1 || $order->status == 2)
								<div class="col-sm-4">
									<button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
								</div>	
							@else
								<div class="col-sm-8">
									<button type="submit" class="btn btn-success float-right">Update</button>
								</div>
								<div class="col-sm-4">
									<button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
								</div>
							@endif
						</div>
					</form>
				</div>
				<div class="modal-footer">
				{{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button> --}}
				</div>
			</div>
			</div>
		</div>

		{{-- Delivery status modal --}}

		<div class="modal fade" id="deliveryStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Delivery Status</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<form action="{{route('admin.order.deliveryUpdate')}}" method="POST">
						@csrf
						{{-- Hidden file --}}
						<input type="hidden" name="orderId" value="{{$order->id}}" required>

						<div class="form-group row">
						  <label for="inputPassword" class="col-sm-4 col-form-label">Delivery Status</label>
						  <div class="col-sm-8">
							<select class="form-control" name="deliveryStatus" required>
								
								@if ($order->delivery_status == 0)
									<option value="0" selected>Pending</option>
									<option value="2">On Delivery</option>
									<option value="3">Failed</option>
								@elseif($order->delivery_status == 1)
									<option value="1" selected readonly>Complete</option>
								@elseif($order->delivery_status == 3)
									<option value="3" selected readonly>Failed</option>
								@elseif($order->delivery_status == 2)
									<option value="2" selected>On Delivery</option>
									<option value="1">Complete</option>
									<option value="3">Failed</option>
								@else
									<option value="">--Select an Option--</option>
									<option value="0">Pending</option>
									<option value="1">Complete</option>
									<option value="2">On Delivery</option>
									<option value="3">Failed</option>
								@endif
								
							</select>
						  </div>
						</div>
						<div class="row">
							@if ($order->delivery_status == 1 || $order->status == 3)
								<div class="col-sm-4">
									<button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
								</div>	
							@else
								<div class="col-sm-8">
									<button type="submit" class="btn btn-success float-right">Update</button>
								</div>
								<div class="col-sm-4">
									<button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
								</div>
							@endif
						</div>
					</form>
				</div>
				<div class="modal-footer">
				{{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button> --}}
				</div>
			</div>
			</div>
		</div>


	@endsection
