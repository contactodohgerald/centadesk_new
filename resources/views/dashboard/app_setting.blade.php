﻿@php
$pageTitle = 'App Settings Area';
$Setting = 'active';
@endphp
@include('layouts.head')

<body>
    <!-- Header Start -->
    @include('layouts.header')
    <!-- Header End -->

    <!-- Left Sidebar Start -->
    @include('layouts.sidebar')
    <!-- Left Sidebar End -->

    <!-- Body Start -->
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class='uil uil-cog'></i>App Setting</h2>
                        <div class="setting_tabs">
                            <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-account-tab" data-toggle="pill" href="#pills-account" role="tab" aria-selected="true">App Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-privacy-tab" data-toggle="pill" href="#pills-privacy" role="tab" aria-selected="false">Enrollment</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab">

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

                                <div class="account_setting">
                                    <form action="{{route('update_app_settings', $appSettings->unique_id)}}" method="POST">
                                        @csrf

                                        <div class="basic_profile">
                                            <div class="basic_ptitle">
                                                {{-- <h4>Basic Profile</h4>
                                                    <p>Add information about yourself</p>--}}
                                            </div>
                                            <div class="basic_form">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="ui search focus mt-30">
                                                                    <label for="company_name">Company Name</label>
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="text" name="company_name" value="{{$appSettings->company_name}}" id="company_name" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="ui search focus mt-30">
                                                                    <label for="company_url">Company Url</label>
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="url" name="company_url" value="{{$appSettings->company_url}}" id="company_url" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="ui search focus mt-30">
                                                                    <label for="company_email_1">Company Email 1</label>
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="email" name="company_email_1" value="{{$appSettings->company_email_1}}" id="company_email_1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="ui search focus mt-30">
                                                                    <label for="company_email_2">Company Email 2</label>
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="email" name="company_email_2" value="{{$appSettings->company_email_2}}" id="company_email_2">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="ui search focus mt-30">
                                                                    <label for="company_phone">Company Phone</label>
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="tel" name="company_phone" value="{{$appSettings->company_phone_1}}" id="company_phone">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="ui search focus mt-30">
                                                                    <label for="whatsApp">WhatsApp Phone</label>
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="tel" name="whatsApp" value="{{$appSettings->whatsApp_phone}}" id="whatsApp">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="ui search focus mt-30">
                                                                    <label for="facebook_url">Facebook Url</label>
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="url" name="facebook_url" value="{{$appSettings->facebook_url}}" id="facebook_url">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="ui search focus mt-30">
                                                                    <label for="twitter_url">Twitter Url</label>
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="url" name="twitter_url" value="{{$appSettings->twitter_url}}" id="twitter_url">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="ui search focus mt-30">
                                                                    <label for="instagram_url">Instagram Url</label>
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="url" name="instagram_url" value="{{$appSettings->instagram_url}}" id="instagram_url">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="ui search focus mt-30">
                                                                    <label for="youtube_url">YouTube Url</label>
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="url" name="youtube_url" value="{{$appSettings->youtube_url}}" id="youtube_url">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="ui search focus mt-30">
                                                                    <label for="company_address">Company Address</label>
                                                                    <div class="ui form swdh30">
                                                                        <div class="field">
                                                                            <textarea rows="3" name="company_address" id="company_address">{{$appSettings->company_address}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="divider-1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="save_btn" type="submit">Save Changes</button>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-privacy" role="tabpanel" aria-labelledby="pills-privacy-tab">
                                <div class="account_setting">
                                    {{-- <h4>Enrollment</h4> --}}
                                    <p>Enter percentage to be removed from payments made to teachers.</p>
                                    <form action="" class="enroll_percent_form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="ui search focus">
                                                    <label for="bit_coin_wallet">Course Enrollment Percentage</label>
                                                    <div class="ui left icon input swdh11 swdh19">
                                                        <input class="prompt srch_explore" type="number" name="percentage" id="wallet" placeholder="Enter percentage to pay teachers" value="{{$appSettings->enrollment_percentage}}">
                                                        <i class="uil uil-receipt icon icon2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <button class="save_btn enroll_percent_btn" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')

    </div>
    <!-- Body End -->

    @include('layouts.e_script')

    <script>
        $(document).ready(function () {
            // $('.delete_course_modal').click(function(e) {
            //     e.preventDefault();
            //     append_id('delete_course_id', '.delete_course_form', '#delete_course_modal', this)
            //     $('#delete_course_modal').modal('toggle');
            // });


        $('.enroll_percent_btn').click(async function(e) {
            e.preventDefault();
            let enroll_percent_form = $('.enroll_percent_form').serializeArray();
            let form_data = set_form_data(enroll_percent_form);
            let returned = await ajaxRequest('/update_course_percent', form_data);
            // console.log(returned);
            // return;
            validator(returned,'/app_settings_page');
        });

        });
    </script>
