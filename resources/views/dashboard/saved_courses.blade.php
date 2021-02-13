﻿@php
	$pageTitle = 'Settings Area';
	$saveCourse = 'active';
@endphp
@include('layouts.head')

<body>
	<!-- Header Start -->
	@include('layouts.header')
	<!-- Header End -->

	<!-- Left Sidebar Start -->
	@include('layouts.sidebar')
	<!-- Left Sidebar End -->

	<!-- Body Start -->
	<div class="wrapper">
    <div class="sa4d25">
			<div class="container-fluid">			
				<div class="row">
					<div class="col-lg-3 col-md-4 ">
						<div class="section3125 hstry142">
							<div class="grp_titles pt-0">
								<div class="ht_title">Saved Courses</div>
								<a href="#" class="ht_clr">Remove All</a>
							</div>
							<div class="tb_145">
								<div class="wtch125">
									<span class="vdt14">{{count($saved_courses)}} Courses</span>
								</div>
								<a href="#" class="rmv-btn"><i class='uil uil-trash-alt'></i>Remove Saved Courses</a>
							</div>						
						</div>							
					</div>					
					<div class="col-md-9">
						<div class="_14d25 mb-20">						
							<div class="row">
								<div class="col-md-12">
                                    <h4 class="mhs_title">Saved Courses</h4>
                                    @if(count($saved_courses) > 0)
                                        @foreach($saved_courses  as $k => $each_saved_courses)
                                        <div class="fcrse_1 mt-30">
                                            <a href="{{route('view_course', $each_saved_courses->courses->unique_id )}}" class="hf_img">
                                                <img src="images/courses/img-1.jpg" alt="">
                                                <div class="course-overlay">
                                                    <div class="badge_seller">Bestseller</div>
                                                    <div class="crse_reviews">
                                                        <i class="uil uil-star"></i>4.5
                                                    </div>
                                                    <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                    <div class="crse_timer">
                                                    {{$each_saved_courses->created_at->diffForHumans()}}
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="hs_content">
                                                <div class="eps_dots eps_dots10 more_dropdown">
                                                    <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                    <div class="dropdown-content">
                                                        <span><i class='uil uil-times'></i>Remove</span>															
                                                    </div>																											
                                                </div>
                                                <div class="vdtodt">
                                                    <span class="vdt14">{{$each_saved_courses->courses->views}} views</span>
                                                    <span class="vdt14">{{$each_saved_courses->courses->created_at->diffForHumans()}}</span>
                                                </div>
                                                <a href="{{route('view_course', $each_saved_courses->courses->unique_id )}}" class="crse14s title900">{{$each_saved_courses->courses->name}}</a>
                                                <a href="{{route('view_course', $each_saved_courses->courses->unique_id )}}" class="crse-cate">{{$each_saved_courses->courses->short_caption}}</a>
                                                <div class="auth1lnkprce">
                                                    <p class="cr1fot">By <a href="#">{{$each_saved_courses->users->name}} {{$each_saved_courses->users->last_name}}</a></p>
                                                    <div class="prce142">{{auth()->user()->getAmountForView($each_saved_courses->courses->price->amount)['data']['currency'] }}  {{number_format(auth()->user()->getAmountForView($each_saved_courses->courses->price->amount)['data']['amount'])}}</div>
                                                    <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="fcrse_1 mt-30">
                                        <div class="alert alert-success text-center">No Data Was Ruturned</div>
                                    </div>
                                    @endif
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