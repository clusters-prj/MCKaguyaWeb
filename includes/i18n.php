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
const SUPPORTED_LANGS = ['ja', 'en','es','fr','ko','zh-CN','zh-TW','ar','ru','pt'];
const DEFAULT_LANG = 'ja';

/**
 * Accept-Language ヘッダーを解析して、最も適合する対応言語を返す。
 *
 * - q値（品質値）の降順で評価する。q値の指定がない場合は 1.0 とみなす。
 * - 「zh-CN」「zh-Hant-TW」のような地域・文字体系つきのタグにも対応する。
 *   完全一致 → 地域つき別名（zh-Hans→zh-CN 等）→ 言語部分のみ、の順で探す。
 *
 * 対応言語が見つからない場合は null を返す。
 */
function match_accept_language(string $header): ?string {
    // SUPPORTED_LANGS を小文字化したものと元の表記の対応表
    $supported = [];
    foreach (SUPPORTED_LANGS as $code) {
        $supported[strtolower($code)] = $code;
    }

    // 言語部分（ハイフンより前）だけで引ける対応表。
    // 先に定義されているものを優先するため、既出のキーは上書きしない。
    $by_prefix = [];
    foreach (SUPPORTED_LANGS as $code) {
        $prefix = strtolower(explode('-', $code)[0]);
        if (!isset($by_prefix[$prefix])) {
            $by_prefix[$prefix] = $code;
        }
    }

    // 文字体系（script）から地域つきコードへの読み替え
    $script_aliases = [
        'zh-hans' => 'zh-CN',
        'zh-hant' => 'zh-TW',
        'zh-sg'   => 'zh-CN',
        'zh-hk'   => 'zh-TW',
        'zh-mo'   => 'zh-TW',
    ];

    // q値つきでパースする
    $entries = [];
    foreach (explode(',', $header) as $index => $entry) {
        $parts = explode(';', trim($entry));
        $tag = strtolower(trim($parts[0]));
        if ($tag === '') {
            continue;
        }
        $q = 1.0;
        foreach (array_slice($parts, 1) as $param) {
            if (preg_match('/^\s*q\s*=\s*([0-9.]+)\s*$/i', $param, $m)) {
                $q = (float) $m[1];
            }
        }
        if ($q <= 0) {
            continue; // q=0 は「この言語は不可」の意味
        }
        // 同じq値のときはヘッダーの記載順を保つ
        $entries[] = ['tag' => $tag, 'q' => $q, 'order' => $index];
    }

    usort($entries, function ($a, $b) {
        return $b['q'] <=> $a['q'] ?: $a['order'] <=> $b['order'];
    });

    foreach ($entries as $entry) {
        $tag = $entry['tag'];
        if ($tag === '*') {
            continue;
        }

        // 3-1. 完全一致（zh-cn → zh-CN）
        if (isset($supported[$tag])) {
            return $supported[$tag];
        }

        // 3-2. 文字体系つきタグの読み替え（zh-Hant-TW → zh-hant → zh-TW）
        $segments = explode('-', $tag);
        if (count($segments) >= 2) {
            $script_key = $segments[0] . '-' . $segments[1];
            if (isset($script_aliases[$script_key])) {
                return $script_aliases[$script_key];
            }
        }

        // 3-3. 言語部分のみ（en-US → en）
        if (isset($by_prefix[$segments[0]])) {
            return $by_prefix[$segments[0]];
        }
    }

    return null;
}

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
        $match = match_accept_language($_SERVER['HTTP_ACCEPT_LANGUAGE']);
        if ($match !== null) {
            return $match;
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