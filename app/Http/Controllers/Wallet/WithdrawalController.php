<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Model\AppSettings;
use App\Model\TransactionModel;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WithdrawalController extends Controller
{
    use Generics;
    //
    function __construct(AppSettings $appSettings, TransactionModel $transactionModel)
    {
        $this->middleware('auth');
        $this->appSettings = $appSettings;
        $this->transactionModel = $transactionModel;
    }

    public function myWithdrawals(){

        return view('dashboard.withdrawals');

    }

    public function handleValidation(array $data){

        $validator = Validator::make($data, [
            'amount'=>'required|numeric'
        ]);

        return $validator;
    }

    //create new withdrwawl
    public function storeWithdrawal(Request $request)
    {

        try{

            $user = Auth::user();
            $settings = $this->appSettings->getSingleModel();
            $least_withdrawable_amount = $this->getAmountForDatabase($settings->least_withdrawable_amount);

            $validation = $this->handleValidation($request->all());
            if($validation->fails()){
                return redirect('/withdrawals')->withErrors('error_message', $validation);
            }

            //check if the user has enough balance to be withdrawn
            $amountInBaseCurrency = $this->getAmountForDatabase($request->amount);
            if($amountInBaseCurrency['data']['amount'] > $user->balance){
                return redirect('/withdrawals')->with('error_message', 'Insufficient account Balance');
            }

            if($user->balance < $settings->least_withdrawable_amount){
                return redirect('/withdrawals')->with('error_message', 'Your wallet Balance must be greater than ('.$amountInBaseCurrency.') '.$least_withdrawable_amount['data']['amount'].' before you can be eligible to make withdrawals');
            }

            //add the withdrawal to the database
            $requestForDb = $this->withdrawalRequestValues($request, $user, $settings);
            $withdrawalTransaction = $this->transactionModel->insertIntoTransactionModel($requestForDb);

            if($withdrawalTransaction){

                $minus_amount_from_user_balance = $user->balance - $amountInBaseCurrency['data']['amount'] ;

                $user->balance = $minus_amount_from_user_balance;
                $user->save();

                $userCurrency = $user->currency_details->second_currency;
                $amount_for_view = $this->getAmountForView($request->amount)['data']['amount'] ;
                return redirect('/withdrawals')->with('success_message', "Your withdrawal Request for ($userCurrency) $amount_for_view was submitted successfully");
            }

        }catch(\Exception $exception){

            $errors =  $exception->getMessage();
            Redirect::back()->with('error_message', $errors);

        }

    }

    //create the values for withdrawal requet
    function withdrawalRequestValues($request, $user, $settings){

        $request->amount = $this->getAmountForDatabase($request->amount)['data']['amount'];
        $request->currency = $this->getAmountForView($request->amount)['data']['currency'];
        $request->unique_id = $this->createUniqueId('transaction_models', 'unique_id');
        $request->user_unique_id = $user->unique_id;
        $request->type_of_user = $user->user_type;
        $request->description = "Withdrawal from $settings->site_name`s Wallet";
        $request->action_type = 'withdrawal';
        $request->status = 'pending';
        return $request;
    }
}
