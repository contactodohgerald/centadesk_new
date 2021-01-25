@php $pageTitle = 'Home Area'; @endphp
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
			<div class="container">
				<div class="row">
					<div class="col-12">
						{{-- <div class="course_tabs_1"> --}}
							<div id="add-course-tab" class="step-app">
<form action="create-course" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="step-content">
        <div class="step-tab-panel step-tab-info active" id="tab_step1">
            <div class="tab-from-content">
                <div class="title-icon">
                    <h3 class="title"><i class="uil uil-info-circle"></i>Course Details</h3>
                </div>
                <div class="course__form">
                    <div class="general_info10">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="ui search focus mt-30 lbel25">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <div class="ui left icon input swdh19">
                                        <input class="prompt srch_explore" type="text" placeholder="Insert your course title." name="title" data-purpose="edit-course-title" maxlength="60" id="main[title]" value="">
                                        <div class="badge_num">60</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="mt-30 lbel25">
                                    <label>Category <span class="text-danger">*</span></label>
                                </div>
                                <select name="category" class="ui hj145 dropdown cntry152 prompt srch_explore">
                                    <option value="">Select</option>
                                    <option value="0">Free</option>
                                    <option value="1">$24.99 (tier 1)</option>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="course_des_textarea mt-30 lbel25">
                                    <label>Course Description*</label>
                                    <div class="course_des_bg">
                                        <ul class="course_des_ttle">
                                            <li><a href="#"><i class="uil uil-bold"></i></a></li>
                                            <li><a href="#"><i class="uil uil-italic"></i></a></li>
                                            <li><a href="#"><i class="uil uil-list-ul"></i></a></li>
                                            <li><a href="#"><i class="uil uil-left-to-right-text-direction"></i></a></li>
                                            <li><a href="#"><i class="uil uil-right-to-left-text-direction"></i></a></li>
                                            <li><a href="#"><i class="uil uil-list-ui-alt"></i></a></li>
                                            <li><a href="#"><i class="uil uil-link"></i></a></li>
                                            <li><a href="#"><i class="uil uil-text-size"></i></a></li>
                                            <li><a href="#"><i class="uil uil-text"></i></a></li>
                                        </ul>
                                        <div class="textarea_dt">
                                            <div class="ui form swdh339">
                                                <div class="field">
                                                    <textarea rows="5" name="description" id="id_course_description" placeholder="Insert your course description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="price_course">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="price_title">
                                    <h4><i class="uil uil-dollar-sign-alt"></i>Pricing</h4>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6">
                                <div class="mt-30 lbel25">
                                    <label>Currency*</label>
                                </div>
                                <select class="ui hj145 dropdown cntry152 prompt srch_explore">
                                    <option value="">USD</option>
                                    <option value="1">USD</option>
                                    <option value="2">CAD</option>
                                    <option value="3">BRL</option>
                                    <option value="4">EUR</option>
                                    <option value="5">GBP</option>
                                    <option value="6">INR</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="mt-30 lbel25">
                                    <label>Select*</label>
                                </div>
                                <select class="ui hj145 dropdown cntry152 prompt srch_explore">
                                    <option value="">Select</option>
                                    <option value="0">Free</option>
                                    <option value="1">$24.99 (tier 1)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-tab-panel step-tab-gallery" id="tab_step2">
            <div class="tab-from-content">
                <div class="title-icon">
                    <h3 class="title"><i class="uil uil-image-upload"></i>View</h3>
                </div>
                <div class="course__form">
                    <div class="view_info10">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="view_all_dt">
                                    <div class="view_img_left">
                                        <div class="view__img">
                                            <img src="images/courses/add_img.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="view_img_right">
                                        <h4>Cover Image</h4>
                                        <p>Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.</p>
                                        <div class="upload__input">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile04">
                                                    <label class="custom-file-label" for="inputGroupFile04">No Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="view_all_dt">
                                    <div class="view_img_left">
                                        <div class="view__img">
                                            <img src="images/courses/add_video.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="view_img_right">
                                        <h4>Promotional Video</h4>
                                        <p>Students who watch a well-made promo video are 5X more likely to enroll in your course. We've seen that statistic go up to 10X for exceptionally awesome videos. Learn how to make yours awesome!</p>
                                        <div class="upload__input">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile05">
                                                    <label class="custom-file-label" for="inputGroupFile05">No Choose file</label>
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

        {{-- <div class="step-tab-panel step-tab-amenities" id="tab_step4">
            <div class="tab-from-content">
                <div class="title-icon">
                    <h3 class="title"><i class="uil uil-file-copy-alt"></i>Extra Information</h3>
                </div>
               <div class="course__form">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="extra_info">
                                <h4 class="part__title">Captions</h4>
                            </div>
                            <div class="view_info10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="caption__check mt-30">
                                            <div class="ui form">
                                                <div class="grouped fields">
                                                    <div class="ui form checkbox_sign cp_458">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="checkbox" tabindex="0" class="hidden">
                                                                <label>English<span class="filter__counter">(300)</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign cp_458">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="checkbox" tabindex="0" class="hidden">
                                                                <label>Español<span class="filter__counter">(210)</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign cp_458">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="checkbox" tabindex="0" class="hidden">
                                                                <label>Português<span class="filter__counter">(170)</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign cp_458">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="checkbox" tabindex="0" class="hidden">
                                                                <label>Italiano<span class="filter__counter">(174)</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign cp_458">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="checkbox" tabindex="0" class="hidden">
                                                                <label>Français<span class="filter__counter">(120)</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign cp_458">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="checkbox" tabindex="0" class="hidden">
                                                                <label>Polski<span class="filter__counter">(130)</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign cp_458">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="checkbox" tabindex="0" class="hidden">
                                                                <label>Deutsch<span class="filter__counter">(30)</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign cp_458">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="checkbox" tabindex="0" class="hidden">
                                                                <label>Bahasa Indonesia<span class="filter__counter">(20)</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign cp_458">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="checkbox" tabindex="0" class="hidden">
                                                                <label>ภาษาไทย<span class="filter__counter">(10)</span></label>
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
                </div>
             </div>
        </div> --}}

    </div>
    <button type="submit" class="btn btn-default steps_btn">Submit for Review</button>
</form>

								<div class="step-footer step-tab-pager">
								</div>
							</div>
                        {{-- </div> --}}
                    </div>
				</div>
			</div>
		</div>

		@include('layouts.footer')
	</div>
	<!-- Body End -->

@include('layouts.e_script')
