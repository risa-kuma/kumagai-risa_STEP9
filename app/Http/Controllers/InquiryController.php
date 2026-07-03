<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // メール送信に必要
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    /**
     * お問い合わせ画面を表示
     */
    public function index()
    {
        return view('inquiry.inquiry'); // ビューのパスは実際の構成に合わせてください
    }

    /**
     * お問い合わせの送信・保存処理
     */
    public function store(Request $request)
    {
        // 入力チェック
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        try {
            // 1. Model経由でDBに保存
            $inquiry = Inquiry::create([
                'user_id' => Auth::id(),
                'title'   => $validated['title'],
                'body'    => $validated['body'],
            ]);

            // 2. メール送信処理 (※事前にMailableクラスの作成が必要です)
            // Mail::to('admin@example.com')->send(new \App\Mail\InquiryMail($inquiry));

            // 3. 【指摘2対応】成功時は「商品一覧画面」へ遷移
            return redirect()->route('products.index')->with('success', 'お問い合わせを送信しました！');

        } catch (\Exception $e) {
            // 失敗時は元の画面に戻る
            return redirect()->back()->with('error', '送信に失敗しました：' . $e->getMessage());
        }
    }
}