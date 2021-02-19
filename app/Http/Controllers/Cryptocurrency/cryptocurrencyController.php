<?php

namespace App\Http\Controllers\Cryptocurrency;

use App\User;
use Exception;
use GuzzleHttp\Client;
use App\Model\AppSettings;
use App\Traits\appFunction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class cryptocurrencyController extends Controller
{
    use appFunction;

    private $blockchain_api_v2_key = '0b9da7ee-b055-42fc-ac3f-1872f7641577';
    private $call_back_url = 'https://coinhunta.com';


    function __construct(AppSettings $appSettings)
    {
        $this->middleware('auth');
        $this->appSettings = $appSettings;
    }

    /**
     * Function for generating blockchain payment wallet address.
     *
     * @param string $txn_id
     * @return array
     */
    public function gen_payment_address(Request $request)
    {
        $txn_id = $request->input();
        // Get the account xpub.
        $app_settings = $this->appSettings->getSingleModel();
        $app_xpub = $app_settings['account_xpub'];

        $callback_url = $this->call_back_url;
        $api_key = $this->blockchain_api_v2_key;
        try {
            if (!$txn_id) {
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
            // https://api.blockchain.info/v2/receive?xpub=xpub6DRUkwWYGnoarDMuZUKQZcUA1P9H32AHM7qwQUqKaGWXjeV74VfxtQDAZwi2bmSLtM2PkKMbEQZFgMFF4ZbbjAFgs9ubwLebhqcSwriNJMxpub6DRUkwWYGnoarDMuZUKQZcUA1P9H32AHM7qwQUqKaGWXjeV74VfxtQDAZwi2bmSLtM2PkKMbEQZFgMFF4ZbbjAFgs9ubwLebhqcSwriNJMD&callback=https://coinhunta.com&key=0b9da7ee-b055-42fc-ac3f-1872f7641577
            // $response = $this->curl_request('GET', 'https://api.blockchain.info/v2/receive?xpub=' . $app_xpub . '&callback=' . $callback_url . '&key=' . $api_key . '');
            $response = $this->guzzle_client('GET', 'https://api.blockchain.info/v2/receive?xpub=' . $app_xpub . '&callback=' . $callback_url . '&key=' . $api_key . '');

            return $response;
        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['message' => $error, 'status' => false];
        }
    }
}
