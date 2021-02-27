<?php

namespace App\Http\Controllers\Enrollment;

use App\course_model;
use Exception;
use App\Traits\Generics;
use App\Traits\appFunction;
use Illuminate\Http\Request;
use App\Model\courseEnrollment;
use App\Http\Controllers\Controller;
use App\Model\AppSettings;

class CourseEnrollmentController extends Controller
{
    use Generics, appFunction;

    public function __construct(AppSettings $AppSettings, course_model $course)
    {
        $this->AppSettings = $AppSettings;
        $this->course = $course;
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

            $enroll = courseEnrollment::create([
                'unique_id' => $unique_id,
                'course_creator' => $course_creator,
                'user_enrolling' => $user_enrolling,
                'percentage' => $enrollment_percentage,
            ]);

            if (!$enroll->unique_id) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\courseEnrollment  $courseEnrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, courseEnrollment $courseEnrollment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\courseEnrollment  $courseEnrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(courseEnrollment $courseEnrollment)
    {
        //
    }
}
