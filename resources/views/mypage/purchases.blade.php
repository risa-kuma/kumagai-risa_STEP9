<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('購入履歴') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4">あなたの購入履歴</h3>

                @if ($purchases->isEmpty())
                    <p>購入履歴はありません。</p>
                @else
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">注文番号</th>
                                <th class="border px-4 py-2">画像</th>
                                <th class="border px-4 py-2">商品名</th>
                                <th class="border px-4 py-2">数量</th>
                                <th class="border px-4 py-2">価格</th>
                                <th class="border px-4 py-2">合計金額</th>
                                <th class="border px-4 py-2">購入日</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td class="border px-4 py-2 text-center">#{{ $purchase->id }}</td>

                                    {{-- 画像 --}}
                                    <td class="border px-4 py-2 text-center">
                                        @if ($purchase->product && $purchase->product->image)
                                            <a href="{{ route('products.show', $purchase->product_id) }}">
                                                <img src="{{ asset('storage/' . $purchase->product->image) }}" 
                                                     alt="{{ $purchase->product->name }}" 
                                                     class="w-16 h-16 object-cover mx-auto hover:opacity-80 transition">
                                            </a>
                                        @else
                                            <span class="text-gray-500 text-sm">画像なし</span>
                                        @endif
                                    </td>

                                    {{-- 商品名 --}}
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('products.show', $purchase->product_id) }}" class="text-blue-600 hover:underline">
                                            {{ $purchase->product->name ?? '商品名不明' }}
                                        </a>
                                    </td>

                                    <td class="border px-4 py-2 text-center">{{ $purchase->quantity }}</td>
                                    <td class="border px-4 py-2 text-right">¥{{ number_format($purchase->price) }}</td>
                                    <td class="border px-4 py-2 text-right">¥{{ number_format($purchase->price * $purchase->quantity) }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $purchase->created_at->format('Y/m/d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- ページネーション --}}
                    <div class="mt-4">
                        {{ $purchases->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>