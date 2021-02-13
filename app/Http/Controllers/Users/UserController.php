<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;
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

    protected function Validator($request)
    {

        $this->validator = Validator::make($request->all(), [
            'account_name' => 'required',
            'bank_code' => 'required',
            'bank_account' => 'required',
        ]);
    }

    function bankAccountUpdate(Request $request)
    {

        $data = $request->all();

        try {
            $this->Validator($request); //validate fields

            $user = Auth::user();

            $user->account_name = $data['account_name'];
            $user->bank_code = $data['bank_code'];
            $user->account_number = $data['bank_account'];

            if ($user->save()) {
                return redirect('/main_settings_page')->with('success_message', 'Bank Account Details was updated Successfully');
            } else {
                return redirect('/main_settings_page')->with('error_message', 'An Error occurred, Please try Again Later');
            }
        } catch (Exception $exception) {

            $errorsArray = $exception->getMessage();
            return  redirect('main_settings_page')->with('error_message', $errorsArray);
        }
    }

    function walletAddressUpdate(Request $request)
    {

        $data = $request->all();

        try {

            $user = Auth::user();

            $user->wallet_address = $data['bit_coin_wallet'];

            if ($user->save()) {
                return redirect('/main_settings_page')->with('success_message', 'Wallet was updated Successfully');
            } else {
                return redirect('/main_settings_page')->with('error_message', 'An Error occurred, Please try Again Later');
            }
        } catch (Exception $exception) {

            $errorsArray = $exception->getMessage();
            return  redirect('main_settings_page')->with('error_message', $errorsArray);
        }
    }

    /**
     * Post Controller for update of user details.
     *
     * @param Request $request
     * @return array
     */
    public function update_user_details(Request $request)
    {
        $user = $request->user();

        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:40',
                'other_names' => 'required|string',
                'headline' => 'required|string|max:100',
                'description' => 'required|min:50',
                'facebook' => 'string',
                'twitter' => 'string',
                'linkedin' => 'string',
                'youtube' => 'string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }

            $first_name = $request->input('first_name');
            $other_names = $request->input('other_names');
            $headline = $request->input('headline');
            $description = $request->input('description');
            $facebook = $request->input('facebook');
            $twitter = $request->input('twitter');
            $linkedin = $request->input('linkedin');
            $youtube = $request->input('youtube');

            $user = User::find($user->unique_id);

            $user->name = $first_name;
            $user->last_name = $other_names;
            $user->professonal_heading = $headline;
            $user->description = $description;
            $user->facebook = $facebook;
            $user->twitter = $twitter;
            $user->linkedin = $linkedin;
            $user->youtube = $youtube;
            $updated = $user->save();


            if (!$updated) {
                throw new Exception('Database Error!');
            } else {
                $error = 'Personal Details Updated!';
                return response()->json(["message" => $error, 'status' => true]);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => $error,
            ];
            return response()->json(["message" => $error, 'status' => false]);
        }
    }
}
