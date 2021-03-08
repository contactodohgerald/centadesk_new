@php
    $current_page = 'Instructor Profile';
    $instructor = 'active';
 @endphp
@include('includes.head')

@include('includes.header')

<!---page Title --->
<section class="bg-img pt-150 pb-20" data-overlay="7" style="background-image: url({{asset('front-end/images/front-end-img/background/bg-8.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">Profile</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-white-50"><i class="mdi mdi-home-outline"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Profile</li>
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
            <div class="col-lg-3 col-md-4 col-12">
                <div class="box position-sticky t-100">
                    <div class="box-body text-center">
                        <div class="mb-20 mt-20">
                            <img src="{{asset('storage/profile/'.$instructors->profile_image)}}" width="150" class="rounded-circle bg-info-light" alt="{{env('APP_NAME')}}">
                            <h4 class="mt-20 mb-0">{{ucfirst($instructors->name)}} {{ucfirst($instructors->last_name)}}</h4>
                            <a href="https://centadesk.com/scl/ref={{ $instructors->user_referral_id }}">https://centadesk.com/scl/ref={{ $instructors->user_referral_id }}</a>
                        </div>
                        <ul class="list-inline text-center mt-20">
                            <li><a href="https://facebook.com/{{ $instructors->facebook }}" target="_blank" data-toggle="tooltip" title="" data-original-title="Facebook"><i class="fa fa-facebook-square font-size-20"></i></a></li>
                            <li><a href="https://twitter.com/{{ $instructors->twitter }}" target="_blank" data-toggle="tooltip" title="" data-original-title="Twitter"><i class="fa fa-twitter-square font-size-20"></i></a></li>
                            <li><a href="https://www.youtube.com/{{ $instructors->youtube }}" target="_blank" data-toggle="tooltip" title="" data-original-title="Youtube"><i class="fa fa-youtube font-size-20"></i></a></li>
                            <li><a href="https://www.linkedin.com/{{ $instructors->linkedin }}" target="_blank" data-toggle="tooltip" title="" data-original-title="Linkedin"><i class="fa fa-linkedin-square font-size-20"></i></a></li>
                        </ul>
                    </div>
                    <ul class="nav d-block nav-stacked" id="pills-tab23" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-personal-tab" data-toggle="pill" href="#pills-personal" role="tab" aria-controls="pills-personal" aria-selected="true">
                                <i class="mr-10 mdi mdi-account"></i>Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-courses-tab" data-toggle="pill" href="#pills-courses" role="tab" aria-controls="pills-courses" aria-selected="true">
                                <i class="mr-10 mdi mdi-book"></i>Courses <span class="pull-right badge bg-info-light">{{count($instructors->courses) }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-followers-tab" data-toggle="pill" href="#pills-followers" role="tab" aria-controls="pills-followers" aria-selected="true">
                                <i class="mr-10 mdi mdi-bookmark-plus"></i>Subscribers  <span class="pull-right badge bg-success-light">{{count($instructors->subscribers)}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="tab-content" id="pills-tabContent23">
                            <div class="tab-pane fade show active" id="pills-personal" role="tabpanel" aria-labelledby="pills-personal-tab">
                                <h4 class="box-title mb-0">
                                    Personal Details
                                </h4>
                                <hr>
                                <ul class="list-unstyled clearfix">
                                    <li class="w-md-p50 float-left pb-10">
                                        <a href="#" class="text-dark d-flex justify-content-between pr-50">
                                            <span class="font-weight-500">Name :</span>
                                            <span class="text-muted"> {{ucfirst($instructors->name)}} {{ucfirst($instructors->last_name)}}</span>
                                        </a>
                                    </li>
                                    <li class="w-md-p50 float-left pb-10">
                                        <a href="#" class="text-dark d-flex justify-content-between pr-50">
                                            <span class="font-weight-500">Email :</span>
                                            <span class="text-muted">{{$instructors->email}}</span>
                                        </a>
                                    </li>
                                </ul>
                                <hr>
                                <h4 class="box-title mb-0">
                                    About Me
                                </h4>
                                <hr>
                                <p>{!! $instructors->description !!}</p>
                            </div>
                            <div class="tab-pane fade" id="pills-courses" role="tabpanel" aria-labelledby="pills-courses-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="box-title mb-0">
                                            My Courses
                                        </h4>
                                        <hr>
                                    </div>
                                    @if(count($instructors->courses) > 0)
                                        @foreach($instructors->courses as $s => $each_instructors)
                                            <div class="col-lg-4 col-12">
                                                <div class="card">
                                                    <img class="card-img-top" src="{{asset('storage/course-img/'.$each_instructors->cover_image)}}" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h4 class="card-title justify-content-between d-flex align-items-center">
                                                            {{ucfirst($each_instructors->name)}}</h4>
                                                        <p class="card-text">{{ucfirst($each_instructors->short_caption)}}</p>
                                                    </div>
                                                    <div class="card-footer justify-content-between d-flex align-items-center">
                                                        <div class="d-flex font-size-18 font-weight-600"> <span class="text-dark mr-10">$ {{number_format($each_instructors->course_price)}}</span> </div>
                                                        <span>
                                                            <div class="crse_reviews">
                                                                <i class="fa fa-star"></i>{{$each_instructors->count_reviews}}
                                                             </div>
                                                            <span class="text-muted ml-2">({{count($each_instructors->review)}})</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-12 col-12">
                                            <div class=" align-items-center mb-30">
                                                <div class="alert alert-success text-center">This Instructor Has No Courses Yet</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="box-title mb-0">
                                            Subscribers
                                        </h4>
                                        <hr>
                                    </div>
                                    @if(count($instructors->subscribers) > 0)
                                        @foreach($instructors->subscribers as $i => $each_subscribers)
                                            <div class="col-md-6 col-12">
                                                <div class="d-flex align-items-center mb-30">
                                                    <div class="mr-15">
                                                        <img src="{{asset('storage/profile/'.$each_subscribers->users->profile_image)}}" class="avatar avatar-lg rounded10 bg-primary-light" alt="{{env('APP_NAME')}}">
                                                    </div>
                                                    <div class="d-flex flex-column font-weight-500">
                                                        <a href="#" class="text-dark hover-primary mb-1 font-size-16">{{ucfirst($each_subscribers->users->name)}} {{ucfirst($each_subscribers->users->last_name)}}</a>
                                                        <span class="text-mute">{{$each_subscribers->users->email}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-12 col-12">
                                            <div class=" align-items-center mb-30">
                                                <div class="alert alert-success text-center">This Instructor Has No Subscribers Yet</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
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

