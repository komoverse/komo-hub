<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SSOController;

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

Route::get('/', [PageController::class, 'showAccountDashboard']);
Route::prefix('auth')->group(function(){
    Route::get('google', [SSOController::class, 'redirectToGoogle']);
    Route::get('google/callback', [SSOController::class, 'handleGoogleCallback']);
    Route::get('facebook', [SSOController::class, 'redirectToFacebook']);
    Route::get('facebook/callback', [SSOController::class, 'handleFacebookCallback']);
    Route::get('twitter', [SSOController::class, 'redirectToTwitter']);
    Route::get('twitter/callback', [SSOController::class, 'handleTwitterCallback']);
});
Route::get('login', [PageController::class, 'showLoginPage']);
Route::post('login', [PageController::class, 'login']);
Route::get('logout', [PageController::class, 'logout']);
Route::get('register', [PageController::class, 'showRegisterPage']);
Route::post('register', [PageController::class, 'submitRegistration']);
Route::post('otp', [PageController::class, 'submitOTPChallenge']);
Route::post('phantom-login', [PageController::class, 'phantomLogin']);

Route::post('change-pp', [PageController::class, 'changeProfilePicture']);
Route::post('add-wallet', [PageController::class, 'addSolanaWallet']);

Route::get('topup', [PageController::class, 'showTopupShardForm']);
Route::get('topup/qris/{price_idr}', [PageController::class, 'topupShardIDR']);
Route::get('topup/idr-va/{price_idr}', [PageController::class, 'topupShardIDRVA']);
Route::get('topup/view/qris/{tx_id}', [PageController::class, 'getQRIS']);
Route::get('topup/view/va/{tx_id}', [PageController::class, 'getVA']);
Route::get('shard-tx', [PageController::class, 'getShardTXHistory']);
Route::get('check-qris-tx/{komo_tx_id}', [PageController::class, 'checkQRISTXStatus']);
Route::get('check-va-tx/{komo_tx_id}', [PageController::class, 'checkVATXStatus']);

Route::get('topup/paypal/{price_usd}', [PageController::class, 'topupShardPaypal']);
Route::get('topup/paypal/link/{komo_tx_id}', [PageController::class, 'redirectPaypalLink']);

Route::get('topup/coinpayments/{shard_amount}', [PageController::class, 'topupShardCoinPayments']);
Route::get('topup/coinpayments/link/{komo_tx_id}', [PageController::class, 'redirectCoinPaymentsLink']);


Route::get('paypal', [PageController::class, 'paypal']);
Route::get('paypal-get/{komo_tx_id}', [PageController::class, 'paypalGet']);

Route::post('change-display-name', [PageController::class, 'changeDisplayName']);


Route::post('validate/check-username', [PageController::class, 'registerCheckUsername']);
Route::post('validate/check-email', [PageController::class, 'registerCheckEmail']);
Route::post('validate/check-wallet', [PageController::class, 'registerCheckWallet']);

Route::get('forgot-password', [PageController::class, 'showForgotPasswordForm']);
Route::post('forgot-password', [PageController::class, 'submitForgotPasswordRequest']);
Route::get('reset-password/{hash}', [PageController::class, 'showNewPasswordForm']);
Route::post('reset-password', [PageController::class, 'submitNewPassword']);

Route::post('change-password', [PageController::class, 'submitChangePassword']);

Route::get('resend-verify-email', [PageController::class, 'resendVerifyEmail']);
Route::post('verify-email', [PageController::class, 'submitVerifyEmail']);

Route::post('change-game-notif', [PageController::class, 'changeGameNotification']);

Route::get('leaderboard', [PageController::class, 'showLeaderboard']);
Route::get('leaderboard/{type}', [PageController::class, 'showLeaderboard']);
Route::get('leaderboard/{type}/{param}', [PageController::class, 'showLeaderboard']);

Route::get('match-detail/{match_id}', [PageController::class, 'showMatchDetail']);
Route::get('match-history', [PageController::class, 'showMatchHistory']);

Route::get('withdraw', [PageController::class, 'showWithdrawPage']);



Route::prefix('admin')->group(function(){
    Route::get('register', [AdminController::class, 'showAdminRegisterPage']);
    Route::post('register', [AdminController::class, 'adminRegister']);
    Route::get('login', [AdminController::class, 'showAdminLoginPage']);
    Route::post('login', [AdminController::class, 'loginAdmin']);
    Route::get('logout', [AdminController::class, 'logoutAdmin']);
});