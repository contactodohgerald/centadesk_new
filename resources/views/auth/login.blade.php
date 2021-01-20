@php $pageTitle = 'Login Area'; @endphp
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from gambolthemes.net/html-items/cursus_demo_f12/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Aug 2020 17:44:30 GMT -->
@include('layouts.head_auth')

<body>
<!-- Signup Start -->
<div class="sign_in_up_bg">
    <div class="container">
        <div class="row justify-content-lg-center justify-content-md-center">
            <div class="col-lg-12">
                <div class="main_logo25" id="logo">
                    <a href="/">
                        <img src="{{asset('dashboard/images/logo.svg')}}" alt="">
                    </a>
                    <a href="/">
                        <img class="logo-inverse" src="{{asset('dashboard/images/ct_logo.svg')}}" alt="">
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-md-8">
                <div class="sign_form">
                    <h2>Welcome Back</h2>
                    <p>Log In to Your {{env('APP_NAME')}} Account!</p>
                  {{--  <button class="social_lnk_btn color_btn_fb"><i class="uil uil-facebook-f"></i>Continue with Facebook</button>
                    <button class="social_lnk_btn mt-15 color_btn_tw"><i class="uil uil-twitter"></i>Continue with Twitter</button>
                    <button class="social_lnk_btn mt-15 color_btn_go"><i class="uil uil-google"></i>Continue with Google</button>--}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="ui search focus mt-15">
                            <div class="ui left icon input swdh95">
                                <input id="email" type="email" class="prompt srch_explore @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                                <i class="uil uil-envelope icon icon2"></i>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="ui search focus mt-15">
                            <div class="ui left icon input swdh95">
                                <input id="password" type="password" class="prompt srch_explore @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                <i class="uil uil-key-skeleton-alt icon icon2"></i>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="ui form mt-30 checkbox_sign">
                            <div class="inline field">
                                <div class="ui checkbox mncheck">
                                    <input type="checkbox" tabindex="0" class="hidden">
                                    <label>Remember Me</label>
                                </div>
                            </div>
                        </div>
                        <button class="login-btn" type="submit">Sign In</button>
                    </form>
                    <p class="sgntrm145">Or
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>.
                        @endif
                    </p>
                    <p class="mb-0 mt-30 hvsng145">Don't have an account? <a href="{{route('register')}}">Sign Up</a></p>
                </div>

                @include('layouts.footer_auth')

            </div>
        </div>
    </div>
</div>
<!-- Signup End -->

@include('layouts.e_script_auth')

</body>

<!-- Mirrored from gambolthemes.net/html-items/cursus_demo_f12/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Aug 2020 17:44:30 GMT -->
</html>