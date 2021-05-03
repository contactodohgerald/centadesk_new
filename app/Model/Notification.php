<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    
    public function users(){
        return $this->belongsTo('App\User', 'user_unique_id');
    }

    function getAllNotification($condition, $id = 'id', $desc = 'desc'){

        return Notification::where($condition)->orderBy($id, $desc)->get();

    }

    function getSingleNotification($condition){

        return Notification::where($condition)->first();

    }
}
