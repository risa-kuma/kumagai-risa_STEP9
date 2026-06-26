<x-app-layout>
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">商品編集</h1>

    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- 商品名：name -> product_name に変更 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">商品名</label>
                <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm border p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">価格</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm border p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">商品説明</label>
                <textarea name="description" rows="4" class="mt-1 block w-full rounded border-gray-300 shadow-sm border p-2" required>{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- 画像：image -> img_path に変更 --}}
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
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700">更新する</button>
                <a href="{{ route('mypage.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">戻る</a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>