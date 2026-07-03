<footer class="w-full bg-white py-10 mt-12 border-t border-gray-100">
    <div class="max-w-7xl mx-auto flex flex-col items-center gap-4">

        {{-- お問い合わせボタン：インラインスタイルを削除しTailwindクラスで定義 --}}
        <a href="{{ route('contact') }}"
           class="bg-indigo-600 text-white px-5 py-2 rounded text-sm font-medium shadow-sm transition hover:opacity-90">
            お問い合わせ
        </a>

        {{-- ナビゲーションリンク --}}
        <div class="flex items-center gap-6 text-sm mt-2">
            <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline font-medium">Home</a>
            <a href="{{ route('mypage.index') }}" class="text-indigo-600 hover:underline font-medium">マイページ</a>
        </div>

        {{-- 区切り線 --}}
        <div class="w-full max-w-4xl border-t border-gray-100 my-4"></div>

        {{-- コピーライト --}}
        <p class="text-gray-500 text-xs">© 2024 Company, Inc</p>
    </div>
</footer>