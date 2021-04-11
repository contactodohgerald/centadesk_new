<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\course_model;
use App\Traits\Generics;
use App\Traits\UsersArray;

class InstructorsControllers extends Controller
{
    //
    use Generics, UsersArray;
    function __construct(User $user, course_model $course_model){
        $this->user = $user;
        $this->course_model = $course_model;
    }

    public function intructorProfilePage($unique_id = null){

        if($unique_id != null){

            $users = $this->user->getSingleUser([
                ['unique_id', $unique_id],
            ]);

            $users->courses;

            $users->subscribers;

            $query = [
                ['user_id', $users->unique_id],
                ['status', 'confirmed'],
            ];

            $course = $this->course_model->getCourseByPaginate(20, $query);
            foreach ($course as $each_course){
                $each_course->user;
                $each_course->price;

                $each_course->courseEnrollment;

                $each_course->course_price = $this->getAmountForNotLoggedInUser($each_course->price->amount);

                $each_course->review;
                $each_course->count_reviews = $this->calculateRatings($each_course->review);

                $each_course->download_url = explode('++', $each_course->course_urls);
            }

            $view = [
                'users'=>$users,
                'course'=>$course,
            ];
            return view('front_end.instructor-profile', $view);

        }

    }

}
