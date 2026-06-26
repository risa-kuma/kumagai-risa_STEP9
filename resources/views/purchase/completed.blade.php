<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('購入完了') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

                <h3 class="text-lg font-semibold mb-4">
                    ご購入ありがとうございました！
                </h3>

                <p class="mb-6">
                    ご注文が正常に完了しました。
                </p>

                <a href="{{ route('products.index') }}"
                   class="text-blue-600 hover:text-blue-900 underline">
                    商品一覧へ戻る
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
