<?php
/**
 * エラーページの共通テンプレート。
 *
 * 403 / 404 / 500 はレイアウトがほぼ同一なので、この1ファイルにまとめている。
 * 各 errors/<code>.php から、以下の変数を定義したうえで include する。
 *
 *   $error_code  … HTTPステータスコード（整数）
 *   $error_hints … 「よくある質問」に並べる翻訳キーの配列
 *
 * Apache の ErrorDocument から内部リダイレクトで呼ばれるため、
 * ステータスコードは Apache 側が保持する。ただし直接アクセスされた
 * 場合に 200 を返さないよう、念のため自前でも送出しておく。
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';

if (!isset($error_code)) {
    $error_code = 500;
}
if (!isset($error_hints)) {
    $error_hints = [];
}

if (!headers_sent()) {
    http_response_code($error_code);
}

$error_title = t("error_{$error_code}_title");
$error_desc  = t("error_{$error_code}_desc");
?>
<!DOCTYPE html>
<html lang="<?= current_lang() ?>" dir="<?= lang_dir() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $error_code ?> - <?= h($error_title) ?></title>
    <meta name="robots" content="noindex">
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="stylesheet" href="/assets/error.css">
</head>
<body>
    <div class="container">
        <div class="error-section">
            <div class="error-code"><?= $error_code ?></div>
            <h1 class="error-title"><?= h($error_title) ?></h1>
            <p class="error-description"><?= h($error_desc) ?></p>
        </div>

        <section>
            <h2><?= h(t('error_what_to_do')) ?></h2>
            <div class="suggestions">
                <a class="suggestion-card" href="/index.php">
                    <span class="suggestion-emoji" aria-hidden="true">🏠</span>
                    <div class="suggestion-text"><?= h(t('error_go_home')) ?></div>
                </a>
                <a class="suggestion-card" href="/pages/gameinfo.php">
                    <span class="suggestion-emoji" aria-hidden="true">🔍</span>
                    <div class="suggestion-text"><?= h(t('error_browse_menu')) ?></div>
                </a>
                <a class="suggestion-card" href="/pages/contact.php">
                    <span class="suggestion-emoji" aria-hidden="true">✉️</span>
                    <div class="suggestion-text"><?= h(t('error_contact')) ?></div>
                </a>
            </div>
            <div class="action-buttons">
                <a class="btn primary" href="/index.php"><?= h(t('error_go_home')) ?></a>
                <button class="btn" id="go-back" type="button"><?= h(t('error_go_back')) ?></button>
            </div>
        </section>

        <?php if (!empty($error_hints)): ?>
        <section>
            <h2><?= h(t('error_faq')) ?></h2>
            <ul>
                <?php foreach ($error_hints as $hint_key): ?>
                    <li><?= h(t($hint_key)) ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
        <?php endif; ?>

        <p class="text-muted" style="text-align: center; margin-top: 24px;">
            <?= h(t('error_code_label')) ?>: <?= $error_code ?> | <?= h($error_title) ?>
        </p>
    </div>

    <script>
        // 履歴がない場合（新しいタブで直接開いた等）はトップへ戻す
        document.getElementById('go-back').addEventListener('click', function () {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/index.php';
            }
        });
    </script>
</body>
</html>
