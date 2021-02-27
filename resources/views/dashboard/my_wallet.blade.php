﻿@php
$users = auth()->user();
	$pageTitle = 'Wallet Area';
	$Wallet = 'active';
@endphp
@include('layouts.head')

<body>
	<!-- Header Start -->
	@include('layouts.header')
	<!-- Header End -->

	<!-- Left Sidebar Start -->
	@include('layouts.sidebar')
	<!-- Left Sidebar End -->

	<!-- Body Start -->
	<div class="wrapper">
		<div class="sa4d25">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h2 class="st_title"><i class="uil uil-wallet"></i>Wallet</h2>
					</div>
					<div class="col-md-12">

						@if(Session::has('success_message'))
							<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
								<i class="fa fa-envelope-o mr-2"></i>
								{{ Session::get('success_message') }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
						@elseif(Session::has('error_message'))
							<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
								<i class="fa fa-envelope-o mr-2"></i>
								{{ Session::get('error_message') }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
						@endif

						<div class="card_dash1">
							<div class="card_dash_left1">
								<i class="uil uil-money-bill"></i>
								<h1><b>{{number_format($userDetails->calculateUserBalance(), 2)}} ({{$userDetails->getBalanceForView()['data']['currency']}})</b></h1>
							</div>
							<div class="card_dash_right1">
								<button class="create_btn_dash" onclick="bringOutModalMain('.accountTopUp')">Account TopUp</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form action="{{route('transactions_by_date')}}" method="post">
							@csrf
							<h5>Filter With Date</h5>
							<div class="row">
								<div class="form-group col-sm-4">
									<input type="date" class="form-control" required placeholder="Start Date" name="start_date" >
									@error('start_date')
									<span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
								</div>
								<div class="form-group  col-sm-4">
									<input class="form-control" type="date" required placeholder="End Date" name="end_date" >
									@error('start_date')
									<span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
								</div>
								<div class="form-group  col-sm-4">
									<button  class="btn btn-info" type="submit">Proceed</button>
								</div>
								<hr style="color: #fff;" size="10">
							</div>
						</form>
					</div>
					<div class="col-md-12">
						<br>
						<h2 class="text-danger">Transaction(s) ({{$dates}})</h2>
						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-my-courses-tab" data-toggle="pill" href="#pills-my-courses" role="tab" aria-controls="pills-my-courses" aria-selected="true"><i class="uil uil-wallet"></i>All Transaction</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-upcoming-courses-tab" data-toggle="pill" href="#pills-upcoming-courses" role="tab" aria-controls="pills-upcoming-courses" aria-selected="false"><i class="uil uil-thumbs-up"></i>Confirmed Transaction</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-my-purchases-tab" data-toggle="pill" href="#pills-my-purchases" role="tab" aria-controls="pills-my-purchases" aria-selected="false"><i class="uil uil-thumbs-down"></i>Failed Transaction</a>
								</li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
											<tr>
												<th class="text-center" scope="col">S / N</th>
												@if(auth()->user()->user_type === 'admin')
													<th class="text-center" scope="col">Full Name</th>
													<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Amount</th>
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Reference</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Date Created</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($transaction) > 0)
												@php $count = 1; @endphp
												@foreach($transaction  as $k => $each_transaction)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														@if(auth()->user()->user_type === 'admin')
															<td class="text-center cell-ta">{{$userDetails->name}} {{$userDetails->last_name}}</td>
															<td class="text-center cell-ta">{{$userDetails->email}}</td>
														@endif
														<td class="text-center cell-ta">{{number_format(auth()->user()->getAmountForView($each_transaction->amount)['data']['amount'], 2)}} ({{auth()->user()->getAmountForView($each_transaction->amount)['data']['currency'] }})</td>
														<td class="text-center cell-ta">{{$each_transaction->action_type}}</td>
														<td class="text-center cell-ta">{{$each_transaction->reference}}</td>
														@php if($each_transaction->status === 'confirmed'){
																$status = 'Confirmed';
																$labelColor = 'success';
															}else if($each_transaction->status === 'pending'){
																$status = 'Pending';
																$labelColor = 'warning';
															}else if($each_transaction->status === 'processing'){
																$status = 'Processing';
																$labelColor = 'warning';
															}else if($each_transaction->status === 'failed'){
																$status = 'Failed';
																$labelColor = 'danger';
															}
														@endphp
														<td class="text-center">
															<button class="btn btn-{{$labelColor}}">{{$status}}</button>
														</td>
														<td class="text-center cell-ta">{{$each_transaction->created_at}}</td>
														<td class="text-center">
															<a target="_blank" href="{{route('transaction_history', $each_transaction->unique_id)}}" title="View" class="gray-s"><i class="uil uil-adjust"></i></a>
														</td>
													</tr>
													@php $count++ @endphp
												@endforeach
											@endif
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-upcoming-courses" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
											<tr>
												<th class="text-center" scope="col">S / N</th>
												@if(auth()->user()->user_type === 'admin')
													<th class="text-center" scope="col">Full Name</th>
													<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Amount</th>
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Reference</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Date Created</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($successful_transaction) > 0)
												@php $count = 1; @endphp
												@foreach($successful_transaction  as $k => $each_successful_transaction)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														@if(auth()->user()->user_type === 'admin')
															<td class="text-center cell-ta">{{$userDetails->name}} {{$userDetails->last_name}}</td>
															<td class="text-center cell-ta">{{$userDetails->email}}</td>
														@endif
														<td class="text-center cell-ta">{{number_format(auth()->user()->getAmountForView($each_successful_transaction->amount)['data']['amount'], 2)}} ({{auth()->user()->getAmountForView($each_successful_transaction->amount)['data']['currency'] }})</td>
														<td class="text-center cell-ta">{{$each_transaction->action_type}}</td>
														<td class="text-center cell-ta">{{$each_transaction->reference}}</td>
														@php if($each_successful_transaction->status === 'confirmed'){
																$status = 'Confirmed';
																$labelColor = 'success';
															}else if($each_successful_transaction->status === 'pending'){
																$status = 'Pending';
																$labelColor = 'warning';
															}else if($each_successful_transaction->status === 'processing'){
																$status = 'Processing';
																$labelColor = 'warning';
															}else if($each_successful_transaction->status === 'failed'){
																$status = 'Failed';
																$labelColor = 'danger';
															}
														@endphp
														<td class="text-center">
															<button class="btn btn-{{$labelColor}}">{{$status}}</button>
														</td>
														<td class="text-center cell-ta">{{$each_successful_transaction->created_at}}</td>
														<td class="text-center">
															<a target="_blank" href="{{route('transaction_history', $each_successful_transaction->unique_id)}}" title="View" class="gray-s"><i class="uil uil-adjust"></i></a>
														</td>
													</tr>
													@php $count++ @endphp
												@endforeach
											@endif
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-my-purchases" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
											<tr>
												<th class="text-center" scope="col">S / N</th>
												@if(auth()->user()->user_type === 'admin')
													<th class="text-center" scope="col">Full Name</th>
													<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Amount</th>
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Reference</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Date Created</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($pending_transaction) > 0)
												@php $count = 1; @endphp
												@foreach($pending_transaction  as $k => $each_pending_transaction)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														@if(auth()->user()->user_type === 'admin')
															<td class="text-center cell-ta">{{$userDetails->name}} {{$userDetails->last_name}}</td>
															<td class="text-center cell-ta">{{$userDetails->email}}</td>
														@endif
														<td class="text-center cell-ta">{{number_format(auth()->user()->getAmountForView($each_pending_transaction->amount)['data']['amount'], 2)}} ({{auth()->user()->getAmountForView($each_pending_transaction->amount)['data']['currency'] }})</td>
														<td class="text-center cell-ta">{{$each_pending_transaction->action_type}}</td>
														<td class="text-center cell-ta">{{$each_pending_transaction->reference}}</td>
														@php if($each_pending_transaction->status === 'confirmed'){
																$status = 'Confirmed';
																$labelColor = 'info';
															}else if($each_pending_transaction->status === 'pending'){
																$status = 'Pending';
																$labelColor = 'warning';
															}else if($each_pending_transaction->status === 'processing'){
																$status = 'Processing';
																$labelColor = 'warning';
															}else if($each_pending_transaction->status === 'failed'){
																$status = 'Failed';
																$labelColor = 'danger';
															}
														@endphp
														<td class="text-center">
															<button class="btn btn-{{$labelColor}}">{{$status}}</button>
														</td>
														<td class="text-center cell-ta">{{$each_pending_transaction->created_at}}</td>
														<td class="text-center">
															<a target="_blank" href="{{route('transaction_history', $each_pending_transaction->unique_id)}}" title="View" class="gray-s"><i class="uil uil-adjust"></i></a>
														</td>
													</tr>
													@php $count++ @endphp
												@endforeach
											@endif
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@include('layouts.footer')

	</div>
	<!-- Body End -->

@include('layouts.e_script')
