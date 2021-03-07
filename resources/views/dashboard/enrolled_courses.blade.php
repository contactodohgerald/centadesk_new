@php
$users = auth()->user();
	$pageTitle = 'Enrolled Courses';
	$enrolledCourse = 'active';
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
	<div class="wrapper">
    <div class="sa4d25">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-md-4 ">
						<div class="section3125 hstry142">
							<div class="grp_titles pt-0">
								<div class="ht_title font-poppins">2 Courses</div>
								{{-- <a href="#" class="ht_clr">Remove All</a> --}}
							</div>
							<div class="tb_145">
								<div class="wtch125">
									{{-- <span class="vdt14">{{count($courses)}} Courses</span> --}}
								</div>
								<a href="javascript:;" class="rmv-btn font-poppins" onclick="deleteSavedCourse(this, 'all')"><i class='uil uil-trash-alt'></i>Remove All Enrolled Courses</a>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="_14d25 mb-20">
							<div class="row">
								<div class="col-md-12">
                                    <h4 class="mhs_title font-poppins">Courses i enrolled in</h4>
                                    @if(count($courses) > 0)
                                        @foreach($courses  as $k => $e)
                                        <div class="fcrse_1 mt-30">
                                            <a href="{{route('view_course', $e->unique_id )}}" class="hf_img">
                                                <img src="{{asset($link.'course-img/'.$e->cover_image)}}" alt="{{env('APP_NAME')}}"  height="180">
                                                <div class="course-overlay">
<!--                                                    <div class="badge_seller">Bestseller</div>-->
                                                    <div class="crse_reviews">
                                                        <i class="uil uil-star"></i>{{$e->count_review}}34
                                                    </div>

                                                    <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                    <div class="crse_timer font-poppins">
                                                    {{$e->created_at->diffForHumans()}}
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="hs_content">
                                                <div class="eps_dots eps_dots10 more_dropdown">
                                                    <a href="javascript:;"><i class="uil uil-ellipsis-v"></i></a>
                                                    <div class="dropdown-content">
                                                        <span onclick="deleteSavedCourse(this, 'single')"><i class='uil uil-times'></i>Remove</span>
                                                    </div>
                                                </div>
                                                <div class="vdtodt">
                                                    <span class="vdt14">{{$e->views}} views</span>
                                                    <span class="vdt14">{{$e->created_at->diffForHumans()}}</span>
                                                </div>
                                                <input type="hidden" class="saved_course_id" value="{{$e->unique_id}}">
                                                <input type="hidden" class="user_unique_id" value="{{auth()->user()->unique_id}}">
                                                <a href="{{route('view_course', $e->unique_id )}}" class="crse14s title900 font-poppins"><b>{{$e->name}}</b></a>
                                                <a href="{{route('view_course', $e->unique_id )}}" class="crse-cate font-poppins">{{$e->short_caption}}</a>
                                                <div class="auth1lnkprce">
                                                    <p class="cr1fot">By <a href="{{route('view_profile', $e->user->unique_id )}}">{{$e->user->name}} {{$e->user->last_name}}</a></p>
                                                    <div class="prce142 font-poppins">{{auth()->user()->getAmountForView($e->price->amount)['data']['currency'] }}  {{number_format(auth()->user()->getAmountForView($e->price->amount)['data']['amount'])}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="fcrse_1 mt-30">
                                        <div class="alert alert-success text-center">You haven't enrolled for any course, Browse through our Courses & add to your Enrolled Library</div>
                                    </div>
                                    @endif
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
