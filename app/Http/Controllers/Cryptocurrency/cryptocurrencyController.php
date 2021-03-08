<?php

namespace App\Http\Controllers\Cryptocurrency;

use App\User;
use Exception;
use GuzzleHttp\Client;
use App\Traits\Generics;
use App\Model\AppSettings;
use App\Traits\appFunction;
use Illuminate\Http\Request;
use App\Model\paymentAddress;
use App\Model\TransactionModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PaymentAddress\PaymentAddressController;

class cryptocurrencyController extends Controller
{
    use appFunction, Generics;

    private $blockchain_api_v2_key = '0b9da7ee-b055-42fc-ac3f-1872f7641577';
    private $call_back_url = 'https://centadesk.com';
    private $crypto_compare_api_key = '9f84f53a067dd8d02d95feb9fef27ba64208ef313e0c7367a8e7f2d49f5866e7';

    // old xpub6CiHKyu1wfr4WYXUv9amvGUErgKpMGtc8qmKFakjMbVK8EctZihZGpEA9ybLusoyUVg7PRrwy3DMN4Gxu2EiwvF2boBTHyLy9kqcvwSmm6V

    // new xpub6CiHKyu1wfr4YB6TLi8jwgWhfXub6FjhHLM3SsHrxB1nxvfr552gjWB3MnEq6XKtwWH7KBr8PpSpdpetBot6d91gBkJegyYkC5wdEkjHEJx



    function __construct(AppSettings $appSettings, TransactionModel $transactionModel, PaymentAddressController $PaymentAddressController)
    {
        $this->middleware('auth');
        $this->appSettings = $appSettings;
        $this->transactionModel = $transactionModel;
        $this->PaymentAddressController = $PaymentAddressController;
    }

    public function payment_gateway($id)
    {
        $condition = [
            ['unique_id', $id],
        ];
        $transactions = $this->transactionModel->getSingleTransaction($condition);

        $view = [
            'transaction' => $transactions,
        ];
        return view('dashboard.bitcoin_gateway', $view);
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
     * @return mixed
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

            // check if response contains a value
            if (empty($response)) {
                $error = [
                    'errors' => [$this->errorMsgs(15)['msg']],
                ];
                return ['errors' => $error, 'status' => false];
            }



            if (key((array)$response) == 'message') {
                // if its a problem with xpub, probably maxed out its limit.
                if (current((array)$response) == 'Problem with xpub') {
                    $prev_used_address = $this->PaymentAddressController->get_prev_addresses($app_xpub);
                    if ($prev_used_address['status'] == false) {
                        return $prev_used_address;
                    }

                    return [
                        'status' => true,
                        'data' => $prev_used_address
                    ];
                } else {
                    throw new Exception(current((array)$response));
                }
            } else {
                // store payment address for use in future
                $store_address = $this->PaymentAddressController->create($app_xpub, $response['address']);
                if ($store_address['status'] == false) {
                    return $store_address;
                }

                return [
                    'status' => true,
                    'data' => $response
                ];
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return ["errors" => $error, 'status' => false];
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

            $address = $this->gen_payment_address($request, $txn_id);

            if ($address['status'] === false) {
                // return response()->json($address);
                throw new Exception($address['errors']['errors']);
            }

            $response = $this->api_call('https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD&api_key=' . $this->crypto_compare_api_key);
            if (empty($response)) {
                throw new Exception($this->errorMsgs(15)['msg']);
            }

            $amt_in_coin = $this->convert_to_crypto($response, $inputed_amount);

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
            $request->btc_payment_address = $address['data']['address'];
            $request->amount_in_btc = $amt_in_coin;

            $transaction = $this->transactionModel->insertIntoTransactionModel($request);

            if ($transaction) {
                $error = 'Transaction Created! Awaiting payment.';
                return response()->json(["message" => $error, "ref_id" => $txn_id, 'status' => true]);
            } else {
                throw new Exception($this->errorMsgs(14)['msg']);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }
    /**
     * Function to convert crypto_compare response to crypto equivalent.
     *
     * @return numeric
     */
    public function convert_to_crypto($response, $amt_in_usd)
    {
        // the api returns the equivalent of 1 of the coin in usd
        $equiv = $response['USD'];
        $amt_in_coin = $amt_in_usd / $equiv;
        return $amt_in_coin;
    }

    public function confirm_payment()
    {
        /*
        confirm the transaction id
        change transaction status to confirmed
        top up the balance in the user table
        */
    }
}
