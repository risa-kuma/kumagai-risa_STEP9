<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// トップページ：ログイン状態による振り分け
Route::get('/', function () {
    return auth()->check() ? redirect()->route('products.index') : redirect()->route('login');
});

// お問い合わせ（認証不要）
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::post('/contact/submit', function (Request $request) {
    return back()->with('success', 'お問い合わせを受け付けました。');
})->name('contact.submit');

// 認証済みルート
Route::middleware(['auth'])->group(function () {
    
    // --- マイページ関連 ---
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');
    Route::get('/mypage/purchases', [PurchaseController::class, 'mypage'])->name('mypage.purchases');
    Route::get('/mypage/{id}', [MypageController::class, 'show'])->name('mypage.show');
    Route::get('/mypage/{id}/edit', [MypageController::class, 'edit'])->name('mypage.edit');
    Route::patch('/mypage/{id}', [MypageController::class, 'update'])->name('mypage.update');
    Route::delete('/mypage/{id}', [MypageController::class, 'destroy'])->name('mypage.destroy');
    
    // --- 商品関連 ---
    Route::resource('products', ProductController::class);
    Route::post('/products/{product}/favorite', [ProductController::class, 'favorite'])->name('products.favorite');

    // --- カート関連 ---
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update'); // ★追加しました
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    
    // --- 購入関連 ---
    Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::post('/purchase/complete', [PurchaseController::class, 'complete'])->name('purchase.complete');
    Route::get('/purchase/completed', function () {
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