<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Purchase;

class MypageController extends Controller
{
    /**
     * マイページ表示
     */
    public function index()
    {
        $user = Auth::user();
        
        // 修正：自分の出品商品のみを取得するように絞り込み
        $myProducts = Product::where('user_id', $user->id)->orderBy('id', 'asc')->get();
        
        // 自分の購入履歴を取得
        $myPurchases = Purchase::with('product')->where('user_id', $user->id)->get();
        
        return view('mypage.index', compact('user', 'myProducts', 'myPurchases'));
    }

    /**
     * 自分の出品商品詳細表示
     */
    public function show($id)
    {
        // 念のため、自分が登録した商品であるか確認（または単に検索）
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
        
        // 必要に応じて、ログインユーザーが所有者かチェックを入れるとより安全です
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('mypage.index')->with('error', '権限がありません');
        }

        $product->delete();
        
        return redirect()->route('mypage.index')->with('success', '商品を削除しました');
    }
}