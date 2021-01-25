@php
$user_type = auth()->user()->user_type;
@endphp
<nav class="vertical_nav">
    <div class="left_section menu_left" id="js-menu" >
        <div class="left_section">
            <ul>
                <li class="menu--item">
                    <a href="index.html" class="menu--link active" title="Home">
                        <i class='uil uil-home-alt menu--icon'></i>
                        <span class="menu--label">Home</span>
                    </a>
                </li>
                <li class="menu--item menu--item__has_sub_menu">
                    <label class="menu--link" title="Categories">
                        <i class='uil uil-layers menu--icon'></i>
                        <span class="menu--label">Course</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="create-course" class="sub_menu--link">Create</a>
                        </li>
                    </ul>
                </li>
                <li class="menu--item">
                    <a href="live_streams.html" class="menu--link" title="Live Streams">
                        <i class='uil uil-kayak menu--icon'></i>
                        <span class="menu--label">Live Streams</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="explore.html" class="menu--link" title="Explore">
                        <i class='uil uil-search menu--icon'></i>
                        <span class="menu--label">Explore</span>
                    </a>
                </li>
                <li class="menu--item menu--item__has_sub_menu">
                    <label class="menu--link" title="Categories">
                        <i class='uil uil-layers menu--icon'></i>
                        <span class="menu--label">Categories</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="#" class="sub_menu--link">Development</a>
                        </li>

                    </ul>
                </li>
                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link" title="Wallet">
                        <i class='uil uil-wallet menu--icon'></i>
                        <span class="menu--label">Wallet</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('my_balance')}}" class="sub_menu--link">My Wallet</a>
                        </li>
                    </ul>
                </li>
                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link" title="Wallet">
                        <i class='uil uil-money-withdraw menu--icon'></i>
                        <span class="menu--label">Withdrawal</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('withdrawals')}}" class="sub_menu--link">Funds Withdrawal</a>
                        </li>
                    </ul>
                </li>
                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link" title="Tests">
                        <i class='uil uil-clipboard-alt menu--icon'></i>
                        <span class="menu--label">Tests</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="certification_center.html" class="sub_menu--link">Certification Center</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="certification_start_form.html" class="sub_menu--link">Certification Fill Form</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="certification_test_view.html" class="sub_menu--link">Test View</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="certification_test__result.html" class="sub_menu--link">Test Result</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="http://www.gambolthemes.net/html-items/edututs+/Instructor_Dashboard/my_certificates.html" class="sub_menu--link">My Certification</a>
                        </li>
                    </ul>
                </li>
                <li class="menu--item">
                    <a href="saved_courses.html" class="menu--link" title="Saved Courses">
                        <i class="uil uil-heart-alt menu--icon"></i>
                        <span class="menu--label">Saved Courses</span>
                    </a>
                </li>
                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link" title="Pages">
                        <i class='uil uil-file menu--icon'></i>
                        <span class="menu--label">Pages</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="about_us.html" class="sub_menu--link">About</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="sign_in.html" class="sub_menu--link">Sign In</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="sign_up.html" class="sub_menu--link">Sign Up</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="sign_up_steps.html" class="sub_menu--link">Sign Up Steps</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="membership.html" class="sub_menu--link">Paid Membership</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="course_detail_view.html" class="sub_menu--link">Course Detail View</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="checkout_membership.html" class="sub_menu--link">Checkout</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="invoice.html" class="sub_menu--link">Invoice</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="career.html" class="sub_menu--link">Career</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="apply_job.html" class="sub_menu--link">Job Apply</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="our_blog.html" class="sub_menu--link">Our Blog</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="blog_single_view.html" class="sub_menu--link">Blog Detail View</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="company_details.html" class="sub_menu--link">Company Details</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="press.html" class="sub_menu--link">Press</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="live_output.html" class="sub_menu--link">Live Stream View</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="add_streaming.html" class="sub_menu--link">Add live Stream</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="search_result.html" class="sub_menu--link">Search Result</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="thank_you.html" class="sub_menu--link">Thank You</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="coming_soon.html" class="sub_menu--link">Coming Soon</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="error_404.html" class="sub_menu--link">Error 404</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="left_section pt-2">
            <ul>
                @if($user_type === 'admin' || $user_type === 'super_admin')
                    <li class="menu--item  menu--item__has_sub_menu">
                        <label class="menu--link" title="Setting">
                            <i class='uil uil-cog menu--icon'></i>
                            <span class="menu--label">Setting</span>
                        </label>
                        <ul class="sub_menu">
                            <li class="sub_menu--item">
                                <a href="{{route('main_settings_page')}}" class="sub_menu--link">Main Setting</a>
                            </li>
                            <li class="sub_menu--item">
                                <a href="{{route('app_settings_page')}}" class="sub_menu--link">App Setting</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="menu--item">
                        <a href="{{route('main_settings_page')}}" class="menu--link" title="Setting">
                            <i class='uil uil-cog menu--icon'></i>
                            <span class="menu--label">Setting</span>
                        </a>
                    </li>
                @endif
                <li class="menu--item">
                    <a href="javascript:void(0)" onclick="bringOutModalMain('.logout')" class="menu--link" title="Sign Out">
                        <i class='uil uil-sign-out-alt menu--icon'></i>
                        <span class="menu--label">Sign Out</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="help.html" class="menu--link" title="Help">
                        <i class='uil uil-question-circle menu--icon'></i>
                        <span class="menu--label">Help</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="report_history.html" class="menu--link" title="Report History">
                        <i class='uil uil-windsock menu--icon'></i>
                        <span class="menu--label">Report History</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="feedback.html" class="menu--link" title="Send Feedback">
                        <i class='uil uil-comment-alt-exclamation menu--icon'></i>
                        <span class="menu--label">Send Feedback</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="left_footer">
            <ul>
                <li><a href="about_us.html">About</a></li>
                <li><a href="press.html">Press</a></li>
                <li><a href="contact_us.html">Contact Us</a></li>
                <li><a href="coming_soon.html">Advertise</a></li>
                <li><a href="coming_soon.html">Developers</a></li>
                <li><a href="terms_of_use.html">Copyright</a></li>
                <li><a href="terms_of_use.html">Privacy Policy</a></li>
                <li><a href="terms_of_use.html">Terms</a></li>
            </ul>
            <div class="left_footer_content">
                <p>© 2020 <strong>Cursus</strong>. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</nav>
