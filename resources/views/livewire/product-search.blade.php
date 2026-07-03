<div class="max-w-4xl mx-auto p-6">
    {{-- 検索フォーム --}}
    <div class="mb-6 flex flex-wrap gap-4 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
        <input type="text" wire:model.live.debounce.300ms="name" placeholder="商品名で検索" 
               class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-full md:w-auto flex-1">
        
        <input type="number" wire:model.live.debounce.300ms="min_price" placeholder="最低価格" 
               class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-full md:w-32">
        
        <input type="number" wire:model.live.debounce.300ms="max_price" placeholder="最高価格" 
               class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-full md:w-32">
    </div>

    {{-- 商品リストテーブル --}}
    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-100">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-3 text-sm font-bold text-gray-700">ID</th>
                    <th class="px-6 py-3 text-sm font-bold text-gray-700">商品名</th>
                    <th class="px-6 py-3 text-sm font-bold text-gray-700">価格</th>
                    <th class="px-6 py-3 text-sm font-bold text-gray-700">詳細</th>
                </tr>
            </thead>
            {{-- ここから tbody を修正 --}}
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $product->id }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900">{{ $product->product_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">¥{{ number_format($product->price) }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('products.show', $product->id) }}" class="btn-emerald text-sm py-1 px-3">
                                詳細
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            該当する商品が見つかりませんでした
                        </td>
                    </tr>
                @endforelse
            </tbody>
            {{-- tbody 修正終了 --}}
        </table>
    </div>