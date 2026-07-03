<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    // 指摘3対応：テーブルのカラムに合わせて修正
    protected $fillable = [
        'user_id', 
        'title', 
        'body'
    ];
}