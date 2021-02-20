﻿@php
	$pageTitle = 'Course Details Area';
	$Complain = 'active';
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

<!-- Video Model Start -->
<div class="modal vd_mdl fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <iframe  src="{{$course->intro_video}}" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

        </div>
    </div>
</div>
<!-- Video Model End -->

	<!-- Body Start -->
		<div class="wrapper _bg4586">
			<div class="_215b01">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="section3125">
								<div class="row justify-content-center">
									<div class="col-xl-4 col-lg-5 col-md-6">
										<div class="preview_video">
											<a href="#" class="fcrse_img" data-toggle="modal" data-target="#videoModal">
												<img src="{{asset($link.'course-img/'.$course->cover_image)}}" alt="">
												<div class="course-overlay">
													<div class="badge_seller">Bestseller</div>
													<span class="play_btn1"><i class="uil uil-play"></i></span>
													<span class="_215b02">Preview this course</span>
												</div>
											</a>
										</div>
										<input type="hidden" class="course_unique_id" value="{{$course->unique_id}}">
										<input type="hidden" class="user_unique_id" value="{{auth()->user()->unique_id}}">
										<div class="_215b10">
											<a href="javascript:;" onclick="saveCourse('{{$course->unique_id}}', '{{auth()->user()->unique_id}}')" class="_215b11" title="Save Course">
												<span><i class="uil uil-heart"></i></span>Save Course
											</a>
										</div>

									</div>
									<div class="col-xl-8 col-lg-7 col-md-6">
										<div class="_215b03">
											<h2 class="font-poppins">{{ucfirst($course->name)}}</h2>
											<span class="_215b04 font-poppins">{{$course->short_caption}}</span>
										</div>
										<div class="_215b05 font-poppins">
											<div class="crse_reviews mr-2 rating_ratio font-poppins">
											</div>
											({{count($course->reviews)}} ratings)
										</div>
										<div class="_215b05 font-poppins">
											114,521 students enrolled
										</div>
										<div class="_215b05 font-poppins">
											Last updated: {{$course->created_at->diffForHumans()}}
										</div>
                                        <div class="_215b05 font-poppins">
											Rate This Course:
                                            <div class="rating-box mt-20" id="rate">

                                            </div>
										</div>
										<div class="_215b06">
											<div class="_215b07">
												<span><i class='uil uil-money-bill'></i></span>
												{{auth()->user()->getAmountForView($course->price->amount)['data']['currency'] }} {{number_format(auth()->user()->getAmountForView($course->price->amount)['data']['amount'])}}
											</div>
										</div>
										<ul class="_215b31">
											<li><button class="btn_buy">Enroll Now</button></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="_215b15 _byt1458">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="user_dt5">
								<div class="user_dt_left">
									<div class="live_user_dt">
										<div class="user_img5">
											<a href="#"><img src="/storage/profile/{{ $course->user->profile_image }}" alt=""></a>
										</div>
										<div class="user_cntnt">
											<a href="#" class="_df7852">{{ucfirst($course->user->name)}} {{ucfirst($course->user->last_name)}}</a>
											<button class="subscribe-btn" onclick="subscribeTOTeacher(this, '{{auth()->user()->unique_id}}', '{{$course->user->unique_id}}')">Subscribe</button>
										</div>
									</div>
								</div>
								<div class="user_dt_right">
									<ul>
										<li>
											<a class="lkcm152"><i class="uil uil-eye"></i><span>{{$course->views}}</span></a>
										</li>
										<li>
											<a href="javascript:;" class="lkcm152" onclick="likeAndDislikeCourse('like')"><i class="uil uil-thumbs-up"></i><span>{{$course->likes}}</span></a>
										</li>
										<li>
											<a href="javascript:;" class="lkcm152" onclick="likeAndDislikeCourse('dislike')"><i class="uil uil-thumbs-down"></i><span>{{$course->dislikes}}</span></a>
										</li>
									</ul>
								</div>
							</div>
							<div class="course_tabs">
								<nav>
									<div class="nav nav-tabs tab_crse justify-content-center" id="nav-tab" role="tablist">
										<a class="nav-item nav-link active" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-selected="true">About</a>
										<a class="nav-item nav-link" id="nav-courses-tab" data-toggle="tab" href="#nav-courses" role="tab" aria-selected="false">Courses Content</a>
										<a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews" role="tab" aria-selected="false">Reviews</a>
									</div>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="_215b17">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="course_tab_content">
								<div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade show active" id="nav-about" role="tabpanel">
										<div class="_htg451">
											<div class="_htg452 mt-35">
												<h3>Description</h3>
												<p>{!! $course->description !!}</p>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="nav-courses" role="tabpanel">
										<div class="crse_content">
											<h3>Course content</h3>
											<div class="_112456">
												<ul class="accordion-expand-holder">
													<li><span class="accordion-expand-all _d1452">Expand all</span></li>
													<li><span class="_fgr123"> 402 lectures</span></li>
													<li><span class="_fgr123">47:06:29</span></li>
												</ul>
											</div>
											<div id="accordion" class="ui-accordion ui-widget ui-helper-reset">
												<a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
													<div class="section-header-left">
																<span class="section-title-wrapper">
																	<i class='uil uil-presentation-play crse_icon'></i>
																	<span class="section-title-text">Introduction to this Course</span>
																</span>
													</div>
													<div class="section-header-right">
														<span class="num-items-in-section">8 lectures</span>
														<span class="section-header-length">22:08</span>
													</div>
												</a>
												<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">A Note On Asking For Help</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:12</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Introducing Our TA</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">01:42</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Join the Online Community</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:51</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Why This Course?</div>
															</div>
														</div>
														<div class="details">
															<a href="#" class="preview-text">Preview</a>
															<span class="content-summary">07:48</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file-download-alt icon_142'></i>
															<div class="top">
																<div class="title">Syllabus Download</div>
															</div>
														</div>
														<div class="details">
															<a href="#" class="preview-text">Preview</a>
															<span class="content-summary">2 pages</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Syllabus Walkthrough</div>
															</div>
														</div>
														<div class="details">
															<a href="#" class="preview-text">Preview</a>
															<span class="content-summary">01:42</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Lecture Slides</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:11</span>
														</div>
													</div>
												</div>
												<a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
													<div class="section-header-left">
																<span class="section-title-wrapper">
																	<i class='uil uil-presentation-play crse_icon'></i>
																	<span class="section-title-text">Introduction to Front End Development</span>
																</span>
													</div>
													<div class="section-header-right">
														<span class="num-items-in-section">6 lectures</span>
														<span class="section-header-length">27:26</span>
													</div>
												</a>
												<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Unit Objectives</div>
															</div>
														</div>
														<div class="details">
															<a href="#" class="preview-text">Preview</a>
															<span class="content-summary">01.40</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Setting Up Front-End Developer Environment</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:30</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Setting Up Front-End Developer Environment</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">03:11</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Introduction to the Web</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:11</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Introduction to the Web</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">10.08</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">The Front End Holy Trinity</div>
															</div>
														</div>
														<div class="details">
															<a href="#" class="preview-text">Preview</a>
															<span class="content-summary">11:46</span>
														</div>
													</div>
												</div>
												<a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
													<div class="section-header-left">
																<span class="section-title-wrapper">
																	<i class='uil uil-presentation-play crse_icon'></i>
																	<span class="section-title-text">Introduction to HTML</span>
																</span>
													</div>
													<div class="section-header-right">
														<span class="num-items-in-section">13 lectures</span>
														<span class="section-header-length">58:55</span>
													</div>
												</a>
												<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Unit Objectives</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">01.38</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">HTML Basicsng Up Front-End Developer Environment</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">05:53</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Introduction to MDN</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:19</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Introduction to MDN</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">01:51</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">HTML Boilerplate and Comments</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">09:42</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Basic Tags</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">08:23</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">HTML Lists</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">04:32</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">HTML Lists Assignment</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">01:23</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">HTML Lists Assignment: SOLUTION</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">05:59</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Divs and Spans</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">05:23</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">HTML Attributes</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">09:00</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Recreate Webpage Assignment</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">01:00</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Recreate Webpage Assignment: SOLUTION</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">03:56</span>
														</div>
													</div>
												</div>
												<a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
													<div class="section-header-left">
																<span class="section-title-wrapper">
																	<i class='uil uil-presentation-play crse_icon'></i>
																	<span class="section-title-text">Intermediate HTML</span>
																</span>
													</div>
													<div class="section-header-right">
														<span class="num-items-in-section">13 lectures</span>
														<span class="section-header-length">01.12:29</span>
													</div>
												</a>
												<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Unit Objectives</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">01.19</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">HTML Tables</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">06:03</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Tables Exercise</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">01:18</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Introduction to Forms</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">06:19</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Playing with Inputs</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">03:04</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">The Form Tag</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">06:36</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Labels</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">03:32</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Form Validations</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">03:43</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Dropdowns and Radio Buttons</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">11:19</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Form Exercise</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">07:23</span>
														</div>
													</div>
												</div>
												<a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
													<div class="section-header-left">
																<span class="section-title-wrapper">
																	<i class='uil uil-presentation-play crse_icon'></i>
																	<span class="section-title-text">Introduction to CSS</span>
																</span>
													</div>
													<div class="section-header-right">
														<span class="num-items-in-section">15 lectures</span>
														<span class="section-header-length">01.40:15</span>
													</div>
												</a>
												<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Unit Objectives</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">02.28</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">CSS Basics</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">05:25</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Our First Stylesheet</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">10:18</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about CSS Colors and Background and Border (next 2 lectures)</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:20</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">CSS Colors</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">14:35</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Background and Border</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">06:58</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Selectors Basics Todo List</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:32</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Selectors Basics Todo List</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">10:43</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Introduction to Chrome Inspector</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">05:43</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">More Advanced Selectors</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">09:23</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Specificity and the Cascade</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:23</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Specificity and the Cascade</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">10:38</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Selectors Practice Exercise</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:22</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Selectors Practice Exercise</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">04:28</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Selectors Practice Exercise: SOLUTION</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">16:48</span>
														</div>
													</div>
												</div>
												<a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
													<div class="section-header-left">
																<span class="section-title-wrapper">
																	<i class='uil uil-presentation-play crse_icon'></i>
																	<span class="section-title-text">Intermediate CSS</span>
																</span>
													</div>
													<div class="section-header-right">
														<span class="num-items-in-section">16 lectures</span>
														<span class="section-header-length">01.26:40</span>
													</div>
												</a>
												<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Unit Objectives</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">01.40</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Text and Fonts</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">09:55</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">More Text and Fonts</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">04:42</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Google Fonts</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:22</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Using Google Fonts</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">04:35</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Introduction to the Box Model</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">11:58</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Creating a Tic Tac Toe Board</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">01:41</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Creating a Tic Tac Toe Board: SOLUTION</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">07:43</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Image Gallery Code Along Pt. 1</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:20</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Image Gallery Code Along Pt. 1</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">08:20</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about changes to Google Fonts</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:40</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Image Gallery Code Along Pt. 2</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">05:46</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">CSS Blog From Scratch Exercise Intro</div>
															</div>
														</div>
														<div class="details">
															<a href="#" class="preview-text">Preview</a>
															<span class="content-summary">03:23</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">CSS Blog From Scratch Exercise SOLUTION Pt. 1</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">08:38</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">CSS Blog From Scratch Exercise SOLUTION Pt. 2</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">08:12</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">CSS Blog From Scratch Exercise SOLUTION Pt. 3</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">07:28</span>
														</div>
													</div>
												</div>
												<a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
													<div class="section-header-left">
																<span class="section-title-wrapper">
																	<i class='uil uil-presentation-play crse_icon'></i>
																	<span class="section-title-text">Bootstrap</span>
																</span>
													</div>
													<div class="section-header-right">
														<span class="num-items-in-section">16 lectures</span>
														<span class="section-header-length">01.59:54</span>
													</div>
												</a>
												<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Unit Objectives</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">02.28</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Bootstrap versions</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:44</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">What is Bootstrap?</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">08:02</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Adding Bootstrap to a Project</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">09:15</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Forms and Inputs</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">14:00</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Nav Bars</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">15:44</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about The Grid System</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:11</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">The Grid System</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">08:43</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Grid System Pt. 2</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">11:43</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Bootstrap Image Gallery Pt. 1</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:55</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Bootstrap Image Gallery Pt. 1</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">14:20</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Font Awesome</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:16</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Bootstrap Image Gallery Pt. 2</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">09:46</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Creating a Startup Landing Page Code Along</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">14:23</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Creating a Startup Landing Page Code Along Pt. 2</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">10:30</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about making bootstrap responsive on mobile devices</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:14</span>
														</div>
													</div>
												</div>
												<a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
													<div class="section-header-left">
																<span class="section-title-wrapper">
																	<i class='uil uil-presentation-play crse_icon'></i>
																	<span class="section-title-text">Bootstrap 4!</span>
																</span>
													</div>
													<div class="section-header-right">
														<span class="num-items-in-section">11 lectures</span>
														<span class="section-header-length">01.16:28
																</span>
													</div>
												</a>
												<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">A History of Bootstrap 4</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">04.40</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">The Bootstrap 4 Documentation</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">02:24</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Changes from Bootstrap 3 to 4</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">07:52</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Bootstrap 4 Code/Solutions Download</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:41</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Getting Started With Bootstrap 4</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">05:15</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Bootstrap 4 Colors and Backgrounds</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">05:59</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Typography</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">11:12</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">New Fancy Spacing Utilities</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">12:28</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Responsive Breakpoints</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">10:55</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Bootstrap4 Navbars</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">08:20</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">The New Display Utility</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">07:26</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Bootstrap 4: Flexbox and Layout</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">10:14</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Flexbox Utilities Part 2</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">07:23</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Navs and Flexbox</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">09:56</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">The Bootstrap 4 Grid</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">08:56</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">PATTERN PROJECT Part 1</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">12:06</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">PATTERN PROJECT Part 2</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">11:30</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">The Grid + Flexbox</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">11:44</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Museum of Candy Project Part 1</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">05:36</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Note about Museum of Candy Project Part 2</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">00:12</span>
														</div>
													</div>
												</div>
												<a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
													<div class="section-header-left">
																<span class="section-title-wrapper">
																	<i class='uil uil-presentation-play crse_icon'></i>
																	<span class="section-title-text">Introduction to JavaScript</span>
																</span>
													</div>
													<div class="section-header-right">
														<span class="num-items-in-section">12 lectures</span>
														<span class="section-header-length">56:21</span>
													</div>
												</a>
												<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Unit Objectives</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">04.41</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">The JavaScript Console</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">02:22</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Primitives</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">13:22</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-file icon_142'></i>
															<div class="top">
																<div class="title">Primitives Exercises</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">03:21</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Variables</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">06:15</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Null and Undefined</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">02:33</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Useful Built-In Methods</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">05:12</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Writing JavaScript in a Separate File</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">04:28</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">JS Stalker Exercise</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">01:55</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">JS Stalker Exercise: SOLUTION</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">04:45</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Age Calculator Exercise</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">01:10</span>
														</div>
													</div>
													<div class="lecture-container">
														<div class="left-content">
															<i class='uil uil-play-circle icon_142'></i>
															<div class="top">
																<div class="title">Age Calculator Exercise: SOLUTION</div>
															</div>
														</div>
														<div class="details">
															<span class="content-summary">04:01</span>
														</div>
													</div>
												</div>
											</div>
											<a class="btn1458" href="#">20 More Sections</a>
										</div>
									</div>
									<div class="tab-pane fade" id="nav-reviews" role="tabpanel">
										<div class="student_reviews">
											<div class="row">
												<div class="col-lg-5">
													<div class="reviews_left">
														<h3>Student Feedback</h3>
														<div class="total_rating">
															<div class="rating-box">
																<span class="rating-star full-star"></span>
																<span class="rating-star full-star"></span>
																<span class="rating-star full-star"></span>
																<span class="rating-star full-star"></span>
																<span class="rating-star half-star"></span>
															</div>
															<div class="_rate002">Course Rating</div>
														</div>
														<div class="_rate003">
															<div class="_rate004">
																<div class="progress progress1">
																	<div class="progress-bar w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
																<div class="rating-box">
																	<span class="rating-star full-star"></span>
																	<span class="rating-star full-star"></span>
																	<span class="rating-star full-star"></span>
																	<span class="rating-star full-star"></span>
																	<span class="rating-star full-star"></span>
																</div>
																<div class="_rate002">70%</div>
															</div>
															<div class="_rate004">
																<div class="progress progress1">
																	<div class="progress-bar w-30" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
																<div class="rating-box">
																	<span class="rating-star full-star"></span>
																	<span class="rating-star full-star"></span>
																	<span class="rating-star full-star"></span>
																	<span class="rating-star full-star"></span>
																	<span class="rating-star empty-star"></span>
																</div>
																<div class="_rate002">40%</div>
															</div>
															<div class="_rate004">
																<div class="progress progress1">
																	<div class="progress-bar w-5" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
																<div class="rating-box">
																	<span class="rating-star full-star"></span>
																	<span class="rating-star full-star"></span>
																	<span class="rating-star full-star"></span>
																	<span class="rating-star empty-star"></span>
																	<span class="rating-star empty-star"></span>
																</div>
																<div class="_rate002">5%</div>
															</div>
															<div class="_rate004">
																<div class="progress progress1">
																	<div class="progress-bar w-2" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
																<div class="rating-box">
																	<span class="rating-star full-star"></span>
																	<span class="rating-star full-star"></span>
																	<span class="rating-star empty-star"></span>
																	<span class="rating-star empty-star"></span>
																	<span class="rating-star empty-star"></span>
																</div>
																<div class="_rate002">1%</div>
															</div>
															<div class="_rate004">
																<div class="progress progress1">
																	<div class="progress-bar w-1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
																<div class="rating-box">
																	<span class="rating-star full-star"></span>
																	<span class="rating-star empty-star"></span>
																	<span class="rating-star empty-star"></span>
																	<span class="rating-star empty-star"></span>
																	<span class="rating-star empty-star"></span>
																</div>
																<div class="_rate002">1%</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="review_right">
														<div class="review_right_heading">
															<h3>Reviews</h3>
															<div class="review_search">
											 					<input class="rv_srch" type="text" placeholder="Search reviews...">
																<button class="rvsrch_btn"><i class='uil uil-search'></i></button>
															</div>
														</div>
													</div>
													<div class="review_all120 reviewHold">
                                                        @if(count($course->reviews) > 0)
                                                            @foreach($course->reviews as $key => $each_review)
														    <div class="review_item">
                                                                <div class="review_usr_dt">
                                                                    <img src="images/left-imgs/img-1.jpg" alt="">
                                                                    <div class="rv1458">
                                                                        <h4 class="tutor_name1" onmouseover="getRatingsForView('{{$course->unique_id}}', '{{$each_review->users->unique_id}}', '.hold_value{{$key}}')">{{$each_review->users->name}} {{$each_review->users->last_name}}</h4>
                                                                        <span class="time_145">{{$each_review->created_at->diffForHumans()}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="rating-box mt-20 hold_value{{$key}}">

                                                                </div>
															    <p class="rvds10">{{ucfirst($each_review->review_message)}}</p>
														    </div>
                                                            @endforeach
                                                            <div class="review_item">
                                                                <a href="#" class="more_reviews">See More Reviews</a>
                                                            </div>
                                                        @else
                                                            <div class="alert alert-danger text-center">NO Review For This Course</div>
                                                        @endif
													</div>
												</div>
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
