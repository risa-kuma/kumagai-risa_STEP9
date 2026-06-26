<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品登録</title>
</head>
<body>
    <h1>商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <label>商品名：</label><br>
        <input type="text" name="name"><br><br>

        <label>価格：</label><br>
        <input type="number" name="price"><br><br>

        <label>説明：</label><br>
        <textarea name="description"></textarea><br><br>

        <label>画像パス：</label><br>
        <input type="text" name="image"><br><br>

        <button type="submit">登録する</button>
    </form>

    <br>
    <a href="{{ route('products.index') }}">一覧に戻る</a>
</body>
</html>
