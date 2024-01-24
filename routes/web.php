<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
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

Route::group(['middleware' => ['prevent.back', 'auth.guest', 'logged.user']], function () {
    Route::get('/adminDashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/addCategory', [AdminController::class, 'addCategory'])->name('addCategory');
    Route::get('/products', [ProductController::class, 'products'])->name('products');
    Route::get('/addProduct', [ProductController::class, 'addProduct'])->name('addProduct');
    Route::post('/addProductRequest', [ProductController::class, 'addProductRequest'])->name('addProductRequest');

});
