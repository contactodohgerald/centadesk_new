@php
    $current_page = 'Testimonies';
    $testimonies = 'active';
 @endphp
@include('includes.head')

@include('includes.header')

<!---page Title --->
<section class="bg-img pt-150 pb-20" data-overlay="7" style="background-image: url({{asset('front-end/images/front-end-img/background/bg-8.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">Testimonial</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Testimonial</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page content -->

<section class="py-50">
    <div class="container">
        <div class="row">
            <div class="box bg-transparent no-shadow">
                <div class="box-body">
                    <div class="owl-carousel owl-theme owl-btn-1" data-nav-arrow="true" data-nav-dots="false" data-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xx-items="1">
                        @if(count($testimonys) > 0)
                            @foreach($testimonys as $kk => $each_test)
                                <div class="item">
                                    <div class="text-center">
                                        <div class="max-w-750 mx-auto">
                                            <div class="testimonial-info">
                                                <h4 class="name mb-0 mt-10">{{$each_test->user_name}}</h4>
                                            </div>
                                            <div class="testimonial-content">
                                                <p class="font-size-16">{{$each_test->message}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>What people Say</h2>
                <hr>
            </div>
        </div>
        @if(count($testimonys) > 0)
            <div class="row">
                @foreach($testimonys as $kk => $each_test)
                    <div class="col-md-6 col-12">
                        <div class="testimonial-bx mb-30">
                            <div class="testimonial-info">
                                <h4 class="name">{{$each_test->user_name}}</h4>
                            </div>
                            <div class="testimonial-content">
                                <p class="font-size-16">{{$each_test->message}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="py-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Reviews</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel owl-theme owl-btn-1" data-nav-arrow="true" data-nav-dots="false" data-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xx-items="1">
                    <div class="item">
                        <div class="card card-body mb-0 mx-md-50 mx-20">
                            <div class="card-courses-title">
                                <h4 class="mb-20">Become a PHP Master and Make Money</h4>
                            </div>
                            <div class="card-courses-list-bx">
                                <ul class="card-courses-view">
                                    <li class="card-courses-user">
                                        <div class="card-courses-user-pic bg-primary-light">
                                            <img src="../images/front-end-img/avatar/4.jpg" alt="">
                                        </div>
                                        <div class="card-courses-user-info">
                                            <h5>Reviewer</h5>
                                            <h4>Keny White</h4>
                                        </div>
                                    </li>
                                    <li class="card-courses-review">
                                        <h5>3 Review</h5>
                                        <ul class="cours-star">
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </li>
                                    <li class="card-courses-categories">
                                        <h5>Date</h5>
                                        <h4>10/12/2019</h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="row card-courses-dec">
                                <div class="col-md-12">
                                    <h6 class="mb-10">Best Quality Product</h6>
                                    <p>Lorem ipsum dolor sit amet, est ei idque voluptua copiosae, pro detracto disputando reformidans at, ex vel suas eripuit. Vel alii zril maiorum ex, mea id sale eirmod epicurei. Sit te possit senserit, eam alia veritus maluisset ei, id cibo vocent ocurreret per. Te qui doming doctus referrentur, usu debet tamquam et. Sea ut nullam aperiam, mei cu tollit salutatus delicatissimi. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card card-body mb-0 mx-md-50 mx-20">
                            <div class="card-courses-title">
                                <h4 class="mb-20">Become a PHP Master and Make Money</h4>
                            </div>
                            <div class="card-courses-list-bx">
                                <ul class="card-courses-view">
                                    <li class="card-courses-user">
                                        <div class="card-courses-user-pic bg-primary-light">
                                            <img src="../images/front-end-img/avatar/1.jpg" alt="">
                                        </div>
                                        <div class="card-courses-user-info">
                                            <h5>Reviewer</h5>
                                            <h4>Keny White</h4>
                                        </div>
                                    </li>
                                    <li class="card-courses-review">
                                        <h5>3 Review</h5>
                                        <ul class="cours-star">
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </li>
                                    <li class="card-courses-categories">
                                        <h5>Date</h5>
                                        <h4>10/12/2019</h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="row card-courses-dec">
                                <div class="col-md-12">
                                    <h6 class="mb-10">Best Quality Product</h6>
                                    <p>Lorem ipsum dolor sit amet, est ei idque voluptua copiosae, pro detracto disputando reformidans at, ex vel suas eripuit. Vel alii zril maiorum ex, mea id sale eirmod epicurei. Sit te possit senserit, eam alia veritus maluisset ei, id cibo vocent ocurreret per. Te qui doming doctus referrentur, usu debet tamquam et. Sea ut nullam aperiam, mei cu tollit salutatus delicatissimi. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card card-body mb-0 mx-md-50 mx-20">
                            <div class="card-courses-title">
                                <h4 class="mb-20">Become a PHP Master and Make Money</h4>
                            </div>
                            <div class="card-courses-list-bx">
                                <ul class="card-courses-view">
                                    <li class="card-courses-user">
                                        <div class="card-courses-user-pic bg-primary-light">
                                            <img src="../images/front-end-img/avatar/3.jpg" alt="">
                                        </div>
                                        <div class="card-courses-user-info">
                                            <h5>Reviewer</h5>
                                            <h4>Keny White</h4>
                                        </div>
                                    </li>
                                    <li class="card-courses-review">
                                        <h5>3 Review</h5>
                                        <ul class="cours-star">
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </li>
                                    <li class="card-courses-categories">
                                        <h5>Date</h5>
                                        <h4>10/12/2019</h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="row card-courses-dec">
                                <div class="col-md-12">
                                    <h6 class="mb-10">Best Quality Product</h6>
                                    <p>Lorem ipsum dolor sit amet, est ei idque voluptua copiosae, pro detracto disputando reformidans at, ex vel suas eripuit. Vel alii zril maiorum ex, mea id sale eirmod epicurei. Sit te possit senserit, eam alia veritus maluisset ei, id cibo vocent ocurreret per. Te qui doming doctus referrentur, usu debet tamquam et. Sea ut nullam aperiam, mei cu tollit salutatus delicatissimi. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('includes.footer')


@include('includes.e_script')

