@php $pageTitle = 'View Courses';
// $i=1;

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
						<h2 class="st_title"><i class="uil uil-book-alt"></i>Courses</h2>
					</div>
					<div class="col-md-12">
						<div class="card_dash1">
							<div class="card_dash_left1">
								<i class="uil uil-book-alt"></i>
								<h1>Jump Into Course Creation</h1>
							</div>
							<div class="card_dash_right1">
								<button class="create_btn_dash" onclick="window.location.href = 'create-course';">Create Your Course</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-my-courses-tab" data-toggle="pill" href="#pills-my-courses" role="tab" aria-controls="pills-my-courses" aria-selected="true"><i class="uil uil-book-alt"></i>My Courses</a>
								</li>
								{{-- <li class="nav-item">
									<a class="nav-link" id="pills-my-purchases-tab" data-toggle="pill" href="#pills-my-purchases" role="tab" aria-controls="pills-my-purchases" aria-selected="false"><i class="uil uil-download-alt"></i>My Purchases</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-upcoming-courses-tab" data-toggle="pill" href="#pills-upcoming-courses" role="tab" aria-controls="pills-upcoming-courses" aria-selected="false"><i class="uil uil-upload-alt"></i>Upcoming Courses</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-discount-tab" data-toggle="pill" href="#pills-discount" role="tab" aria-controls="pills-discount" aria-selected="false"><i class="uil uil-tag-alt"></i>Discounts</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-promotions-tab" data-toggle="pill" href="#pills-promotions" role="tab" aria-controls="pills-promotions" aria-selected="false"><i class="uil uil-megaphone"></i>Promotions</a>
								</li> --}}
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
												<tr>
													<th class="text-center" scope="col">Item No.</th>
													<th>Title</th>
													<th class="text-center" scope="col">Publish Date</th>
													<th class="text-center" scope="col">Like</th>
													<th class="text-center" scope="col">Views</th>
													<th class="text-center" scope="col">Category</th>
													<th class="text-center" scope="col">Status</th>
													<th class="text-center" scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
                                                @if (!$courses->isEmpty())
                                                @foreach ($courses as $e)
												<tr>
													<td class="text-center">{{ $loop->iteration }}</td>
													<td>{{ $e->name }}</td>
													<td class="text-center">{{ $e->created_at }}</td>
													<td class="text-center">{{ $e->views }}</td>
													<td class="text-center">{{ $e->like }}</td>
													<td class="text-center"><a href="#">{{ $e->category->name }}</a></td>
													<td class="text-center text-capitalize"><b class="course_active">{{ $e->status }}</b></td>
													<td class="text-center">
														<a href="/edit-course/{{ $e->unique_id }}" title="Edit" class="gray-s"><i class="uil uil-edit-alt"></i></a>
														<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
													</td>
                                                </tr>
                                                @endforeach
                                                @else
												<tr>
													<td colspan="8" class="text-center ">No Records Found</td>
                                                </tr>
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
													<th class="text-center" scope="col">Item No.</th>
													<th class="cell-ta" scope="col">Title</th>
													<th class="cell-ta" scope="col">Vendor</th>
													<th class="cell-ta" scope="col">Category</th>
													<th class="text-center" scope="col">Delivery Type</th>
													<th class="text-center" scope="col">Price</th>
													<th class="text-center" scope="col">Purchase Date</th>
													<th class="text-center" scope="col">Actions</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="text-center">001</td>
													<td class="cell-ta">Course Title Here</td>
													<td class="cell-ta"><a href="#">Zoena Singh</a></td>
													<td class="cell-ta"><a href="#">Web Development</a></td>
													<td class="text-center"><b class="course_active">Download</b></td>
													<td class="text-center">$15</td>
													<td class="text-center">25 March 2020</td>
													<td class="text-center">
														<a href="#" title="Download" class="gray-s"><i class="uil uil-download-alt"></i></a>
														<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
														<a href="#" title="Print" class="gray-s"><i class="uil uil-print"></i></a>
													</td>
												</tr>
												<tr>
													<td class="text-center">002</td>
													<td class="cell-ta">Course Title Here</td>
													<td class="cell-ta"><a href="#">Rock William</a></td>
													<td class="cell-ta"><a href="#">C++</a></td>
													<td class="text-center"><b class="course_active">Download</b></td>
													<td class="text-center">$20</td>
													<td class="text-center">20 March 2020</td>
													<td class="text-center">
														<a href="#" title="Download" class="gray-s"><i class="uil uil-download-alt"></i></a>
														<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
														<a href="#" title="Print" class="gray-s"><i class="uil uil-print"></i></a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-upcoming-courses" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
												<tr>
													<th class="text-center" scope="col">Item No.</th>
													<th class="cell-ta">Title</th>
													<th class="text-center" scope="col">Thumbnail</th>
													<th class="text-center">Category</th>
													<th class="text-center">Price</th>
													<th class="text-center">Date</th>
													<th class="text-center" scope="col">Status</th>
													<th class="text-center" scope="col">Actions</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="text-center">01</td>
													<td class="cell-ta">Course Title Here</td>
													<td class="text-center"><a href="#">View</a></td>
													<td class="text-center"><a href="#">Web Development</a></td>
													<td class="text-center">$15</td>
													<td class="text-center">9 April 2020</td>
													<td class="text-center"><b class="course_active">Pending</b></td>
													<td class="text-center">
														<a href="#" title="Edit" class="gray-s"><i class="uil uil-edit-alt"></i></a>
														<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
													</td>
												</tr>
												<tr>
													<td class="text-center">02</td>
													<td class="cell-ta">Course Title Here</td>
													<td class="text-center"><a href="#">View</a></td>
													<td class="text-center"><a href="#">Graphic Design</a></td>
													<td class="text-center">$12</td>
													<td class="text-center">8 April 2020</td>
													<td class="text-center"><b class="course_active">Pending</b></td>
													<td class="text-center">
														<a href="#" title="Edit" class="gray-s"><i class="uil uil-edit-alt"></i></a>
														<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
													</td>
												</tr>
												<tr>
													<td class="text-center">03</td>
													<td class="cell-ta">Course Title Here</td>
													<td class="text-center"><a href="#">View</a></td>
													<td class="text-center"><a href="#">Photography</a></td>
													<td class="text-center">$6</td>
													<td class="text-center">7 April 2020</td>
													<td class="text-center"><b class="course_active">Pending</b></td>
													<td class="text-center">
														<a href="#" title="Edit" class="gray-s"><i class="uil uil-edit-alt"></i></a>
														<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-discount" role="tabpanel">
									<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingOne">
												<div class="panel-title adcrse1250">
													<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
														New Discount
													</a>
												</div>
											</div>
											<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
												<div class="panel-body adcrse_body">
													<div class="row">
														<div class="col-lg-8">
															<div class="discount_form">
																<div class="row">
																	<div class="col-lg-6 col-md-6">
																		<div class="mt-20 lbel25">
																			<label>Course*</label>
																		</div>
																		<select class="ui hj145 dropdown cntry152 prompt srch_explore">
																			<option value="">Select Course</option>
																			<option value="1">Course Title Here</option>
																			<option value="2">Course Title Here</option>
																			<option value="3">Course Title Here</option>
																			<option value="4">Course Title Here</option>
																			<option value="5">Course Title Here</option>
																			<option value="6">Course Title Here</option>
																			<option value="7">Course Title Here</option>
																		</select>
																	</div>
																	<div class="col-lg-6 col-md-6">
																		<div class="ui search focus mt-20 lbel25">
																			<label>Discount Amount</label>
																			<div class="ui left icon input swdh19">
																				<input class="prompt srch_explore" type="number" name="off" value="" required="" min="1" max="99" placeholder="Percent (eg. 20 for 20%)">
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-6 col-md-6">
																		<div class="ui search focus mt-20 lbel25">
																			<label>Start Date</label>
																			<div class="ui left icon input swdh19">
																				<input class="prompt srch_explore datepicker-here" type="text" data-language="en" placeholder="dd/mm/yyyy">
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-6 col-md-6">
																		<div class="ui search focus mt-20 lbel25">
																			<label>End Date</label>
																			<div class="ui left icon input swdh19">
																				<input class="prompt srch_explore datepicker-here" type="text" data-language="en" placeholder="dd/mm/yyyy">
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-6 col-md-6">
																		<button class="discount_btn" type="submit">Save Changes</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
												<tr>
													<th class="text-center" scope="col">Item No.</th>
													<th class="cell-ta">Course</th>
													<th class="text-center" scope="col">Start Date</th>
													<th class="text-center" scope="col">End Date</th>
													<th class="text-center" scope="col">Discount</th>
													<th class="text-center" scope="col">Status</th>
													<th class="text-center" scope="col">Actions</th>
												</tr>
											</thead>
											<tbody>
                                                <tr>
													<td class="text-center">01</td>
													<td class="cell-ta">Course Title Here</td>
													<td class="text-center">02 November 2019</td>
													<td class="text-center">19 November 2019</td>
													<td class="text-center">20%</td>
													<td class="text-center"><b class="course_active">Active</b></td>
													<td class="text-center">
														<a href="#" title="Edit" class="gray-s"><i class="uil uil-edit-alt"></i></a>
														<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
													</td>
												</tr>
                                            </tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-promotions" role="tabpanel" aria-labelledby="pills-promotions-tab">
									<div class="promotion_tab mb-10">
										<img src="images/dashboard/promotion.svg" alt="">
										<h4>Baby promotion plan is activated!</h4>
										<p>By activating promotion plans you can improve course views and sales.</p>
										<button class="plan_link_btn" onclick="window.location.href = '#';">Change New Plan</button>
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

        <script>
            $(document).ready(function () {

            });
        </script>
