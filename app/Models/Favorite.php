<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    // このお気に入りが「どのユーザーのものか」
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // このお気に入りが「どの商品のものか」
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}