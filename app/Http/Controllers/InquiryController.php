<?php

namespace App\Http\Controllers;

use App\Models\Inquiry; // 👈 規約通りModelを読み込んで操作します
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * お問い合わせ画面を表示 (規約準拠)
     */
    public function index()
    {
        // ⭕ 直接Viewを呼ばず、必ずControllerからViewを返します
        return view('inquiry');
    }

    /**
     * お問い合わせの送信・保存処理
     */
    public function store(Request $request)
    {
        // 入力チェック（バリデーション）
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        try {
            // ⭕【規約準拠】クエリビルダを使わず、Model（Eloquent）経由で保存します
            Inquiry::create([
                'user_id' => $request->user()->id, // ログイン中のユーザーID
                'title'   => $validated['title'],
                'body'    => $validated['body'],
            ]);

            // 🟢 成功メッセージを返して元の画面に戻る
            return redirect()->back()->with('success', 'お問い合わせを送信しました！');

        } catch (\Exception $e) {
            // 🔴 失敗時はエラーメッセージを返す
            return redirect()->back()->with('error', '送信に失敗しました');
        }
    }
}