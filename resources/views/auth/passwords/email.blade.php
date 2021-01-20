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
                <h2>Request a Password Reset</h2>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="ui search focus mt-50">
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
                    <button class="login-btn" type="submit">Send Password Reset Link</button>
                </form>
                <p class="mb-0 mt-30">Go Back <a href="{{route('login')}}">Sign In</a></p>
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