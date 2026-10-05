<?php
declare(strict_types=1);
session_start();
$clientIp = $_SERVER['REMOTE_ADDR'] ?? '';
$isPrivateClient = in_array($clientIp, ['127.0.0.1', '::1'], true)
    || filter_var($clientIp, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false;
if (!$isPrivateClient) { http_response_code(404); exit('Not Found'); }
$root = dirname(__DIR__);
$dataFile = $root . '/data/homepage.json';
$imageDir = $root . '/assets/gallery';
$defaults = [
    'hero_title' => "物語の街を、\n歩ける世界に。",
    'hero_intro' => '本プロジェクトは、マインクラフトにおいて「超かぐや姫！」の世界観を忠実に、かつ独自の解釈を加えて再現することを目的に始動しました。',
    'hero_image' => '2026-10-05_17.31.29.webp',
    'hero_image_alt' => '星の海に浮かぶツクヨミの鳥居と光の道',
    'gallery' => [
        ['title'=>'路上ライブが行われた道','description'=>'光に導かれて、ライブの余韻を歩く。','images'=>['2026-10-04_02.43.18.webp','2026-10-04_02.41.29.webp']],
        ['title'=>'ネオン商店街','description'=>'灯りが連なる、街のにぎわい。','images'=>['2026-10-04_02.31.28.webp','2026-10-04_02.29.10.webp']],
        ['title'=>'川床','description'=>'水辺に灯る、やわらかな時間。','images'=>['2026-10-04_02.12.49.webp','2026-10-04_02.12.30.webp']],
    ],
    'news' => [
        ['date'=>'2026.08.29','text'=>'メンバーを募集しています'],
        ['date'=>'2026.06.30','text'=>'プロジェクトの最新情報を公開しました'],
        ['date'=>'2026.06.17','text'=>'ツクヨミ再現プロジェクト始動'],
    ],
];
$saved = json_decode((string)@file_get_contents($dataFile), true) ?: [];
$content = array_replace($defaults, $saved);
if (empty($_SESSION['editor_token'])) $_SESSION['editor_token'] = bin2hex(random_bytes(24));
$message = '';
$escape = static fn($v): string => htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$clip = static function(string $value, int $limit): string {
    if (function_exists('mb_substr')) return mb_substr($value, 0, $limit);
    preg_match_all('/./us', $value, $characters);
    return implode('', array_slice($characters[0] ?? [], 0, $limit));
};
$imageFiles = array_values(array_filter(scandir($imageDir) ?: [], static fn($name) => preg_match('/\.(webp|png|jpe?g|avif)$/i', $name)));
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['editor_token'], (string)($_POST['token'] ?? ''))) {
        http_response_code(403); exit('編集画面を再読み込みしてください。');
    }
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['image'];
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        $ext = ['image/webp'=>'webp','image/png'=>'png','image/jpeg'=>'jpg','image/avif'=>'avif'][$mime] ?? null;
        if ($file['error'] === UPLOAD_ERR_OK && $file['size'] <= 15 * 1024 * 1024 && $ext) {
            $name = 'editor-' . date('Ymd-His') . '-' . bin2hex(random_bytes(3)) . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $imageDir . '/' . $name)) $message = '画像を追加しました。選択欄から使えます。';
        } else $message = '画像を追加できませんでした。WebP、PNG、JPEG、AVIF（15MB以下）を選んでください。';
        $imageFiles = array_values(array_filter(scandir($imageDir) ?: [], static fn($n) => preg_match('/\.(webp|png|jpe?g|avif)$/i', $n)));
    }
    if (isset($_POST['save'])) {
        $cleanImage = static function($name) use ($imageFiles): string {
            $name = basename((string)$name);
            return in_array($name, $imageFiles, true) ? $name : '';
        };
        $next = [
            'hero_title' => $clip(trim((string)($_POST['hero_title'] ?? '')), 100),
            'hero_intro' => $clip(trim((string)($_POST['hero_intro'] ?? '')), 500),
            'hero_image' => $cleanImage($_POST['hero_image'] ?? ''),
            'hero_image_alt' => $clip(trim((string)($_POST['hero_image_alt'] ?? '')), 160),
            'gallery' => [], 'news' => [],
        ];
        for ($i=0; $i<3; $i++) {
            $next['gallery'][] = [
                'title' => $clip(trim((string)($_POST['gallery_title'][$i] ?? '')),80),
                'description' => $clip(trim((string)($_POST['gallery_description'][$i] ?? '')),220),
                'images' => array_values(array_filter(array_map($cleanImage, (array)($_POST['gallery_images'][$i] ?? [])))),
            ];
        }
        for ($i=0; $i<3; $i++) $next['news'][] = ['date'=>$clip(trim((string)($_POST['news_date'][$i] ?? '')),20),'text'=>$clip(trim((string)($_POST['news_text'][$i] ?? '')),180)];
        if ($next['hero_image'] && file_put_contents($dataFile, json_encode($next, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|LOCK_EX)) !== false) {
            $content = array_replace($defaults, $next); $message = '変更を保存しました。サイトに反映されています。';
        } else $message = '保存できませんでした。ヒーロー画像を選択してください。';
    }
}
$select = static function(string $field, string $selected) use ($imageFiles, $escape): void {
    echo '<select name="'. $field .'">';
    foreach ($imageFiles as $file) echo '<option value="'. $escape($file) .'"'.($file === $selected ? ' selected':'').'>'. $escape($file) .'</option>';
    echo '</select>';
};
?>
<!doctype html><html lang="ja"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>サイト編集ツール | MCツクヨミ制作委員会</title>
<style>
:root{font-family:"Noto Sans JP","Yu Gothic",sans-serif;color:#28253c;background:#f1edf5}*{box-sizing:border-box}body{margin:0}.top{padding:26px max(22px,calc((100% - 1050px)/2));background:linear-gradient(115deg,#29243f,#55436d);color:white}.top a{color:#f5dba8}.wrap{max-width:1050px;margin:28px auto;padding:0 18px}.card{background:#fff;border:1px solid #e7dfeb;border-radius:16px;padding:clamp(18px,4vw,34px);margin:18px 0;box-shadow:0 12px 36px #3427440c}.card h2{margin:0 0 8px;font:600 1.4rem "Zen Old Mincho",serif}.hint{color:#777184;font-size:.92rem;margin:0 0 20px}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:18px}.field{display:grid;gap:7px;margin:14px 0}.field label{font-size:.88rem;font-weight:700}.field small{color:#81798a}input,textarea,select{font:inherit;width:100%;padding:11px 12px;border:1px solid #ddd5e5;border-radius:8px;background:#fff;color:#29253d}textarea{min-height:90px;resize:vertical}.photo{display:flex;align-items:center;gap:12px;margin:10px 0}.photo img{width:120px;height:74px;object-fit:cover;border-radius:7px;background:#eee}.photo select{flex:1}.notice{padding:14px 18px;background:#e9f4ee;border-radius:9px;color:#285d43}.buttons{display:flex;gap:12px;align-items:center;flex-wrap:wrap}.save{border:0;border-radius:9px;padding:14px 24px;background:#4e4077;color:white;font:700 1rem inherit;cursor:pointer}.preview{color:#514477}.theme{border-top:1px solid #eee8f1;padding-top:20px;margin-top:22px}footer{padding:20px;text-align:center;color:#777184;font-size:.85rem}@media(max-width:600px){.top{padding:22px}.wrap{margin-top:14px}.photo{align-items:flex-start;flex-direction:column}.photo img{width:100%;height:auto;aspect-ratio:16/9}}
</style><link rel="preconnect" href="https://fonts.googleapis.com"><link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Zen+Old+Mincho:wght@500;600&display=swap" rel="stylesheet">
<header class="top"><strong>MC TSUKUYOMI / SITE EDITOR</strong><h1>ホームページ編集</h1><a href="/" target="_blank">公開ページを別タブで確認 ↗</a></header><main class="wrap">
<?php if ($message): ?><p class="notice"><?= $escape($message) ?></p><?php endif; ?>
<form method="post" enctype="multipart/form-data"><input type="hidden" name="token" value="<?= $escape($_SESSION['editor_token']) ?>">
<section class="card"><h2>トップのメッセージ</h2><p class="hint">ホームページを開いたとき最初に表示される文章と画像です。</p>
<div class="field"><label>大見出し</label><textarea name="hero_title"><?= $escape($content['hero_title']) ?></textarea><small>改行したい場所で改行してください。</small></div>
<div class="field"><label>紹介文</label><textarea name="hero_intro"><?= $escape($content['hero_intro']) ?></textarea></div><div class="grid"><div class="field"><label>ヒーロー画像</label><?php $select('hero_image',$content['hero_image']); ?></div><div class="field"><label>画像の説明（アクセシビリティ）</label><input name="hero_image_alt" value="<?= $escape($content['hero_image_alt']) ?>"></div></div></section>
<section class="card"><h2>再現建築ギャラリー</h2><p class="hint">3つのテーマの順番は固定です。同じテーマの複数画像から、ページを開くたび1枚をランダムに表示します。</p>
<?php foreach ($content['gallery'] as $i=>$item): ?><div class="theme"><h3><?= str_pad((string)($i+1),2,'0',STR_PAD_LEFT) ?>　テーマ</h3><div class="grid"><div class="field"><label>テーマ名</label><input name="gallery_title[<?= $i ?>]" value="<?= $escape($item['title']) ?>"></div><div class="field"><label>短い説明</label><input name="gallery_description[<?= $i ?>]" value="<?= $escape($item['description']) ?>"></div></div><div class="field"><label>このテーマでランダム表示する画像（複数選択可）</label><select name="gallery_images[<?= $i ?>][]" multiple size="5"><?php foreach($imageFiles as $file): ?><option value="<?= $escape($file) ?>"<?= in_array($file,$item['images'],true)?' selected':'' ?>><?= $escape($file) ?></option><?php endforeach; ?></select><small>Ctrl（MacはCommand）を押しながらクリックで複数選択。</small></div></div><?php endforeach; ?></section>
<section class="card"><h2>最近のお知らせ</h2><p class="hint">ホームページ下部のお知らせを編集できます。</p><?php foreach($content['news'] as $i=>$news): ?><div class="grid"><div class="field"><label>日付</label><input name="news_date[<?= $i ?>]" value="<?= $escape($news['date']) ?>"></div><div class="field"><label>お知らせ内容</label><input name="news_text[<?= $i ?>]" value="<?= $escape($news['text']) ?>"></div></div><?php endforeach; ?></section>
<section class="card"><h2>画像を追加</h2><p class="hint">追加した画像は上の画像選択欄に表示されます（WebP、PNG、JPEG、AVIF、15MBまで）。</p><div class="buttons"><input style="max-width:460px" type="file" name="image" accept="image/webp,image/png,image/jpeg,image/avif"><button class="save" name="upload" value="1">画像をアップロード</button></div></section>
<section class="card buttons"><button class="save" name="save" value="1">変更を保存</button><a class="preview" href="/" target="_blank">サイトをプレビュー ↗</a></section>
</form></main><footer>変更データはこのプロジェクトの data/homepage.json に保存されます。</footer></html>
