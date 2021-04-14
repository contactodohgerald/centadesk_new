<?php

namespace App;

use App\Model\AppSettings;
use App\Model\CurrencyRatesModel;
use App\Model\Previledges;
use App\Model\RolesModel;
use App\Model\UserTypesModel;
use App\Traits\Generics;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail{
    use Notifiable;
    use Generics;

    //
    use SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'unique_id',
        'last_name',
        'user_type',
        'referred_id',
        'user_referral_id',
        'professonal_heading',
        'description',
        'facebook',
        'twitter',
        'linkedin',
        'youtube',
        'instagram',
        'whatsapp',
        'verified_badge'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses(){
        return $this->hasMany('App\course_model', 'user_id');
    }

    public function subscribers(){
        return $this->hasMany('App\Model\Subscribe', 'teacher_unique_id');
    } 
    
    public function enroll_students(){
        return $this->hasMany('App\Model\courseEnrollment', 'user_enrolling');
    }

    public function getSingleUser($condition){

        $users = User::where($condition)->first();

        return $users;

    }

    public function getAllUsers($condition, $id = 'id', $desc = 'desc'){

        $users = User::orderBy($id, $desc)->where($condition)->get();

        return $users;

    }

    function getBalanceForView(){

        if(Auth::check()) {
            $userObject = Auth::user();
            $amountDetails = $this->calculateExchangeRate($userObject, $userObject->balance, 'sending_to_view');
            return $amountDetails;
        }


    }

    function getAmountForView($amount){
        if(Auth::check()){
            $userObject = Auth::user();
        }else{
            $appSettings = new AppSettings();
            $appSettings = $appSettings->getSingleModel();
            $appSettings->prefered_currency = 50;
            $userObject = $appSettings;
        }
        $amountDetails = $this->calculateExchangeRate($userObject, $amount, 'sending_to_view');
        return $amountDetails;

    }

    //calculate the user balance
    function calculateUserBalance(){
        $user_details = Auth::user();
        $user_balance = $user_details->balance;
        $user_unique_id = $user_details->unique_id;

        $condition = [
            ['user_unique_id', $user_unique_id],
            ['action_type', 'withdrawal'],
            ['status', 'pending'],
        ];

        $get_withdrawal_amount = $this->getAllTransactionAmount($condition);

        //add the withdrawal amount where the type = withdrawal and the status = pending to the user balance

        $total = $user_balance + $get_withdrawal_amount;

        $user_new_balance = $this->getAmountForView($total);

        return $user_new_balance['data']['amount'];
    }

    public function currency_details(){
        return $this->belongsTo('App\Model\CurrencyRatesModel', 'preferred_currency');
    }

    function returnLink(){

        if(env('APP_ENV') === 'production'){
            return 'storage/';
        }else{
            return 'storage/';
        }

    }

    function returnBaseUrl(){
        return 'http://127.0.0.1:8000/';
    }

    function privilegeChecker($role){

        if(Auth::check()){
            $userDetails = Auth::user();
            $userType = $userDetails->user_type;
            $typOfUserDetails = UserTypesModel::where('type_of_user', $userType)->first();
            $roleDetails = RolesModel::where('role', $role)->first();
            if($typOfUserDetails === null || $roleDetails === null){
                return false;
            }
            //get the previledges
            $priviledgesDetails = Previledges::where('role_id', $roleDetails->unique_id)->where('type_of_user_id', $typOfUserDetails->unique_id)->first();
            if($priviledgesDetails !== null){
                return true;
            }
        }

        return false;
    }

    function getOneModel($userId){
        return User::find($userId);
    }

}
