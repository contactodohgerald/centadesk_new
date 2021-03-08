@php
    $current_page = 'Course Details';
    $courses = 'active';
@endphp
@include('includes.head')

@include('includes.header')

<!---page Title --->
<section class="bg-img pt-150 pb-20" data-overlay="7" style="background-image: url({{asset('front-end/images/front-end-img/background/bg-8.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">Courses Details</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="#" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Courses Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page content -->

<section class="py-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-md-7 col-12">
                <div class="box">
                    <img class="box-img-top btrr-5 btlr-5" src="{{asset('storage/course-img/'.$course->cover_image)}}" alt="{{env('APP_NAME')}}" width="100%" height="500px">
                    <div class="box-body">
                        <h3 class="box-title">{{ucfirst($course->name)}}</h3>
                        <div class="cour-stac d-lg-flex align-items-center text-fade">
                            <div class="d-flex align-items-center">
                                <p>{{$course->created_at->diffForHumans()}}</p>
                                <p class="lt-sp">|</p>
                                <p>{{ucfirst($course->user->name)}} {{ucfirst($course->user->last_name)}}</p>
                                <p class="lt-sp">|</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p><i class="fa fa-user text-muted mr-5"></i> {{count($course->courseEnrollment)}}  Enrolled</p>
                            </div>
                        </div>
                        <div class="d-lg-flex align-items-center mt-15">
                            <div class="d-flex align-items-center">
								<span>
                                     <div class="crse_reviews">
                                        <i class="fa fa-star"></i>{{$course->count_reviews}}
                                     </div>
									<span class="text-muted ml-2">{{count($course->review)}} reviews</span>
								</span>
                                <div class="d-flex align-items-center ml-35">
                                    <i class="fa fa-heart text-danger mr-5"></i> {{$course->likes}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <h4 class="box-title mb-0 font-weight-500">Description</h4>
                        <hr>
                        <p class="font-size-16 mb-30">{!! $course->description !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-5 col-sm-12">
                <div class="course-detail-bx">
                    <div class="box box-body">
                        <div class="course-price">
                            <div class="mb-5">
                                <div class="text-dark mb-2 text-center">
                                    <span class="text-dark font-weight-600 h1">$ {{number_format($course->course_price)}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="{{route('checkout', $course->unique_id) }}"  class="btn waves-effect waves-light btn btn-block btn-success mb-10">Enroll Now</a>
                        </div>
                    </div>
                    <div class="box box-body">
                        <div class="staff-bx">
                            <div class="staff-info d-flex align-items-center">
                                <div class="staff-thumb mr-10">
                                    <a href="{{route('instructor-profile', $course->user->unique_id)}}">
                                        <img src="{{asset('storage/profile/'.$course->user->profile_image)}}" alt="{{env('APP_NAME')}}" class="bg-secondary-light rounded-circle max-w-60">
                                    </a>
                                </div>
                                <div class="staff-name">
                                    <a href="{{route('instructor-profile', $course->user->unique_id)}}">
                                        <h5 class="mb-0">{{ucfirst($course->user->name)}} {{ucfirst($course->user->last_name)}}</h5>
                                    </a>
                                    <span>{{ucfirst($course->user->professonal_heading)}}</span>
                                </div>
                            </div>
                        </div>
                        <hr class="w-p100">
                        <div>
                            <div>
                                <div class="d-flex align-items-center mb-5">
                                    <div class="bg-primary rounded h-30 w-30 l-h-30 text-center mr-10">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <a href="#"> {{$course->user->email}}</a>
                                </div>
                                <div class="d-flex align-items-center mb-5">
                                    <div class="bg-primary rounded h-30 w-30 l-h-30 text-center mr-10">
                                        <i class="fa fa-link"></i>
                                    </div>
                                    <a href="https://centadesk.com/scl/ref={{ $course->user->user_referral_id }}">https://centadesk.com/scl/ref={{ $course->user->user_referral_id }}</a>
                                </div>
                            </div>
                            <ul class="list-inline mt-20 mb-0">
                                <li><a href="https://facebook.com/{{ $course->user->facebook }}" target="_blank" data-toggle="tooltip" title="" data-original-title="Facebook"><i class="fa fa-facebook-square font-size-20"></i></a></li>
                                <li><a href="https://twitter.com/{{ $course->user->twitter }}" target="_blank" data-toggle="tooltip" title="" data-original-title="Twitter"><i class="fa fa-twitter-square font-size-20"></i></a></li>
                                <li><a href="https://www.youtube.com/{{ $course->user->youtube }}" target="_blank" data-toggle="tooltip" title="" data-original-title="Youtube"><i class="fa fa-youtube font-size-20"></i></a></li>
                                <li><a href="https://www.linkedin.com/{{ $course->user->linkedin }}" target="_blank" data-toggle="tooltip" title="" data-original-title="Linkedin"><i class="fa fa-linkedin-square font-size-20"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="box box-body">
                        <div class="widget mb-0">
                            <h4 class="mb-20">Reviews</h4>
                            @if(count($course->review) > 0)
                                <div class="owl-carousel" data-nav-dots="false" data-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xx-items="1">
                                    @foreach($course->review as $h => $each_review)
                                        <div class="item">
                                            <div class="testimonial-widget">
                                                <div class="testimonial-content">
                                                    <p>{{$each_review->review_message}}</p>
                                                </div>
                                                <div class="testimonial-info mt-20">
                                                    <div class="testimonial-avtar">
                                                        <img class="img-fluid" src="{{asset('storage/profile/'.$each_review->users->profile_image)}}" alt="{{env('APP_NAME')}}">
                                                    </div>
                                                    <div class="testimonial-name">
                                                        <strong>{{ucfirst($each_review->users->name)}} {{ucfirst($each_review->users->last_name)}}</strong>
                                                        <span>{{ucfirst($each_review->users->professonal_heading)}}</span>
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
            </div>
        </div>
    </div>
</section>

@include('includes.footer')


@include('includes.e_script')

