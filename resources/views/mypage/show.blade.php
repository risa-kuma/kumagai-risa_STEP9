<x-app-layout>
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">出品商品詳細</h1>
    
    <div class="bg-white p-6 rounded shadow">
        {{-- 指摘2: $product->image を $product->img_path に修正 --}}
        @if($product->img_path)
            <div class="mb-6">
                <p class="font-bold mb-2">商品画像：</p>
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="max-w-sm rounded border">
            </div>
        @endif
        
        {{-- 指摘2: $product->name を $product->product_name に修正 --}}
        <p class="text-xl font-bold mb-2">商品名：{{ $product->product_name }}</p>
        <p class="mb-2">説明：{{ $product->description }}</p>
        <p class="mb-4">金額：¥{{ number_format($product->price) }}</p>

        <div class="mt-6 flex space-x-4">
            {{-- 編集ボタン --}}
            <a href="{{ route('products.edit', $product->id) }}" class="btn-blue">編集</a>
            
            {{-- 指摘1: onsubmit で確認ダイアログを追加 --}}
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当にこの商品を削除しますか？');">
                @csrf 
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded">削除する</button>
            </form>
            
            <a href="{{ route('mypage.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded">戻る</a>
        </div>
    </div>
</div>
</x-app-layout>