<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Cytech EC</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    @include('layouts.header')

    <main class="flex-grow py-8">
        {{-- メッセージをメインコンテンツのすぐ上に配置 --}}
        @if (session('success'))
            <div class="max-w-4xl mx-auto mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        {{ $slot }}
    </main>

    @include('layouts.footer')

</body>
</html>