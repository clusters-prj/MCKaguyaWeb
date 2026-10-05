<?php
/**
 * lang/*.php のキーの過不足を検査する CI 用スクリプト。
 *
 *   php tools/check_lang_keys.php
 *
 * 基準は lang/ja.php（既定言語）。他の言語ファイルに
 *  - 足りないキー  … そのページに [[key_name]] と表示されてしまう
 *  - 余分なキー    … 使われていない翻訳（多くは名前の打ち間違い）
 * があれば一覧を出して終了コード1で失敗する。
 *
 * 重複キーも検出する（PHPの配列リテラルでは後勝ちで静かに上書き
 * されるため、翻訳したつもりが反映されない事故が起きやすい）。
 */

$lang_dir = dirname(__DIR__) . '/lang';
$base_lang = 'ja';

$files = glob($lang_dir . '/*.php');
sort($files);

if (!$files) {
    fwrite(STDERR, "lang ディレクトリに翻訳ファイルが見つかりません\n");
    exit(1);
}

$has_error = false;

// ---- 重複キーの検出（require では潰れてしまうのでソースを読む） ----
$duplicates = [];
foreach ($files as $file) {
    $seen = [];
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $no => $line) {
        if (preg_match("/^\s*'([^']+)'\s*=>/", $line, $m)) {
            $key = $m[1];
            if (isset($seen[$key])) {
                $duplicates[basename($file)][] = sprintf(
                    '%s (%d行目 と %d行目)', $key, $seen[$key], $no + 1
                );
            } else {
                $seen[$key] = $no + 1;
            }
        }
    }
}

if ($duplicates) {
    $has_error = true;
    echo "重複しているキーがあります（後に書いた方で上書きされます）:\n";
    foreach ($duplicates as $name => $items) {
        echo "  $name\n";
        foreach ($items as $item) {
            echo "    - $item\n";
        }
    }
    echo "\n";
}

// ---- キーの過不足の検出 ----
$base_file = $lang_dir . '/' . $base_lang . '.php';
if (!file_exists($base_file)) {
    fwrite(STDERR, "基準ファイルがありません: $base_file\n");
    exit(1);
}

$base_keys = array_keys(require $base_file);

foreach ($files as $file) {
    $name = basename($file, '.php');
    if ($name === $base_lang) {
        continue;
    }

    $keys = array_keys(require $file);
    $missing = array_diff($base_keys, $keys);
    $extra   = array_diff($keys, $base_keys);

    if ($missing || $extra) {
        $has_error = true;
        echo "lang/$name.php:\n";
        foreach ($missing as $key) {
            echo "  - 未翻訳: $key\n";
        }
        foreach ($extra as $key) {
            echo "  - ja.php に無いキー: $key\n";
        }
        echo "\n";
    }
}

if ($has_error) {
    fwrite(STDERR, "翻訳ファイルのキーが揃っていません。\n");
    exit(1);
}

echo sprintf(
    "OK: %d 言語 × %d キーが揃っています。\n",
    count($files),
    count($base_keys)
);
