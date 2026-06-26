<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-8">
        {{-- カードデザイン --}}
        <div class="bg-white shadow-sm rounded-lg p-8">
            
            <h2 class="text-3xl font-bold text-gray-800 mb-8">商品一覧</h2>

            {{-- 検索フォームエリア --}}
            <form method="GET" action="{{ route('products.index') }}" class="flex gap-3 mb-8 flex-wrap items-center">
                {{-- name検索を product_name に合わせて調整 --}}
                <input type="text" name="name" value="{{ request('name') }}" class="border border-gray-300 rounded px-4 py-2 text-base w-64" placeholder="商品名を入力">
                <input type="number" name="min_price" value="{{ request('min_price') }}" class="border border-gray-300 rounded px-4 py-2 w-32 text-base" placeholder="最低価格">
                <span class="text-gray-500 font-bold">~</span>
                <input type="number" name="max_price" value="{{ request('max_price') }}" class="border border-gray-300 rounded px-4 py-2 w-32 text-base" placeholder="最高価格">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold text-base hover:bg-blue-700 transition">検索</button>
            </form>

            {{-- 商品一覧テーブル --}}
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50">
                        <tr class="border-b border-gray-200">
                            <th class="p-5 font-bold text-gray-800 text-lg">商品番号</th>
                            <th class="p-5 font-bold text-gray-800 text-lg">商品名</th>
                            <th class="p-5 font-bold text-gray-800 text-lg">商品説明</th>
                            <th class="p-5 font-bold text-gray-800 text-lg text-center">画像</th>
                            <th class="p-5 font-bold text-gray-800 text-lg">料金(¥)</th>
                            <th class="p-5 font-bold text-gray-800 text-lg">在庫</th>
                            <th class="p-5"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="p-5 text-gray-800 text-lg">{{ $product->id }}</td>
                                {{-- 修正箇所：name -> product_name --}}
                                <td class="p-5 font-bold text-gray-900 text-lg">{{ $product->product_name ?? $product->name }}</td>
                                <td class="p-5 text-gray-700 text-lg">{{ $product->description }}</td>
                                <td class="p-5 text-center">
                                    {{-- 修正箇所：image -> img_path --}}
                                    @if ($product->img_path ?? $product->image)
                                        <img src="{{ asset('storage/' . ($product->img_path ?? $product->image)) }}" 
                                             alt="{{ $product->product_name ?? $product->name }}" 
                                             class="h-12 mx-auto object-contain">
                                    @else
                                        <span class="text-gray-400 text-base">画像なし</span>
                                    @endif
                                </td>
                                <td class="p-5 text-gray-900 font-bold text-lg">¥{{ number_format($product->price) }}</td>
                                <td class="p-5 text-lg font-bold">
                                    @if ($product->stock > 0)
                                        <span class="text-gray-800">{{ $product->stock }}</span>
                                    @else
                                        <span class="text-red-500">売り切れ</span>
                                    @endif
                                </td>
                                <td class="p-5 text-right">
                                    <a href="{{ route('products.show', $product->id) }}"
                                       class="inline-block bg-emerald-600 text-white px-6 py-2 rounded font-bold text-base hover:bg-emerald-700 transition">
                                       詳細
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>