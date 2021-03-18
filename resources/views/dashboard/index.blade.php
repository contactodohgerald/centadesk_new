@php
$users = auth()->user();
$pageTitle = 'Home Area';
$home = 'active';
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
                    @if(auth()->user()->cac_verification_status === 'no' && auth()->user()->user_type === 'teacher')
                    <div class="col-xl-6 col-lg-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-envelope-o mr-2"></i>
                            Please upload a means of identification for KYC verification
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                    @endif
                    {{-- @if(auth()->user()->yearly_subscription_status === 'no' && auth()->user()->user_type === 'student')
                        <div class="col-xl-7 col-lg-7">
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <i class="fa fa-envelope mr-2"></i>
                                With a subscription, you'll always have the latest features, fixes, and security updates along with ongoing tech support at no extra cost.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div class="cmtk_dt">
                                <ul class="clock block clearfix">
                                    <li>
                                        <span class="remaining-days" id="days">00</span>
                                        <label>Days</label>
                                    </li>
                                    <li class="sep">:</li>
                                    <li>
                                        <span class="remaining-hours" id="hours">00</span>
                                        <label>hours</label>
                                    </li>
                                    <li class="sep">:</li>
                                    <li>
                                        <span class="remaining-minutes" id="minutes">00</span>
                                        <label>minutes</label>
                                    </li>
                                    <li class="sep">:</li>
                                    <li>
                                        <span class="remaining-seconds" id="seconds">00</span>
                                        <label>seconds</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif--}}
                    <div class="col-xl-12 col-lg-12 mb-30">

                        <div class="section3126">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="value_props">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                <div class="value_icon mt-20">
                                                    <i class='uil uil-history'></i>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-8 col-md-8">
                                                <div class="value_content">
                                                    <h3 class="font-poppins">$ 0.00</h3>
                                                    <p class="font-poppins">Wallet Balance</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="value_props">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                <div class="value_icon mt-20">
                                                    <i class='uil uil-history'></i>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-8 col-md-8">
                                                <div class="value_content">
                                                    <h3 class="font-poppins">$ 0.00</h3>
                                                    <p class="font-poppins">Total Earnings</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="value_props">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                <div class="value_icon mt-20">
                                                    <i class='uil uil-history'></i>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-8 col-md-8">
                                                <div class="value_content">
                                                    <h3 class="font-poppins">$ 0.00</h3>
                                                    <p class="font-poppins">Total Withdrawals</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="value_props">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                <div class="value_icon mt-20">
                                                    <i class='uil uil-history'></i>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-8 col-md-8">
                                                <div class="value_content">
                                                    <h3 class="font-poppins">$ 0.00</h3>
                                                    <p class="font-poppins">Wallet Balance</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="value_props">
                                        <div class="value_icon">
                                            <i class='uil uil-user-check'></i>
                                        </div>
                                        <div class="value_content">
                                            <h4>Learn from industry experts</h4>
                                            <p>Select from top instructors around the world</p>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="value_props">
                                        <div class="value_icon">
                                            <i class='uil uil-play-circle'></i>
                                        </div>
                                        <div class="value_content">
                                            <h4>Find video courses on almost any topic</h4>
                                            <p>Build your library for your career and personal growth</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="value_props">
                                        <div class="value_icon">
                                            <i class='uil uil-presentation-play'></i>
                                        </div>
                                        <div class="value_content">
                                            <h4>100,000 online courses</h4>
                                            <p>Explore a variety of fresh topics</p>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">

                        <div class="section3125">
                            <h3 class="item_title font-poppins">Live Streams </h3>
                            <a href="/explore/live_streams" class="see150 font-poppins">See all</a>
                            <div class="la5lo1">
                                <div class="owl-carousel live_stream owl-theme">
                                    @foreach ($live_streams as $e)
                                    <div class="item">
                                        <div class="stream_1">
                                            <a href="{{ route('stream_details',['id'=>$e->unique_id]) }}" class="stream_bg">
                                                <img src="/storage/profile/{{ $e->user->profile_image }}" alt="">
                                                <h4 class="font-poppins">{{ $e->user->name }} {{ $e->user->last_name }}</h4>
                                                {{-- <p class="font-poppins text-capitalize clamp">{{ $e->title }}</p> --}}
                                                <p class="font-poppins stream_bg_p">Live<span></span></p>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- <div class="section3125 mt-50">
                            <h4 class="item_title">Featured Courses</h4>
                            <a href="{{route('explore')}}" class="see150">See all</a>
                        <div class="la5lo1">
                            @if(count($course) > 0)
                            <div class="owl-carousel featured_courses owl-theme">
                                @foreach($course as $key => $each_course)
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <a href="{{route('view_course', $each_course->unique_id )}}" class="fcrse_img">
                                            <img src="{{asset($link.'course-img/'.$each_course->cover_image)}}" alt="{{env('APP_NAME')}}">
                                            <div class="course-overlay">
                                                <!--                                                            <div class="badge_seller">Bestseller</div>-->
                                                <div class="crse_reviews">
                                                    <i class='uil uil-star'></i>{{$each_course->count_review}}
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer">
                                                    25 hours
                                                </div>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class='uil uil-ellipsis-v'></i></a>
                                                <div class="dropdown-content">
                                                    <span onclick="saveCourse('{{$each_course->unique_id}}', '{{auth()->user()->unique_id}}') "><i class="uil uil-heart"></i>Save</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">{{$each_course->views}} views</span>
                                                <span class="vdt14">{{$each_course->created_at->diffForHumans()}}</span>
                                            </div>
                                            <a href="{{route('view_course', $each_course->unique_id )}}" class="crse14s">{{$each_course->name}}3</a>
                                            <a href="javascript:;" class="crse-cate font-poppins">{{$each_course->category->name}}</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot">By <a href="{{route('view_profile', $each_course->user->unique_id )}}">{{$each_course->user->name}} {{$each_course->user->last_name}}</a></p>
                                                <div class="prce142">{{auth()->user()->getAmountForView($each_course->price->amount)['data']['currency'] }} {{number_format(auth()->user()->getAmountForView($each_course->price->amount)['data']['amount'])}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div> --}}
                    <div class="section3125 mt-30">
                        <h4 class="item_title font-poppins">Newest Courses</h4>
                        <a href="{{route('explore')}}" class="see150 font-poppins">See all</a>
                        <div class="la5lo1">
                            @if(count($course) > 0)
                            <div class="owl-carousel featured_courses owl-theme">
                                @foreach($course as $key => $each_course)
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <a href="{{route('view_course', $each_course->unique_id )}}" class="fcrse_img">
                                            <img src="{{asset($link.'course-img/'.$each_course->cover_image)}}" alt="{{env('APP_NAME')}}">
                                            <div class="course-overlay">
                                                <!--                                                            <div class="badge_seller">Bestseller</div>-->
                                                <div class="crse_reviews">
                                                    <i class='uil uil-star'></i>{{$each_course->count_review}}
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer font-poppins">
                                                    25 hours
                                                </div>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class='uil uil-ellipsis-v'></i></a>
                                                <div class="dropdown-content">
                                                    <span onclick="saveCourse('{{$each_course->unique_id}}', '{{auth()->user()->unique_id}}') "><i class="uil uil-heart"></i>Save</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">{{$each_course->views}} views</span>
                                                <span class="vdt14">{{$each_course->created_at->diffForHumans()}}</span>
                                            </div>
                                            <a href="{{route('view_course', $each_course->unique_id )}}" class="crse14s font-poppins">{{$each_course->name}}3</a>
                                            <a href="javascript:;" class="crse-cate font-poppins">{{$each_course->category->name}}</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot text-capitalize">By <a href="{{route('view_profile', $each_course->user->unique_id )}}">{{$each_course->user->name}} {{$each_course->user->last_name}}</a></p>
                                                <div class="prce142 font-poppins">{{auth()->user()->getAmountForView($each_course->price->amount)['data']['currency'] }} {{number_format(auth()->user()->getAmountForView($each_course->price->amount)['data']['amount'])}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="section3125 mt-50">
                        <h4 class="item_title font-poppins">Popular Instructors</h4>
                        <a href="{{route('browse_instructor')}}" class="see150 font-poppins">See all</a>
                        <div class="la5lo1">
                            @if(count($instructors) > 0)
                            <div class="owl-carousel top_instrutors owl-theme">
                                @foreach($instructors as $ke => $each_instructors)
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <div class="tutor_img">
                                            <a href="{{route('view_profile', $each_instructors->unique_id )}}">
                                                <img src="{{asset(auth()->user()->returnLink().'/profile/'.$each_instructors->profile_image)}}" alt="{{env('APP_NAME')}}">
                                            </a>
                                        </div>
                                        <div class="tutor_content_dt">
                                            <div class="tutor150">
                                                <a href="{{route('view_profile', $each_instructors->unique_id )}}" class="tutor_name font-poppins text-capitalize">{{$each_instructors->name}} {{$each_instructors->last_name}}</a>
                                                <div class="mef78" title="Verify">
                                                    <i class="uil uil-check-circle"></i>
                                                </div>
                                            </div>
                                            <div class="tutor_cate font-poppins text-capitalize">{{ $each_instructors->professonal_heading }}
                                                @if ($each_instructors->professonal_heading)
                                                    |
                                                @endif
                                                {{($each_instructors->user_type === 'super_admin')?'Super Admin':$each_instructors->user_type}}</span></div>
                                            <ul class="tutor_social_links">
                                                <li><a href="https://facebook.com/{{ $each_instructors->facebook }}" class="fb"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="https://twitter.com/{{ $each_instructors->twitter }}" class="tw"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="https://www.linkedin.com/{{ $each_instructors->linkedin }}" class="ln"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="https://www.youtube.com/{{ $each_instructors->youtube }}" class="yu"><i class="fab fa-youtube"></i></a></li>
                                            </ul>
                                            <div class="tut1250">
                                                <span class="vdt15">{{$each_instructors->enrolled_users}} Students</span>
                                                <span class="vdt15">{{$each_instructors->count_course}} Courses</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="right_side">
                        <div class="fcrse_2 mb-30">
                            <div class="tutor_img">
                                <a href="{{ route('profile')}}"><img src="{{asset($link.'/profile/'.$user->profile_image)}}" alt=""></a>
                            </div>
                            <div class="tutor_content_dt">
                                <div class="tutor150">
                                    <a href="{{ route('profile')}}" class="tutor_name font-poppins">{{ $users->name }} {{ $users->last_name }}</a>
                                    <div class="mef78" title="Verify">
                                        <i class="uil uil-check-circle"></i>
                                    </div>
                                </div>
                                <div class="tutor_cate text-capitalize font-poppins">{{ $user->professonal_heading }}
                                    @if ($user->professonal_heading)
                                        |
                                    @endif
                                    {{($user->user_type === 'super_admin')?'Super Admin':$user->user_type}}</span></div>
                                <ul class="tutor_social_links">
                                    <li><a href="https://facebook.com/{{ $user->facebook }}" class="fb"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://twitter.com/{{ $user->twitter }}" class="tw"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.linkedin.com/{{ $user->linkedin }}" class="ln"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="https://www.youtube.com/{{ $user->youtube }}" class="yu"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                                <div class="tut1250">
                                    <span class="vdt15 font-poppins">615K Students</span>
                                    <span class="vdt15 font-poppins">12 Courses</span>
                                </div>
                                <a href="{{ route('profile')}}" class="prfle12link font-poppins">Go To Profile</a>
                            </div>
                        </div>
                        <div class="fcrse_3">
                            <div class="cater_ttle">
                                <h4 class="font-poppins">Live Streaming</h4>
                            </div>
                            <div class="live_text">
                                <div class="live_icon"><i class="uil uil-kayak"></i></div>
                                <div class="live-content">
                                    <p class="font-poppins">Set up your channel and stream live to your students</p>
                                    <button class="live_link" onclick="window.location.href = '{{ route('create-course') }}';">Get Started</button>
                                    <span class="livinfo font-poppins">Info : This feature only for 'Instructors'.</span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="fcrse_3">
                            <div class="cater_ttle">
                                <h4>Top Categories</h4>
                            </div>
                            <ul class="allcate15">
                                <li><a href="#" class="ct_item"><i class='uil uil-arrow'></i>Development</a></li>
                                <li><a href="#" class="ct_item"><i class='uil uil-graph-bar'></i>Business</a></li>
                                <li><a href="#" class="ct_item"><i class='uil uil-monitor'></i>IT and Software</a></li>
                                <li><a href="#" class="ct_item"><i class='uil uil-ruler'></i>Design</a></li>
                                <li><a href="#" class="ct_item"><i class='uil uil-chart-line'></i>Marketing</a></li>
                                <li><a href="#" class="ct_item"><i class='uil uil-book-open'></i>Personal Development</a></li>
                                <li><a href="#" class="ct_item"><i class='uil uil-camera'></i>Photography</a></li>
                                <li><a href="#" class="ct_item"><i class='uil uil-music'></i>Music</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                {{-- <div class="col-xl-12 col-lg-12">
                        <div class="section3125 mt-30">
                            <h4 class="item_title">What Our Student Have Today</h4>
                            <div class="la5lo1">
                                <div class="owl-carousel Student_says owl-theme">
                                    <div class="item">
                                        <div class="fcrse_4 mb-20">
                                            <div class="say_content">
                                                <p>"Donec ac ex eu arcu euismod feugiat. In venenatis bibendum nisi, in placerat eros ultricies vitae. Praesent pellentesque blandit scelerisque. Suspendisse potenti."</p>
                                            </div>
                                            <div class="st_group">
                                                <div class="stud_img">
                                                    <img src="images/left-imgs/img-4.jpg" alt="">
                                                </div>
                                                <h4>Jassica William</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="fcrse_4 mb-20">
                                            <div class="say_content">
                                                <p>"Cras id enim lectus. Fusce at arcu tincidunt, iaculis libero quis, vulputate mauris. Morbi facilisis vitae ligula id aliquam. Nunc consectetur malesuada bibendum."</p>
                                            </div>
                                            <div class="st_group">
                                                <div class="stud_img">
                                                    <img src="images/left-imgs/img-1.jpg" alt="">
                                                </div>
                                                <h4>Rock Smith</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="fcrse_4 mb-20">
                                            <div class="say_content">
                                                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos eros ac, sagittis orci."</p>
                                            </div>
                                            <div class="st_group">
                                                <div class="stud_img">
                                                    <img src="images/left-imgs/img-7.jpg" alt="">
                                                </div>
                                                <h4>Luoci Marchant</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="fcrse_4 mb-20">
                                            <div class="say_content">
                                                <p>"Nulla bibendum lectus pharetra, tempus eros ac, sagittis orci. Suspendisse posuere dolor neque, at finibus mauris lobortis in. Pellentesque vitae laoreet tortor."</p>
                                            </div>
                                            <div class="st_group">
                                                <div class="stud_img">
                                                    <img src="images/left-imgs/img-6.jpg" alt="">
                                                </div>
                                                <h4>Poonam Sharma</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="fcrse_4 mb-20">
                                            <div class="say_content">
                                                <p>"Curabitur placerat justo ac mauris condimentum ultricies. In magna tellus, eleifend et volutpat id, sagittis vitae est. Pellentesque vitae laoreet tortor."</p>
                                            </div>
                                            <div class="st_group">
                                                <div class="stud_img">
                                                    <img src="images/left-imgs/img-3.jpg" alt="">
                                                </div>
                                                <h4>Davinder Singh</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
            </div>
        </div>
    </div>

    @include('layouts.footer')
    </div>
    <!-- Body End -->

    @include('layouts.e_script')
