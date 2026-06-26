<header class="w-full bg-white border-b border-gray-200 py-4 px-6 shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        
        {{-- 左側：ロゴ --}}
        <div class="text-2xl font-semibold text-gray-900">
            <a href="{{ route('products.index') }}">Cytech EC</a>
        </div>

        {{-- 右側：ナビゲーションとログアウトボタン --}}
        <div class="flex items-center gap-6 text-sm">
            <a href="{{ route('products.index') }}" style="color: #4f46e5;" class="hover:underline font-medium">Home</a>
            <a href="{{ route('mypage.index') }}" style="color: #4f46e5;" class="hover:underline font-medium">マイページ</a>
            
            <span class="text-gray-600">
                ログインユーザー: <span class="font-semibold text-gray-800">{{ Auth::user()->name ?? 'TTUU' }}</span>
            </span>

            {{-- ログアウトボタン：画像通りの赤茶色（#b75a4b）を強制適用 --}}
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" 
                        style="background-color: #b75a4b !important; color: #ffffff !important;" 
                        class="px-4 py-2 rounded text-sm font-medium shadow-sm transition hover:opacity-90">
                    ログアウト
                </button>
            </form>
        </div>

    </div>
</header>