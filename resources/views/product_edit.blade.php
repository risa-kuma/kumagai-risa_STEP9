<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            プロフィール
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- プロフィール情報 --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">プロフィール情報</h3>
                <p class="mt-1 text-sm text-gray-600">
                    アカウントのプロフィール情報とメールアドレスを更新できます。
                </p>

                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <label class="block font-medium text-sm text-gray-700">名前</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">メールアドレス</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>保存</x-primary-button>
                    </div>
                </form>
            </div>

            {{-- パスワード変更 --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">パスワード変更</h3>
                <p class="mt-1 text-sm text-gray-600">
                    安全のため、長くて推測されにくいパスワードを設定してください。
                </p>

                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block font-medium text-sm text-gray-700">現在のパスワード</label>
                        <input type="password" name="current_password"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">新しいパスワード</label>
                        <input type="password" name="password"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">パスワード確認</label>
                        <input type="password" name="password_confirmation"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>保存</x-primary-button>
                    </div>
                </form>
            </div>

            {{-- アカウント削除 --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">アカウント削除</h3>
                <p class="mt-1 text-sm text-gray-600">
                    アカウントを削除すると、すべてのデータは完全に削除されます。
                    削除前に必要なデータがあれば保存してください。
                </p>

                <form method="post" action="{{ route('profile.destroy') }}" class="mt-6">
                    @csrf
                    @method('delete')

                    <x-danger-button>アカウントを削除</x-danger-button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
