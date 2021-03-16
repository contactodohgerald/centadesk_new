@php
    $current_page = 'Blogs Details';
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
                    <h2 class="page-title text-white">Blog Details</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Blog Details</li>
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
            <div class="col-lg-9 col-md-8 col-12">
                <div class="blog-post mb-30">
                    <div class="entry-image clearfix">
                        <img class="img-fluid" src="{{asset('storage/blog_image/'.$blog_post->blog_image)}}" alt="{{env('APP_NAME')}}">
                    </div>
                    <div class="blog-detail">
                        <div class="entry-meta mb-10">
                            <ul class="list-unstyled">
                                <li><a href="javascript:;"><i class="fa fa-street-view"></i>{{$blog_post->views}}</a></li>
                                <li><a href="javascript:;"><i class="fa fa-comment-o"></i>{{count($blog_post->blogComments)}}</a></li>
                                <li><a href="javascript:;"><i class="fa fa-calendar-o"></i>{{$blog_post->created_at->diffForHumans()}}</a></li>
                            </ul>
                        </div>
                        <hr>
                        <div class="entry-title mb-10">
                            <a href="#" class="font-size-24">{{$blog_post->blog_title}}</a>
                        </div>
                        <div class="entry-content">
                            <p>{!! $blog_post->blog_message !!}</p>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="widget">
                            <h4 class="mt-0 pb-15 mb-25 bb-1">TAGS</h4>
                            <div class="widget-tags">
                                @if(count($blog_post->blog_post_tag) > 0)
                                <ul class="list-unstyled">
                                    @foreach($blog_post->blog_post_tag as $wer => $message)
                                        <li><a href="#">{{$message->tag_name}}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="blog-comment">
                            <h4 class="mt-0 pb-15 mb-25 bb-1">{{count($blog_post->blogComments)}} Comments</h4>
                            @if(count($blog_post->blogComments) > 0)
                                @foreach($blog_post->blogComments as $hp => $each_blog_comment)
                                    <div class="comment-1">
                                        <div class="comment-info">
                                            <h4 class="theme-color">{{ucfirst($each_blog_comment->user_name)}} <span>{{$each_blog_comment->created_at->diffForHumans()}}</span></h4>
                                            <p>{{$each_blog_comment->message}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-success text-center"> No Comment For This Blog at this time</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="widget">
                            <h4 class="mt-0 pb-15 mb-25 bb-1">Leave a Reply</h4>
                            @if(Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    <i class="fa fa-envelope-o mr-2"></i>
                                    {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @elseif(Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                    <i class="fa fa-envelope-o mr-2"></i>
                                    {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            <form id="contactform" class="form-row" action="{{route('blog-comment', $blog_post->unique_id)}}" method="post">
                                @csrf
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="name" required class="form-control" placeholder="Your Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" required placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="7" required placeholder="message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <button name="submit" type="submit" value="Send" class="btn btn-primary"><span>Submit Now</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="side-block px-20 py-10 bg-white">
                    <div class="widget">
                        <h4 class="pb-15 mb-25 bb-1">Tags</h4>
                        <div class="widget-tags">
                            @if(count($blog_post->blog_post_tag) > 0)
                                <ul class="list-unstyled">
                                    @foreach($blog_post->blog_post_tag as $wer => $message)
                                        <li><a href="#">{{$message->tag_name}}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="widget">
                        <h4 class="pb-15 mb-25 bb-1">Recent Posts </h4>
                        @if(count($recentPosts) > 0)
                            @foreach($recentPosts as $r => $each_recent_post)
                                @if($r == 10)
                                    @break
                                @endif
                                <div class="recent-post clearfix">
                                    <div class="recent-post-image">
                                        <img class="img-fluid bg-primary-light" src="{{asset('storage/blog_image/'.$each_recent_post->blog_image)}}" alt="{{env('APP_NAME')}}">
                                    </div>
                                    <div class="recent-post-info">
                                        <a href="{{route('blog-details', $each_recent_post->unique_id )}}">{{$each_recent_post->blog_title}}</a>
                                        <span><i class="fa fa-calendar-o"></i>{{$each_recent_post->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-success text-center">No Blog Post is Available at this time, Please check back at a later time</div>
                        @endif
                    </div>

                    <div class="widget">
                        <h4 class="pb-15 mb-25 bb-1">Testimonials</h4>
                        <div class="owl-carousel" data-nav-dots="false" data-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xx-items="1">
                            @if(count($testimonys) > 0)
                                @foreach($testimonys as $kk => $each_test)
                                    <div class="item">
                                        <div class="testimonial-widget">
                                            <div class="testimonial-content">
                                                <p>{{$each_test->message}} </p>
                                            </div>
                                            <div class="testimonial-info mt-20">
                                                <div class="testimonial-name">
                                                    <strong>{{$each_test->user_name}}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="widget mb-10">
                        <h4 class="pb-15 mb-25 bb-1">Quick contact</h4>
                        @if(Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <i class="fa fa-envelope-o mr-2"></i>
                                {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @elseif(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <i class="fa fa-envelope-o mr-2"></i>
                                {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        <form class="gray-form" action="{{route('contact-mail')}}" method="post">
                                @csrf
                            <div class="form-group">
                                <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name (Optional)">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" required class="form-control" id="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" required class="form-control" id="phone" placeholder="Phone (Optional)">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" required placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <textarea name="message" rows="4" class="form-control" required placeholder="Message"></textarea>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('includes.footer')


@include('includes.e_script')

