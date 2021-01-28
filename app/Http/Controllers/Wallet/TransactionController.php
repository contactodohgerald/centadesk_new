<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Model\TransactionModel;
use App\Traits\Generics;
use App\Traits\Payment;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    //
    use Generics, Payment;

    function __construct(TransactionModel $transactionModel, User $user)
    {
        $this->middleware('auth');
        $this->transactionModel = $transactionModel;
        $this->user = $user;
    }

    public function myTransaction(){

        $userDetails = Auth::user();

        if ($userDetails === 'admin'){

            $condition = [
                ['action_type', 'top_up'],
            ];
            $transaction = $this->transactionModel->getAllTransaction($condition);

            $conditions = [
                ['action_type', 'top_up'],
                ['status', 'pending'],
            ];
            $pending_transaction = $this->transactionModel->getAllTransaction($conditions);

            $conditionss = [
                ['action_type', 'top_up'],
                ['status', 'confirmed'],
            ];
            $successful_transaction = $this->transactionModel->getAllTransaction($conditionss);
        }else{
            $condition = [
                ['user_unique_id', $userDetails->unique_id],
                ['action_type', 'top_up'],
            ];
            $transaction = $this->transactionModel->getAllTransaction($condition);

            $conditions = [
                ['user_unique_id', $userDetails->unique_id],
                ['action_type', 'top_up'],
                ['status', 'pending'],
            ];
            $pending_transaction = $this->transactionModel->getAllTransaction($conditions);

            $conditionss = [
                ['user_unique_id', $userDetails->unique_id],
                ['action_type', 'top_up'],
                ['status', 'confirmed'],
            ];
            $successful_transaction = $this->transactionModel->getAllTransaction($conditionss);
        }

        $data = ['transaction'=>$transaction, 'pending_transaction'=>$pending_transaction, 'successful_transaction'=>$successful_transaction, 'userDetails'=>$userDetails];

        return view('dashboard.my_wallet', $data);

    }

    public function showTopUpTransaction($unique_id){

        $userDetails = Auth::user();

        $condition = [
            ['unique_id', $unique_id]
        ];

        $transactions = $this->transactionModel->getSingleTransaction($condition);

        return view('dashboard.transaction_history', ['userDetails'=>$userDetails, 'transactions'=>$transactions]);
    }

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [
            'topUpAmount' => 'required',
        ]);

    }

    public function topUpWallet(Request $request){

        $user_details = Auth::user();

        try{
            $this->Validator($request);//validate fields

            $user_unique_id = $user_details->unique_id;

            $user_full_name = $user_details->name. ' '.$user_details->last_name;

            $user_preferred_currency = $user_details->getBalanceForView()['data']['currency'];

            $inputed_amount = $request->topUpAmount;

            $unique_id = $this->createUniqueId('transaction_models', 'unique_id');
            $request = $user_details;
            $request->unique_id = $unique_id;
            $request->user_unique_id = $user_unique_id;
            $request->type_of_user = $user_details->user_type;
            $request->currency = $user_preferred_currency;
            $request->reference = $unique_id;
            $request->amount = $this->getAmountForDatabase($inputed_amount)['data']['amount'];
            $request->description = 'Wallet Top Up';
            $request->action_type = 'top_up';
            $request->status = 'pending';

            $newTransactionDetails = $this->transactionModel->insertIntoTransactionModel($request);

            if ($newTransactionDetails){

                $ipaddress = $this->get_client_ip();

                $pay_with_flutterwave = $this->pay_with_flutterwave( $this->base_url."/confirm_top_up", $inputed_amount, $user_details->email, $user_details->phone, $user_full_name, $unique_id, $user_preferred_currency, $user_details->id, $ipaddress);

                return redirect()->to($pay_with_flutterwave);

            }else{
                return redirect('/my_balance')->with('error_message', 'An Error occurred, Please try Again Later');
            }

        }catch (Exception $exception){

            $errorsArray = $exception->getMessage();
            return  redirect('/my_balance')->with('error_message', $errorsArray);

        }

    }

    public function confirmUserPayments(){

        $transaction_id = $_GET['transaction_id'];
        $tx_ref = $_GET['tx_ref'];
        $status = $_GET['status'];

        if ($status === 'successful'){

            $decoded_response = $this->confirmPayments($transaction_id);

            if ($decoded_response['status'] === 'success'){

                if ($decoded_response['data']['tx_ref'] != $tx_ref){
                    return redirect('/my_balance')->with('error_message', 'Transaction Confirmation Was Not Successful, An Error Occurred');
                }

                $condition = [
                    ['unique_id', $decoded_response['data']['tx_ref']]
                ];

                $transactionModel = $this->transactionModel->getSingleTransaction($condition);

                $conditions = [
                    ['unique_id', $transactionModel->user_unique_id],
                    ['is_deleted', 'no'],
                ];

                $user = $this->user->getSingleUser($conditions);

                $convertedPrice = $this->calculateExchangeRate($user->unique_id, $transactionModel->amount, 'send_to_view');

                //display error
                if ($decoded_response['data']['amount'] !== $convertedPrice || $decoded_response['data']['amount'] > $convertedPrice){
                    $transactionModel->status = 'failed';
                    $transactionModel->save();
                    return redirect('/my_balance')->with('error_message', 'Amount Paid Is Not Equal To Actual Price');
                }

                if ($decoded_response['data']['currency']!== $transactionModel->currency){
                    $transactionModel->status = 'failed';
                    $transactionModel->save();
                    return redirect('/my_balance')->with('error_message', 'Currency Is Not Equal To That Of The Actual Price');
                }

                //update the PayForBookByUser table
                $transactionModel->flw_ref = $decoded_response['data']['flw_ref'];
                $transactionModel->status = 'confirmed';
                $transactionModel->account_token = $decoded_response['data']['account']['account_token'];
                $transactionModel->consumer_id = $decoded_response['data']['meta']['consumer_id'];
                $transactionModel->consumer_mac = $decoded_response['data']['meta']['consumer_mac'];
                $transactionModel->amount_settled = $decoded_response['data']['amount_settled'];
                $transactionModel->device_fingerprint = $decoded_response['data']['device_fingerprint'];
                $transactionModel->save();

                $add_to_user_balance = $user->balance + $transactionModel->amount;

                $user->balance = $add_to_user_balance;
                $user->save();

                return redirect('/my_balance')->with('success_message', 'Payment Was Successfully Made, You Can Now Upload Books From Your Device');

            }else{
                return redirect('/my_balance')->with('error_message', 'Payment Was Not Verified, An Error Occurred');
            }

        }
    }
}
