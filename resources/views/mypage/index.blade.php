<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">マイページ</h1>
        
        <div class="mb-8">
            <a href="{{ route('profile.edit') }}" class="btn-indigo">
                アカウント編集
            </a>
            <div class="flex justify-between bg-white p-4 rounded shadow-sm border border-gray-100">
                <p>
                    ユーザー名：{{ $user->name ?? '未設定' }}<br>
                    Eメール：{{ $user->email }}
                </p>
                <p class="text-right">
                    名前（漢字）：{{ $user->name_kanji ?? '未設定' }}<br>
                    名前（カナ）：{{ $user->name_kana ?? '未設定' }}
                </p>
            </div>
        </div>

        {{-- 出品商品リスト --}}
        <div class="mb-12">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">&lt;出品商品&gt;</h2>
                <a href="{{ route('products.create') }}" class="btn-blue">
                    新規登録
                </a>
            </div>
            <table class="w-full text-left border-t border-b bg-white">
                <tr class="text-sm border-b bg-gray-50">
                    <th class="p-3">商品番号</th>
                    <th class="p-3">商品名</th>
                    <th class="p-3">商品説明</th>
                    <th class="p-3">料金(¥)</th>
                    <th class="p-3"></th>
                </tr>
                @forelse($myProducts as $product)
                <tr class="border-b">
                    <td class="p-3">{{ $product->id }}</td>
                    <td class="p-3 font-bold">{{ $product->product_name }}</td>
                    <td class="p-3">{{ $product->description }}</td>
                    <td class="p-3">{{ number_format($product->price) }}</td>
                    <td class="p-3 text-right">
                        <a href="{{ route('mypage.show', $product->id) }}" class="btn-emerald">
                            詳細
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-4 text-center text-gray-500">出品中の商品はありません</td></tr>
                @endforelse
            </table>
        </div>

        {{-- 購入商品リスト --}}
        <div>
            <h2 class="text-lg font-bold mb-4">&lt;購入した商品&gt;</h2>
            <table class="w-full text-left border-t border-b bg-white">
                <tr class="text-sm border-b bg-gray-50">
                    <th class="p-3">商品名</th>
                    <th class="p-3">商品説明</th>
                    <th class="p-3">料金(¥)</th>
                    <th class="p-3">個数</th>
                </tr>
                @forelse($mySales as $sale)
                <tr class="border-b">
                    <td class="p-3 font-bold">{{ $sale->product->product_name ?? '商品不明' }}</td>
                    <td class="p-3">{{ $sale->product->description ?? '-' }}</td>
                    <td class="p-3">{{ number_format($sale->price) }}</td>
                    <td class="p-3">{{ $sale->quantity }}</td>  
                </tr>
                @empty
                <tr><td colspan="4" class="p-4 text-center text-gray-500">購入履歴はありません</td></tr>
                @endforelse
            </table>
        </div>
    </div>
</x-app-layout>