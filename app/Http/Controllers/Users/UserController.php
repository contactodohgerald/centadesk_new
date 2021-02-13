<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('auth');
    }

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [
            'account_name' => 'required',
            'bank_code' => 'required',
            'bank_account' => 'required',
        ]);

    }

    function bankAccountUpdate(Request $request){

        $data = $request->all();

        try{
            $this->Validator($request);//validate fields

            $user = Auth::user();

            $user->account_name = $data['account_name'];
            $user->bank_code = $data['bank_code'];
            $user->account_number = $data['bank_account'];

            if ($user->save()){
                return redirect('/main_settings_page')->with('success_message', 'Bank Account Details was updated Successfully');
            }else{
                return redirect('/main_settings_page')->with('error_message', 'An Error occurred, Please try Again Later');
            }

        }catch (Exception $exception){

            $errorsArray = $exception->getMessage();
            return  redirect('main_settings_page')->with('error_message', $errorsArray);

        }

    }

    function walletAddressUpdate(Request $request){

        $data = $request->all();

        try{

            $user = Auth::user();

            $user->wallet_address = $data['bit_coin_wallet'];

            if ($user->save()){
                return redirect('/main_settings_page')->with('success_message', 'Wallet was updated Successfully');
            }else{
                return redirect('/main_settings_page')->with('error_message', 'An Error occurred, Please try Again Later');
            }

        }catch (Exception $exception){

            $errorsArray = $exception->getMessage();
            return  redirect('main_settings_page')->with('error_message', $errorsArray);

        }

    }
}
