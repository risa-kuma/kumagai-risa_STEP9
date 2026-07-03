<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // 会社名を持つカラム名を指定してください（例: company_name）
    protected $fillable = ['company_name'];

    // もし会社が複数の商品を持っているなら、ここも追加しておくと便利です
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}