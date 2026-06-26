<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ログイン画面
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // ★ ログインのレート制限（必須）
        RateLimiter::for('login', function ($request) {
            return Limit::perMinute(5)->by($request->email ?? $request->ip());
        });

        // パスワードリセットメール送信画面
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        // パスワード再設定画面
        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        // 新規登録画面
        Fortify::registerView(function () {
            return view('auth.register');
        });
    }
}
