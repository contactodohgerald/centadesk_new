@php
    $current_page = 'How It Works';
    $how_it_work = 'active';
 @endphp
@include('includes.head')

@include('includes.header')

<!---page Title --->
<section class="bg-img pt-150 pb-20" data-overlay="7" style="background-image: url({{asset('front-end/images/front-end-img/background/bg-8.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">How It Works</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">How It Works</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page content -->

<section class="py-50 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-12">
                <h1 class="mb-10 text-uppercase text-center">How It Works</h1>
                <p class="font-size-16">The platform has a registration feature that allows interested users to register using a referral link of their sponsor/referral. The system is such that anyone joining will come through a person.
                    The link of any of the instructors will be displayed on the course description for enrollment. When a person has successful registration using the affiliate link, he/she is required to enroll in a course. The enrolment will open up the various opportunities presented in the platform, which he can choose to take advantage of.
                </p>

                <h1 class="mb-10 text-uppercase text-center">Pricing</h1>
                <p>Note the pricing for courses are preset by the platform. In other to achieve our aim and to regulated the system’s business area we see it necessary to regulate the pricing for the platform so as to be able to meet up with the multi-level program which is vital in empowering every user of the platform. The pricing may be uniform throughout the platform for each courses irrespective of the course specialty.</p>

                <h1 class="mb-10 text-uppercase text-center">Earnings</h1>
                <p>{{env('APP_NAME')}} have various ways in which users of the platform can make earnings regardless of their membership category.</p>

                <h3 class="mb-10">Affiliate member</h3>
                <p>An affiliate shares his/her referral link with friends and family to register on the platform and get information for every successful registration. This feature is open to anybody registered on the platform and has enrolled for at least one course. Once a person registers and enrolls, the affiliate program will be enabled on his dashboard, and he can start inviting his friends to join.
                    <br>
                    The affiliate user gets a bonus for each direct referral he/she makes. The affiliate system also has a multi-level system which is up to the 20th generation. This implies that he/she must get paid when his/her downline refers a person. This is also extended to the 20th generation and therefore generating a passive income to the affiliates. Each of this generation has a particular percentage the user get as listed below.
                </p>

                <h4>Earning: <br>Direct referral 10%</h4>
                <ul class="list-unstyled">
                    <li>1st = 5%</li>
                    <li>2nd = 3%</li>
                    <li>3rd = 2.6%</li>
                    <li>4th = 2.4%</li>
                    <li>5th = 2.2%</li>
                    <li>6th = 2%</li>
                    <li>7th = 1.8%</li>
                    <li>8th = 1.6%</li>
                    <li>9th = 1.4%</li>
                    <li>10th = 1.2%</li>
                    <li>11th = 1%</li>
                    <li>12th = 0.9%</li>
                    <li>13th = 0.8%</li>
                    <li>14th = 0.7%</li>
                    <li>15th = 0.6%</li>
                    <li>16th = 0.5%</li>
                    <li>17th = 0.4%</li>
                    <li>18th = 0.3%</li>
                    <li>19th = 0.2%</li>
                    <li>20th = 0.1%</li>
                    <li> Payable Commissions = 48.7%</li>
                </ul>
                <h3 class="mb-10">Student</h3>
                <p>A student member is a person that joined the platform with the mindset to learn. Once payment is made, the student will have access to the affiliate feature. He or she may wish to participate or not in the affiliate business. Still, if he or she decides to participate, the benefits associated with the affiliate business will be entitled to him or her.
                    <br>
                    The student will join the system through an affiliate link, and he or she has a maximum period of 7 days to enroll in a course, or his or her membership will be declined, so he or she needs to contact the admin for access. But in a situation when he or she defaults again, the account will be suspended.
                </p>
                <h4>Earning: <br>Affiliate Commissions</h4>

                <h3 class="mb-10">Teacher</h3>
                <p>Interested people may wish to list their courses on the platform and get a commission every time users enroll for their courses. A teacher during registration will signify that he or she is a teacher or instructor and after registration is done, he or she will be given an extra feature on his dashboard where he or she can list his/her courses.
                    <br>
                    Courses uploaded on the platform belongs to the teacher but will be treated as though owned by the platform. Each time a student join the platform and obtain a membership license by purchasing/subscribing to a teachers course certain percentage will be remitted to the teacher while certain percent goes to the platform and the rest goes back to the systems multi-level program.
                    <br>
                    The platform will notify the teacher or instructor each time a student registers for his/her course, and he/she is expected to do a follow-up on the student.
                    <br>
                    The platform will vet the teacher’s learning content before they are granted access to be visible on the platform. The teacher can also decide to join the affiliate program by enrolling in a course as membership depends on that.
                    <br>
                    The teacher will be earning in two ways, which are:
                </p>
                <ul>
                    <li>As an affiliate member when they have to unlock the feature by enrolling in a particular course. Once this is done, the teacher or instructor will have full access to the affiliate package and all benefits as earlier stated.</li>
                    <li>He or she can earn on the platform if their listed course is enrolled by a student. A teacher get 10% of the subscription fee each time a student gain membership through their course.</li>
                </ul>
                <h4>Earning: <br>Course Commission: 10%</h4>
                <h5>Affiliate Commissions</h5>

                <h3 class="mb-10">Agent member</h3>
                <p>The agent’s member has four stages as the user progress in the platform. To qualify as an agent, the individual ought to have a certain number of direct referrals to unlock this opportunity. The agent, just like every other user, can join the platform either as a student or teacher, and his or her activities will determine if he or she will get to the level of an agent.
                    <br>
                    It is important to note that when a teacher becomes an agent, their role as a teacher will still be active.
                </p>
                <h3>Earning:</h3>
                <h4>Course Commission: 10% (when an agent and a teacher) <br>
                    Higher Affiliate Commissions</h4>

                <h2 class="mb-10">Silver Agent</h2>
                <p>To qualify as a silver agent, an active user who is either a teacher or student must have up to 50 direct down liners, which implies that he must have referred up to 50 people directly. At this point, he or she might decide to upgrade to the silver agent and unlock the benefits entitled to the said level.
                    <br>
                    The silver agent benefits listed below will be unlocked, and unlike the affiliate member, the direct referral bonus is upgraded to 15%.
                </p>
                <h4> Direct referral 15%</h4>
                <ul class="list-unstyled">
                    <li>1st = 5%</li>
                    <li>2nd = 3%</li>
                    <li>3rd = 2.6%</li>
                    <li>4th = 2.4%</li>
                    <li>5th = 2.2%</li>
                    <li>6th = 2%</li>
                    <li>7th = 1.8%</li>
                    <li>8th = 1.6%</li>
                    <li>9th = 1.4%</li>
                    <li>10th = 1.2%</li>
                    <li>11th = 1%</li>
                    <li>12th = 0.9%</li>
                    <li>13th = 0.8%</li>
                    <li>14th = 0.7%</li>
                    <li>15th = 0.6%</li>
                    <li>16th = 0.5%</li>
                    <li>17th = 0.4%</li>
                    <li>18th = 0.3%</li>
                    <li>19th = 0.2%</li>
                    <li>20th = 0.1%</li>
                    <li> Payable Commissions = 53.7%</li>

                </ul>

                <h2 class="mb-10">Diamond  Agent</h2>
                <p>To qualify as a diamond agent, an active user who is either a teacher or student must have up to 100 direct downliners. At this point, he or she may decide to upgrade to the diamond agent. Upon the upgrade, the following benefits listed below will be entitled to the said level will be unlocked. <br> The benefits as a diamond agent as listed below
                </p>
                <h4>Direct referral 20%</h4>
                <ul class="list-unstyled">
                    <li>1st = 5%</li>
                    <li>2nd = 3%</li>
                    <li>3rd = 2.6%</li>
                    <li>4th = 2.4%</li>
                    <li>5th = 2.2%</li>
                    <li>6th = 2%</li>
                    <li>7th = 1.8%</li>
                    <li>8th = 1.6%</li>
                    <li>9th = 1.4%</li>
                    <li>10th = 1.2%</li>
                    <li>11th = 1%</li>
                    <li>12th = 0.9%</li>
                    <li>13th = 0.8%</li>
                    <li>14th = 0.7%</li>
                    <li>15th = 0.6%</li>
                    <li>16th = 0.5%</li>
                    <li>17th = 0.4%</li>
                    <li>18th = 0.3%</li>
                    <li>19th = 0.2%</li>
                    <li>20th = 0.1%</li>
                    <li> Payable Commissions = 58.7%</li>
                </ul>

                <h2 class="mb-10">Golden Agent</h2>
                <p>To become a golden agent, the active user must have up to 200 direct downliners, which implies that they must have referred up to 200 people directly. At this point, he or she may decide to upgrade to a golden agent.
                    <br>
                    The benefits as a golden agent are listed below
                </p>
                <h4>Direct referral 25%</h4>
                <ul class="list-unstyled">
                    <li>1st = 5%</li>
                    <li>2nd = 3%</li>
                    <li>3rd = 2.6%</li>
                    <li>4th = 2.4%</li>
                    <li>5th = 2.2%</li>
                    <li>6th = 2%</li>
                    <li>7th = 1.8%</li>
                    <li>8th = 1.6%</li>
                    <li>9th = 1.4%</li>
                    <li>10th = 1.2%</li>
                    <li>11th = 1%</li>
                    <li>12th = 0.9%</li>
                    <li>13th = 0.8%</li>
                    <li>14th = 0.7%</li>
                    <li>15th = 0.6%</li>
                    <li>16th = 0.5%</li>
                    <li>17th = 0.4%</li>
                    <li>18th = 0.3%</li>
                    <li>19th = 0.2%</li>
                    <li>20th = 0.1%</li>
                    <li> Payable Commissions = 63.7%</li>
                </ul>

                <h2 class="mb-10">Special Agent</h2>
                <p>To qualify as a special agent, the active user must have referred up to 1000 people directly. At this point, he or she can upgrade to a special agent. Upon upgrade, the platform will unlock the special agent benefits.
                </p>
                <h4>Direct referral 35%</h4>
                <ul>
                    <li>1st = 5%</li>
                    <li>2nd = 3%</li>
                    <li>3rd = 2.6%</li>
                    <li>4th = 2.4%</li>
                    <li>5th = 2.2%</li>
                    <li>6th = 2%</li>
                    <li>7th = 1.8%</li>
                    <li>8th = 1.6%</li>
                    <li>9th = 1.4%</li>
                    <li>10th = 1.2%</li>
                    <li>11th = 1%</li>
                    <li>12th = 0.9%</li>
                    <li>13th = 0.8%</li>
                    <li>14th = 0.7%</li>
                    <li>15th = 0.6%</li>
                    <li>16th = 0.5%</li>
                    <li>17th = 0.4%</li>
                    <li>18th = 0.3%</li>
                    <li>19th = 0.2%</li>
                    <li>20th = 0.1%</li>
                    <li> Payable Commissions = 73.7%</li>
                </ul>

            </div>
        </div>
    </div>
</section>


@include('includes.footer')


@include('includes.e_script')

