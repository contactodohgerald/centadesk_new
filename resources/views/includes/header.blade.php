<body class="theme-primary">

<!-- The social media icon bar -->
<div class="icon-bar-sticky">
    <a href="#" class="waves-effect waves-light btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
    <a href="#" class="waves-effect waves-light btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
    <a href="#" class="waves-effect waves-light btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
    <a href="#" class="waves-effect waves-light btn btn-social-icon btn-youtube"><i class="fa fa-youtube-play"></i></a>
</div>

<header class="top-bar">
    <div class="topbar">

        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-6 col-12 d-lg-block d-none">
                    <div class="topbar-social text-center text-md-left topbar-left">
                        <ul class="list-inline d-md-flex d-inline-block">
{{--                            <li class="ml-10 pr-10"><a href="#"><i class="text-white fa fa-question-circle"></i> Ask a Question</a></li>--}}
                            <li class="ml-10 pr-10"><a href="#"><i class="text-white fa fa-envelope"></i> info@EduAdmin.com</a></li>
                            <li class="ml-10 pr-10"><a href="#"><i class="text-white fa fa-phone"></i> +(1) 123-878-1649</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-12 xs-mb-10">
                    <div class="topbar-call text-center text-lg-right topbar-right">
                        <ul class="list-inline d-lg-flex justify-content-end">
<!--                            <li class="mr-10 pl-10 lng-drop">
                                <select class="header-lang-bx selectpicker">
                                    <option>USD</option>
                                    <option>EUR</option>
                                    <option>GBP</option>
                                    <option>INR</option>
                                </select>
                            </li>
                            <li class="mr-10 pl-10 lng-drop">
                                <select class="header-lang-bx selectpicker">
                                    <option data-icon="flag-icon flag-icon-us">Eng USA</option>
                                    <option data-icon="flag-icon flag-icon-gb">Eng UK</option>
                                </select>
                            </li>-->
                            @if (Route::has('login'))
                                <div class="top-right links">
                                    @auth
                                        <li class="mr-10 pl-10">
                                            <a href="{{ url('/home') }}"><i class="text-white fa fa-dashboard d-md-inline-block d-none"></i> Dashboard</a>
                                        </li>
                                    @else
                                        <li class="mr-10 pl-10">
                                            <a href="{{ route('login') }}"><i class="text-white fa fa-sign-in d-md-inline-block d-none"></i> Login</a>
                                        </li>

                                        @if (Route::has('register'))
                                            <li class="mr-10 pl-10">
                                                <a href="{{ route('register') }}"><i class="text-white fa fa-user d-md-inline-block d-none"></i> Register</a>
                                            </li>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav hidden class="nav-white nav-transparent">
        <div class="nav-header">
            <a href="/" class="brand">
                <img src="{{asset('front-end/images/logo-light-text2.png')}}" alt="{{env('APP_NAME')}}"/>
            </a>
            <button class="toggle-bar">
                <span class="ti-menu"></span>
            </button>
        </div>
        <ul class="menu">
            <li class="<?php print @$index?>">
                <a href="/">Home</a>
            </li>
            <li class="<?php print @$about?>">
                <a href="{{route('about')}}">About Us</a>
            </li>
            <li>
                <a href="{{route('faq')}}">Career</a>
            </li>
            <li class="dropdown <?php print @$courses?>">
                <a href="#">Courses</a>
                <ul class="dropdown-menu">
                    <li><a href="{{route('list-courses')}}">Courses List</a></li>
                    <li><a href="{{route('categories')}}">Categories</a></li>
                </ul>
            </li>
            <li>
                <a href="{{route('faq')}}">Testimonies</a>
            </li>
            <li>
                <a href="{{route('faq')}}">Gallery(Events)</a>
            </li>
            <li>
                <a href="{{route('faq')}}">How it works</a>
            </li>
            <li>
                <a href="{{route('faq')}}">Blog</a>
            </li>
            <li class="<?php print @$faq?>">
                <a href="{{route('faq')}}">FAQs</a>
            </li>
            <li class="<?php print @$contact?>">
                <a href="{{route('contact')}}">Contact Us</a>
            </li>
        </ul>
        <div class="wrap-search-fullscreen">
            <div class="container">
                <button class="close-search"><span class="ti-close"></span></button>
                <input type="text" placeholder="Search..." />
            </div>
        </div>
    </nav>
</header>
