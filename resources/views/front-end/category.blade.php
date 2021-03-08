@php
    $current_page = 'Course Categories';
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
                    <h2 class="page-title text-white">Our Courses Categories</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="#" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Our Courses Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page content -->

<section class="py-50">
    <div class="container">
        @if(count($course_category_model) > 0)
            <div class="row">
                @foreach($course_category_model as $k => $each_category)
                    <div class="col-lg-3 col-md-6 col-12">
                        <a class="box box-link-shadow text-center pull-up" href="{{route('course-list', $each_category->unique_id)}}">
                            <div class="box-body py-15 bg-secondary bbrr-0 bblr-0">
                                <p class="font-weight-600">{{ucfirst($each_category->name)}}</p>
                            </div>
                            <div class="box-body">
                                <p class="mt-5">
                                    <span class="icon-Book-open font-size-50 text-info"><span class="path1"></span><span class="path2"></span></span>
                                </p>
                                <span class="badge badge-dark">{{count($each_category->courses)}}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="py-50">
    <div class="container">
        @if(count($course_category_model) > 0)
            <div class="row">
                @foreach($course_category_model as $key => $each_categories)
                    <div class="col-12 col-lg-4 col-md-6">
                        <div class="box ">
                            <div class="box-header with-border bg-secondary">
                                <h4 class="box-title">{{ucfirst($each_categories->name)}}</h4>
                                <div class="box-controls pull-right">
                                    <a href="{{route('course-list', $each_categories->unique_id)}}" class="btn btn-xs btn-primary">View All</a>
                                </div>
                            </div>
                            <div class="box-body">
                                @if(count($each_categories->courses) > 0)
                                    <ul class="list list-arrow">
                                        @foreach($each_categories->courses as $keys => $each_course)
                                            <li> <a href="#">{{ucfirst($each_course->name)}}</a> </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@include('includes.footer')


@include('includes.e_script')

