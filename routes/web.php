<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Staff\ProductController as StaffProductController;
use App\Models\Categories;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

// Route::get('', [CategorieController::class, 'index']);

Route::get('/', function () {
    return view('auth.login');
})->name('formlogin');
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
Route::get('forget-password', function () {
    return view('auth.forget-password');
})->name('forget-password');

Route::get('/product', function () {
    return view('Themes.pages.product.index');
})->name('product');
// Route::get('/category',function(){
//         return view('Themes.pages.category.index');
//         })->name('category');
Route::get('/employee', function () {
    return view('Themes.pages.employee.index');
})->name('employee');

Route::middleware(['checkRole:1', CheckLogin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('store');
        Route::post('add', [ProductController::class, 'addSubmit'])->name('add');
        Route::get('{id}', [ProductController::class, 'editForm'])->name('edit');
        Route::post('{id}', [ProductController::class, 'update'])->name('update');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('delete');
        Route::get('product-search-name', [ProductController::class, 'search'])->name('search');
        Route::get('product-filter/{id}', [ProductController::class, 'productFilter'])->name('filter');
        Route::get('product-images/{id}', [ProductController::class, 'deleteImagesProduct'])->name('deleteImagesProduct');
        Route::post('product-category', [ProductController::class, 'Changecategory'])->name('changecategory');
        Route::post('product-status', [ProductController::class, 'Changestatus'])->name('changestatus');
    });
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/',  [CategorieController::class, 'index'])->name('index');
        Route::post('/create', [CategorieController::class, 'store'])->name('store');
        Route::get('/delete/{id}', [CategorieController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [CategorieController::class, 'edit'])->name('detail');
        Route::put('/update/{id}', [CategorieController::class, 'update'])->name('update');
    });

    Route::prefix('user')->name('staff.')->group(function(){
        Route::get('', [UserController::class, 'index'])->name('store');
        Route::post('update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('add', [UserController::class, 'add'])->name('add');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('delete');
        Route::post('updateAdmin/{id}', [UserController::class, 'updateadmin'])->name('updateAdmin');
    });

    Route::prefix('brand')->name('brand.')->group(function(){
        Route::get('', [BrandController::class, 'index'])->name('store');
        Route::post('add', [BrandController::class, 'add'])->name('add');
        Route::get('delete', [BrandController::class, 'delete'])->name('delete');
        Route::post('update/{id}', [BrandController::class, 'update'])->name('update');
    });
    Route::prefix('client')->name('client.')->group(function(){
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [ClientController::class, 'edit'])->name('detail');
        Route::put('/update/{id}', [ClientController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ClientController::class, 'delete'])->name('delete');
    });
    Route::prefix('order')->name('order.')->group(function(){
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detail');
    });
});

Route::middleware(['checkRole:2', CheckLogin::class])->prefix('staff')->name('staff.')->group(function(){
    Route::get('', [StaffProductController::class, 'index'])->name('index');
});




