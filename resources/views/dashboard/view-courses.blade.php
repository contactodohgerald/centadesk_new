@php
$users = auth()->user();
	$pageTitle = 'View Courses';
	$Course = 'active';
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
                <div class="row" id="errorHold"></div>
				<div class="row">
					<div class="col-md-12">
						<br>
						<h4 class="text-danger">
							@if(auth()->user()->privilegeChecker('view_restricted_roles'))
								<div class="pull-right">
									<a class="btn btn-danger" onclick="activateCoursesStatus(this)" href="javascript:;">Confirm Courses Status</a>
									<a class="btn btn-danger" onclick="deleteCourse(this)" href="javascript:;">Delete Course</a>
								</div>
							@endif
						</h4>
					</div>
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
													@if(auth()->user()->privilegeChecker('view_restricted_roles'))
													<th class="text-center">
														<input onclick="checkAll()" type="checkbox" class="mainCheckBox" />
													</th>
													@endif
													<th class="text-center" scope="col">Title</th>
													<th class="text-center" scope="col">Publish Date</th>
													<th class="text-center" scope="col">Like</th>
													<th class="text-center" scope="col">Views</th>
													<th class="text-center" scope="col">Category</th>
													@if(auth()->user()->privilegeChecker('view_restricted_roles'))
													<th class="text-center" scope="col">User's Name</th>
													<th class="text-center" scope="col">User's Email</th>
													@endif
													<th class="text-center" scope="col">Status</th>
													<th class="text-center" scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
                                                @if (!$courses->isEmpty())
                                                @foreach ($courses as $e)
												<tr>
													<td class="text-center">{{ $loop->iteration }}</td>
													@if(auth()->user()->privilegeChecker('view_restricted_roles'))
													<td class="text-center sorting_1">
														<input type="checkbox" class="smallCheckBox" value="{{$e->unique_id}}">
													</td>
													@endif
													<td class="text-center">{{ $e->name }}</td>
													<td class="text-center">{{ $e->created_at }}</td>
													<td class="text-center">{{ $e->views }}</td>
													<td class="text-center">{{ $e->likes }}</td>
													<td class="text-center"><a href="#">{{ $e->category->name }}</a></td>
													@if(auth()->user()->privilegeChecker('view_restricted_roles'))
													<td class="text-center">{{ $e->user->name }} {{ $e->user->last_name }}</td>
													<td class="text-center">{{ $e->user->email }}</td>
													@endif
													<td class="text-center text-capitalize"><b class="course_active">{{ $e->status }}</b></td>
													<td class="text-center">
                                                        <a href="/view_course/{{ $e->unique_id }}" title="View" class="gray-s"><i class="uil uil-adjust"></i></a>
														<a href="/edit-course/{{ $e->unique_id }}" title="Edit" class="cursor-pointer gray-s"><i class="uil uil-edit-alt"></i></a>
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
							</div>
						</div>
					</div>
				</div>
            </div>
            @include('layouts.footer')
        </div>
        <div class="modal zoomInUp " id="delete_course_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content"  style="background-color: #333 !important;">
                    <div class="modal-header">
                        <h4>Delete Course?</h4>
                    </div>
                    <form class="delete_course_form">
                        @csrf
                        <div class="modal-body">
                            <p class="text-danger">By clicking continue, this course will be deleted permanently. <br> It can't be recovered after this.</p>
                        </div>
                    </form>
                    <div class="modal-footer no-border">
                        <div class="text-right">
                            <button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary btn-sm delete_course_btn" data-dismiss="modal">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Body End -->

        @include('layouts.e_script')

        <script>
            $(document).ready(function () {
                $('.delete_course_modal').click(function(e) {
                    e.preventDefault();
                    append_id('delete_course_id', '.delete_course_form', '#delete_course_modal', this)
                    $('#delete_course_modal').modal('toggle');
                });


            // $('.delete_course_btn').click(async function(e) {
            //     e.preventDefault();
            //     let delete_course_form = $('.delete_course_form').serializeArray();
            //     let form_data = set_form_data(delete_course_form);
            //     let returned = await ajaxRequest('/delete-course/'+delete_course_form[1].value, form_data);
            //     // return;
            //     validator(returned, '/view-courses');
            // });

            });
        </script>
