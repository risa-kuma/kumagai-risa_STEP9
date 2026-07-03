import Alpine from 'alpinejs';

window.Alpine = Alpine;

/**
 * ページ共通の初期化や、特定の要素に対する処理をここに記述します。
 * 各関数内で要素の存在チェックを行うことで、エラーを防ぎます。
 */
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. 画像プレビュー処理の例（ファイル入力がある場合のみ実行）
    const imageInput = document.querySelector('input[type="file"]');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            console.log('画像が選択されました:', e.target.files[0]);
            // ここにプレビュー表示などのロジックを追加可能
        });
    }

    // 2. その他、全ページ共通で行いたい処理があればここに記述
    console.log('アプリケーションが初期化されました');
});

// Alpine.js を起動
Alpine.start();