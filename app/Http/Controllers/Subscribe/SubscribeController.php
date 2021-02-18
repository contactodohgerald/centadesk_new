<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Model\Subscribe;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    //
    use Generics;
    function __construct(Subscribe $subscribe){

        $this->subscribe = $subscribe;

    }

    function handleValidations(array $data){

        $validator = Validator::make($data, [
            'userId' => 'required',
            'teacherId' => 'required'
        ]);

        return $validator;

    }

    public function subscribeTOTeacher(Request $request){

        $data = $request->all();

        try{

            $validation = $this->handleValidations($request->all());
            if($validation->fails()){
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            $condition = [
                ['user_unique_id', $data['userId']],
                ['teacher_unique_id', $data['teacherId']],
            ];

            $subscribe = $this->subscribe->getAllSubscribers($condition);

            if ($subscribe->count() > 0){
                return response()->json(['error_code'=>1, 'error_message'=>'You have subscribed to this instructor']);
            }else{
                $unique_id = $this->createUniqueId('subscribes', 'unique_id');

                $subscribes = new Subscribe();
                $subscribes->unique_id = $unique_id;
                $subscribes->user_unique_id = $data['userId'];
                $subscribes->teacher_unique_id = $data['teacherId'];

                if($subscribes->save()){
                    return response()->json(['error_code'=>0, 'success_statement'=>'Subscribed!']);
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
