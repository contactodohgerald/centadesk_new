<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Auth\VerificationController;

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
    Route::get('/main_settings_page', [App\Http\Controllers\AppSettings\AppSettingsController::class, 'mainSettings'])->name('main_settings_page');
    Route::get('/app_settings_page', [App\Http\Controllers\AppSettings\AppSettingsController::class, 'appSettings'])->name('app_settings_page');
    Route::post('/update_app_settings/{unique_id}', [App\Http\Controllers\AppSettings\AppSettingsController::class, 'updateAppSettings'])->name('update_app_settings');

});

Route::group(['middleware'=>'web'], function(){
    //update currency
    Route::post('/update_user_currency', [App\Http\Controllers\CurrencyRate\CurrencyRateController::class, 'updateUserPreferredCurrency'])->name('update_user_currency');

});

Route::group(['middleware'=>'web'], function(){
    //wallet
    Route::get('/my_balance', [App\Http\Controllers\Wallet\TransactionController::class, 'myTransaction'])->name('my_balance');
    Route::post('/top_up', [App\Http\Controllers\Wallet\TransactionController::class, 'topUpWallet'])->name('top_up');
    Route::get('/confirm_top_up', [App\Http\Controllers\Wallet\TransactionController::class, 'confirmUserPayments'])->name('confirm_top_up');

    //withdrawals
    Route::get('/withdrawals', [App\Http\Controllers\Wallet\WithdrawalController::class, 'myWithdrawals'])->name('withdrawals');
    //request withdrwawal
    Route::post('/make_withdrawal', [App\Http\Controllers\Wallet\WithdrawalController::class, 'storeWithdrawal'])->name('make_withdrawal');

});


Route::group(['middleware'=>'web'], function(){
    //bank verification
    Route::get('/verifications/bank', [App\Http\Controllers\Verifications\VerifyBankController::class, 'index'])->name('account_validation');
    Route::post('/verify-bank', [App\Http\Controllers\Verifications\VerifyBankController::class, 'verifyBank'])->name('verify-bank');
    Route::post('/add-bank', [App\Http\Controllers\Verifications\VerifyBankController::class, 'addBank'])->name('add-bank');

});
