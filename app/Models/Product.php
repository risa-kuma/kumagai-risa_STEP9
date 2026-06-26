<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 対応するテーブル名
    protected $table = 'products';

    /**
     * 更新可能なカラム（ホワイトリスト）
     * 設計書のカラム名に合わせて修正しました
     */
    protected $fillable = [
        'user_id',
        'company_id',
        'product_name', // name から変更
        'price',
        'stock',
        'description',
        'img_path',     // image から変更
    ];

    /**
     * お気に入りリレーション
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}