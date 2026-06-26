<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function store(Request $request)
    {
        // 今回は上のWeb用が直接保存するので、ここは空っぽで大丈夫です！
        return response()->json(['message' => 'API専用の部屋です']);
    }
}