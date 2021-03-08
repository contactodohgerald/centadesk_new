@php
    $current_page = 'Index';
    $index = 'active';
 @endphp
@include('includes.head')

@include('includes.header')

<section class="bg-img pt-200 pb-120" data-overlay="7" style="background-image: url({{asset('front-end/images/front-end-img/banners/banner-1.jpg')}}); background-position: top center;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center mt-80">
                    <h1 class="box-title text-white mb-30">Find Your Online Course</h1>
                </div>
                <form class="cours-search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="What do you want to learn today?">
                        <div class="input-group-append">
                            <button class="btn btn-block btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
                <div class="text-center">
                    <a href="{{route('list-courses')}}" class="btn btn-outline text-white">Browse Courses List</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-50 bg-white" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12 text-center">
                <h1 class="mb-15">Explore our Courses</h1>
                <hr class="w-100 bg-primary">
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-12">
                @if(count($course_category_model) > 0)
                    <ul class="nav nav-tabs justify-content-center bb-0 mb-10" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#all" role="tab">All</a> </li>
                        @foreach($course_category_model as $key => $each_category)
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab{{$key}}" role="tab">{{ucfirst($each_category->name)}}</a> </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="all" role="tabpanel">
                            <div class="px-15 pt-15">
                                @if(count($course) > 0)
                                    <div class="row">
                                        @foreach($course as $kk => $each_course)
                                            @if($kk == 13)
                                                @break
                                            @endif
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <div class="box">
                                                    <a href="{{route('course-details', $each_course->unique_id)}}">
                                                        <img class="card-img-top" src="{{asset('storage/course-img/'.$each_course->cover_image)}}" alt="{{env('APP_NAME')}}" width="100%" height="200px">
                                                    </a>
                                                    <div class="box-body">
                                                        <div class="text-left">
                                                            <h4 class="box-title">{{ucfirst($each_course->name)}}</h4>
                                                            <p class="mb-10 text-light font-size-12"><i class="fa fa-calendar mr-5"></i>{{$each_course->	created_at->diffForHumans()}}</p>
                                                            <p class="box-text">{{ucfirst($each_course->short_caption)}}</p>
                                                            <a href="{{route('course-details', $each_course->unique_id)}}" class="btn btn-outline btn-primary btn-sm">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        @foreach($course_category_model as $key => $each_category)
                            <div class="tab-pane" id="tab{{$key}}" role="tabpanel">
                                <div class="px-15 pt-15">
                                    @if(count($course) > 0)
                                        <div class="row">
                                            @foreach($course as $kk => $each_course)
                                                @if($each_course->category_id == $each_category->unique_id)
                                                    @if($kk == 13)
                                                        @break
                                                    @endif
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="box">
                                                            <a href="{{route('course-details', $each_course->unique_id)}}">
                                                                <img class="card-img-top" src="{{asset('storage/course-img/'.$each_course->cover_image)}}" alt="{{env('APP_NAME')}}" width="100%" height="200px">
                                                            </a>
                                                            <div class="box-body">
                                                                <div class="text-left">
                                                                    <h4 class="box-title">{{ucfirst($each_course->name)}}</h4>
                                                                    <p class="mb-10 text-light font-size-12"><i class="fa fa-calendar mr-5"></i>{{$each_course->	created_at->diffForHumans()}}</p>
                                                                    <p class="box-text">{{ucfirst($each_course->short_caption)}}</p>
                                                                    <a href="{{route('course-details', $each_course->unique_id)}}" class="btn btn-outline btn-primary btn-sm">View</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="pt-xl-100 pb-50" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-12">
                <div class="box box-body p-xl-50 p-30">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-12">
                            <p class="badge badge-warning badge-lg">FREE</p>
                            <h1 class="mb-15">Live Classes</h1>
                            <h4 class="font-weight-400">It is a long established fact that a reade.</h4>
                            <p class="font-size-22">Experience Plus for free and start<br> learning from the best</p>
                            <a href="#" class="btn btn-outline btn-primary">See all</a>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="media-list media-list-hover media-list-divided md-post mt-lg-0 mt-30">
                                <a class="media media-single box-shadowed bg-white pull-up mb-15" href="#">
                                    <img class="w-80 rounded ml-0" src="../images/front-end-img/avatar/1.jpg" alt="...">
                                    <div class="media-body font-weight-500">
                                        <h5 class="overflow-hidden text-overflow-h nowrap">Basic English for IBPS SO/ IBPS PO/IBPS Clerk exams | 5 PM</h5>
                                        <small class="text-fade">Today, 5:00 PM</small>
                                        <p><small class="text-fade mt-10">Johen doe</small></p>
                                    </div>
                                </a>
                                <a class="media media-single box-shadowed bg-white pull-up mb-15" href="#">
                                    <img class="w-80 rounded ml-0" src="../images/front-end-img/avatar/2.jpg" alt="...">
                                    <div class="media-body font-weight-500">
                                        <h5 class="overflow-hidden text-overflow-h nowrap">Basic English for IBPS SO/ IBPS PO/IBPS Clerk exams | 5 PM</h5>
                                        <small class="text-fade">Today, 5:00 PM</small>
                                        <p><small class="text-fade mt-10">Johen doe</small></p>
                                    </div>
                                </a>
                                <a class="media media-single box-shadowed bg-white pull-up mb-15" href="#">
                                    <img class="w-80 rounded ml-0" src="../images/front-end-img/avatar/3.jpg" alt="...">
                                    <div class="media-body font-weight-500">
                                        <h5 class="overflow-hidden text-overflow-h nowrap">Basic English for IBPS SO/ IBPS PO/IBPS Clerk exams | 5 PM</h5>
                                        <small class="text-fade">Today, 5:00 PM</small>
                                        <p><small class="text-fade mt-10">Johen doe</small></p>
                                    </div>
                                </a>
                                <a class="media media-single box-shadowed bg-white pull-up mb-0" href="#">
                                    <img class="w-80 rounded ml-0" src="../images/front-end-img/avatar/4.jpg" alt="...">
                                    <div class="media-body font-weight-500">
                                        <h5 class="overflow-hidden text-overflow-h nowrap">Basic English for IBPS SO/ IBPS PO/IBPS Clerk exams | 5 PM</h5>
                                        <small class="text-fade">Today, 5:00 PM</small>
                                        <p><small class="text-fade mt-10">Johen doe</small></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-50" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12 text-center">
                <h1 class="mb-15">Our top University Partners.</h1>
                <hr class="w-100 bg-primary">
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-12">
                <div class="owl-carousel owl-theme owl-btn-1" data-nav-arrow="false" data-nav-dots="false" data-items="6" data-md-items="4" data-sm-items="3" data-xs-items="2" data-xx-items="2">
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-1.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-2.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-3.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-4.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-5.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-6.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-7.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-8.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-9.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-10.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-11.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                    <div class="item"><img src="{{asset('front-end/images/front-end-img/unilogo/uni-12.jpg')}}" class="img-fluid my-15 rounded box-shadowed pull-up" alt="" ></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-50 bg-white" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12 text-center">
                <h1 class="mb-15">Newest Courses</h1>
                <hr class="w-100 bg-primary">
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-12">
                @if(count($course_category_model) > 0)
                    <ul class="nav nav-tabs justify-content-center bb-0 mb-10" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tabs_all" role="tab">All</a> </li>
                        @foreach($course_category_model as $key => $each_category)
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tabs{{$key}}" role="tab">{{ucfirst($each_category->name)}}</a> </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs_all" role="tabpanel">
                            <div class="px-15 pt-15">
                                @if(count($new_course) > 0)
                                    <div class="row">
                                        @foreach($new_course as $kk => $each_course)
                                            @if($kk == 4)
                                                @break
                                            @endif
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <div class="box">
                                                    <a href="{{route('course-details', $each_course->unique_id)}}">
                                                        <img class="card-img-top" src="{{asset('storage/course-img/'.$each_course->cover_image)}}" alt="{{env('APP_NAME')}}" width="100%" height="200px">
                                                    </a>
                                                    <div class="box-body">
                                                        <div class="text-left">
                                                            <h4 class="box-title">{{ucfirst($each_course->name)}}</h4>
                                                            <p class="mb-10 text-light font-size-12"><i class="fa fa-calendar mr-5"></i>{{$each_course->	created_at->diffForHumans()}}</p>
                                                            <p class="box-text">{{ucfirst($each_course->short_caption)}}</p>
                                                            <a href="{{route('course-details', $each_course->unique_id)}}" class="btn btn-outline btn-primary btn-sm">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        @foreach($course_category_model as $key => $each_category)
                            <div class="tab-pane" id="tabs{{$key}}" role="tabpanel">
                                <div class="px-15 pt-15">
                                    @if(count($new_course) > 0)
                                        <div class="row">
                                            @foreach($new_course as $kk => $each_course)
                                                @if($each_course->category_id == $each_category->unique_id)
                                                    @if($kk == 4)
                                                        @break
                                                    @endif
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="box">
                                                            <a href="{{route('course-details', $each_course->unique_id)}}">
                                                                <img class="card-img-top" src="{{asset('storage/course-img/'.$each_course->cover_image)}}" alt="{{env('APP_NAME')}}" width="100%" height="200px">
                                                            </a>
                                                            <div class="box-body">
                                                                <div class="text-left">
                                                                    <h4 class="box-title">{{ucfirst($each_course->name)}}</h4>
                                                                    <p class="mb-10 text-light font-size-12"><i class="fa fa-calendar mr-5"></i>{{$each_course->	created_at->diffForHumans()}}</p>
                                                                    <p class="box-text">{{ucfirst($each_course->short_caption)}}</p>
                                                                    <a href="{{route('course-details', $each_course->unique_id)}}" class="btn btn-outline btn-primary btn-sm">View</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="py-50" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12 text-center">
                <h1 class="mb-15">Reviews & Ratings</h1>
                <hr class="w-100 bg-primary">
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-md-3 col-12">
                <div class="box pull-up">
                    <div class="box-body">
                        <div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="mr-15">
                                    <img src="{{asset('front-end/images/front-end-img/avatar/1.jpg')}}" class="avatar avatar-lg rounded10" alt="">
                                </div>
                                <div class="d-flex flex-column font-weight-500">
                                    <a href="#" class="text-dark hover-primary mb-1 font-size-16">Johen Kothari</a>
                                    <span class="text-fade font-size-12">Software Engineer</span>
                                </div>
                            </div>
                            <p class="mb-25 min-h-120">A great aspect of this course is the student mentors. These people are always there to help, support, and motivate the student to complete modules...</p>
                            <div class="d-flex align-items-center">
                                <a href="#">
                                    <i class="mr-15 fa fa-linkedin-square"></i>
                                    <span>Detailed Review</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box pull-up">
                    <div class="box-body">
                        <div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="mr-15">
                                    <img src="{{asset('front-end/images/front-end-img/avatar/2.jpg')}}" class="avatar avatar-lg rounded10" alt="">
                                </div>
                                <div class="d-flex flex-column font-weight-500">
                                    <a href="#" class="text-dark hover-primary mb-1 font-size-16">Johen doe</a>
                                    <span class="text-fade font-size-12">Vice President</span>
                                </div>
                            </div>
                            <p class="mb-25 min-h-120">This course actually helped me move from being a general manager to vice president. The content was exciting. I actually implemented what I learnt through case...</p>
                            <div class="d-flex align-items-center">
                                <a href="#">
                                    <i class="mr-15 fa fa-linkedin-square"></i>
                                    <span>Detailed Review</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box pull-up">
                    <div class="box-body">
                        <div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="mr-15">
                                    <img src="{{asset('front-end/images/front-end-img/avatar/3.jpg')}}" class="avatar avatar-lg rounded10" alt="">
                                </div>
                                <div class="d-flex flex-column font-weight-500">
                                    <a href="#" class="text-dark hover-primary mb-1 font-size-16">Anshu Srivastav</a>
                                    <span class="text-fade font-size-12">Research Assistant</span>
                                </div>
                            </div>
                            <p class="mb-25 min-h-120">Group case studies really give a sense of teamwork, as it happens in regular classroom studies. It teaches us coordination and right attitude as a team...</p>
                            <div class="d-flex align-items-center">
                                <a href="#">
                                    <i class="mr-15 fa fa-linkedin-square"></i>
                                    <span>Detailed Review</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box pull-up">
                    <div class="box-body">
                        <div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="mr-15">
                                    <img src="{{asset('front-end/images/front-end-img/avatar/4.jpg')}}" class="avatar avatar-lg rounded10" alt="">
                                </div>
                                <div class="d-flex flex-column font-weight-500">
                                    <a href="#" class="text-dark hover-primary mb-1 font-size-16">Mical Doe</a>
                                    <span class="text-fade font-size-12">Analyst</span>
                                </div>
                            </div>
                            <p class="mb-25 min-h-120">It doesn’t matter what your previous working background is, as everything is taught from the basics.</p>
                            <div class="d-flex align-items-center">
                                <a href="#">
                                    <i class="mr-15 fa fa-linkedin-square"></i>
                                    <span>Detailed Review</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-50 bg-white" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12 text-center">
                <h1 class="mb-15">Our Instructors</h1>
                <hr class="w-100 bg-primary">
            </div>
        </div>
        <div class="row mt-30">
            @if(count($instructors) > 0)
                @foreach($instructors as $j => $each_instructor)
                    @if($j == 5)
                        @break
                    @endif
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="box">
                            <div class="box-header no-border p-0">
                                <a href="{{route('instructor-profile', $each_instructor->unique_id)}}">
                                    <img class="img-fluid" src="{{asset('storage/profile/'.$each_instructor->profile_image)}}" alt="{{env('APP_NAME')}}" width="100%" height="200px">
                                </a>
                            </div>
                            <div class="box-body">
                                <div class="text-center">
                                    <div class="user-contact list-inline text-center">
                                        <a href="https://facebook.com/{{ $each_instructor->facebook }}" target="_blank" class="btn btn-circle mb-5 btn-facebook"><i class="fa fa-facebook"></i></a>
                                        <a href="https://twitter.com/{{ $each_instructor->twitter }}" target="_blank" class="btn btn-circle mb-5 btn-twitter"><i class="fa fa-twitter"></i></a>
                                        <a href="https://www.youtube.com/{{ $each_instructor->youtube }}" target="_blank" class="btn btn-circle mb-5 btn-youtube"><i class="fa fa-youtube"></i></a>
                                        <a href="https://www.linkedin.com/{{ $course->user->linkedin }}" target="_blank" class="btn btn-circle mb-5 btn-linkedin"><i class="fa fa-linkedin"></i></a>
                                    </div>
                                    <h3 class="my-10"><a href="#">{{ucfirst($each_instructor->name)}} {{ucfirst($each_instructor->last_name)}}</a></h3>
                                    <h6 class="user-info mt-0 mb-10 text-fade">{{ucfirst($each_instructor->professonal_heading)}}</h6>
                                    <p class="text-fade w-p85 mx-auto">
                                        <a href="https://centadesk.com/scl/ref={{ $each_instructor->user_referral_id }}">https://centadesk.com/scl/ref={{ $each_instructor->user_referral_id }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="col-12 text-center">
                <a href="{{route('instructors-list')}}" class="btn btn-primary mx-auto">View All Instructors</a>
            </div>
        </div>
    </div>
