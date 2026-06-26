<?php

use Illuminate\Support\Facades\Route; // 👈 これが必要です！
use App\Http\Controllers\Api\PurchaseController;

Route::middleware('auth:sanctum')->post('/purchase', [PurchaseController::class, 'store']);