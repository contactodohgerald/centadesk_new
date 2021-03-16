@php
    $current_page = 'Blogs';
    $blog = 'active';
 @endphp
@include('includes.head')

@include('includes.header')

<!---page Title --->
<section class="bg-img pt-150 pb-20" data-overlay="7" style="background-image: url({{asset('front-end/images/front-end-img/background/bg-8.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">Blog</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Blog</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page content -->

<section class="py-50">
    <div class="container">
        @if(count($blogs) > 0)
            <div class="row">
                @foreach($blogs as $jj => $each_blog)
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="blog-post">
                            <div class="entry-image clearfix">
                                <img class="img-fluid" src="{{asset('storage/blog_image/'.$each_blog->blog_image)}}" alt="{{env('APP_NAME')}}">
                            </div>
                            <div class="blog-detail">
                                <div class="entry-title mb-10">
                                    <a href="{{route('blog-details', $blogs->unique_id )}}">{{$each_blog->blog_title}}</a>
                                </div>
                                <div class="entry-meta mb-10">
                                    <ul class="list-unstyled">
                                        <li><a href="javascript:;"><i class="fa fa-street-view"></i>{{$each_blog->views}}</a></li>
                                        <li><a href="javascript:;"><i class="fa fa-comment-o"></i> 5</a></li>
                                        <li><a href="javascript:;"><i class="fa fa-calendar-o"></i>{{$each_blog->created_at->diffForHumans()}}</a></li>
                                    </ul>
                                </div>
<!--                                <div class="entry-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus fuga laborum totam itaque architecto! Laudantium sed delectus assumenda, doloribus non.</p>
                                </div>-->
                                <div class="entry-share d-flex justify-content-between align-items-center">
                                    <div class="entry-button">
                                        <a href="{{route('blog-details', $blogs->unique_id )}}" class="btn btn-primary btn-sm">Read more</a>
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
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success text-center">No Blog Post is Available at this time, Please check back at a later time</div>
                </div>
            </div>
        @endif
    </div>
</section>

@include('includes.footer')


@include('includes.e_script')

