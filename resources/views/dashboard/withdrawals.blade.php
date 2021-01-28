@php
	$pageTitle = 'Funds Withdrawals Area';
	$users = auth()->user();
	$user_type = $users->user_type;
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
						<h2 class="st_title"><i class="uil uil-money-withdraw"></i>Funds Withdrawals</h2>
					</div>
					@if($user_type !== 'admin')
					<div class="col-md-12">
						<div class="card_dash1">
							<div class="row">
								<div class="col-lg-4">
									<img src="{{asset('dashboard/images/used_images/withdrawal.png')}}" alt="{{env('APP_NAME')}}" class="img-thumbnail">
								</div>
								<div class="col-lg-8">

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

									<form action="{{route('make_withdrawal')}}" method="post">
										@csrf
										<div class="ui search focus mt-30">
											<label for="amount">{{ __('Amount To Be Withdrawn') }} ({{auth()->user()->getBalanceForView()['data']['currency']}})</label>
											<div class="ui left icon input swdh11 swdh19">
												<input class="prompt srch_explore @error('amount') is-invalid @enderror" type="number" name="amount" id="amount" required placeholder="Enter Amount">
												<i class="uil uil-money-withdraw icon icon2"></i>

												@error('amount')
												<span class="invalid-feedback" role="alert">
												 <strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</div>
										<button class="save_btn" type="submit">Request For Withdrawal</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					@endif
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-my-courses-tab" data-toggle="pill" href="#pills-my-courses" role="tab" aria-controls="pills-my-courses" aria-selected="true"><i class="uil uil-book-alt"></i>All Withdrawals</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-my-purchases-tab" data-toggle="pill" href="#pills-my-purchases" role="tab" aria-controls="pills-my-purchases" aria-selected="false"><i class="uil uil-download-alt"></i>Pending Withdrawals</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-upcoming-courses-tab" data-toggle="pill" href="#pills-upcoming-courses" role="tab" aria-controls="pills-upcoming-courses" aria-selected="false"><i class="uil uil-upload-alt"></i>Successful Withdrawals</a>
								</li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
											<tr>
												<th class="text-center" scope="col">S / N</th>
												<th class="text-center" scope="col">Amount</th>
												<th class="text-center" scope="col">Bank Name</th>
												<th class="text-center" scope="col">Account Number</th>
												<th class="text-center" scope="col">Account Name</th>
												@if($user_type === 'admin')
												<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Reference</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Withdrawal Date</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
												@if(count($transaction) > 0)
												@php $count = 1; @endphp
												@foreach($transaction  as $k => $each_transaction)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center cell-ta">{{$users->getAmountForView($each_transaction->amount)['data']['amount']}} ({{$users->getAmountForView($each_transaction->amount)['data']['currency'] }})</td>
														<td class="text-center cell-ta">Bank</td>
														<td class="text-center cell-ta">Number</td>
														<td class="text-center cell-ta">Name</td>
														@if($user_type === 'admin')
															<td class="text-center cell-ta">{{$each_transaction->users->email}}</td>
														@endif
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
															<a href="#" title="View" class="gray-s"><i class="uil uil-adjust"></i></a>
															<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
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
												<th class="text-center" scope="col">Amount</th>
												<th class="text-center" scope="col">Bank Name</th>
												<th class="text-center" scope="col">Account Number</th>
												<th class="text-center" scope="col">Account Name</th>
												@if($user_type === 'admin')
													<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Reference</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Withdrawal Date</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($pending_transaction) > 0)
												@php $count = 1; @endphp
												@foreach($pending_transaction  as $k => $each_pending_transaction)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center cell-ta">{{$users->getAmountForView($each_pending_transaction->amount)['data']['amount']}} ({{$users->getAmountForView($each_pending_transaction->amount)['data']['currency'] }})</td>
														<td class="text-center cell-ta">Bank</td>
														<td class="text-center cell-ta">Number</td>
														<td class="text-center cell-ta">Name</td>
														@if($user_type === 'admin')
															<td class="text-center cell-ta">{{$each_pending_transaction->users->email}}</td>
														@endif
														<td class="text-center cell-ta">{{$each_pending_transaction->action_type}}</td>
														<td class="text-center cell-ta">{{$each_pending_transaction->reference}}</td>
														@php if($each_pending_transaction->status === 'confirmed'){
																$status = 'Confirmed';
																$labelColor = 'success';
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
															<a href="#" title="View" class="gray-s"><i class="uil uil-adjust"></i></a>
															<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
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
												<th class="text-center" scope="col">Amount</th>
												<th class="text-center" scope="col">Bank Name</th>
												<th class="text-center" scope="col">Account Number</th>
												<th class="text-center" scope="col">Account Name</th>
												@if($user_type === 'admin')
													<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Reference</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Withdrawal Date</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($successful_transaction) > 0)
												@php $count = 1; @endphp
												@foreach($successful_transaction  as $k => $each_successful_transaction)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center cell-ta">{{$users->getAmountForView($each_successful_transaction->amount)['data']['amount']}} ({{$users->getAmountForView($each_successful_transaction->amount)['data']['currency'] }})</td>
														<td class="text-center cell-ta">Bank</td>
														<td class="text-center cell-ta">Number</td>
														<td class="text-center cell-ta">Name</td>
														@if($user_type === 'admin')
															<td class="text-center cell-ta">{{$each_successful_transaction->users->email}}</td>
														@endif
														<td class="text-center cell-ta">{{$each_successful_transaction->action_type}}</td>
														<td class="text-center cell-ta">{{$each_successful_transaction->reference}}</td>
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
															<a href="#" title="View" class="gray-s"><i class="uil uil-adjust"></i></a>
															<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
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