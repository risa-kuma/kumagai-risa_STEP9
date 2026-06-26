<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('最終確認') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

                <h3 class="text-lg font-semibold mb-4">
                    以下の内容で購入を確定しますか？
                </h3>

                <table class="w-full border border-gray-300 mb-6">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">商品名</th>
                            <th class="border px-4 py-2 text-left">価格</th>
                            <th class="border px-4 py-2 text-left">数量</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cart as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $item['name'] }}</td>
                                <td class="border px-4 py-2">¥{{ number_format($item['price']) }}</td>
                                <td class="border px-4 py-2">{{ $item['quantity'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- 購入確定ボタン -->
                <form action="{{ route('purchase.complete') }}" method="POST" class="mt-6">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        購入を確定する
                    </button>
                </form>

                <!-- 戻るリンク -->
                <a href="{{ route('purchase.index') }}"
                   class="text-gray-600 hover:text-gray-900 underline mt-4 inline-block">
                    戻る
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
