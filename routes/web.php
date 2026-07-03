<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\InquiryController; // 追加
use Illuminate\Support\Facades\Route;

// トップページ：ログイン状態による振り分け
Route::get('/', function () {
    return auth()->check() ? redirect()->route('products.index') : redirect()->route('login');
});

// --- お問い合わせルート（指摘対応） ---
Route::get('/inquiry', [InquiryController::class, 'index'])->name('inquiry.index');
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

// 認証済みルート
Route::middleware(['auth'])->group(function () {
    
    // --- マイページ関連 ---
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');
    Route::get('/mypage/sales', [PurchaseController::class, 'mypage'])->name('mypage.purchases');
    Route::get('/mypage/{id}', [MypageController::class, 'show'])->name('mypage.show');
    Route::get('/mypage/{id}/edit', [MypageController::class, 'edit'])->name('mypage.edit');
    Route::patch('/mypage/{id}', [MypageController::class, 'update'])->name('mypage.update');
    Route::delete('/mypage/{id}', [MypageController::class, 'destroy'])->name('mypage.destroy');
    
    // --- 商品関連 ---
    Route::resource('products', ProductController::class);
    Route::post('/products/{product}/like', [ProductController::class, 'like'])->name('products.like');

    // --- カート関連 ---
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    
    // --- 購入関連 ---
    Route::get('/sale', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::post('/sale/complete', [PurchaseController::class, 'complete'])->name('purchase.complete');
    Route::get('/sale/completed', function () {
        return view('purchase.completed');
    })->name('purchase.completed'); 

    // --- プロフィール関連 ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';