<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * アカウント情報編集画面を表示
     */
    public function edit(Request $request): View
    {
        // ビューを表示するだけにする（HTMLコードをコントローラーから削除）
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * プロフィールの更新処理
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // 1. バリデーション
        // ※DBのカラム名に合わせて name_kanji / name_kana に変更しています
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'name_kanji' => ['required', 'string', 'max:255'],
            'name_kana'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        // 2. 値をセットして保存
        $user->update([
            'name'       => $request->name,
            'name_kanji' => $request->name_kanji,
            'name_kana'  => $request->name_kana,
            'email'      => $request->email,
        ]);

        return redirect()->route('mypage.index')->with('status', 'profile-updated');
    }
}