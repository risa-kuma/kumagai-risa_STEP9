<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sale;

class MypageController extends Controller
{
    /**
     * マイページ表示
     */
    public function index()
    {
        $user = Auth::user();
        
        // 自分の出品商品を取得（既存の通り）
        $myProducts = Product::ofUser($user->id)->orderBy('id', 'asc')->get();
        
        // 指摘3対応：購入した商品を「購入日（created_at）の昇順」で取得
        $mySales = Sale::with('product')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
        
        return view('mypage.index', compact('user', 'myProducts', 'mySales'));
    }

    /**
     * 自分の出品商品詳細表示
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        return view('mypage.show', compact('product'));
    }

    /**
     * 編集画面表示
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // ログインユーザーが所有者かチェック
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('mypage.index')->with('error', '権限がありません');
        }

        $product->delete();
        
        return redirect()->route('mypage.index')->with('success', '商品を削除しました');
    }
}