@php
    $current_page = 'Contact';
    $courses = 'active';
 @endphp
@include('includes.head')

@include('includes.header')

<!---page Title --->
<section class="bg-img pt-150 pb-20" data-overlay="7" style="background-image: url({{asset('front-end/images/front-end-img/background/bg-8.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">Contact us</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Contact us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page content -->

<section class="py-50">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 col-12">
                <form class="contact-form" action="{{route('contact-mail')}}" method="post">
                    @csrf
                    <div class="text-left mb-30">
                        <h2>Get In Touch</h2>
                    </div>
                    @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <i class="fa fa-envelope-o mr-2"></i>
                            {{ Session::get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @elseif(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            <i class="fa fa-envelope-o mr-2"></i>
                            {{ Session::get('error_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="full_name" placeholder="Full Name (Optional)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" required placeholder="Your Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone (Optional)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" required placeholder="Subject">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea name="message" rows="5" class="form-control" required placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button name="submit" type="submit" value="Submit" class="btn btn-primary"> Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5 col-12 mt-30 mt-md-0">
                <div class="box box-body p-40 bg-dark mb-0">
                    <h2 class="box-title text-white">Contact Info</h2>
                    <div class="widget font-size-18 my-20 py-20 by-1 border-light">
                        <ul class="list list-unstyled text-white-80">
                            <li class="pl-40"><i class="ti-location-pin"></i>{{$appSettings->company_address}}</li>
                            <li class="pl-40 my-20"><i class="ti-mobile"></i>{{$appSettings->company_phone_1}}</li>
                            <li class="pl-40"><i class="ti-email"></i>{{$appSettings->company_email_1}}</li>
                        </ul>
                    </div>
                    <h4 class="mb-20">Follow Us</h4>
                    <ul class="list-unstyled d-flex gap-items-1">
                        <li><a href="https://facebook.com/{{ $appSettings->facebook_url }}" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/{{ $appSettings->twitter_url }}" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.youtube.com/{{ $appSettings->youtube_url }}" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-youtube"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="row">
        <div class="col-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30596552044!2d-74.25986763304465!3d40.69714941412697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1537364999769" class="map" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
</section>

@include('includes.footer')


@include('includes.e_script')

