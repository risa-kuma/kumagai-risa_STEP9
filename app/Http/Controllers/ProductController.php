<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * 商品一覧表示
     */
    public function index(Request $request)
    {
        $query = Product::where('user_id', '!=', Auth::id());

        if ($request->filled('name')) {
            $query->where('product_name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->orderBy('id', 'asc')->get();

        return view('products.index', compact('products'));
    }

    /**
     * 商品登録画面を表示
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * 商品登録処理
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'price'        => 'required|integer|min:0',
            'stock'        => 'required|integer|min:0',
            'description'  => 'nullable|string',
            'img_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('img_path')) {
            $validated['img_path'] = $request->file('img_path')->store('products', 'public');
        }
        
        $user = Auth::user();
        $validated['user_id'] = $user->id;
        $validated['company_id'] = $user->company_id;

        Product::create($validated);
        
        return redirect()->route('mypage.index')->with('success', '商品を登録しました');
    }

    /**
     * 商品詳細表示
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $isFavorite = false;
        if (Auth::check()) {
            $isFavorite = $product->favorites()->where('user_id', Auth::id())->exists();
        }
        return view('products.show', compact('product', 'isFavorite'));
    }

    /**
     * 商品編集画面を表示
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * 商品更新処理
     */
    public function update(Request $request, $id)
    {
        // stockのバリデーションを追加しました
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'price'        => 'required|integer|min:0',
            'stock'        => 'required|integer|min:0',
            'description'  => 'nullable|string',
            'img_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('img_path')) {
            // 古い画像があれば削除（オプション）
            if ($product->img_path) {
                Storage::disk('public')->delete($product->img_path);
            }
            $validated['img_path'] = $request->file('img_path')->store('products', 'public');
        }

        $product->update($validated);
        return redirect()->route('mypage.index')->with('success', '更新しました');
    }

    /**
     * 商品削除処理
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->img_path) {
            Storage::disk('public')->delete($product->img_path);
        }
        $product->delete();
        return redirect()->route('mypage.index')->with('success', '削除しました');
    }

    /**
     * お気に入り登録・解除処理
     */
    public function favorite(Product $product)
    {
        if (!Auth::check()) return redirect()->route('login');
        
        $user = Auth::user();
        $favorite = $product->favorites()->where('user_id', $user->id);

        if ($favorite->exists()) {
            $favorite->delete();
            $message = 'お気に入りを解除しました。';
        } else {
            $product->favorites()->create(['user_id' => $user->id]);
            $message = 'お気に入りに登録しました！';
        }

        return back()->with('success', $message);
    }
}