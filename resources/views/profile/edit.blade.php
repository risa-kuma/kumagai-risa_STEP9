<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('アカウント編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- 更新成功時のメッセージ表示 --}}
            @if (session('status') === 'profile-updated')
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg font-bold">
                    ✓ プロフィール情報を更新しました！
                </div>
            @endif

            {{-- プロフィール情報修正フォーム --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg text-gray-900">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h3 class="text-lg font-medium text-gray-900">プロフィール情報</h3>
                            <p class="mt-1 text-sm text-gray-600">アカウント情報を更新できます。</p>
                        </header>

                        <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            {{-- Name (ユーザー名) --}}
                            <div>
                                <x-input-label for="name" :value="__('Name（ユーザー名）')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            {{-- Name Kanji (名前 漢字) --}}
                            <div>
                                <x-input-label for="name_kanji" :value="__('名前(漢字)')" />
                                <x-text-input id="name_kanji" name="name_kanji" type="text" class="mt-1 block w-full" :value="old('name_kanji', $user->name_kanji)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('name_kanji')" />
                            </div>

                            {{-- Name Kana (名前 カナ) --}}
                            <div>
                                <x-input-label for="name_kana" :value="__('名前(カナ)')" />
                                <x-text-input id="name_kana" name="name_kana" type="text" class="mt-1 block w-full" :value="old('name_kana', $user->name_kana)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('name_kana')" />
                            </div>

                            {{-- Email --}}
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('保存する') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            {{-- 戻るリンク --}}
            <div class="text-left px-4">
                <a href="{{ route('mypage.index') }}" class="text-gray-600 hover:text-gray-900 underline text-sm">
                    マイページに戻る
                </a>
            </div>

        </div>
    </div>
</x-app-layout>