<?php


use App\Subscription_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\priceController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Roles\RolesController;
use App\Http\Controllers\Course\courseController;

use App\Http\Controllers\Roles\AddRolesController;
use App\Http\Controllers\Roles\UserTypeController;
use App\Http\Controllers\Auth\VerificationController;

use App\Http\Controllers\Complain\ComplainController;
use App\Http\Controllers\Wallet\WithdrawalController;
use App\Http\Controllers\Wallet\TransactionController;
use App\Http\Controllers\CourseCategoryModelController;
use App\Http\Controllers\SaveCourse\SaveCourseController;
use App\Http\Controllers\AppSettings\AppSettingsController;

use App\Http\Controllers\Complain\ComplainHandleController;
use App\Http\Controllers\Verifications\VerifyBankController;
use App\Http\Controllers\CurrencyRate\CurrencyRateController;
use App\Http\Controllers\Subscriptions\SubscriptionController;
use App\Http\Controllers\Cryptocurrency\cryptocurrencyController;

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
Route::get('/show-csrf', 'HomeController@showToken');
Route::get('/clear-cache', 'HomeController@clear_cache');

Route::group(['middleware' => 'web'], function () {
    // courses

    Route::get('/create-course',[courseController::class,'index']);
    Route::get('/view-courses', [courseController::class,'show']);
    Route::get('/edit-course/{id}', [courseController::class,'update_page']);
    Route::post('/create-course', [courseController::class,'create']);
    Route::post('/edit-course/{id}', [courseController::class,'update']);
    Route::post('/delete-course/{id}', [courseController::class,'soft_delete']);

});


Route::group(['middleware' => 'web'], function () {
    // user routes
    Route::get('/teacher/profile',[UserController::class,'show_teacher_profile']);
    Route::post('/personal-details',[UserController::class,'update_user_details']);
    Route::post('/profile/photo',[UserController::class,'upload_cover_photo']);
});


Route::group(['middleware' => 'web'], function () {
    // crypto currency
    // Route::post('/user/wallet/update',[cryptocurrencyController::class,'update_wallet']);
    Route::post('/generate_address',[cryptocurrencyController::class,'gen_payment_address']);
});


Route::group(['middleware' => 'web'], function () {
    // Subscription
    Route::post('/subscribe_to',[SubscriptionController::class,'subscribe_to']);
    Route::post('/unsubscribe_from',[SubscriptionController::class,'unsubscribe_from']);
});


Auth::routes(['verify' => true]);

//verify email address
Route::get('/email/verify', [VerificationController::class, 'showNotice'])->middleware(['auth'])->name('verification.notice'); //verification.notice


//email verification handler
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmailHandler'])->middleware(['auth', 'signed'])->name('verification.verify');
//resend verification link
Route::post('/email/verification-notification', [VerificationController::class, 'sendVerificationEmailNotification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::group(['middleware'=>'web'], function(){
    //create Course Category
    Route::get('/create_category', [CourseCategoryModelController::class, 'index'])->name('create_category');
    Route::get('/view_category', [CourseCategoryModelController::class, 'viewCoursesCategories'])->name('view_category');
    Route::post('/add_category', [CourseCategoryModelController::class, 'create'])->name('add_category');
    Route::get('/edit_category/{unique_id}', [CourseCategoryModelController::class, 'show'])->name('edit_category');
    Route::post('/update_category/{unique_id}', [CourseCategoryModelController::class, 'update'])->name('update_category');

});

Route::group(['middleware'=>'web'], function(){
    // Course
    Route::get('/create-course',  [courseController::class, 'index'])->name('create-course');
    Route::get('/view-courses',  [courseController::class, 'show'])->name('view-courses');
    Route::get('/view_course/{unique_id}', [courseController::class, 'showCourses'])->name('view_course');
    Route::get('/edit-course/{id}', [courseController::class, 'update_page'])->name('edit-course');

});

Route::group(['middleware'=>'web'], function(){
    //create Price For Course
    Route::get('/create_price', [priceController::class, 'create'])->name('create_price');
    Route::post('/store_price', [priceController::class, 'store'])->name('store_price');
    Route::get('/view_price', [priceController::class, 'index'])->name('view_price');

});

