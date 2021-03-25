@php

$categories = new \App\course_category_model;
$categories_list = $categories->getAllCategories();

$appSettings = new \App\Model\AppSettings();
$site_logo = $appSettings->getSingleModel();

@endphp
    <!-- ajax loader -->
    <div style="display: none;" id="the_load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!-- ajax loader -->

<header class="header clearfix">
    <button type="button" id="toggleMenu" class="toggle_menu">
        <i class='uil uil-bars'></i>
    </button>
    <button id="collapse_menu" class="collapse_menu">
        <i class="uil uil-bars collapse_menu--icon "></i>
        <span class="collapse_menu--label"></span>
    </button>
    <div class="main_logo" id="logo">
        <a href="/">
            <img src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{env('APP_NAME')}}">
        </a>
        <a href="/">
            <img class="logo-inverse" src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{env('APP_NAME')}}">
        </a>
    </div>
    <div class="top-category">
        <div class="ui compact menu cate-dpdwn">
            <div class="ui simple dropdown item">
                <a href="#" class="option_links p-0" title="categories"><i class="uil uil-apps"></i></a>
                <div class="menu dropdown_category5">
                    @if($categories_list->count() > 0)
                        @foreach($categories_list as $each_categories)
                            <a href="{{route('category-explore', $each_categories->unique_id)}}" class="item channel_item">{{$each_categories->name}}</a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="search120">
        <div class="ui search">
            <div class="ui left icon input swdh10">
                <input class="prompt srch10" type="text" placeholder="Search for Tuts Videos, Tutors, Tests and more..">
                <i class='uil uil-search-alt icon icon1'></i>
            </div>
        </div>
    </div>
    <div class="header_right">
        <ul>
            <li>
                <a href="/create-course" class="upload_btn" title="Create New Course">Create New Course</a>
            </li>
            <li class="ui dropdown">
                <a href="#" class="option_links" title="Notifications"><i class='uil uil-bell'></i><span class="noti_count">3</span></a>
                <div class="menu dropdown_mn">
                    <a href="#" class="channel_my item">
                        <div class="profile_link">
                            <img src="images/left-imgs/img-1.jpg" alt="">
                            <div class="pd_content">
                                <h6>Rock William</h6>
                                <p>Like Your Comment On Video <strong>How to create sidebar menu</strong>.</p>
                                <span class="nm_time">2 min ago</span>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="channel_my item">
                        <div class="profile_link">
                            <img src="images/left-imgs/img-2.jpg" alt="">
                            <div class="pd_content">
                                <h6>Jassica Smith</h6>
                                <p>Added New Review In Video <strong>Full Stack PHP Developer</strong>.</p>
                                <span class="nm_time">12 min ago</span>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="channel_my item">
                        <div class="profile_link">
                            <img src="images/left-imgs/img-9.jpg" alt="">
                            <div class="pd_content">
                                <p> Your Membership Approved <strong>Upload Video</strong>.</p>
                                <span class="nm_time">20 min ago</span>
                            </div>
                        </div>
                    </a>
                    <a class="vbm_btn" href="instructor_notifications.html">View All <i class='uil uil-arrow-right'></i></a>
                </div>
            </li>
            <li class="ui dropdown">
                <a href="#" class="opts_account" title="Account">
                    <img src="{{asset(auth()->user()->returnLink().'/profile/'.auth()->user()->profile_image)}}" alt="">
                </a>
                <div class="menu dropdown_account">
                    <div class="channel_my">

                        <div class="profile_link">
                            <img src="{{asset(auth()->user()->returnLink().'/profile/'.auth()->user()->profile_image)}}" alt="">
                            <div class="pd_content">
                                <div class="rhte85">
                                    <h6 class="text-capitalize">{{auth()->user()->name}} {{auth()->user()->last_name}}</h6>
                                    @if (auth()->user()->verified_badge == 'yes')
                                    <div class="mef78" title="Verified">
                                        <i class='uil uil-check-circle'></i>
                                    </div>
                                    @endif
                                </div>
                                <span>{{auth()->user()->email}}</span>
                            </div>
                        </div>
                        <a href="{{route('profile')}}" class="dp_link_12">View Profile</a>
                    </div>
                    <div class="night_mode_switch__btn">
                        <a href="#" id="night-mode" class="btn-night-mode font-poppins">
                            <i class="uil uil-moon"></i> Night mode
                            <span class="btn-night-mode-switch">
									<span class="uk-switch-button"></span>
								</span>
                        </a>
                    </div>
                    <a href="{{route('main_settings_page')}}" class="item channel_item">Account Settings</a>
                    <a class="item channel_item" href="javascript:void(0)" onclick="bringOutModalMain('.logout')">Sign Out</a>
                </div>
            </li>
        </ul>
    </div>
</header>
