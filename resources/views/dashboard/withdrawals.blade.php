@php $pageTitle = 'Funds Withdrawals Area'; @endphp
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
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Withdrawal Date</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>

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
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Withdrawal Date</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>

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
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Withdrawal Date</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>

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