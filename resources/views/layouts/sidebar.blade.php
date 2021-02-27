@php
$user_type = auth()->user()->user_type;
 $condition = [
    ['status', 'pending'],
    ['ignore_status', 'no'],
 ];
$complain = new \App\Model\AccountResolve();
$complains = $complain->getAllOfComplain($condition);

$conditions = [
    ['status', 'pending'],
];
$verifications = new \App\Model\KycVerification();
$verifications_count = $verifications->getAllKycVerification($conditions);
@endphp
<nav class="vertical_nav">
    <div class="left_section menu_left" id="js-menu" >
        <div class="left_section">
            <ul>
                <li class="menu--item">
                    <a href="{{route('home')}}" class="menu--link <?php print @$home;?>" title="Home">
                        <i class='uil uil-home-alt menu--icon'></i>
                        <span class="menu--label">Home</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{route('profile')}}" class="menu--link <?php print @$profile;?>" title="Profile">
                        <i class='uil uil-user-circle menu--icon'></i>
                        <span class="menu--label">Profile</span>
                    </a>
                </li>
                @if(auth()->user()->privilegeChecker('teachers_view'))
                    <li class="menu--item">
                        <a href="{{route('kyc_verification')}}" class="menu--link <?php print @$profile;?>" title="Profile">
                            <i class='uil uil-comment-verify menu--icon'></i>
                            <span class="menu--label">KYC Verification</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                <li class="menu--item menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$Price;?>" title="Price">
                        <i class='uil uil-money-bill menu--icon'></i>
                        <span class="menu--label">Course Price</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('create_price')}}" class="sub_menu--link">Create Price</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="{{route('view_price')}}" class="sub_menu--link">View Prices</a>
                        </li>
                    </ul>
                </li>
                <li class="menu--item menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$Categories;?>" title="Categories">
                        <i class='uil uil-layers menu--icon'></i>
                        <span class="menu--label">Course Categories</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('create_category')}}" class="sub_menu--link">Create Categories</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="{{route('view_category')}}" class="sub_menu--link">View Categories</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(auth()->user()->privilegeChecker('view_add_courses'))
                <li class="menu--item menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$Course;?>" title="Categories">
                        <i class='uil uil-plus-circle menu--icon'></i>
                        <span class="menu--label">Courses</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="/create-course" class="sub_menu--link">Create</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="/view-courses" class="sub_menu--link">View All</a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="menu--item">
                    <a href="{{route('explore')}}" class="menu--link <?php print @$explore;?>" title="Explore">
                        <i class='uil uil-search menu--icon'></i>
                        <span class="menu--label">Explore</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{route('saved-course')}}" class="menu--link <?php print @$saveCourse;?>" title="Saved Courses">
                        <i class="uil uil-heart-alt menu--icon"></i>
                        <span class="menu--label">Saved Courses</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{route('browse_instructor')}}" class="menu--link <?php print @$instructor?>" title="Browse Instructors">
                        <i class='uil uil-asterisk menu--icon'></i>
                        <span class="menu--label">Browse Instructors</span>
                    </a>
                </li>
                @if(auth()->user()->privilegeChecker('teachers_view'))
                <li class="menu--item">
                    <a href="{{route('browse_subscribers')}}" class="menu--link <?php print @$instructor?>" title="Subscribers">
                        <i class='uil uil-anchor menu--icon'></i>
                        <span class="menu--label">View Subscribers</span>
                    </a>
                </li>
                @endif
                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$Wallet;?>" title="Wallet">
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
                    <label class="menu--link <?php print @$Withdrawal;?>" title="Wallet">
                        <i class='uil uil-money-withdraw menu--icon'></i>
                        <span class="menu--label">Withdrawal</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('withdrawals')}}" class="sub_menu--link">Funds Withdrawal</a>
                        </li>
                    </ul>
                </li>
                @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$Users;?>" title="Users">
                        <i class='uil uil-user menu--icon'></i>
                        <span class="menu--label">Users</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('all_students')}}" class="sub_menu--link">Students</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="{{route('all_instructor')}}" class="sub_menu--link">Teachers / Instructors</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
        <div class="left_section pt-2">
            <ul>
                @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                <li class="menu--item">
                    <a href="{{route('complain_list')}}" class="menu--link <?php print @$Complain;?>" title="Complains">
                        <i class='uil uil-auto-flash menu--icon'></i>
                        <span class="menu--label">Complains <span class="noti_count">{{$complains->count()}}</span></span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{route('verify_kyc')}}" class="menu--link <?php print @$KYC;?>" title="KYC Verification">
                        <i class='uil uil-comment-alt-verify menu--icon'></i>
                        <span class="menu--label">KYC Verifications <span class="noti_count">{{$verifications_count->count()}}</span></span>
                    </a>
                </li>
                @endif
                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$Setting;?>" title="Setting">
                        <i class='uil uil-cog menu--icon'></i>
                        <span class="menu--label">Setting </span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('main_settings_page')}}" class="sub_menu--link">Main Setting</a>
                        </li>
                        @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                        <li class="sub_menu--item">
                            <a href="{{route('app_settings_page')}}" class="sub_menu--link">App Setting</a>
                        </li>
                        @endif
                    </ul>
                </li>

                @if(auth()->user()->privilegeChecker('view_roles'))
                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link" title="Setting">
                        <i class='uil uil-cog menu--icon'></i>
                        <span class="menu--label">Roles Management </span>
                    </label>
                    <ul class="sub_menu">

                        <li class="sub_menu--item"><a href="{{route('add_roles')}}"><span class="mini-sub-pro">Add New Roles</span></a></li>
                        <li class="sub_menu--item"><a href="{{route('add_user_type')}}"><span class="mini-sub-pro">Add User type</span></a></li>
                        <li class="sub_menu--item"><a href="{{route('view_all_roles')}}"><span class="mini-sub-pro">View Roles</span></a></li>
                        <li class="sub_menu--item"><a href="{{route('all_user_type')}}"><span class="mini-sub-pro">View User Types</span></a></li>
                    </ul>
                </li>
                @endif
                <li class="menu--item">
                    <a href="javascript:void(0)" onclick="bringOutModalMain('.logout')" class="menu--link" title="Sign Out">
                        <i class='uil uil-sign-out-alt menu--icon'></i>
                        <span class="menu--label">Sign Out </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="left_footer">
            <div class="left_footer_content">
                <p>© @php $d=date('Y'); print $d;@endphp <strong>{{env('APP_NAME')}}</strong>. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</nav>
