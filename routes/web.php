<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TradeController;
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
Route::get('/cron', function () {
    \Artisan::call('request:change');
    return true;
});

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login.submit', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['prevent.back', 'auth.guest', 'logged.user']], function () {
    Route::get('/adminDashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/addCategory', [AdminController::class, 'addCategory'])->name('addCategory');
    Route::get('/products', [ProductController::class, 'products'])->name('products');
    Route::get('/addProduct', [ProductController::class, 'addProduct'])->name('addProduct');
    Route::post('/addProductRequest', [ProductController::class, 'addProductRequest'])->name('addProductRequest');
    Route::get('/users', [UserController::class, 'users'])->name('users');
    Route::get('/userDetails', [UserController::class, 'userDetails'])->name('userDetails');
    Route::post('/blockUser', [UserController::class, 'blockUser'])->name('blockUser');
    Route::get('/recharges', [TransactionController::class, 'recharges'])->name('recharges');
    Route::get('/withdraws', [TransactionController::class, 'withdraws'])->name('withdraws');
    Route::get('/wallets', [UserController::class, 'wallets'])->name('wallets');
    Route::get('/transactionHistory', [TransactionController::class, 'transactionHistory'])->name('transactionHistory');
    Route::post('/approveWallet', [UserController::class, 'approveWallet'])->name('approveWallet');
    Route::post('/rejectWallet', [UserController::class, 'rejectWallet'])->name('rejectWallet');
    Route::post('/approveTransaction', [TransactionController::class, 'approveTransaction'])->name('approveTransaction');
    Route::post('/rejectTransaction', [TransactionController::class, 'rejectTransaction'])->name('rejectTransaction');
    Route::get('/sells', [TradeController::class, 'sells'])->name('sells');
    Route::post('/approveTrade', [TradeController::class, 'approveTrade'])->name('approveTrade');
    Route::post('/rejectTrade', [TradeController::class, 'rejectTrade'])->name('rejectTrade');
    Route::get('/buys', [TradeController::class, 'buys'])->name('buys');
    Route::get('/trades', [TradeController::class, 'trades'])->name('trades');



});
