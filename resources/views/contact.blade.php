<x-app-layout>
    <div class="max-w-3xl mx-auto p-8 my-8 bg-white shadow-sm rounded-lg border border-gray-100">
        
        <h2 class="text-2xl font-bold text-gray-800 mb-8">お問い合わせフォーム</h2>

        <form method="POST" action="{{ route('contact.submit') }}">
            @csrf

            {{-- お名前 --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">お名前</label>
                <input type="text" name="name" 
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required>
            </div>

            {{-- メールアドレス --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">メールアドレス</label>
                <input type="email" name="email" 
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required>
            </div>

            {{-- お問い合わせ内容 --}}
            <div class="mb-8">
                <label class="block text-gray-700 font-bold mb-2">お問い合わせ内容</label>
                <textarea name="message" 
                          class="w-full border border-gray-300 rounded px-4 py-2 h-40 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                          required></textarea>
            </div>

            {{-- ボタンエリア --}}
            <div class="flex items-center gap-4">
            <button type="submit" class="btn-blue">送信</button>
            <a href="{{ route('products.index') }}" class="btn-gray">
                戻る
            </a>
            </div>
        </form>
    </div>
</x-app-layout>