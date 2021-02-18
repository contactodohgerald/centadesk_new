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

    function uploadUserCAC(){

        return view('dashboard.upload_cac');
    }

    protected function Validators($request){

        $this->validator = Validator::make($request->all(), [
            'cac_passport' => 'required|mimes:jpg,jpeg,png|max:3000',
            'cac_files' => 'required|mimes:jpg,jpeg,png,pdf,doc|max:6000',
        ]);

    }

    function uploadCACFiles(Request $request){
        $user = Auth::user();
        try{
            $this->Validators($request);//validate fields

            if ($user->cac_verification_status === 'no'){

                if ($request->hasFile('cac_passport')) {
                    $file = $request->file('cac_passport');
                    $cac_passport = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->storeAs('public/cac_passport', $cac_passport);
                }

                if ($request->hasFile('cac_files')) {
                    $files = $request->file('cac_files');
                    $cac_files = md5($files->getClientOriginalName() . time()) . "." . $files->getClientOriginalExtension();
                    $files->storeAs('public/cac_files', $cac_files);
                }

                $user->passport_cac = $cac_passport;
                $user->file_cac = $cac_files;
                $user->cac_verification_status = 'yes';
                if ($user->save()){
                    return redirect('/upload_cac')->with('success_message', 'CAC Upload was made successfully');
                }else{
                    return redirect('/upload_cac')->with('error_message', 'An Error occurred, Please try Again Later');
                }
            }else{
                //code for remove old file
                if ($user->passport_cac !== null) {
                    if(file_exists(storage_path('app/public/cac_passport/') . $user->passport_cac)){
                        $file_old = storage_path('app/public/cac_passport/') . $user->passport_cac;
                        unlink($file_old);
                    }
                }
                if ($request->hasFile('cac_passport')) {
                    $file = $request->file('cac_passport');
                    $cac_passport = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->storeAs('public/cac_passport', $cac_passport);
                }

                if ($user->file_cac !== null) {
                    if(file_exists(storage_path('app/public/cac_files/') . $user->file_cac)){
                        $file_olds = storage_path('app/public/cac_files/') . $user->file_cac;
                        unlink($file_olds);
                    }
                }
                if ($request->hasFile('cac_files')) {
                    $files = $request->file('cac_files');
                    $cac_files = md5($files->getClientOriginalName() . time()) . "." . $files->getClientOriginalExtension();
                    $files->storeAs('public/cac_files', $cac_files);
                }

                $user->passport_cac = $cac_passport;
                $user->file_cac = $cac_files;
                if ($user->save()){
                    return redirect('/upload_cac')->with('success_message', 'CAC Upload was made successfully');
                }else{
                    return redirect('/upload_cac')->with('error_message', 'An Error occurred, Please try Again Later');
                }

            }
        }catch (Exception $exception){

            $errorsArray = $exception->getMessage();
            return  redirect('upload_cac')->with('error_message', $errorsArray);

        }

    }
}
