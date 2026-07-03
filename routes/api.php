<?php

use Illuminate\Support\Facades\Route; // 👈 これが必要です！
use App\Http\Controllers\Api\PurchaseController;

Route::middleware('auth:sanctum')->post('/sale', [PurchaseController::class, 'store']);