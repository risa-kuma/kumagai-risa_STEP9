<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
</head>
<body>
    <h1>商品一覧</h1>

    <a href="{{ route('products.create') }}">新規登録</a>

    <ul>
        @foreach ($products as $product)
            <li>
                {{ $product->name }} - {{ $product->price }}円
                |
                <a href="{{ route('products.show', $product->id) }}">詳細</a>
                |
                <a href="{{ route('products.edit', $product->id) }}">編集</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
