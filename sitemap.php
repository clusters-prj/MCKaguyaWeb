<?php
/**
 * sitemap.xml を動的に生成する。
 *
 * 以前は assets/sitemap.xml に手書きで置いていたが、
 *  - 検索エンジンが探す /sitemap.xml ではない場所にあった
 *  - 対応10言語のうち ja/en/zh の3つしか書かれておらず、しかも
 *    'zh' は SUPPORTED_LANGS に存在しないコードだった
 *  - ページを増やすたびに全言語ぶん手で書き足す必要があった
 * ため、includes/pages.php を元に生成する方式に変更した。
 *
 * lastmod は各PHPファイルの更新日時から取る。
 */

require_once __DIR__ . '/includes/i18n.php';

$pages = require __DIR__ . '/includes/pages.php';

// 各言語版のURL（hreflang用）。1ページぶんまとめて組み立てる。
function sitemap_alternates(string $path): array {
    $alternates = [];
    foreach (SUPPORTED_LANGS as $lang) {
        $alternates[$lang] = SITE_URL . $path . '?lang=' . rawurlencode($lang);
    }
    $alternates['x-default'] = SITE_URL . $path;
    return $alternates;
}

header('Content-Type: application/xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php foreach ($pages as $page):
    $file = __DIR__ . $page['path'];
    $lastmod = file_exists($file) ? date('c', filemtime($file)) : date('c');
    $alternates = sitemap_alternates($page['path']);

    // 言語ごとに <url> を1つずつ出す。相互の hreflang は全ページ共通。
    foreach (SUPPORTED_LANGS as $lang): ?>
  <url>
    <loc><?= h($alternates[$lang]) ?></loc>
    <lastmod><?= h($lastmod) ?></lastmod>
    <priority><?= h($page['priority']) ?></priority>
<?php   foreach ($alternates as $alt_lang => $alt_url): ?>
    <xhtml:link rel="alternate" hreflang="<?= h($alt_lang) ?>" href="<?= h($alt_url) ?>" />
<?php   endforeach; ?>
  </url>
<?php endforeach; endforeach; ?>
</urlset>
