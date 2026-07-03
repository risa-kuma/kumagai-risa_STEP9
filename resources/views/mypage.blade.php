@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4">
    <div class="bg-white shadow-sm rounded-lg p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">マイページ</h2>

        <div class="space-y-6 mb-10">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">アカウント名</h3>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Eメール</h3>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-8 mb-10 flex space-x-4">
            <a href="{{ route('products.create') }}" class="btn-blue">新規商品登録</a>
            <a href="{{ route('profile.edit') }}" class="btn-gray">アカウント編集</a>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-6">&lt;出品商品&gt;</h3>
        <div class="border border-gray-200 rounded-lg overflow-hidden mb-10">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50">
                    <tr class="border-b border-gray-200">
                        <th class="p-5 font-bold text-gray-800 text-lg">商品番号</th>
                        <th class="p-5 font-bold text-gray-800 text-lg">商品名</th>
                        <th class="p-5 font-bold text-gray-800 text-lg">料金(¥)</th>
                        <th class="p-5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($myProducts as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="p-5 text-gray-800 text-lg">{{ $product->id }}</td>
                        <td class="p-5 font-bold text-gray-900 text-lg">{{ $product->product_name }}</td>
                        <td class="p-5 text-gray-900 font-bold text-lg">¥{{ number_format($product->price) }}</td>
                        <td class="p-5 text-right">
                            <a href="{{ route('mypage.show', $product->id) }}" 
                               class="inline-block bg-emerald-600 text-white px-6 py-2 rounded font-bold text-base hover:bg-emerald-700 transition">
                               詳細
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-5 text-center text-gray-500">出品中の商品はありません</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h3 class="text-2xl font-bold text-gray-800 mb-6">&lt;購入した商品&gt;</h3>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50">
                    <tr class="border-b border-gray-200">
                        <th class="p-5 font-bold text-gray-800 text-lg">商品名</th>
                        <th class="p-5 font-bold text-gray-800 text-lg">商品説明</th>
                        <th class="p-5 font-bold text-gray-800 text-lg">料金(¥)</th>
                        <th class="p-5 font-bold text-gray-800 text-lg">個数</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($mySales as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="p-5 font-bold text-gray-900 text-lg">{{ $order->product->product_name ?? '商品不明' }}</td>
                        <td class="p-5 text-gray-700 text-lg">{{ $order->product->description ?? '-' }}</td>
                        <td class="p-5 text-gray-900 font-bold text-lg">¥{{ number_format($order->price) }}</td>
                        <td class="p-5 text-gray-800 text-lg">{{ $order->quantity }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-5 text-center text-gray-500">購入履歴はありません</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection