<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionModel extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    function getSingleTransaction($condition){

        $transactionModel = TransactionModel::where($condition)->first();

        return $transactionModel;

    }

    function getAllTransaction($condition, $id = 'id', $desc = 'desc'){

        $transactionModel = TransactionModel::where($condition)->orderBy($id, $desc)->get();

        return $transactionModel;

    }




    function insertIntoTransactionModel($requestObject){

        $transaction = new TransactionModel();
        $transaction->unique_id = $requestObject->unique_id;//$this->createUniqueId('transaction_models', 'unique_id');
        $transaction->user_unique_id = $requestObject->user_unique_id;
        $transaction->type_of_user = $requestObject->type_of_user;
        $transaction->amount = $requestObject->amount;
        $transaction->description = $requestObject->description;
        $transaction->action_type = $requestObject->action_type;
        $transaction->status = $requestObject->status;
        $transaction->reference = $requestObject->reference ?? '';
        $transaction->country = $requestObject->country ?? '';
        $transaction->currency = $requestObject->currency ?? '';
        $transaction->customer = $requestObject->customer ?? '';
        $transaction->recurrence = $requestObject->recurrence ?? '';

        if($transaction->save()){
            return $transaction;
        }

    }
}
