<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('最終購入確認') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-lg font-semibold mb-6 text-gray-800">
                    ⚠️ 以下の内容で注文を確定します。よろしいですか？
                </h3>

                {{-- カート内容のテーブル --}}
                <table class="w-full border border-gray-300 mb-8">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">画像</th>
                            <th class="border px-4 py-2 text-left">商品名</th>
                            <th class="border px-4 py-2 text-left">価格</th>
                            <th class="border px-4 py-2 text-left">数量</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cart as $id => $item)
                            <tr>
                                <td class="border px-4 py-2">
                                    @if(!empty($item['image']))
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                                    @else
                                        <div class="w-16 h-16 bg-gray-100 flex items-center justify-center text-xs text-gray-400 rounded">なし</div>
                                    @endif
                                </td>
                                <td class="border px-4 py-2">{{ $item['name'] ?? '名前なし' }}</td>
                                <td class="border px-4 py-2">¥{{ number_format($item['price'] ?? 0) }}</td>
                                <td class="border px-4 py-2">{{ $item['quantity'] ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border px-4 py-2 text-center text-gray-500">カートに商品がありません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="flex items-center gap-6">
                    {{-- 購入確定ボタン --}}
                    @if(!empty($cart))
                        <form action="{{ route('purchase.complete') }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit"
                                class="px-8 py-3 bg-emerald-600 text-white rounded font-bold shadow-md hover:bg-emerald-700 transition">
                                購入を確定する
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('cart.index') }}"
                       class="text-gray-500 hover:text-gray-900 underline text-sm transition">
                        カートに戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>