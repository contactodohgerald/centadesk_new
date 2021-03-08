@php
    $current_page = 'Course List';
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
                    <h2 class="page-title text-white">Our Courses List</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="#" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Our Courses List</li>
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
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="side-block px-20 py-10 bg-white">
                    <div class="widget">
                        <h4 class="pb-15 mb-25 bb-1">All Categories</h4>
                        @if(count($course_category_model) > 0)
                            <ul class="list-unstyled">
                                @foreach($course_category_model as $ks => $each_categories)
                                    <li>
                                        <input type="checkbox" id="basic_checkbox_{{$ks}}" class="filled-in">
                                        <label for="basic_checkbox_{{$ks}}" class="d-flex justify-content-between align-items-center">
                                            <a href="{{route('course-list', $each_categories->unique_id)}}">{{ucfirst($each_categories->name)}}</a>
                                            <span class="badge badge-sm badge-primary-light">{{count($each_categories->courses)}}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="bg-light p-10 d-lg-flex justify-content-between align-items-center mb-20 rounded">
                            <h2 class="mb-lg-0 mb-20">List of courses for category</h2>
                            <div class="d-flex justify-lg-content-end align-items-center">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item mx-5" role="presentation">
                                        <a class="nav-link b-0 font-size-18" id="pills-grid-tab" data-toggle="pill" href="#pills-grid" role="tab" aria-controls="pills-grid" aria-selected="false">
                                            <i class="fa fa-th mr-0"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item mx-5" role="presentation">
                                        <a class="nav-link active b-0 font-size-18" id="pills-list-tab" data-toggle="pill" href="#pills-list" role="tab" aria-controls="pills-list" aria-selected="true">
                                            <i class="fa fa-list mr-0"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            @if(count($course) > 0)
                                <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                                    @foreach($course as $j => $each_course)
                                        <div class="card rounded-0">
                                            <div class="d-lg-flex">
                                                <div class="position-relative w-lg-400">
                                                    <a href="{{route('course-details', $each_course->unique_id)}}">
                                                        <img class="" src="{{asset('storage/course-img/'.$each_course->cover_image)}}" alt="{{env('APP_NAME')}}" width="100%" height="200px">
                                                    </a>
                                                </div>
                                                <div class="card mb-0 no-border no-shadow w-p100">
                                                    <div class="card-body">
                                                        <div class="cour-stac d-lg-flex align-items-center text-fade">
                                                            <div class="d-flex align-items-center">
                                                                <p>{{$each_course->created_at->diffForHumans()}}</p>
                                                                <p class="lt-sp">|</p>
                                                                <p>{{ucfirst($each_course->user->name)}} {{ucfirst($each_course->user->last_name)}}</p>
                                                                <p class="lt-sp">|</p>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <p>{{$each_course->user->professonal_heading}}</p>
                                                            </div>
                                                        </div>
                                                        <h3 class="card-title mt-20">{{ucfirst($each_course->name)}}</h3>
                                                        <p class="card-text">{{ucfirst($each_course->short_caption)}}</p>
                                                    </div>
                                                    <div class="card-footer justify-content-between d-flex align-items-center">
                                                        <div class="d-flex font-size-18 font-weight-600"> <span class="text-dark mr-10">$ {{number_format($each_course->course_price)}}</span> </div>
                                                        <span>
                                                             <div class="crse_reviews">
                                                                <i class="fa fa-star"></i>{{$each_course->count_reviews}}
                                                             </div>
                                                            <span class="text-muted ml-2">({{count($each_course->review)}})</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="tab-pane fade" id="pills-grid" role="tabpanel" aria-labelledby="pills-grid-tab">
                                @if(count($course) > 0)
                                    <div class="row">
                                        @foreach($course as $j => $each_course)
                                            <div class="col-lg-4 col-12">
                                                <div class="card">
                                                    <a href="{{route('course-details', $each_course->unique_id)}}">
                                                        <img class="card-img-top" src="{{asset('storage/course-img/'.$each_course->cover_image)}}" alt="{{env('APP_NAME')}}" width="100%" height="200px">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="cour-stac d-flex align-items-center text-fade mt-20">
                                                            <p>{{$each_course->created_at->diffForHumans()}}</p>
                                                            <p class="lt-sp">|</p>
                                                            <p>{{ucfirst($each_course->user->name)}} {{ucfirst($each_course->user->last_name)}}</p>
                                                        </div>
                                                        <h4 class="card-title justify-content-between d-flex align-items-center">{{ucfirst($each_course->name)}}</h4>
                                                        <p class="card-text">{{ucfirst($each_course->short_caption)}}</p>
                                                    </div>
                                                    <div class="card-footer justify-content-between d-flex align-items-center">
                                                        <div class="d-flex font-size-18 font-weight-600"> <span class="text-dark mr-10">$ {{number_format($each_course->course_price)}}</span> </div>
                                                        <span>
                                                           <div class="crse_reviews">
                                                                <i class="fa fa-star"></i>{{$each_course->count_reviews}}
                                                             </div>
                                                            <span class="text-muted ml-2">({{count($each_course->review)}})</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div aria-label="Page navigation example">
                            <ul class="pagination mb-0">
                                <li class="page-item"><a class="page-link" href="{{$course->previousPageUrl()}}">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">{{$course->currentPage()}}</a></li>
                                <li class="page-item"><a class="page-link" href="{{$course->nextPageUrl()}}">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('includes.footer')


@include('includes.e_script')

