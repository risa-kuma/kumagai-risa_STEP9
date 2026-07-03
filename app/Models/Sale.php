<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // 対応するテーブル名
    protected $table = 'sales';

    // 更新可能なカラム（ホワイトリスト）
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * この購入履歴の商品を取得
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * この購入履歴のユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}