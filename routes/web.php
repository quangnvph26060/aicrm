<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\CheckInventoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Staff\ClientController as StaffClientController;
use App\Http\Controllers\Staff\OrderController as StaffOrderController;
use App\Http\Controllers\Staff\ProductController as StaffProductController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Client\SignUpController;
use App\Http\Controllers\Staff\CheckInventoryController as staffcheckController;
use App\Http\Controllers\Staff\WareHomeController;
use App\Http\Controllers\SuperAdmin\StoreController;
use App\Models\Categories;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

// Route::get('', [CategorieController::class, 'index']);
Route::get('/register', [SignUpController::class, 'index'])->name('register.index');
Route::post('/register_account', [SignUpController::class, 'store'])->name('register.signup');
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

Route::middleware(CheckLogin::class)->prefix('admin')->name('admin.')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/day', [DashboardController::class, 'StatisticsByDay'])->name('dashboard.day');
    Route::get('/dashboard/month', [DashboardController::class, 'StatisticsByMonth'])->name('dashboard.month');
    Route::get('/dashboard/year', [DashboardController::class, 'StatisticsByYear'])->name('dashboard.year');
    Route::get('/detail/{id}', [AdminController::class, 'getAdminInfor'])->name('detail');
    Route::post('/update/{id}', [AdminController::class, 'updateAdminInfor'])->name('update');
    Route::post('/changePassword', [AdminController::class, 'changePassword'])->name('changePassword');
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('store');
        Route::get('add', [ProductController::class, 'addForm'])->name('addForm');
        Route::post('add', [ProductController::class, 'addSubmit'])->name('add');
        Route::get('{id}', [ProductController::class, 'editForm'])->name('edit');
        Route::post('{id}', [ProductController::class, 'update'])->name('update');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('delete');
        Route::get('product-images/{id}', [ProductController::class, 'deleteImagesProduct'])->name('deleteImagesProduct');
        Route::post('product-category', [ProductController::class, 'Changecategory'])->name('changecategory');
        Route::post('product-status', [ProductController::class, 'Changestatus'])->name('changestatus');
        Route::get('search/name', [ProductController::class, 'findByName'])->name('findName');
    });
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/',  [CategorieController::class, 'index'])->name('index');
        Route::get('/create', [CategorieController::class, 'add'])->name('add');
        Route::post('/create', [CategorieController::class, 'store'])->name('store');
        Route::get('/delete/{id}', [CategorieController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [CategorieController::class, 'edit'])->name('detail');
        Route::post('/update/{id}', [CategorieController::class, 'update'])->name('update');
        Route::get('search/name', [CategorieController::class, 'findByName'])->name('findName');
    });

    Route::prefix('user')->name('staff.')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('store');
        Route::get('update/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('add', [UserController::class, 'addForm'])->name('addForm');
        Route::post('add', [UserController::class, 'add'])->name('add');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('delete');
        Route::post('updateAdmin/{id}', [UserController::class, 'updateadmin'])->name('updateAdmin');
        Route::get('search/phone', [UserController::class, 'findByPhone'])->name('findByPhone');
    });

    Route::prefix('brand')->name('brand.')->group(function () {
        Route::get('', [BrandController::class, 'index'])->name('store');
        Route::get('add', [BrandController::class, 'addForm'])->name('addForm');
        Route::post('add', [BrandController::class, 'add'])->name('add');
        Route::get('delete', [BrandController::class, 'delete'])->name('delete');
        Route::get('update/{id}', [BrandController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [BrandController::class, 'update'])->name('update');
        Route::get('search/name', [BrandController::class, 'findByName'])->name('findByName');
    });
    Route::prefix('client')->name('client.')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [ClientController::class, 'edit'])->name('detail');
        Route::put('/update/{id}', [ClientController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ClientController::class, 'delete'])->name('delete');
        Route::get('/filter', [ClientController::class, 'findClient'])->name('filter');
    });
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detail');
        // Route::get('/find/phone', [OrderController::class, 'getOrderbyPhone'])->name('findByPhone');
        Route::get('/admin/order/filter', [OrderController::class, 'filterOrder'])->name('filter');
    });
    Route::prefix('config')->name('config.')->group(function () {
        Route::get('/detail', [ConfigController::class, 'index'])->name('detail');
        Route::post('/update', [ConfigController::class, 'updateConfig'])->name('update');
    });

    Route::prefix('checkInventory')->name('check.')->group(function () {
        Route::get('/', [CheckInventoryController::class, 'index'])->name('index');
        Route::get('/filter', [CheckInventoryController::class, 'filterCheck'])->name('filter');
        Route::get('/detail/{id}', [CheckInventoryController::class, 'detail'])->name('detail');
    });
})->middleware('checkRole:1');

Route::middleware(['checkRole:2', CheckLogin::class])->prefix('staff')->name('staff.')->group(function () {
    Route::get('', [StaffProductController::class, 'index'])->name('index');
    Route::post('/cart/add', [StaffProductController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [StaffProductController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove', [StaffProductController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/client/add', [StaffClientController::class, 'addClient'])->name('client.add');
    Route::post('pay', [StaffClientController::class, 'pay'])->name('pay');
    Route::get('cart', [StaffClientController::class, 'cart'])->name('cart.data');
    Route::get('order', [StaffOrderController::class, 'index'])->name('order');
    Route::get('order/fetch', [StaffOrderController::class, 'orderFetch'])->name('orderFetch');
    Route::get('product', [StaffProductController::class, 'product'])->name('product.get');
    //checkInventory
    Route::get('product/search', [StaffProductController::class, 'search'])->name('product.search');
    Route::get('checkInventory', [staffcheckController::class, 'index'])->name('Inventory.get');
    Route::get('checkInventory/add', [staffcheckController::class, 'add'])->name('Inventory.add');
    // warehome
    Route::get('warehome', [WareHomeController::class, 'index'])->name('warehome.get');
    Route::post('warehome/add', [WareHomeController::class, 'add'])->name('warehome.add');
    Route::post('warehome/update', [WareHomeController::class, 'update'])->name('warehome.update');
});


Route::middleware(['checkRole:3', CheckLogin::class])->prefix('sa')->name('sa.')->group(function () {
    Route::prefix('store')->name('store.')->group(function () {
        Route::get('/index', [StoreController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [StoreController::class, 'detail'])->name('detail');
        Route::get('/findByPhone', [StoreController::class, 'findByPhone'])->name('findByPhone');
    });
});
