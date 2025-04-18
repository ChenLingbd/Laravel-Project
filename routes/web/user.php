<?php

use App\Http\Controllers\Web\User\ProductController;
use App\Http\Controllers\Web\User\ProductMessageController;
use App\Http\Controllers\Web\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user.')->middleware(['auth', 'verified'])->group(function () {
    // 我的商品頁,刊登頁,建立商品,編輯頁,更新商品,刪除
    Route::resource('products', ProductController::class)
        ->except(['show']);
    // 商品上下架
    Route::patch('/products/{product}/inactive', [ProductController::class, 'inactive'])
        ->name('products.inactive');

    // 留言 建立,編輯頁,更新留言,刪除
    Route::resource('products.messages', ProductMessageController::class)
        ->only(['store', 'edit', 'update', 'destroy']);

    Route::post('/products/{product}/messages/{message}/reply', [ProductMessageController::class, 'reply'])
        ->name('products.messages.reply');

    // 個人資料 頁面,修改密碼,刪除帳號
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
