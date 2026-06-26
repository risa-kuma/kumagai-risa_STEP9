<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品詳細</title>
</head>
<body>
    <h1>商品詳細</h1>

    <p><strong>商品名：</strong> {{ $product->name }}</p>
    <p><strong>価格：</strong> {{ $product->price }}円</p>
    <p><strong>説明：</strong> {{ $product->description }}</p>
    <p><strong>画像URL：</strong> {{ $product->image }}</p>

    <br>

    <a href="{{ route('products.edit', $product->id) }}">編集する</a>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">削除する</button>
    </form>

    <br><br>
    <a href="{{ route('products.index') }}">一覧に戻る</a>
</body>
</html>
