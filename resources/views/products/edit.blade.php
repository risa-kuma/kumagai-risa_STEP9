<x-app-layout>
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">商品編集</h1>

    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- 商品名 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">商品名</label>
                <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm border p-2" required>
            </div>

            {{-- 価格 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">価格</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm border p-2" required>
            </div>

            {{-- 在庫数（指摘1対応：追加） --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">在庫数</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm border p-2" required min="0">
            </div>

            {{-- 説明 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">商品説明</label>
                <textarea name="description" rows="4" class="mt-1 block w-full rounded border-gray-300 shadow-sm border p-2" required>{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- 画像 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">商品画像</label>
                @if($product->img_path)
                    <div class="mt-2 mb-2">
                        <img src="{{ asset('storage/' . $product->img_path) }}" alt="現在の画像" class="h-20 w-auto rounded border">
                    </div>
                @endif
                <input type="file" name="img_path" class="mt-1 block w-full">
            </div>

            <div class="flex items-center space-x-4 pt-4 border-t">
                <button type="submit" class="btn-blue">更新する</button>
                {{-- 「戻る」先は要件に合わせて適宜調整してください（詳細画面への遷移が好ましい場合もあります） --}}
                <a href="{{ route('mypage.index') }}" class="btn-gray">戻る</a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>