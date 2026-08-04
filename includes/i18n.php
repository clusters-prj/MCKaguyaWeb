<?php
/**
 * 多言語対応の共通読み込みファイル
 * 全ての .php ページの先頭で下記の1行をそのままコピペしてください。
 * DOCUMENT_ROOT基準の絶対パスなので、ページがどの階層にあっても
 * パスを数え直す必要はありません。
 *
 *   require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
 */

// 対応言語一覧（ここに追加するだけで新しい言語を増やせます）
const SUPPORTED_LANGS = ['ja', 'en', 'es', 'fr', 'ko', 'zh-CN', 'zh-TW'];
const DEFAULT_LANG = 'ja';

function detect_lang(): string {
    // 1. URLパラメータ ?lang=en が最優先
    if (isset($_GET['lang']) && in_array($_GET['lang'], SUPPORTED_LANGS, true)) {
        setcookie('lang', $_GET['lang'], time() + 60 * 60 * 24 * 365, '/');
        return $_GET['lang'];
    }

    // 2. Cookie に保存済みの言語
    if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], SUPPORTED_LANGS, true)) {
        return $_COOKIE['lang'];
    }

    // 3. ブラウザの Accept-Language ヘッダーから推測
    if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $accepted = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        foreach ($accepted as $entry) {
            $code = strtolower(substr(trim(explode(';', $entry)[0]), 0, 2));
            if (in_array($code, SUPPORTED_LANGS, true)) {
                return $code;
            }
        }
    }

    // 4. デフォルト
    return DEFAULT_LANG;
}

$GLOBALS['current_lang'] = detect_lang();

$lang_file = $_SERVER['DOCUMENT_ROOT'] . '/lang/' . $GLOBALS['current_lang'] . '.php';
$GLOBALS['dict'] = file_exists($lang_file) ? require $lang_file : [];

/**
 * 翻訳文字列を取得する。
 * キーが見つからない場合はキー自体を表示してすぐ気付けるようにする。
 */
function t(string $key): string {
    return $GLOBALS['dict'][$key] ?? "[[{$key}]]";
}

// 共通処理ファイルなどに1回書いておく
// 省略用
function h($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * 現在の言語コードを取得
 */
function current_lang(): string {
    return $GLOBALS['current_lang'];
}