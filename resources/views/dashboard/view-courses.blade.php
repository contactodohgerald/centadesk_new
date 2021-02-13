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
														<a href="/edit-course/{{ $e->unique_id }}" title="Edit" class="cursor-pointer gray-s"><i class="uil uil-edit-alt"></i></a>
														<a id="{{ $e->unique_id }}" title="Delete" class="cursor-pointer gray-s delete_user_modal"><i class="uil uil-trash-alt"></i></a>
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

            <div class="modal fade zoomInUp" id="delete_user_modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Delete Withdrawal?</h4>
                        </div>
                        <form class="delete_user_form">
                            <div class="modal-body">
                                <p class="text-danger">By clicking continue, this account will be deleted permanently. <br> It can't be recovered after this.</p>
                            </div>
                        </form>
                        <div class="modal-footer no-border">
                            <div class="text-right">
                                <button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary btn-sm delete_user_btn" data-dismiss="modal">Continue</button>
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
                $('.delete_user_modal').click(function(e) {
                    e.preventDefault();
                    append_id('delete_user_id', '.delete_user_form', '#delete_user_modal', this)
                    $('#delete_user_modal').modal('toggle');
                });

            });
        </script>
