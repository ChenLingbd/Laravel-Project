<?php

use App\Http\Controllers\Product\CheckController;
use App\Http\Controllers\Product\CreateController;
use App\Http\Controllers\Product\EditController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    // 我的商品頁面
    Route::get('/products', [CheckController::class, 'index'])
        ->name('products.index');
    // 商品上下架
    Route::put('/products/{product}/demote', [CheckController::class, 'demoteData'])
        ->name('products.demoteData');
    // 商品修改頁面
    Route::get('/products/{product}/edit', [EditController::class, 'edit'])
        ->name('products.edit');
    // 商品>修改 資料
    Route::put('/products/{product}', [CheckController::class, 'update'])
        ->name('products.update');
    // 商品>修改 圖片刪除
    Route::delete('/products/{product}/images/{image}', [CheckController::class, 'deleteImage'])
        ->name('products.deleteImage');
    // 商品刪除
    Route::delete('/products/{product}', [CheckController::class, 'destroy'])
        ->name('products.destroy');

    // 刊登商品頁面
    Route::get('/products/create', [CreateController::class, 'create'])
        ->name('products.create');
    // 商品建立資料
    Route::post('/products', [CreateController::class, 'store'])
        ->name('products.store');

});
