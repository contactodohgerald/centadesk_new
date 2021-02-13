<?php

use App\Http\Controllers\courseController;
use App\Http\Controllers\SaveCourse\SaveCourseController;
use App\Http\Controllers\Wallet\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api'], function ($router) {

    // Route::get('/user', function (Request $request) {
    //     return  $request->all();
    // });

    Route::post('/create-price', 'priceController@create');
    Route::post('/create-category', 'CourseCategoryModelController@create');

    Route::post('/handle_transfers', [TransactionController::class, 'handleTransfers'])->name('handle_transfers');
    Route::post('/confirm_withdrawal_payment', [TransactionController::class, 'markWithdrawalsAsPaid'])->name('confirm_withdrawal_payment');

    Route::post('/activateCoursesStatus', [courseController::class, 'activateCoursesStatus'])->name('activateCoursesStatus');


    Route::post('/saveCourse', [SaveCourseController::class, 'saveCourse'])->name('saveCourse');
});
