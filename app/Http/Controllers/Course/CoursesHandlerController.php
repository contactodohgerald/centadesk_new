<?php

namespace App\Http\Controllers\Course;

use App\course_category_model;
use App\course_model;
use App\Http\Controllers\Controller;
use App\Model\Like;
use App\Model\Review;
use App\Traits\Generics;
use App\Traits\UsersArray;
use App\User;
use Illuminate\Http\Request;

class CoursesHandlerController extends Controller
{
    //
    use Generics, UsersArray;
    function __construct(
        course_category_model $course_category_model, course_model $course_model, Review $review, Like $like, User $user
    ){
        $this->course_category_model = $course_category_model;
        $this->course_model = $course_model;
        $this->review = $review;
        $this->like = $like;
        $this->user = $user;
    }

    public function homePage(){

        $course_category_model = $this->course_category_model->getAllCategories();
        $condition = [
            ['status', 'confirmed']
        ];
        $course = $this->course_model->getAllCourseWithLimit($condition);
        $new_course = $this->course_model->getAllCourseWithLimit($condition);

        $query = [
            ['status', 'active'],
            ['user_type', 'teacher'],
            ['yearly_subscription_status', 'yes'],
        ];
        $instructors = $this->user->getAllUsers($query);

        $view = [
            'course_category_model'=>$course_category_model,
            'course'=>$course,
            'new_course'=>$new_course,
            'instructors'=>$instructors,
            'instructors_count'=>$this->user->getAllUsers([
                ['status', 'active'],
                ['user_type', 'teacher'],
            ]),
            'student_count'=>$this->user->getAllUsers([
                ['status', 'active'],
                ['user_type', 'student'],
            ]),
            'course_count'=>$this->course_model->getAllCourse([
                ['deleted_at', null],
            ]),
        ];
        return view('front-end.index', $view);
    }

    public function getAllInstructorsList(){
        $query = [
            ['status', 'active'],
            ['user_type', 'teacher'],
            ['yearly_subscription_status', 'yes'],
        ];
        $instructors = $this->user->getAllUsers($query);

        return view('front-end.instructors', ['instructors'=>$instructors]);
    }

    public function getInstructorProfile($unique_id = null){

        if ($unique_id != null){
            $query = [
                ['unique_id', $unique_id],
            ];
            $instructors = $this->user->getSingleUser($query);

            $instructors->courses;
            foreach ($instructors->courses as $kk => $each_course){
                $each_course->price;

                $each_course->course_price = $this->getAmountForNotLoggedInUser($each_course->price->amount);

                $each_course->review;
                $each_course->count_reviews = $this->calculateRatings($each_course->review);
            }

            $instructors->subscribers;
            foreach ($instructors->subscribers as $s => $each_subscribers){
                $each_subscribers->users;
            }

            return view('front-end.instructor_profile', ['instructors'=>$instructors]);
        }
    }

    public function getAllCategories(){

        $course_category_model = $this->course_category_model->getAllCategories();

        foreach ($course_category_model as $each_category){
            $each_category->courses;
        }

        return view('front-end.category', ['course_category_model'=>$course_category_model]);
    }

    public function getAllCourses(){
        $condition = [
            ['status', 'confirmed'],
        ];
        $course = $this->course_model->getCourseByPaginate(5, $condition);

        $course_category_model = $this->course_category_model->getAllCategories();

        foreach ($course_category_model as $each_category){
            $each_category->courses;
        }

        $view = [
            'course'=>$course,
            'course_category_model'=>$course_category_model,
        ];

        return view('front-end.list_course', $view);
    }

    public function courseListPage($unique_id = null){

        if ($unique_id != null){

            $condition = [
                ['unique_id', $unique_id]
            ];
            $course_category = $this->course_category_model->getSingleCategories($condition);

            $query = [
                ['category_id', $unique_id],
                ['status', 'confirmed'],
            ];
            $course = $this->course_model->getCourseByPaginate(5, $query);

            $course_category->courses = $course;

            foreach ($course_category->courses as $kk => $each_course){
                $each_course->user;
                $each_course->price;

                $each_course->course_price = $this->getAmountForNotLoggedInUser($each_course->price->amount);

                $each_course->review;
                $each_course->count_reviews = $this->calculateRatings($each_course->review);
            }

            $course_category_model = $this->course_category_model->getAllCategories();

            foreach ($course_category_model as $each_category){
                $each_category->courses;
            }

            $view = [
                'course_category'=>$course_category,
                'course_category_model'=>$course_category_model,
            ];
            return view('front-end.course_list', $view);
        }

    }

    public function getCourseDetails($unique_id = null){

        if ($unique_id != null){
            $condition = [
                ['unique_id', $unique_id],
            ];
            $course = $this->course_model->getSingleCourse($condition);

            $course->user;
            $course->price;

            $course->course_price = $this->getAmountForNotLoggedInUser($course->price->amount);

            $course->review;
            $course->count_reviews = $this->calculateRatings($course->review);
            foreach ($course->review as $each_review){
                $each_review->users;
            }

            $course->courseEnrollment;

            //function that returns an array of users that likes this course and also the course like count
            $likes_array = $this->returnUserArrayForDislikes($course->unique_id);
            $course->likes = $likes_array['like_count'];
            $course->likes_user_array = $likes_array['like_user_array'];

            $view = [
                'course'=>$course,
            ];

            return view('front-end.course_details', $view);
        }
    }
}
