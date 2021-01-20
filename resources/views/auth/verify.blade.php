@php $pageTitle = 'Verification Area'; @endphp
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
                <h2>Verify Your Email Address'</h2>

                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
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