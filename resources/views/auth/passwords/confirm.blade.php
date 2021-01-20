@php $pageTitle = 'Forget Password Area'; @endphp
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from gambolthemes.net/html-items/cursus_demo_f12/forgot_password.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Aug 2020 17:45:59 GMT -->
@include('layouts.head_auth')

<body class="sign_in_up_bg">
<!-- Signup Start -->
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
                <h2>Confirm Password</h2>

                {{ __('Please confirm your password before continuing.') }}

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="ui search focus mt-50">
                        <div class="ui left icon input swdh95">
                            <input id="password" type="password" class="prompt srch_explore @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus placeholder="Password">
                            <i class="uil uil-envelope icon icon2"></i>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <button class="login-btn" type="submit">Confirm Password</button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </form>
            </div>

            @include('layouts.footer_auth')

        </div>
    </div>
</div>
<!-- Signup End -->

@include('layouts.e_script_auth')

</body>

<!-- Mirrored from gambolthemes.net/html-items/cursus_demo_f12/forgot_password.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Aug 2020 17:45:59 GMT -->
</html>