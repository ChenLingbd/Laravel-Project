<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//訪客首頁
Route::get('/', function () {
    return view('Home');
});

//共用: product
Route::get('/product', function () { 
    return view('Product');
});

//共用: product
Route::get('/user-product', function () { 
    return view('Product-user');
});

//登入: product_create
Route::get('/user-product-create', function () {
    return view('Product-create');
});

//登入: 查看用戶刊登商品
Route::get('/user-product-check', function () {
    return view('Product-check');
});

Route::get('/dashboard', function () {
    return view('Home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
