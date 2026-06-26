<footer class="w-full bg-white py-10 mt-12 border-t border-gray-100">
    <div class="max-w-7xl mx-auto flex flex-col items-center gap-4">

        {{-- お問い合わせボタン：画像通りの鮮やかな青（#4f46e5）を強制適用 --}}
        <a href="{{ route('contact') }}"
           style="background-color: #4f46e5 !important; color: #ffffff !important;"
           class="px-5 py-2 rounded text-sm font-medium shadow-sm transition hover:opacity-90">
            お問い合わせ
        </a>

        {{-- ナビゲーションリンク --}}
        <div class="flex items-center gap-6 text-sm mt-2">
            <a href="{{ route('products.index') }}" style="color: #4f46e5;" class="hover:underline font-medium">Home</a>
            <a href="{{ route('mypage.index') }}" style="color: #4f46e5;" class="hover:underline font-medium">マイページ</a>
        </div>

        {{-- 区切り線（画像にある薄い横線） --}}
        <div class="w-full max-w-4xl border-t border-gray-100 my-4"></div>

        {{-- コピーライト --}}
        <p class="text-gray-500 text-xs">© 2024 Company, Inc</p>
    </div>
</footer>