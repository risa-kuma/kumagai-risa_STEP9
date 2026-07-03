<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * 購入確認画面を表示
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'カートが空です');
        }
        return view('purchase.index', ['cart' => $cart]);
    }

    /**
     * 購入の最終確定処理
     */
    public function complete(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'カートが空です');
        }

        try {
            DB::transaction(function () use ($cart) {
                foreach ($cart as $id => $item) { // ここでキー $id を取得
                    // IDを元に商品を取得
                    $product = Product::where('id', $id)->lockForUpdate()->firstOrFail();
                    
                    // 在庫チェック
                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("{$product->name} の在庫が不足しています。");
                    }

                    // 1. 在庫を減らす
                    $product->decrement('stock', $item['quantity']);

                    // 2. 購入履歴を保存
                    Sale::create([
                        'user_id'    => Auth::id(),
                        'product_id' => $product->id,
                        'quantity'   => $item['quantity'],
                        'price'      => $item['price'], // セッションの価格を使用
                    ]);
                }
            });

            // 成功したらカートを空にする
            session()->forget('cart');

            return redirect()->route('purchase.completed')->with('success', 'ご購入ありがとうございました！');

        } catch (\Exception $e) {
            // エラーが発生した場合はエラーメッセージと共に戻す
            return redirect()->route('purchase.index')->with('error', $e->getMessage());
        }
    }

    /**
     * マイページの購入履歴画面を表示
     */
    public function mypage()
    {
        $sales = Sale::with('product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->paginate(10);
            
        return view('mypage.purchases', compact('sales'));
    }
}