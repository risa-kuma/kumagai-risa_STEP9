<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * カート画面（一覧）を表示
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    /**
     * 商品をカートに追加する処理
     */
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = (int)$request->input('quantity', 1);

        // リレーションの company を一緒に読み込む
        $product = Product::with('company')->findOrFail($productId);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name'         => $product->product_name ?? $product->name,
                'price'        => $product->price,
                'quantity'     => $quantity,
                'image'        => $product->img_path ?? $product->image,
                'stock'        => $product->stock,
                // リレーションから会社名を取得
                'company_name' => $product->company->company_name ?? 'TNG', 
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'カートに追加しました');
    }

    /**
     * カートの数量を更新し、購入確認画面へ進む
     */
    public function update(Request $request)
    {
        $quantities = $request->input('quantities', []);
        $cart = session()->get('cart', []);

        foreach ($quantities as $id => $quantity) {
            if (isset($cart[$id])) {
                $stock = $cart[$id]['stock'] ?? 99;
                
                $newQuantity = max(1, (int)$quantity);
                $cart[$id]['quantity'] = min($newQuantity, $stock);
            }
        }

        session()->put('cart', $cart);
        // モーダル形式にするため、このままカート画面に戻すか、
        // 遷移させたい場合は route を適宜指定してください。
        return redirect()->route('cart.index');
    }

    /**
     * カートを空にする処理
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'カートを空にしました');
    }
}