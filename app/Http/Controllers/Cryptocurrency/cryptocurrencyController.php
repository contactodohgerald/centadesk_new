<?php

namespace App\Http\Controllers\Cryptocurrency;

use App\User;
use Exception;
use GuzzleHttp\Client;
use App\Traits\Generics;
use App\Model\AppSettings;
use App\Traits\appFunction;
use Illuminate\Http\Request;
use App\Model\TransactionModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class cryptocurrencyController extends Controller
{
    use appFunction, Generics;

    private $blockchain_api_v2_key = '0b9da7ee-b055-42fc-ac3f-1872f7641577';
    private $call_back_url = 'https://coinhunta.com';

    function __construct(AppSettings $appSettings, TransactionModel $transactionModel)
    {
        $this->middleware('auth');
        $this->appSettings = $appSettings;
        $this->transactionModel = $transactionModel;
    }


    protected function Validator($request)
    {
        $validator = Validator::make($request->all(), [
            'topUpAmount' => 'required|numeric',
        ]);
        return $validator;
    }

    /**
     * Function for generating blockchain payment wallet address.
     *
     * @param string $txn_id
     * @return array
     */
    public function gen_payment_address(Request $request, $txn_id)
    {
        // Get the account xpub.
        $app_settings = $this->appSettings->getSingleModel();
        $app_xpub = $app_settings['account_xpub'];

        $callback_url = $this->call_back_url;
        $api_key = $this->blockchain_api_v2_key;
        try {
            if (empty($txn_id)) {
                throw new Exception('Error! Provide the transaction Id.');
            }

            if (empty($app_xpub)) {
                throw new Exception('Error! System Account Xpub has not been set.');
            }
            if (empty($callback_url)) {
                throw new Exception('Error! Set a callback url for this request.');
            }
            if (empty($api_key)) {
                throw new Exception('Error! Set the api key value for this request.');
            }
            $response = $this->curl_request('GET', 'https://api.blockchain.info/v2/receive?xpub=' . $app_xpub . '&callback=' . urlencode($callback_url) . '&key=' . $api_key . '');
            // return $response;
            if(empty($response)){
                return ['message' => $this->errorMsgs(15)['msg'], 'status' => false];
            }

            if (key((array)$response) == 'message') {
                throw new Exception(current((array)$response));
            } else {
                return $response;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['message' => $error['message'], 'status' => false];
        }
    }

    public function create_transaction(Request $request)
    {
        $user = auth()->user();
        $user_unique_id = $user->unique_id;
        $user_full_name = $user->name . ' ' . $user->last_name;

        $txn_id =  $this->createUniqueId('transaction_models', 'unique_id');
        $inputed_amount = $request->topUpAmount;

        try {
            $validator = $this->Validator($request); //validate fields

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }
            return '$request';

            $address = $this->gen_payment_address($request, $txn_id);

            if (isset($address['status'])) {
                throw new Exception($address['message']);
            }

            $request = $user;
            $request->unique_id = $txn_id;
            $request->user_unique_id = $user_unique_id;
            $request->type_of_user = $user->user_type;
            $request->country = $user->country;
            $request->customer = $user_full_name;
            $request->biller_name = $user_full_name;
            $request->currency = 'USD';
            $request->reference = $txn_id;
            $request->amount = $this->getAmountForDatabase($inputed_amount)['data']['amount'];
            $request->description = 'Wallet Top Up';
            $request->action_type = 'top_up';
            $request->top_up_option = 'bitcoin';
            $request->status = 'pending';
            $request->btc_payment_address = $address['address'];

            $transaction = $this->transactionModel->insertIntoTransactionModel($request);

            if ($transaction) {
                $error = 'Transaction Created!';
                return response()->json(["message" => $error, "ref_id"=> $txn_id, 'status' => true]);
            } else {
                throw new Exception($this->errorMsgs(14)['msg']);
            }

        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['message' => $error, 'status' => false];
        }
    }
}
