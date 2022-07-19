<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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
Route::get('login', [PageController::class, 'showLoginPage']);
Route::post('login', [PageController::class, 'login']);
Route::get('logout', [PageController::class, 'logout']);
Route::get('register', [PageController::class, 'showRegisterPage']);
Route::post('register', [PageController::class, 'submitRegistration']);

Route::post('change-pp', [PageController::class, 'changeProfilePicture']);


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

Route::get('paypal', [PageController::class, 'paypal']);
Route::get('paypal-get/{komo_tx_id}', [PageController::class, 'paypalGet']);

Route::post('change-display-name', [PageController::class, 'changeDisplayName']);



Route::post('validate/check-username', [PageController::class, 'registerCheckUsername']);
Route::post('validate/check-email', [PageController::class, 'registerCheckEmail']);
Route::post('validate/check-wallet', [PageController::class, 'registerCheckWallet']);