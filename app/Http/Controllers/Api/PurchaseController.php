<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function store(Request $request)
    {
        // バリデーション：商品IDと数量が必須
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($request) {
            // 商品を取得（更新ロックをかける）
            $product = Product::lockForUpdate()->findOrFail($request->product_id);

            // 在庫チェック
            if ($product->stock < $request->quantity) {
                return response()->json(['message' => '在庫不足です'], 400);
            }

            // 1. 在庫を減らす
            $product->decrement('stock', $request->quantity);

            // 2. 売上(Sales)テーブルに記録
            // ※user_idはAPI利用者の認証状況に応じて取得してください
            Sale::create([
                'product_id' => $product->id,
                'user_id'    => $request->user()->id ?? 1, // 認証済みのユーザーIDを推奨
                'quantity'   => $request->quantity,
            ]);

            return response()->json(['message' => '購入処理が完了しました'], 200);
        });
    }
}