<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',function (){
    return view('product.index');
});
Route::get('show',[ProductController::class,'showData'])->name('show');
Route::get('getAdd',[ProductController::class,'getAdd']);
Route::post('getAdd',[ProductController::class,'postAdd'])->name('post.add');
//xóa
Route::get('deleteproduct/{id}',[ProductController::class,'deleteProduct']);
// cập nhật
Route::get('edit/{id}',[ProductController::class,'editProduct']);
Route::put('edit/{id}',[ProductController::class,'updateProduct']);

