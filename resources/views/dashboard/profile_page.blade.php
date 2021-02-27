@php
	$pageTitle = 'Profile Page';
	$profile = 'active';
@endphp
@include('layouts.head')

<body>
    <!-- Header Start -->
    @include('layouts.header')
    <!-- Header End -->

    <!-- Left Sidebar Start -->
    @include('layouts.sidebar')
    <!-- Left Sidebar End -->

    @php $link = auth()->user()->returnLink() @endphp

	<!-- Body Start -->
	<div class="wrapper _bg4586">
		<div class="_216b01">
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col-md-10">
						<div class="section3125 rpt145">
							<div class="row">
								<div class="col-lg-7">
									<a href="#" class="_216b22">
										<span><i class="uil uil-windsock"></i></span>Report Profile
									</a>
									<div class="dp_dt150">
										<div class="img148">
											<img src="{{asset($link.'/profile/'.$user->profile_image)}}" alt="">
										</div>
										<div class="prfledt1 ">
											<h2 class="text-capitalize">{{ $user->name }} {{ $user->last_name }}</h2>
											<span class="text-capitalize">{{ $user->professonal_heading }}</span>
											<div class="mt-1">
                                                <a href="">https://www.centadesk.com/scl/ref={{ $user->user_referral_id }}
                                                </a>
                                            </div>
                                            <span class="text-capitalize">{{($user->user_type === 'super_admin')?'Super Admin':$user->user_type}}</span>
										</div>
									</div>
									<ul class="_ttl120">
										<li>
											<div class="_ttl121">
												<div class="_ttl122">Enroll Students</div>
												<div class="_ttl123">612K</div>
											</div>
										</li>
										<li>
											<div class="_ttl121">
												<div class="_ttl122">Courses</div>
												<div class="_ttl123">{{ count($user->courses) }}</div>
											</div>
										</li>
										<li>
											<div class="_ttl121">
												<div class="_ttl122">Reviews</div>
												<div class="_ttl123">115K</div>
											</div>
										</li>
										<li>
											<div class="_ttl121">
												<div class="_ttl122">Subscribers</div>
												<div class="_ttl123">{{count($user->subscribe)}}</div>
											</div>
										</li>
									</ul>
								</div>
								<div class="col-lg-5">
									{{-- <a href="#" class="_216b12">
										<span><i class="uil uil-windsock"></i></span>Report Profile
									</a> --}}
									<div class="rgt-145">
										<ul class="tutor_social_links">
											<li><a href="https://facebook.com/{{ $user->facebook }}" class="fb"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="https://twitter.com/{{ $user->twitter }}" class="tw"><i class="fab fa-twitter"></i></a></li>
											<li><a href="https://www.linkedin.com/{{ $user->linkedin }}" class="ln"><i class="fab fa-linkedin-in"></i></a></li>
											<li><a href="https://www.youtube.com/{{ $user->youtube }}" class="yu"><i class="fab fa-youtube"></i></a></li>
										</ul>
									</div>
									<ul class="_bty149">
                                        <li>
                                            <button class="subscribe-btn btn500" onclick="subscribeTOTeacher(this, '{{auth()->user()->unique_id}}', '{{$user->unique_id}}')">Subscribe</button>
                                        </li>
										<li><button class="msg125 btn500">Message</button></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="_215b15">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="course_tabs">
							<nav>
								<div class="nav nav-tabs tab_crse" id="nav-tab" role="tablist">
									<a class="nav-item nav-link active" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-selected="true">About</a>
									<a class="nav-item nav-link" id="nav-courses-tab" data-toggle="tab" href="#nav-courses" role="tab" aria-selected="false">Courses</a>
									<a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews" role="tab" aria-selected="false">Discussion</a>
                                    <a class="nav-item nav-link" id="nav-subscriptions-tab" data-toggle="tab" href="#nav-subscriptions" role="tab" aria-selected="false">Subscriptions</a>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="_215b17">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="course_tab_content">
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-about" role="tabpanel">
									<div class="_htg451">
										<div class="_htg452">
											<h3>About Me</h3>
											<p>{{ $user->description }}</p>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="nav-courses" role="tabpanel">
									<div class="crse_content">
										<h3>My courses ({{ count($user->courses) }})</h3>
										<div class="_14d25">
											<div class="row">
                                                @foreach ($user->courses as $e)
												<div class="col-lg-3 col-md-4">
													<div class="fcrse_1 mt-30">
														<a href="{{route('view_course', $e->unique_id )}}" class="fcrse_img">
															<img src="{{asset($link.'/course-img/'.$e->cover_image)}}" width="218.5px" height="122.91">
															<div class="course-overlay">
																<div class="badge_seller">Bestseller</div>
																<div class="crse_reviews">
																	<i class="uil uil-star"></i>4.5
																</div>
																<span class="play_btn1"><i class="uil uil-play"></i></span>
																<div class="crse_timer">
																	25 hours
																</div>
															</div>
														</a>
														<div class="fcrse_content">
															<div class="eps_dots more_dropdown">
																<a href="#"><i class="uil uil-ellipsis-v"></i></a>
																<div class="dropdown-content">
                                                                    <span onclick="saveCourse('{{$e->unique_id}}', '{{auth()->user()->unique_id}}') "><i class="uil uil-heart"></i>Save</span>
																</div>
															</div>
															<div class="vdtodt">
																<span class="vdt14">{{$e->views}} views</span>&nbsp;
																<span class="vdt14">{{$e->created_at->diffForHumans()}}</span>
															</div>
															<a href="{{route('view_course', $e->unique_id )}}" class="crse14s">{{ $e->name}}</a>
                                                            <a href="javascript:;" class="crse-cate">{{$e->category->name}}</a>
															<div class="auth1lnkprce">
																<p class="cr1fot text-capitalize">By <a href="#">{{ $e->user->name }} {{ $e->user->last_name }}</a></p>
																<div class="prce142">{{auth()->user()->getAmountForView($e->price->amount)['data']['currency'] }} {{number_format(auth()->user()->getAmountForView($e->price->amount)['data']['amount'])}}</div>
																<button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
															</div>
														</div>
													</div>
												</div>
                                                @endforeach
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="nav-reviews" role="tabpanel">
									<div class="student_reviews">
										<div class="row">
											<div class="col-lg-12">
												<div class="review_right">
													<div class="review_right_heading">
														<h3>Discussions</h3>
													</div>
												</div>
												<div class="cmmnt_1526">
													<div class="cmnt_group">
														<div class="img160">
															<img src="images/left-imgs/img-1.jpg" alt="">
														</div>
														<textarea class="_cmnt001" placeholder="Add a public comment"></textarea>
													</div>
													<button class="cmnt-btn" type="submit">Comment</button>
												</div>
												<div class="review_all120">
													<div class="review_item">
														<div class="review_usr_dt">
															<img src="images/left-imgs/img-1.jpg" alt="">
															<div class="rv1458">
																<h4 class="tutor_name1">John Doe</h4>
																<span class="time_145">2 hour ago</span>
															</div>
															<div class="eps_dots more_dropdown">
																<a href="#"><i class="uil uil-ellipsis-v"></i></a>
																<div class="dropdown-content">
																	<span><i class='uil uil-comment-alt-edit'></i>Edit</span>
																	<span><i class='uil uil-trash-alt'></i>Delete</span>
																</div>
															</div>
														</div>
														<p class="rvds10">Nam gravida elit a velit rutrum, eget dapibus ex elementum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce lacinia, nunc sit amet tincidunt venenatis.</p>
														<div class="rpt101">
															<a href="#" class="report155"><i class='uil uil-thumbs-up'></i> 10</a>
															<a href="#" class="report155"><i class='uil uil-thumbs-down'></i> 1</a>
															<a href="#" class="report155"><i class='uil uil-heart'></i></a>
															<a href="#" class="report155 ml-3">Reply</a>
														</div>
													</div>
													<div class="review_reply">
														<div class="review_item">
															<div class="review_usr_dt">
																<img src="images/left-imgs/img-3.jpg" alt="">
																<div class="rv1458">
																	<h4 class="tutor_name1">Rock Doe</h4>
																	<span class="time_145">1 hour ago</span>
																</div>
																<div class="eps_dots more_dropdown">
																	<a href="#"><i class="uil uil-ellipsis-v"></i></a>
																	<div class="dropdown-content">
																		<span><i class='uil uil-trash-alt'></i>Delete</span>
																	</div>
																</div>
															</div>
															<p class="rvds10">Fusce lacinia, nunc sit amet tincidunt venenatis.</p>
															<div class="rpt101">
																<a href="#" class="report155"><i class='uil uil-thumbs-up'></i> 4</a>
																<a href="#" class="report155"><i class='uil uil-thumbs-down'></i> 2</a>
																<a href="#" class="report155"><i class='uil uil-heart'></i></a>
																<a href="#" class="report155 ml-3">Reply</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
                                <div class="tab-pane fade show" id="nav-subscriptions" role="tabpanel">
                                    <div class="_htg451">
                                        <div class="_htg452">
                                            <h3>Subscriptions</h3>
                                            <div class="row">
                                                @if(count($user->subscribe) > 0)
                                                    @foreach($user->subscribe  as $each_subscribe)
                                                        @if($user->unique_id === auth()->user()->unique_id)
                                                            @continue
                                                        @endif
                                                     <div class="col-lg-3 col-md-4">
                                                    <div class="fcrse_1 mt-30">
                                                        <div class="tutor_img">
                                                            <a href="#"><img src="{{asset($link.'/profile/'.$each_subscribe->users->profile_image)}}" alt=""></a>
                                                        </div>
                                                        <div class="tutor_content_dt">
                                                            <div class="tutor150">
                                                                <a href="{{route('view_profile', $each_subscribe->users->unique_id )}}" class="tutor_name">{{ucfirst($each_subscribe->users->name)}} {{ucfirst($each_subscribe->users->last_name)}}</a>
                                                                <div class="mef78" title="Verify">
                                                                    <i class="uil uil-check-circle"></i>
                                                                </div>
                                                            </div>
                                                            @if($each_subscribe->users->user_type === 'teacher' || $each_subscribe->users->user_type === 'super_admin')
                                                                <div class="tutor_cate">{{$each_subscribe->users->professonal_heading}}</div>
                                                                <ul class="tutor_social_links">
                                                                    <li> <button class="sbbc145" onclick="subscribeTOTeacher(this, '{{auth()->user()->unique_id}}', '{{$each_subscribe->users->unique_id}}')">Subscribe</button></li>
                                                                </ul>
                                                                <div class="tut1250">
                                                                    <span class="vdt15">100K Students</span>
                                                                    <span class="vdt15">{{$each_subscribe->course_count}} Courses</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
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


        $('.delete_course_btn').click(async function(e) {
            e.preventDefault();
            let delete_course_form = $('.delete_course_form').serializeArray();
            let form_data = set_form_data(delete_course_form);
            let returned = await ajaxRequest('/delete-course/'+delete_course_form[1].value, form_data);
            console.log(returned);
            // return;
            validator(returned, '/view-courses');
        });

        });
    </script>
