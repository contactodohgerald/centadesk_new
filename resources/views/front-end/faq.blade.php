@php
    $current_page = 'FAQs';
    $faq = 'active';
 @endphp
@include('includes.head')

@include('includes.header')

<!---page Title --->
<section class="bg-img pt-150 pb-20" data-overlay="7" style="background-image: url({{asset('front-end/images/front-end-img/background/bg-8.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">FAQs</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">FAQs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page content -->

<section class="py-50 cust-accordion">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-wrapper v1">
                    <div class="list">
                        <div class="item">
                            <div class="tab-btn">
                                <a href="#">What technical skills does the student require?<em class="mdi mdi-plus"></em></a>
                            </div>
                            <div class="tab-content">
                                <p>{{env('APP_NAME')}} is designed to be user-friendly. The necessary skills needed are computer skills to access the programs, including using a keyboard, using the Internet, etc. Most online programs require such on their websites. However, users who do not meet this requirement can be guided</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Who can benefit from this platform?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                                <p>This program is designed to meet various users' needs depending on their professional and educational needs.
                                    <br>Examples of users who can benefit from this platform include:</p>
                                <ul class="list-unstyled">
                                    <li>Students</li>
                                    <li>Teachers/instructors</li>
                                    <li>Agents</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">How do students and teachers interact in an online course?<em class="mdi mdi-plus"></em></a></div>
                            <div class="tab-content">
                                <p>The teacher or instructor will be notified when a student enrolls in his/her course. They are required to follow-up on the student and adding them to their WhatsApp or telegram community so that he/she can train the student via sharing his/her learning materials with the student and doing a follow-up to ensure the student gets what he/she wants. Also the course material download links are also available on the platform and students are giving access to communicate directly with the instructors on the platform using the comment section.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">What is the duration of membership?<em class="mdi mdi-plus"></em></a></div>
                            <div class="tab-content">
                                <p>The membership license of each user is of a 12 months duration; that is, after every one year, the user is to pay a certain amount by simply enrolling in fresh courses, and this will give him or her access to the system benefit for another one year and so on.
                                </p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Will I make money doing this?<em class="mdi mdi-plus"></em></a></div>
                            <div class="tab-content">
                                <p>Yes, you will. All you have to do is purchase a course and start referring people; you will be paid a commission from the tuition fee.
                                </p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn">
                                <a href="#">How do I sign up?<em class="mdi mdi-plus"></em></a>
                            </div>
                            <div class="tab-content">
                                <ul class="list-unstyled">
                                   <li>Create an account using the signup bottom</li>
                                   <li>Select if you are a teacher or student</li>
                                   <li>Fill in the necessary information and submit</li>
                                   <li>We will send a confirmation mail to you</li>
                                   <li>Confirm and log in to get started</li>
                                   <li>Enroll for a course and get a 1 year membership license to earn passive income</li>
                               </ul>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#"> How do I make payment?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                                <p>Visit a course and click on the buy button to make a purchase; you will be redirected to make payment via payment gateway. Make payment and start receiving your course.
                                </p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Are students mandated to attend classes at a specific time?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                                <p>We offer flexibility for students. Students participate in discussions through WhatsApp, telegram community. It’s useful as taking a physical class.
                                    <br>The instructor can also determine the timing, and he/she is to act conveniently for the students.
                                </p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Do you offer a free course?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                                <p>No, we do not offer free courses. But on special occasions we might choose to make some courses free for our users.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">As a teacher, am I to pay to join the platform?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                                <p>Yes you must pay to join the system as your membership to the platform is active only when you subscribe.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">When can I withdraw my commission?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                                <p>Affiliate Commissions/Earnings are paid ones a month basically towards the end of every month.</p>
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

