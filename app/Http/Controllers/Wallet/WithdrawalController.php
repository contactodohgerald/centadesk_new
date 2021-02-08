<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Model\AppSettings;
use App\Model\TransactionModel;
use App\Traits\Generics;
use App\Traits\SendMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WithdrawalController extends Controller
{
    use Generics, SendMail;
    //
    function __construct(AppSettings $appSettings, TransactionModel $transactionModel)
    {
        $this->middleware('auth');
        $this->appSettings = $appSettings;
        $this->transactionModel = $transactionModel;
    }

    public function myWithdrawals(){

        $userDetails = Auth::user();

        if ($userDetails->user_type === 'admin' || $userDetails->user_type === 'super_admin'){

            $condition = [
                ['action_type', 'withdrawal'],
            ];
            $transaction = $this->transactionModel->getAllTransaction($condition);

            $conditions = [
                ['action_type', 'withdrawal'],
                ['status', 'pending'],
            ];
            $pending_transaction = $this->transactionModel->getAllTransaction($conditions);

            $conditionss = [
                ['action_type', 'withdrawal'],
                ['status', 'confirmed'],
            ];
            $successful_transaction = $this->transactionModel->getAllTransaction($conditionss);
        }else{
            $condition = [
                ['user_unique_id', $userDetails->unique_id],
                ['action_type', 'withdrawal'],
            ];
            $transaction = $this->transactionModel->getAllTransaction($condition);

            $conditions = [
                ['user_unique_id', $userDetails->unique_id],
                ['action_type', 'withdrawal'],
                ['status', 'pending'],
            ];
            $pending_transaction = $this->transactionModel->getAllTransaction($conditions);

            $conditionss = [
                ['user_unique_id', $userDetails->unique_id],
                ['action_type', 'withdrawal'],
                ['status', 'confirmed'],
            ];
            $successful_transaction = $this->transactionModel->getAllTransaction($conditionss);
        }

        foreach ($transaction as $each_transaction){
            $each_transaction->users;
        }
        foreach ($pending_transaction as $each_pending_transaction){
            $each_pending_transaction->users;
        }
        foreach ($successful_transaction as $each_successful_transaction){
            $each_successful_transaction->users;
        }

        $data = ['transaction'=>$transaction, 'pending_transaction'=>$pending_transaction, 'successful_transaction'=>$successful_transaction, 'userDetails'=>$userDetails, 'dates'=>'ALL'];

        return view('dashboard.withdrawals', $data);

    }

    public function showWithdrawalsByDate(Request $request){

        $userDetails = Auth::user();

        if ($userDetails->user_type === 'admin' || $userDetails->user_type === 'super_admin') {

            $conditions = [
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', '=', 'withdrawal'],
            ];
            $transaction = $this->transactionModel->getAllTransaction($conditions);

            $conditions = [
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', '=', 'withdrawal'],
                ['status', 'pending'],
            ];
            $pending_transaction = $this->transactionModel->getAllTransaction($conditions);

            $conditionss = [
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', '=', 'withdrawal'],
                ['status', 'confirmed'],
            ];
            $successful_transaction = $this->transactionModel->getAllTransaction($conditionss);
        }else{

            $condition = [
                ['user_unique_id', $userDetails->unique_id],
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', '=', 'withdrawal'],
            ];
            $transaction = $this->transactionModel->getAllTransaction($condition);

            $conditions = [
                ['user_unique_id', $userDetails->unique_id],
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', 'withdrawal'],
                ['status', 'pending'],
            ];
            $pending_transaction = $this->transactionModel->getAllTransaction($conditions);

            $conditionss = [
                ['user_unique_id', $userDetails->unique_id],
                ['created_at', '>=', $request->start_date],
                ['created_at', '<', $request->end_date],
                ['action_type', 'withdrawal'],
                ['status', 'confirmed'],
            ];
            $successful_transaction = $this->transactionModel->getAllTransaction($conditionss);

        }

        foreach ($transaction as $each_transaction){
            $each_transaction->users;
        }
        foreach ($pending_transaction as $each_pending_transaction){
            $each_pending_transaction->users;
        }
        foreach ($successful_transaction as $each_successful_transaction){
            $each_successful_transaction->users;
        }

        $data = ['transaction'=>$transaction, 'pending_transaction'=>$pending_transaction, 'successful_transaction'=>$successful_transaction, 'userDetails'=>$userDetails, 'dates'=>$request->start_date.' TO '.$request->end_date];

        return view('dashboard.withdrawals', $data);

    }

    public function handleValidation(array $data){

        $validator = Validator::make($data, [
            'amount'=>'required|numeric'
        ]);

        return $validator;
    }

    //create new withdrawal
    public function storeWithdrawal(Request $request)
    {

        try{

            $user = Auth::user();
            $settings = $this->appSettings->getSingleModel();

            $validation = $this->handleValidation($request->all());
            if($validation->fails()){
                return redirect('/withdrawals')->withErrors('error_message', $validation);
            }

            //check if the user has enough balance to be withdrawn
            $amountInBaseCurrency = $this->getAmountForDatabase($request->amount)['data']['amount'];
            if($amountInBaseCurrency > $user->balance){
                return redirect('/withdrawals')->with('error_message', 'Insufficient account Balance');
            }

            //add the withdrawal to the database
            $requestForDb = $this->withdrawalRequestValues($request, $user, $settings);
            $withdrawalTransaction = $this->transactionModel->insertIntoTransactionModel($requestForDb);

            if($withdrawalTransaction){

                $user->balance = $user->balance  - $amountInBaseCurrency;
                $user->save();

                $heading = 'Withdrawal Request';

                $full_name = $user->name.' '.$user->last_name;

                $date = Carbon::now()->toDateString();

                $amount_for_view = $this->getAmountForView($request->amount)['data']['amount'] ;

                $message = 'Your Withdrawal Request Of '.$amount_for_view.' ('.$this->getAmountForView($request->amount)['data']['currency'].') was successful. Please Wait patiently for approval, as our team are currently reviewing your request.';

                //send email to user
                $this->sendTransactionMail($heading, $message, env('APP_NAME'), $this->base_url, $user->email);

                $message2 = 'A withdrawal request of '.$amount_for_view.' ('.$this->getAmountForView($request->amount)['data']['currency'].') was made by '.$full_name.' on the '.$date.', please endeavor to confirm this request by signing in to the admin area.';

                //send email to admin
                $this->sendTransactionMail($heading, $message2, env('APP_NAME'), $this->base_url, $settings->company_email_2);

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

        $unique_id = $this->createUniqueId('transaction_models', 'unique_id');

        $user_full_name = $user->name .' '.$user->last_name;

        $request->amount = $this->getAmountForDatabase($request->amount)['data']['amount'];
        $request->currency = $this->getAmountForView($request->amount)['data']['currency'];
        $request->unique_id = $unique_id;
        $request->user_unique_id = $user->unique_id;
        $request->type_of_user = $user->user_type;
        $request->customer = $user_full_name;
        $request->biller_name = $user_full_name;
        $request->country = $user->country;
        $request->reference = $unique_id;
        $request->description = "Withdrawal from $settings->site_name`s Wallet";
        $request->action_type = 'withdrawal';
        $request->top_up_option = 'flutterwave';
        $request->status = 'pending';
        return $request;

    }
}
