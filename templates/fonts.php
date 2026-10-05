<?php
/**
 * Webフォントの読み込み（描画をブロックしない）。
 *
 * media="print" で読み込んでおき、ダウンロード完了後に all へ切り替える。
 * 読み込み中は代替フォントで表示され、display=swap により完了後に差し替わる。
 * JavaScript が無効な環境では <noscript> 側で通常どおり読み込む。
 */
$fonts_href = 'https://fonts.googleapis.com/css2?family=Kiwi+Maru:wght@400;500;700&family=Noto+Sans+JP:wght@400;500;600;700&family=Silkscreen:wght@400;700&family=Zen+Old+Mincho:wght@400;500;600;700&display=swap';
?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="<?= h($fonts_href) ?>" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="<?= h($fonts_href) ?>"></noscript>
