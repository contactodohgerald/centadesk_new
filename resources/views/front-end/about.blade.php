@php
    $current_page = 'About';
    $about = 'active';
 @endphp
@include('includes.head')

@include('includes.header')

<!---page Title --->
<section class="bg-img pt-150 pb-20" data-overlay="7" style="background-image: url({{asset('front-end/images/front-end-img/background/bg-8.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">About us</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">About us</li>
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
            <div class="col-lg-4 col-md-4 col-12">
                <a href="#" class="pull-up">
                    <div class="p-10">
                        <span class="font-size-40 icon-Compiling"><span class="path1"></span><span class="path2"></span></span>
                        <h3 class="my-15">Our Philosophy</h3>
                        <div class="text-fade font-size-16 mb-10">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod..</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <a href="#" class="pull-up">
                    <div class="p-10">
                        <span class="font-size-40 icon-Position1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                        <h3 class="my-15">Our Mission</h3>
                        <div class="text-fade font-size-16 mb-10">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod..</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <a href="#" class="pull-up">
                    <div class="p-10">
                        <span class="font-size-40 icon-Book-open"><span class="path1"></span><span class="path2"></span></span>
                        <h3 class="my-15">Our Vission</h3>
                        <div class="text-fade font-size-16 mb-10">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod..</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="py-50 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12">
                <h2 class="mb-10">About Us</h2>
                <p class="font-size-16">{{env('APP_NAME')}} is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life. Everyone is invited be you a hairstylist, artist, or tech person as long as you can transfer your knowledge to another person using the platform.
                    <br>
                    There are laid down rules that govern the platform, and the users are expected to either learn, educate others or earn money by following the system laid down rules of operation. The platform has a multi-level marketing system that aims to empower the users of the platform simply by them introducing their friends, colleagues, family members or telling them about the platform and by so doing receive commission from their tuition fee.</p>
                <a href="{{route('contact')}}" class="btn btn-primary">Contact Us</a>
            </div>
            <div class="col-lg-6 col-12">
                <div class="popup-vdo mt-30 mt-md-0">
                    <img src="{{asset('front-end/images/front-end-img/courses/4f.jpg')}}" class="img-fluid rounded" alt="">
                    <a href="https://www.youtube.com/watch?v=uK67pD7kI6s" target="_blank" class="popup-youtube play-vdo-bt waves-effect waves-circle btn btn-circle btn-primary btn-lg"><i class="mdi mdi-play"></i></a>
                </div>
            </div>
            <div class="col-lg-12 col-12">
                <h2 class="mb-10">Membership</h2>
                <p class="font-size-16">Participating in {{env('APP_NAME')}} is not free. To obtain a membership with {{env('APP_NAME')}} you must enroll/purchase at least one course. Purchasing a course with {{env('APP_NAME')}} automatically makes you a full member for a period of one year. Obtaining membership through course purchase opens access to earning to any kind of users both students and tutors through the multi-level marketing program.
                </p>
            </div>
            <div class="col-lg-12 col-12">
                <h2 class="mb-10">Learning</h2>
                <p class="font-size-16">The sole purpose of this platform is to create a platform where skilled persons can be linked to various persons desiring to learn such skill. The platform is very flexible and tutors and student are allowed to communicate directly. This communication can be done through any social media platform desired by the tutor we made this interaction possible since we know in must case going through a study material can be challenging and most time we need guide throughout the learning process so we believe if tutor are allowed easy communication with the student this aim will be achieved and we will have more happy student.
                </p>
            </div>
            <div class="col-lg-12 col-12">
                <h2 class="mb-10">Users Promise</h2>
                <p class="font-size-16">100% satisfaction <br>
                    {{env('APP_NAME')}} ensures that users are satisfied with the platform. The platform teams are vetting all learning contents. We assure you that you will be satisfied with every course purchased.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-30 bg-img countnm-bx" data-jarallax='{"speed": 0.4}' style="background-image: url({{asset('front-end/images/front-end-img/background/bg-1.jpg')}})" data-overlay="5">
    <div class="container">
        <div class="box box-body bg-transparent mb-0">
            <div class="row">
                <div class="col-lg-4 col-4">
                    <div class="text-center mb-30 mb-lg-0">
                        <div class="w-80 h-80 l-h-100 rounded-circle b-1 border-white text-center mx-auto">
                            <span class="text-white font-size-40 icon-User"><span class="path1"></span><span class="path2"></span></span>
                        </div>
                        <h1 class="countnm my-10 text-white">{{count($instructors_count)}}</h1>
                        <div class="text-uppercase text-white">Instructors</div>
                    </div>
                </div>
                <div class="col-lg-4 col-4">
                    <div class="text-center mb-30 mb-lg-0">
                        <div class="w-80 h-80 l-h-100 rounded-circle b-1 border-white text-center mx-auto">
                            <span class="text-white font-size-40 icon-Book"></span>
                        </div>
                        <h1 class="countnm my-10 text-white">{{count($course_count)}}</h1>
                        <div class="text-uppercase text-white">Courses</div>
                    </div>
                </div>
                <div class="col-lg-4 col-4">
                    <div class="text-center">
                        <div class="w-80 h-80 l-h-100 rounded-circle b-1 border-white text-center mx-auto">
                            <span class="text-white font-size-40 icon-Group"><span class="path1"></span><span class="path2"></span></span>
                        </div>
                        <h1 class="countnm my-10 text-white">{{count($student_count)}}</h1>
                        <div class="text-uppercase text-white">Student</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel owl-theme owl-btn-1" data-nav-arrow="true" data-nav-dots="false" data-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xx-items="1">
                    @if(count($testimonys) > 0)
                        @foreach($testimonys as $kk => $each_test)
                            <div class="item">
                                <div class="text-center">
                                    <div class="max-w-750 mx-auto">
                                        <div class="testimonial-info">
                                            <h4 class="name mb-0 mt-10">{{$each_test->user_name}}</h4>
                                        </div>
                                        <div class="testimonial-content">
                                            <p class="font-size-16">{{$each_test->message}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-100" data-jarallax='{"speed": 0.4}' style="background-image: url({{asset('front-end/images/front-end-img/background/bg-3.jpg')}});" data-overlay="5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div class="text-center text-white">
                    <h2 class="mb-15 font-weight-600 font-size-40">Personalized Customer Service</h2>
                    <p>We tend to be effective, efficient, fast, and reliable when it comes to assisting users. We strive to create a long-term business partnership. Visit help and support for more information. If you are not satisfied, we will listen and make things right when we can. <br> Please visit our FAQ section. </p>
                    <div class="mt-5"><a href="{{route('faq')}}" class="btn btn-primary">FAQS</a></div>
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
                    <div class="col-lg-3 col-md-6">
                        <div class="box">
                            <div class="box-header no-border p-0">
                                <a href="{{route('instructor-profile', $each_instructor->unique_id)}}">
                                    <img class="img-fluid" src="{{asset('storage/profile/'.$each_instructor->profile_image)}}" alt="{{env('APP_NAME')}}" width="50%" height="100px">
                                </a>
                            </div>
                            <div class="box-body">
                                <div class="text-center">
                                    <div class="user-contact list-inline text-center">
                                        <a href="https://facebook.com/{{ $each_instructor->facebook }}" target="_blank" class="btn btn-circle mb-5 btn-facebook"><i class="fa fa-facebook"></i></a>
                                        <a href="https://twitter.com/{{ $each_instructor->twitter }}" target="_blank" class="btn btn-circle mb-5 btn-twitter"><i class="fa fa-twitter"></i></a>
                                        <a href="https://www.youtube.com/{{ $each_instructor->youtube }}" target="_blank" class="btn btn-circle mb-5 btn-youtube"><i class="fa fa-youtube"></i></a>
                                        <a href="https://www.linkedin.com/{{ $each_instructor->linkedin }}" target="_blank" class="btn btn-circle mb-5 btn-linkedin"><i class="fa fa-linkedin"></i></a>
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

@include('includes.footer')


@include('includes.e_script')

