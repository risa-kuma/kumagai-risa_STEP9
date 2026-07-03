<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-sm rounded-lg">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">商品詳細</h1>

        <div class="space-y-2 mb-6 text-xl text-gray-800">
            <p>商品名：{{ $product->product_name }}</p>
            <p>説明：{{ $product->description }}</p>
            <p>金額：¥{{ number_format($product->price) }}</p>
            
            <p>在庫：
                @if($product->stock > 0)
                    <span class="text-green-600 font-bold">{{ $product->stock }} 個</span>
                @else
                    <span class="text-red-600 font-bold">売り切れ</span>
                @endif
            </p>
            <p>会社：{{ $product->company->company_name ?? 'TNG' }}</p>
        </div>

        <div class="mb-6 flex flex-col items-start">
            <span class="text-xl text-gray-800 mb-2">画像：</span>
            <div class="w-full max-w-lg mt-2">
                @if($product->img_path)
                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="w-full h-auto object-contain rounded-md shadow-sm">
                @else
                    <img src="https://illustrations.popsy.co/amber/handholding-tablet.svg" alt="サンプル画像" class="w-full h-auto object-contain max-h-[400px]">
                @endif
            </div>
        </div>

        {{-- ハートボタンエリア --}}
        <div class="text-2xl mt-1 mb-8">
            <form method="POST" action="{{ route('products.like', $product->id) }}">
                @csrf
                <button type="submit" class="hover:scale-110 transition-transform focus:outline-none">
                    <svg class="w-8 h-8 {{ $isLike ? 'text-red-500' : 'text-gray-300' }}" 
                         fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </button>
            </form>
        </div>

        <div class="flex items-center gap-4">
            @if($product->stock > 0)
                <form method="POST" action="{{ route('cart.add') }}" class="inline">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    {{-- btn-blue に統一しました --}}
                    <button type="submit" class="btn-blue">
                        カートに追加する
                    </button>
                </form>
            @else
                <button disabled class="px-6 py-3 rounded-lg text-lg font-medium shadow-md bg-gray-400 text-white cursor-not-allowed">
                    売り切れのため購入できません
                </button>
            @endif

            <a href="{{ route('products.index') }}" class="btn-gray">
                戻る
            </a>
        </div>
    </div>
</x-app-layout>