<?php

use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;

// Route::get('', [CategorieController::class, 'index']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify-otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify_otp_confirm');
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::post('/payment-notify', [PaymentController::class, 'paymentNotify'])->name('payment.notify');

});
Route::get('forget-password',function(){
return view('auth.forget-password');
})->name('forget-password');

Route::get('/product',function(){
    return view('Themes.pages.product.index');
    })->name('product');

// Route::get('/category',function(){
//         return view('Themes.pages.category.index');
//         })->name('category');
Route::get('/employee',function(){
    return view('Themes.pages.employee.index');
            })->name('employee');
Route::get('/category',  [CategorieController::class, 'index'])->name('category.index');
Route::post('/createCategory', [CategorieController::class, 'store'])->name('category.store');
Route::get('delete/{id}', [CategorieController::class, 'delete'])->name('category.delete');
Route::get('/category/detail/{id}', [CategorieController::class, 'edit'])->name('category.detail');
Route::put('/category/update/{id}', [CategorieController::class, 'update'])->name('category.update');
