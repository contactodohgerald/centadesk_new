<?php

namespace App\Traits;

use App\Model\CurrencyRatesModel;
use App\Model\TransactionModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


trait Generics{


    function createObject($array){
        return json_decode(json_encode($array));
    }

    public function random_string ( $type = 'alnum', $len = 20 ){
        switch ( $type )
        {
            case 'alnum'	:
            case 'numeric'	:
            case 'nozero'	:

                switch ($type)
                {
                    case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric'	:	$pool = '0123456789';
                        break;
                    case 'nozero'	:	$pool = '123456789';
                        break;
                }

                $str = '';
                $mdstr = md5 ( uniqid ( mt_rand () ) );
                $mdstrstrlen = strlen($mdstr);
                for ( $i=0; $i < $len; $i++ )
                {
                    $str .= substr ( $pool, mt_rand ( 0, strlen ( $pool ) -1 ), 1 );
                }
                return $str.substr($mdstr, 0, $mdstrstrlen/2);
                break;
            case 'unique' : return md5 ( uniqid ( mt_rand () ) );
                break;
        }
    }

//create a unique id
    public function createUniqueId($table_name, $column){

        /*$unique_id = Controller::picker();*/
        $unique_id = $this->random_string();

        //check for the database count from the database"unique_id"
        $rowcount = DB::table($table_name)->where($column, $unique_id)->count();

        if($rowcount == 0){

            if(empty($unique_id)){
                $this->createUniqueId($table_name, $column);
            }else{
                return $unique_id;
            }

        }else{
            $this->createUniqueId($table_name, $column);
        }

    }

    function returnCurrencyArray(){

        return ['currencyArray'=>['BIF', 'CAD', 'CDF', 'CVE', 'EUR', 'GBP', 'GHS', 'GMD', 'GNF', 'KES', 'LRD', 'MWK', 'MZN',
            'NGN', 'RWF', 'SLL', 'STD', 'TZS', 'UGX', 'USD', 'XAF', 'XOF', 'ZMK', 'ZMW', 'ZWD', 'ZAR'],
         'countryCodeArray'=>['BI', 'CA', 'DR', 'CV', 'EU', 'GB', 'GH', 'GM', 'GN', 'KE', 'LRD', 'MWK', 'MZN',
            'NG', 'RW', 'SL', 'ST', 'TZ', 'UG', 'US', 'XA', 'XO', 'ZM', 'ZM', 'ZW', 'ZA']];

    }

    public  function createUniqueIdForReferral($length, $table_name, $column){

        $unique = $this->create8randomNumberAndString($length);

        //check for the database count from the database"unique_id"
        $rowcount = DB::table($table_name)->where($column, $unique)->count();

        if($rowcount == 0){
            return $unique;
        }else{
            $this->createUniqueIdForReferral($length, $table_name, $column);
        }
    }

    public  function create8randomNumberAndString($length)
    {
        $random = "";
        srand((double) microtime() * 1000000);

        $data = "123456123456789071234567890890";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; // if you need alphabetic also

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;

    }

    //get the currency exchange rate
    public function calculateExchangeRate($userObject, $amount_sent_in = 0, $type_of_action = 'sending_to_view'){
        //base currency is EUR
        //$type_of_action = ('sending_to_view', 'sending_to_db')

        $choosen_currency_id = $userObject->preferred_currency;

        //select the currency
        $currency_details = CurrencyRatesModel::find($choosen_currency_id);
        $rate = $currency_details->rate_of_conversion;

        //$type_of_action = ('sending_to_view', 'sending_to_db')
        if($type_of_action === 'sending_to_view'){
            //die($amount_sent_in);
            //1EUR = $rate for choosen currency
            //$amount_sent_in EUR = ?
            $amount = $amount_sent_in * $rate;
            //$amount = round($amount);
        }

        if($type_of_action === 'sending_to_db'){
            //1EUR = $rate for choosen currency
            //? EUR   =  $amount_sent_in;
            $amount = $amount_sent_in / $rate;
            //$amount = round($amount);
        }

        return [
            'error_code'=>0,
            'error'=>'',
            'data'=>[
                'amount'=>$amount,
                'currency'=>$currency_details->second_currency,
                'currency_id'=>$currency_details->id
            ]
        ];

    }

    function getAmountForView($amount_sent_in = 0){

        $userObject = Auth::user();
        $amountDetails = $this->calculateExchangeRate($userObject, $amount_sent_in, $type_of_action = 'sending_to_view');
        return $amountDetails;

    }

    function getAmountForDatabase($amount_sent_in = 0){

        $userObject = Auth::user();
        $amountDetails = $this->calculateExchangeRate($userObject, $amount_sent_in, $type_of_action = 'sending_to_db');
        return $amountDetails;

    }

    function getAllTransactionAmount($condition){

        $transactionModel = TransactionModel::where($condition)->sum('amount');

        return $transactionModel;

    }

}
