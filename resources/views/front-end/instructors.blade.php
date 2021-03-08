@php
    $current_page = 'Instructors List';
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
                    <h2 class="page-title text-white">Instructors</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-white-50"><i class="mdi mdi-home-outline"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Instructors</li>
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
            @if(count($instructors) > 0)
                @foreach($instructors as $j => $each_instructor)
                    <div class="col-12 col-lg-4">
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
            @else
                <div class="col-12 col-lg-12">
                    <div class="box">
                        <div class="alert alert-success text-center">No Instructor is currently available, check at a later time</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

@include('includes.footer')


@include('includes.e_script')

