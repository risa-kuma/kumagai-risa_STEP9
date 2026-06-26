<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * ログイン後の遷移先
     */
    public const HOME = '/dashboard';   // ← ★ここが超重要！

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->routes(function () {

            // API ルート
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Web ルート
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
