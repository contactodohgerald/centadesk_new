@php
	$pageTitle = 'All Complains Area';
	$Complain = 'active';
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
						<h2 class="st_title"><i class="uil uil-book-alt"></i>All Complains</h2>
					</div>
				</div>
				<div class="row">
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

						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-all-complains-tab" data-toggle="pill" href="#pills-all-complains" role="tab" aria-controls="pills-all-students" aria-selected="true"><i class="uil uil-auto-flash"></i>All Complains</a>
								</li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-all-complains" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
												<tr>
													<th class="text-center" scope="col">S / No</th>
													<th class="text-center" scope="col">Full Name</th>
													<th class="text-center" scope="col">Email</th>
													<th class="text-center" scope="col">User Type</th>
													<th class="text-center" scope="col">Account Status</th>
													<th class="text-center" scope="col">Reasons</th>
													<th class="text-center" scope="col">Complain Status</th>
													<th class="text-center" scope="col">Date</th>
													<th class="text-center" scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
											@if(count($complains) > 0)
												@php $count = 1; @endphp
												@foreach($complains  as $k => $each_complains)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center cell-ta">{{$each_complains->users->name}} {{$each_complains->users->last_name}}</td>
														<td class="text-center cell-ta">{{$each_complains->users->email}}</td>
														<td class="text-center cell-ta">{{$each_complains->users->user_type}}</td>
														<td class="text-center">
															<button class="btn btn-{{($each_complains->users->status === 'active')?'success':'danger'}}">{{$each_complains->users->status}}</button>
														</td>
														<td class="text-center cell-ta">{{$each_complains->reasons}}</td>
														<td class="text-center">
															<button class="btn btn-{{($each_complains->status === 'active')?'success':'primary'}}">{{$each_complains->status}}</button>
														</td>
														<td class="text-center cell-ta">{{$each_complains->created_at}}</td>
														<td class="text-center">
															<a href="javascript:void(0)" item_id="{{$each_complains->unique_id}}" onclick="bringOutModalMain('.activate_account'); addUniqueIdToInputField(this)" title="Activate Account" class="gray-s"><i class="uil uil-thumbs-up"></i></a>
															<a href="javascript:void(0)" item_id="{{$each_complains->unique_id}}" onclick="bringOutModalMain('.ignore_request'); addUniqueIdToInputField(this)" title="Ignore" class="gray-s"><i class="uil uil-adjust"></i></a>
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

<!-- The Modal -->
<div class="modal activate_account" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content" style="background-color: #333 !important;">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Activate Account</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{ route('activate_account') }}">
				@csrf
				<!-- Modal body -->
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="text-center">Are You Sure You Want To Activate This Account?</h3>
						</div>
						<input type="hidden" name="unique_id" class="delete_id">
					</div>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Continue</button>
				</div>
			</form>

		</div>
	</div>
</div>

<!-- The Modal -->
<div class="modal ignore_request" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content" style="background-color: #333 !important;">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Ignore Request</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{ route('ignore_request') }}">
			@csrf
			<!-- Modal body -->
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="text-center">Are You Sure You Want To Ignore This Request</h3>
						</div>
						<input type="hidden" name="unique_id" class="delete_id">
					</div>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Continue</button>
				</div>
			</form>

		</div>
	</div>
</div>

@include('layouts.e_script')