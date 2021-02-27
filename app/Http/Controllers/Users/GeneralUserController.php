<?php

namespace App\Http\Controllers\Users;

use App\course_model;
use App\Http\Controllers\Controller;
use App\Model\Subscribe;
use App\User;
use Exception;
use Illuminate\Http\Request;

class GeneralUserController extends Controller
{
    //

    function __construct(User $user, course_model $course_model, Subscribe $subscribe){
        $this->user = $user;
        $this->course_model = $course_model;
        $this->subscribe = $subscribe;
    }

    public function viewUserGeneral($unique_id){

        $condition = [
            ['unique_id', $unique_id]
        ];
        $user = $this->user->getSingleUser($condition);

        $condition = [
            ['user_id', $user->unique_id]
        ];
        $course_model = $this->course_model->getAllCourse($condition);
        $user->courses = $course_model;

        foreach ($user->courses as $each_course){

            $each_course->user;

            $each_course->price;

            $each_course->category;

        }

        $conditions = [
            ['teacher_unique_id',  $user->unique_id]
        ];
        $subscribe = $this->subscribe->getAllSubscribers($conditions);
        $user->subscribe = $subscribe;

        foreach ($user->subscribe as $each_subscribe){

            $each_subscribe->users;

            $conditionss = [
                ['user_id', $each_subscribe->users->unique_id]
            ];
            $course_model = $this->course_model->getAllCourse($conditionss);
            $each_subscribe->course_count = count($course_model);

        }

        return view('dashboard.profile_page', ['user'=>$user]);
    }

    public function browseInstructors(){

        $condition = [
            ['status', 'active'],
            ['user_type', 'teacher'],
        ];
        $instructors = $this->user->getAllUsers($condition);

        foreach ($instructors as $each_instructors){

            $conditions = [
                ['user_id', $each_instructors->unique_id],
            ];
            $course_model = $this->course_model->getAllCourse($conditions);

            $each_instructors->count_course = $course_model->count();
        }

        return view('dashboard.browse_instructors', ['instructors'=>$instructors]);

    }

    public function updateUserFCMKeys(Request $request, $user_unique_id){
        $data = $request->all();

        $condition = [
            ['unique_id', $user_unique_id]
        ];
        $user = $this->user->getSingleUser($condition);

        try{

            if ($user === null){
                return response()->json(['error_code'=>1, 'error_message'=>'this user does not exist']);
            }else{

                $user->andriod_fcm_key = $data['andriod_fcm_key'];
                $user->ios_fcm_key = $data['ios_fcm_key'];
                $user->web_fcm_key = $data['web_fcm_key'];
                if($user->save()){
                    return response()->json(['error_code'=>0, 'success_statement'=>'FCM Keys were updated successfully']);
                }else{
                    return response()->json(['error_code'=>1, 'error_message'=>'An error occurred, please try again']);
                }
            }

        }catch (Exception $exception){

            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);

        }


    }
}
