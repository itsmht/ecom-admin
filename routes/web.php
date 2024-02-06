<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
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
    Route::post('/approveTransaction', [TransactionController::class, 'approveTransaction'])->name('approveTransaction');


});
