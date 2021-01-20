<?php

use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/*Auth::routes(['verify' => true]);

//verify email address
Route::get('/email/verify', [VerificationController::class, 'showNotice'])->middleware(['auth'])->name('verification.notice');//verification.notice


//email verification handler
Route::get('/email/verify/{id}/{hash}', [VerificationController::class,'verifyEmailHandler'])->middleware(['auth', 'signed'])->name('verification.verify');
//resend verification link
Route::post('/email/verification-notification', [VerificationController::class, 'sendVerificationEmailNotification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');*/
