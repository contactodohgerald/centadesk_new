﻿@php
$users = auth()->user();
$pageTitle = 'Explore';
$explore= 'active';
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
                    <div class="col-xl-12 col-lg-8">
                        <div class="section3125">
                            <div class="explore_search">
                                <div class="ui search focus">
                                    <div class="ui left icon input swdh11">
                                        <input class="prompt srch_explore" type="text" placeholder="Search for Tuts Videos, Tutors, Tests and more..">
                                        <i class="uil uil-search-alt icon icon2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="section3125 mb-15 mt-50">
                            <h4 class="item_title font-poppins">Live Streams</h4>
                            <a href="/explore/live_streams" class="see150 font-poppins">See all</a>
                            <div class="la5lo1">
                                <div class="owl-carousel live_stream owl-theme">

                                    @foreach ($live_streams as $e)
                                    <div class="item">
                                        <div class="stream_1">
                                            <a href="{{ $e->meeting_url }}" class="stream_bg ">
                                                <img src="/storage/profile/{{ $e->user->profile_image }}" alt="">
                                                <h4 class="font-poppins">{{ $e->user->name }} {{ $e->user->last_name }}</h4>
                                                <p class="font-poppins text-capitalize">{{ $e->title }}</p>
                                                <p class="font-poppins">Live<span></span></p>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="_14d25">
                            <div class="row">
                                @if($course->count() > 0)
                                @foreach($course as $each_course)
                                <div class="col-lg-3 col-md-4">
                                    <div class="fcrse_1 mt-30">
                                        <a href="{{route('view_course', $each_course->unique_id )}}" class="fcrse_img">
                                            <img src="{{asset($link.'course-img/'.$each_course->cover_image)}}" width="218.5px" height="122.91">
                                            <div class="course-overlay">
                                                <div class="badge_seller">Bestseller</div>
                                                <div class="crse_reviews">
                                                    <i class="uil uil-star"></i>4.5
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer">
                                                    25 hours
                                                </div>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                <div class="dropdown-content">
                                                    <!--                                                    <span><i class='uil uil-share-alt'></i>Share</span>-->
                                                    <span onclick="saveCourse('{{$each_course->unique_id}}', '{{auth()->user()->unique_id}}') "><i class="uil uil-heart"></i>Save</span>
                                                    <!--                                                    <span><i class='uil uil-ban'></i>Not Interested</span>
                                                    <span><i class="uil uil-windsock"></i>Report</span>-->
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">{{$each_course->views}} views</span>
                                                <span class="vdt14">{{$each_course->created_at->diffForHumans()}}</span>
                                            </div>
                                            <a href="{{route('view_course', $each_course->unique_id )}}" class="crse14s font-poppins">{{$each_course->name}}</a>
                                            <a href="javascript:;" class="crse-cate font-poppins">{{$each_course->category->name}}</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot">By <a href="#">{{$each_course->user->name}} {{$each_course->user->last_name}}</a></p>
                                                <div class="prce142">{{auth()->user()->getAmountForView($each_course->price->amount)['data']['currency'] }} {{number_format(auth()->user()->getAmountForView($each_course->price->amount)['data']['amount'])}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                <div class="col-md-12">
                                    <div class="main-loader mt-50">
                                        <div class="spinner">
                                            <div class="bounce1"></div>
                                            <div class="bounce2"></div>
                                            <div class="bounce3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')

    </div>
    <!-- Body End -->

    @include('layouts.e_script')
