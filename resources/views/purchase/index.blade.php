<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">カート内容</h2>
    </x-slot>

    <div class="py-12" x-data="{ showModal: false }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- カートテーブル --}}
                <table class="w-full border border-gray-300 mb-8">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">画像</th>
                            <th class="border px-4 py-2">商品名</th>
                            <th class="border px-4 py-2">会社</th>
                            <th class="border px-4 py-2">在庫</th>
                            <th class="border px-4 py-2">価格</th>
                            <th class="border px-4 py-2">数量</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cart as $id => $item)
                            <tr>
                                <td class="border px-4 py-2"><img src="{{ asset('storage/' . $item['image']) }}" class="w-16 h-16 object-cover"></td>
                                <td class="border px-4 py-2">{{ $item['name'] }}</td>
                                <td class="border px-4 py-2">{{ $item['company_name'] ?? 'TNG' }}</td>
                                <td class="border px-4 py-2">{{ $item['stock'] }} 個</td>
                                <td class="border px-4 py-2">¥{{ number_format($item['price']) }}</td>
                                <td class="border px-4 py-2">{{ $item['quantity'] }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center p-4">カートは空です。</td></tr>
                        @endforelse
                    </tbody>
                </table>

                @if(!empty($cart))
                    <button @click="showModal = true" class="px-8 py-3 bg-emerald-600 text-white rounded font-bold hover:bg-emerald-700">
                        購入確認へ進む
                    </button>
                @endif
            </div>
        </div>

        {{-- 購入確認モーダル --}}
        <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4" style="display: none;">
            <div class="bg-white p-6 rounded-lg max-w-lg w-full">
                <h3 class="text-xl font-bold mb-4">⚠️ 購入の確定</h3>
                <p class="mb-6">本当にこの内容で購入してもよろしいですか？</p>
                <div class="flex gap-4">
                    <form action="{{ route('purchase.complete') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded">購入を確定する</button>
                    </form>
                    <button @click="showModal = false" class="px-6 py-2 bg-gray-300 rounded">キャンセル</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>