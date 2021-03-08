<?php

namespace App\Http\Controllers\Enrollment;

use App\course_model;
use Carbon\Carbon;
use Exception;
use App\Traits\Generics;
use App\Traits\appFunction;
use Illuminate\Http\Request;
use App\Model\courseEnrollment;
use App\Http\Controllers\Controller;
use App\Model\AppSettings;
use App\User;

class CourseEnrollmentController extends Controller
{
    use Generics, appFunction;

    public function __construct(
        AppSettings $AppSettings, course_model $course, courseEnrollment $courseEnrollment
    ){
        $this->middleware('auth',  ['except' => ['enroll']]);
        $this->AppSettings = $AppSettings;
        $this->course = $course;
        $this->courseEnrollment = $courseEnrollment;
    }

    /**
     * Function for displaying enrollment page.
     *
     * @param string $id
     * @return array
     */
    public function enroll_cart($id)
    {
        $user = auth()->user();
        $course = course_model::find($id);

        // check if already enrolled

        $condition = [
            ['user_enrolling', $user['unique_id'] ],
            ['course_id', $id ],
        ];
        $enrollments = $this->courseEnrollment->getAllEnrolls($condition);
        $enrolled = (count($enrollments) > 0) ? true : false ;
        $view = [
            'course' => $course,
            'enrolled' => $enrolled,
        ];
        // return $view;
        return view('dashboard.shopping_cart', $view);
    }

    public function my_enrolled_courses(Request $request)
    {
        $user = auth()->user();

        // get all user enrolllments
        $condition = [
            ['user_enrolling', $user['unique_id'] ],
        ];
        $enrollments = $this->courseEnrollment->getAllEnrolls($condition);

        // get course details for each user enrollment
        // $enrolled_courses = [];

        // foreach ($enrollments as $e ) {
        //     $condition = [
        //         ['unique_id', $e['course_id'] ],
        //     ];
        //     $each_course = $this->course->getSingleCourse($condition);
        //     array_push($enrolled_courses,$each_course);
        // }


        $view = [
            // 'courses' => $enrolled_courses,
            'enrolls' => $enrollments,
        ];
        // return $view;
        return view('dashboard.enrolled_courses', $view);

    }


    /**
     * Post Method for enrolling in a course.
     * @param string $course_id
     *
     * @return array
     */
    public function enroll(Request $request, $course_id)
    {
        $user = $request->user();
        $user_id = $user['unique_id'];
        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            if (empty($user_id) || empty($course_id)) {
                throw new Exception($this->errorMsgs(15)['msg']);
            }
            // check if already enrolled

            $condition = [
                ['user_enrolling', $user['unique_id'] ],
                ['course_id', $course_id ],
            ];
            $enrollments = $this->courseEnrollment->getAllEnrolls($condition);
            if(count($enrollments) > 0){
                throw new Exception($this->errorMsgs(15)['msg']);
            }

            // get admin enrollment percentage.
            $enrollment_percentage = $this->AppSettings->getSingleModel()['enrollment_percentage'];
            if(empty($enrollment_percentage)){
                throw new Exception($this->errorMsgs(27)['msg']);
            }

            // get course creator from course details.
            $condition = [
                ['unique_id', $course_id],
            ];
            $course_detail = $this->course->getSingleCourse($condition);

            $unique_id = $this->createUniqueId('course_enrollments_tb', 'unique_id');
            $course_creator = $course_detail['user_id'];
            $user_enrolling = $user_id;

            // check if balance can pay for course
            $user_balance = $user['balance'];
            $course_price = $course_detail->price->amount;

            if($user_balance < $course_price){
                throw new Exception($this->errorMsgs(21)['msg']);
            }

            // insert enrollment to enrollment table
            $enroll = courseEnrollment::create([
                'unique_id' => $unique_id,
                'course_id' => $course_id,
                'course_creator' => $course_creator,
                'user_enrolling' => $user_enrolling,
                'percentage' => $enrollment_percentage,
            ]);

            if (!$enroll->unique_id) {
                throw new Exception($this->errorMsgs(14)['msg']);
            }


            // remove course price from balance and update
            $user_balance = $user_balance - $course_price;
            $user_detail =  User::find($user_id);
            $user_detail->balance = $user_balance;
            $user_detail->yearly_subscription_status = 'yes';
            $user_detail->subscription_date = Carbon::now()->toDateTimeString();
            $update_user_balance = $user_detail->save();

            if(!$update_user_balance){
                throw new Exception($this->errorMsgs(14)['msg']);
            }else {
                $error = 'You\'ve been Enrolled Successfully!';
                return response()->json(["message" => $error, 'status' => true]);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }
    /**
     * Function to soft delete an enrollment.
     *
     * @param Request $request
     * @param string $id
     * @return void
     */
    public function soft_delete(Request $request, $id)
    {
        try {
            if (!$id) {
                throw new Exception($this->errorMsgs(15)['msg']);
            }
            $deleted = courseEnrollment::find($id)->delete();

            if (!$deleted) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Course Removed Successfully!';
                return response()->json(["message" => $error, 'status' => true]);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }

    public function batch_soft_Delete(Request $request)
    {
        // return response()->json($request);
        $batch = explode(',',$request['students_to_promote_batch']);
        foreach ($batch as $e ) {
            try {
                if (!$e) {
                    throw new Exception($this->errorMsgs(15)['msg']);
                }
                $deleted = courseEnrollment::find($e)->delete();

                if (!$deleted) {
                    throw new Exception($this->errorMsgs(14)['msg']);
                }
            } catch (Exception $e) {

                $error = $e->getMessage();
                $error = [
                    'errors' => [$error],
                ];
                return response()->json(["errors" => $error, 'status' => false]);
            }
        }

        $error = 'All Enrolled Courses Removed Successfully!';
        return response()->json(["message" => $error, 'status' => true]);
    }
}