</section>

<section class="py-50 bg-img countnm-bx" style="background-image: url({{asset('front-end/images/front-end-img/background/bg-3.jpg')}})" data-overlay="5" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="text-center">
                    <div class="w-80 h-80 l-h-100 rounded-circle b-1 border-white text-center mx-auto">
                        <span class="text-white font-size-40 icon-User"><span class="path1"></span><span class="path2"></span></span>
                    </div>
                    <h1 class="countnm my-10 text-white font-weight-300">5428</h1>
                    <div class="text-uppercase text-white">Teachers</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="text-center">
                    <div class="w-80 h-80 l-h-100 rounded-circle b-1 border-white text-center mx-auto">
                        <span class="text-white font-size-40 icon-Book"></span>
                    </div>
                    <h1 class="countnm my-10 text-white font-weight-300">120</h1>
                    <div class="text-uppercase text-white">Courses</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="text-center">
                    <div class="w-80 h-80 l-h-100 rounded-circle b-1 border-white text-center mx-auto">
                        <span class="text-white font-size-40 icon-Group"><span class="path1"></span><span class="path2"></span></span>
                    </div>
                    <h1 class="countnm my-10 text-white font-weight-300">7485</h1>
                    <div class="text-uppercase text-white">Student</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="text-center">
                    <div class="w-80 h-80 l-h-100 rounded-circle b-1 border-white text-center mx-auto">
                        <span class="text-white font-size-40 icon-Globe"><span class="path1"></span><span class="path2"></span></span>
                    </div>
                    <h1 class="countnm my-10 text-white font-weight-300">100</h1>
                    <div class="text-uppercase text-white">Country</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-50" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12 text-center">
                <h1 class="mb-15">Latest Blog</h1>
                <hr class="w-100 bg-primary">
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-xl-4 col-md-4 col-12">
                <div class="blog-post">
                    <div class="entry-image clearfix">
                        <img class="img-fluid" src="{{asset('front-end/images/front-end-img/courses/1f.jpg')}}" alt="">
                    </div>
                    <div class="blog-detail">
                        <div class="entry-title mb-10">
                            <a href="#">Blog Post With Image</a>
                        </div>
                        <div class="entry-meta mb-10">
                            <ul class="list-unstyled">
                                <li><a href="#"><i class="fa fa-folder-open-o"></i> Design</a></li>
                                <li><a href="#"><i class="fa fa-comment-o"></i> 5</a></li>
                                <li><a href="#"><i class="fa fa-calendar-o"></i> 12 Aug 2020</a></li>
                            </ul>
                        </div>
                        <div class="entry-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus fuga laborum totam itaque architecto! Laudantium sed delectus assumenda, doloribus non.</p>
                        </div>
                        <div class="entry-share d-flex justify-content-between align-items-center">
                            <div class="entry-button">
                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            </div>
                            <div class="social">
                                <strong>Share : </strong>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#"> <i class="fa fa-facebook"></i> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <i class="fa fa-twitter"></i> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <i class="fa fa-pinterest-p"></i> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <i class="fa fa-dribbble"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-12">
                <div class="blog-post">
                    <div class="entry-image clearfix">
                        <div class="owl-carousel bottom-dots-center owl-theme" data-nav-dots="true" data-autoplay="true"  data-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xx-items="1">
                            <div class="item">
                                <img src="{{asset('front-end/images/front-end-img/courses/2f.jpg')}}" alt="">
                            </div>
                            <div class="item">
                                <img src="{{asset('front-end/images/front-end-img/courses/3f.jpg')}}" alt="">
                            </div>
                            <div class="item">
                                <img src="{{asset('front-end/images/front-end-img/courses/4f.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="blog-detail">
                        <div class="entry-title mb-10">
                            <a href="#">Blog Post With Image Slider</a>
                        </div>
                        <div class="entry-meta mb-10">
                            <ul class="list-unstyled">
                                <li><a href="#"><i class="fa fa-folder-open-o"></i> Design</a></li>
                                <li><a href="#"><i class="fa fa-comment-o"></i> 5</a></li>
                                <li><a href="#"><i class="fa fa-calendar-o"></i> 12 Aug 2020</a></li>
                            </ul>
                        </div>
                        <div class="entry-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus fuga laborum totam itaque architecto! Laudantium sed delectus assumenda, doloribus non.</p>
                        </div>
                        <div class="entry-share d-flex justify-content-between align-items-center">
                            <div class="entry-button">
                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            </div>
                            <div class="social">
                                <strong>Share : </strong>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#"> <i class="fa fa-facebook"></i> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <i class="fa fa-twitter"></i> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <i class="fa fa-pinterest-p"></i> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <i class="fa fa-dribbble"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-12">
                <div class="blog-post">
                    <div class="entry-image clearfix">
                        <ul class="grid-post list-unstyled">
                            <li>
                                <img class="img-fluid" src="{{asset('front-end/images/front-end-img/courses/5f.jpg')}}" alt="">
                            </li>
                            <li>
                                <img class="img-fluid" src="{{asset('front-end/images/front-end-img/courses/6f.jpg')}}" alt="">
                            </li>
                            <li>
                                <img class="img-fluid" src="{{asset('front-end/images/front-end-img/courses/7f.jpg')}}" alt="">
                            </li>
                            <li>
                                <img class="img-fluid" src="{{asset('front-end/images/front-end-img/courses/8f.jpg')}}" alt="">
                            </li>
                        </ul>
                    </div>
                    <div class="blog-detail">
                        <div class="entry-title mb-10">
                            <a href="#">Blogpost With Image Grid Gallery</a>
                        </div>
                        <div class="entry-meta mb-10">
                            <ul class="list-unstyled">
                                <li><a href="#"><i class="fa fa-folder-open-o"></i> Design</a></li>
                                <li><a href="#"><i class="fa fa-comment-o"></i> 5</a></li>
                                <li><a href="#"><i class="fa fa-calendar-o"></i> 12 Aug 2020</a></li>
                            </ul>
                        </div>
                        <div class="entry-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus fuga laborum totam itaque architecto! Laudantium sed delectus assumenda, doloribus non.</p>
                        </div>
                        <div class="entry-share d-flex justify-content-between align-items-center">
                            <div class="entry-button">
                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            </div>
                            <div class="social">
                                <strong>Share : </strong>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#"> <i class="fa fa-facebook"></i> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <i class="fa fa-twitter"></i> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <i class="fa fa-pinterest-p"></i> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <i class="fa fa-dribbble"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('includes.footer')


@include('includes.e_script')

