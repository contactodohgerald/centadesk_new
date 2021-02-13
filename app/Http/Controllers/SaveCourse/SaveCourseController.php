<?php

namespace App\Http\Controllers\SaveCourse;

use App\Http\Controllers\Controller;
use App\Model\SavedCourses;
use App\Traits\Generics;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaveCourseController extends Controller
{
    //
    use Generics;
    function __construct(SavedCourses $savedCourses)
    {
        $this->savedCourses = $savedCourses;
    }

    function getAllSavedCourse(){

        $user = Auth()->user();

        $condition = [
            ['user_unique_id', $user->unique_id],
        ];

        $saved_courses = $this->savedCourses->getAllSaveCourse($condition);

        foreach($saved_courses as $each_saved_courses){

            $each_saved_courses->courses;

            $each_saved_courses->courses->price;

            $each_saved_courses->users;

        }

        return view('dashboard.saved_courses', ['saved_courses'=>$saved_courses]);

    }

    function handleValidations(array $data){

        $validator = Validator::make($data, [
            'course_unique_id' => 'required',
            'user_unique_id' => 'required'
        ]);

        return $validator;

    }

    public function saveCourse(Request $request){

        $data = $request->all();

        try{

            $validation = $this->handleValidations($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            $condition = [
                ['user_unique_id', $data['user_unique_id']],
                ['book_unique_id', $data['course_unique_id']],
            ];

            $savedCourse = $this->savedCourses->getAllSaveCourse($condition);

            if (count($savedCourse) > 0){

                return response()->json(['error_code'=>1, 'error_message'=>'This Course has already been save']);

            }else{

                $save_course = new SavedCourses();

                $unique_id = $this->createUniqueId('likes', 'unique_id');

                $save_course->unique_id = $unique_id;
                $save_course->user_unique_id = $data['user_unique_id'];
                $save_course->book_unique_id = $data['course_unique_id'];

                if ($save_course->save()){
                    return response()->json(['error_code'=>0, 'success_statement'=>'course was saved successfully']);
                }else{
                    return response()->json(['error_code'=>1, 'error_message'=>'This Course has already been save']);
                }

            }

        }catch (Exception $exception){

            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);

        }

    }
}
