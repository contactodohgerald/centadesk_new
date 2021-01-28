<?php

namespace App\Http\Controllers\Complain;

use App\Http\Controllers\Controller;
use App\Model\AccountResolve;
use App\Traits\Generics;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplainController extends Controller
{
    //
    use Generics;

    function __construct(User $user, AccountResolve $accountResolve)
    {
        $this->user = $user;
        $this->accountResolve = $accountResolve;
    }

    public function complainPage(){

        return view('dashboard.complain_page');

    }

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'reasons' => 'required',
        ]);

    }

    public function createComplain(Request $request){
        $data = $request->all();

        try{
            $this->Validator($request);//validate fields

            $condition = [
                ['email', $data['email']]
            ];
            $conditions = [
                ['user_email', $data['email']]
            ];

            $user = $this->user->getSingleUser($condition);

            if ($user === null || $user === ''){

                return redirect('/complain_page')->with('error_message', 'Email Provided Does Not Exist On Our Platform');

            }else{

                $complain = $this->accountResolve->getAllOfComplain($conditions);

                if ($complain->count() > 0){

                    return redirect('/complain_page')->with('success_message', 'Please Your Account is still under consideration, please wait patiently as our team of programmers attend to it. You Will Be Notify By Email Upon Successful Account Activation.');

                }else{
                    $unique_id = $this->createUniqueId('account_resolves', 'unique_id');

                    $complain = new AccountResolve();
                    $complain->unique_id = $unique_id;
                    $complain->user_unique_id = $user->unique_id;
                    $complain->user_email = $user->email;
                    $complain->reasons = $data['reasons'];
                    $complain->desc = $data['description'];

                    if ($complain->save()){

                        return redirect('/complain_page')->with('success_message', 'Your Request For Account Activation Has Been Sent Successfully, We implore You To Sit Back And Wait Patiently As Our Team Of Programmers Are Currently Working To Give You the Best. You Will Be Notify By Email Upon Successful Account Activation.');

                    }else{

                        return redirect('/complain_page')->with('error_message', 'An Error occurred, Please try Again Later');

                    }
                }

            }

        }catch (Exception $exception){

            $errorsArray = $exception->getMessage();
            return  redirect('/complain_page')->with('error_message', $errorsArray);

        }

    }
}
