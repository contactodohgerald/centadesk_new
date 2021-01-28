<?php

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Verifications\VerifyBankController;
use App\Http\Controllers\CurrencyRate\CurrencyRateController;
use App\Http\Controllers\AppSettings\AppSettingsController;
use App\Http\Controllers\Wallet\TransactionController;
use App\Http\Controllers\Wallet\WithdrawalController;
use App\Http\Controllers\Complain\ComplainController;
use App\Http\Controllers\Complain\ComplainHandleController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create-course', 'courseController@index');
Route::get('/clear-cache', 'HomeController@clear_cache');


Route::post('/create-course', 'courseController@create');

/*Auth::routes(['verify' => true]);

//verify email address
Route::get('/email/verify', [VerificationController::class, 'showNotice'])->middleware(['auth'])->name('verification.notice');//verification.notice


//email verification handler
Route::get('/email/verify/{id}/{hash}', [VerificationController::class,'verifyEmailHandler'])->middleware(['auth', 'signed'])->name('verification.verify');
//resend verification link
Route::post('/email/verification-notification', [VerificationController::class, 'sendVerificationEmailNotification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');*/

Route::group(['middleware'=>'web'], function(){
    //system settings
    Route::get('/main_settings_page', [AppSettingsController::class, 'mainSettings'])->name('main_settings_page');
    Route::get('/app_settings_page', [AppSettingsController::class, 'appSettings'])->name('app_settings_page');
    Route::post('/update_app_settings/{unique_id}', [AppSettingsController::class, 'updateAppSettings'])->name('update_app_settings');

});

Route::group(['middleware'=>'web'], function(){
    //update currency
    Route::post('/update_user_currency', [CurrencyRateController::class, 'updateUserPreferredCurrency'])->name('update_user_currency');

});

Route::group(['middleware'=>'web'], function(){
    //users
    Route::get('/all_students', [AdminController::class, 'showAllStudents'])->name('all_students');
    Route::get('/all_instructor', [AdminController::class, 'showAllInstructor'])->name('all_instructor');

});

Route::group(['middleware'=>'web'], function(){
    //users
    Route::get('/complain_page', [ComplainController::class, 'complainPage'])->name('complain_page');
    Route::post('/create_complain', [ComplainController::class, 'createComplain'])->name('create_complain');

    Route::get('/complain_list', [ComplainHandleController::class, 'complainListForAdmin'])->name('complain_list');
    Route::post('/activate_account', [ComplainHandleController::class, 'activateUserAccount'])->name('activate_account');
    Route::post('/ignore_request', [ComplainHandleController::class, 'ignoreAccountActivateRequest'])->name('ignore_request');
});

Route::group(['middleware'=>'web'], function(){
    //wallet
    Route::get('/my_balance', [TransactionController::class, 'myTransaction'])->name('my_balance');
    Route::post('/top_up', [TransactionController::class, 'topUpWallet'])->name('top_up');
    Route::get('/confirm_top_up', [TransactionController::class, 'confirmUserPayments'])->name('confirm_top_up');
    Route::get('/transaction_history/{unique_id}', [TransactionController::class, 'showTopUpTransaction'])->name('transaction_history');

    //withdrawals
    Route::get('/withdrawals', [WithdrawalController::class, 'myWithdrawals'])->name('withdrawals');
    //request withdrwawal
    Route::post('/make_withdrawal', [WithdrawalController::class, 'storeWithdrawal'])->name('make_withdrawal');

});

Route::group(['middleware'=>'web'], function(){
    //bank verification
    Route::get('/verifications/bank', [VerifyBankController::class, 'index'])->name('account_validation');
    Route::post('/verify-bank', [VerifyBankController::class, 'verifyBank'])->name('verify-bank');
    Route::post('/add-bank', [VerifyBankController::class, 'addBank'])->name('add-bank');

});
