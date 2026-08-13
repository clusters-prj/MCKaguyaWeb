<?php
/**
 * 全ページ共通の <head> 内容。
 *
 * 使い方 — ページ側で先に変数を定義してから include する。
 *
 *   <?php
 *   require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
 *   $page_title_key = 'contact_page_title';       // 必須
 *   $page_desc_key  = 'contact_intro';            // 任意（省略時は site_description）
 *   ?>
 *   <!DOCTYPE html>
 *   <html lang="<?= current_lang() ?>" dir="<?= lang_dir() ?>">
 *   <head>
 *   <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
 *     <style> ページ固有のCSS </style>
 *   </head>
 *
 * ページ固有の <style> や <link> は、この include の「後ろ」に書くこと。
 */

// 翻訳キーの代わりに $page_title / $page_desc を直接渡すこともできる
// （日本語のみの運用ページなど、翻訳を用意しない場合に使う）。
if (!isset($page_title)) {
    $page_title = isset($page_title_key) ? t($page_title_key) : t('site_title');
}
if (!isset($page_desc)) {
    $page_desc = isset($page_desc_key) ? t($page_desc_key) : t('site_description');
}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($page_title) ?></title>
    <meta name="description" content="<?= h($page_desc) ?>">

    <link rel="icon" href="/favicon.ico" sizes="any">

    <!-- 検索エンジン向け: 正規URLと各言語版の対応関係 -->
    <link rel="canonical" href="<?= h(absolute_url(lang_url(current_lang()))) ?>">
<?php foreach (SUPPORTED_LANGS as $alt_lang): ?>
    <link rel="alternate" hreflang="<?= h($alt_lang) ?>" href="<?= h(absolute_url(lang_url($alt_lang))) ?>">
<?php endforeach; ?>
    <link rel="alternate" hreflang="x-default" href="<?= h(absolute_url(lang_url(null))) ?>">

    <!-- SNSシェア用（Open Graph / Twitter Card） -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= h(t('site_title')) ?>">
    <meta property="og:title" content="<?= h($page_title) ?>">
    <meta property="og:description" content="<?= h($page_desc) ?>">
    <meta property="og:url" content="<?= h(absolute_url(lang_url(current_lang()))) ?>">
    <meta property="og:locale" content="<?= h(str_replace('-', '_', current_lang())) ?>">
    <meta property="og:image" content="<?= h(absolute_url('/assets/logo.JPG')) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="theme-color" content="#6366f1">

    <link rel="stylesheet" href="/assets/style.css" id="main-style">
    <script>
      // 保存済みテーマを <head> の時点で反映する。
      // DOMContentLoaded まで待つと、pre テーマの利用者に
      // 一瞬 style.css が見えてしまう（FOUC）ため、ここで差し替える。
      (function () {
        try {
          if (localStorage.getItem('selected-theme') === 'pre') {
            document.getElementById('main-style').href = '/assets/pre.css';
          }
        } catch (e) {
          // プライベートブラウジング等で localStorage が使えない場合は既定テーマのまま
        }
      })();
    </script>
