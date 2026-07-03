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
        $query = Product::excludeUser(Auth::id());

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
        $product = Product::with('company')->findOrFail($id);
        
        $isLike = false;
        if (Auth::check()) {
            $isLike = $product->likes()->where('user_id', Auth::id())->exists();
        }
        return view('products.show', compact('product', 'isLike'));
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
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'price'        => 'required|integer|min:0',
            'stock'        => 'required|integer|min:0',
            'description'  => 'nullable|string',
            'img_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('img_path')) {
            if ($product->img_path) {
                Storage::disk('public')->delete($product->img_path);
            }
            $validated['img_path'] = $request->file('img_path')->store('products', 'public');
        }

        $product->update($validated);

        // 【修正点】要件に基づき、遷移先を「マイページ」から「出品商品詳細画面」に変更
        return redirect()->route('products.show', $product->id)->with('success', '商品を更新しました');
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
    public function like(Product $product)
    {
        if (!Auth::check()) return redirect()->route('login');
        
        $user = Auth::user();
        $like = $product->likes()->where('user_id', $user->id);

        if ($like->exists()) {
            $like->delete();
            $message = 'いいねを解除しました。';
        } else {
            $product->likes()->create(['user_id' => $user->id]);
            $message = 'いいねしました！';
        }

        return back()->with('success', $message);
    }
}