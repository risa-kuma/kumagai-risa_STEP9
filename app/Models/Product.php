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
     * いいねリレーション
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }
    public function scopeFiltered($query, $name, $minPrice, $maxPrice)
    {
    return $query->when($name, fn($q) => $q->where('product_name', 'like', "%{$name}%"))
                 ->when($minPrice, fn($q) => $q->where('price', '>=', $minPrice))
                 ->when($maxPrice, fn($q) => $q->where('price', '<=', $maxPrice));
    }

    public function scopeOfUser($query, $userId)
    {
        return $query->where('user_id', $userId)->orderBy('id', 'asc');
    }

    public function scopeExcludeUser($query, $userId)
    {
        return $query->where('user_id', '!=', $userId);
    }
}
