<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('カート内容確認') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-lg font-semibold mb-4">以下の商品を購入しますか？</h3>

                <form action="{{ route('cart.update') }}" method="POST">
                    @csrf
                    <table class="w-full border border-gray-300 mb-6">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">商品画像</th>
                                <th class="border px-4 py-2 text-left">商品名</th>
                                <th class="border px-4 py-2 text-left">価格</th>
                                <th class="border px-4 py-2 text-left">数量</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cart as $id => $item)
                                <tr>
                                    <td class="border px-4 py-2">
                                        {{-- imageキーで画像を表示 --}}
                                        @if(!empty($item['image']))
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 flex items-center justify-center text-xs text-gray-500 rounded">No Image</div>
                                        @endif
                                    </td>
                                    {{-- nameキーで商品名を表示 --}}
                                    <td class="border px-4 py-2">{{ $item['name'] ?? '商品名なし' }}</td>
                                    <td class="border px-4 py-2">¥{{ number_format($item['price'] ?? 0) }}</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" 
                                               name="quantities[{{ $id }}]" 
                                               value="{{ $item['quantity'] ?? 1 }}" 
                                               min="1" 
                                               max="{{ $item['stock'] ?? 99 }}" 
                                               class="w-20 border-gray-300 rounded shadow-sm text-center">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border px-4 py-2 text-center text-gray-500">カートに商品は入っていません。</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('products.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded font-bold hover:bg-gray-600 transition shadow-md">戻る</a>
                        
                        @if(!empty($cart))
                            <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded font-bold hover:bg-emerald-700 transition shadow-md">
                                購入確認画面に進む
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>