Route::group(['middleware'=>'web'], function(){
    //system settings
    Route::get('/main_settings_page', [AppSettingsController::class, 'mainSettings'])->name('main_settings_page');
    Route::get('/app_settings_page', [AppSettingsController::class, 'appSettings'])->name('app_settings_page');
    Route::post('/update_app_settings/{unique_id}', [AppSettingsController::class, 'updateAppSettings'])->name('update_app_settings');
});

Route::group(['middleware' => 'web'], function () {
    //update currency
    Route::post('/update_user_currency', [CurrencyRateController::class, 'updateUserPreferredCurrency'])->name('update_user_currency');
});

Route::group(['middleware'=>'web'], function(){
    //saved courses
    Route::get('/saved-course', [SaveCourseController::class, 'getAllSavedCourse'])->name('saved-course');

});

Route::group(['middleware'=>'web'], function(){
    //users
    Route::get('/all_students', [AdminController::class, 'showAllStudents'])->name('all_students');
    Route::get('/all_instructor', [AdminController::class, 'showAllInstructor'])->name('all_instructor');
});

Route::group(['middleware' => 'web'], function () {
    //users
    Route::get('/complain_page', [ComplainController::class, 'complainPage'])->name('complain_page');
    Route::post('/create_complain', [ComplainController::class, 'createComplain'])->name('create_complain');

    Route::get('/complain_list', [ComplainHandleController::class, 'complainListForAdmin'])->name('complain_list');
    Route::post('/activate_account', [ComplainHandleController::class, 'activateUserAccount'])->name('activate_account');
    Route::post('/ignore_request', [ComplainHandleController::class, 'ignoreAccountActivateRequest'])->name('ignore_request');
});

Route::group(['middleware' => 'web'], function () {
    //wallet
    Route::get('/my_balance', [TransactionController::class, 'myTransaction'])->name('my_balance');
    Route::post('/top_up', [TransactionController::class, 'topUpWallet'])->name('top_up');
    Route::get('/confirm_top_up', [TransactionController::class, 'confirmUserPayments'])->name('confirm_top_up');
    Route::post('/transactions_by_date', [TransactionController::class, 'showTransactionByDate'])->name('transactions_by_date');
    Route::get('/transaction_history/{unique_id}', [TransactionController::class, 'showTopUpTransaction'])->name('transaction_history');

    //withdrawals
    Route::get('/withdrawals', [WithdrawalController::class, 'myWithdrawals'])->name('withdrawals');
    //request withdrawals
    Route::post('/make_withdrawal', [WithdrawalController::class, 'storeWithdrawal'])->name('make_withdrawal');
    //show withdrawals by date
    Route::post('/withdrawals_by_date', [WithdrawalController::class, 'showWithdrawalsByDate'])->name('withdrawals_by_date');
});

Route::group(['middleware' => 'web'], function () {
    //bank verification
    Route::get('/verifications/bank', [VerifyBankController::class, 'index'])->name('account_validation');
    Route::post('/verify-bank', [VerifyBankController::class, 'verifyBank'])->name('verify-bank');
    Route::post('/add-bank', [VerifyBankController::class, 'addBank'])->name('add-bank');
});

Route::group(['middleware' => 'web'], function () {
    //users details update
    Route::post('/update_bank_account', [UserController::class, 'bankAccountUpdate'])->name('update_bank_account');
    Route::post('/update_wallet_address', [UserController::class, 'walletAddressUpdate'])->name('update_wallet_address');
});

//Route::group(['middleware'=>'web'], function(){
//bank verification
//add roles area
Route::get('/add_roles', [RolesController::class, 'create'])->name('add_roles');
Route::get('/view_all_roles', [RolesController::class, 'index'])->name('view_all_roles');
Route::post('/store_role', [RolesController::class, 'store'])->name('store_role');
Route::get('/add_role_for_user/{userTypeId}', [AddRolesController::class, 'index'])->name('add_role_for_user');
Route::post('/store_role_for_user/{userTypeId}', [AddRolesController::class, 'store'])->name('store_role_for_user');
//add user type
Route::get('/add_user_type', [UserTypeController::class, 'create'])->name('add_user_type');
Route::get('/all_user_type', [UserTypeController::class, 'index'])->name('all_user_type');
Route::post('/store_user_type', [UserTypeController::class, 'store'])->name('store_user_type');

//});
