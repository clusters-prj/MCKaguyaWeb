<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
$home_content = json_decode(@file_get_contents(__DIR__ . '/data/homepage.json'), true) ?: [];
$home_value = static fn(string $key, string $fallback): string => (string)($home_content[$key] ?? $fallback);
$page_title_key = 'site_title';
$page_desc_key  = 'site_description';
?>
<!DOCTYPE html>
<html lang="<?= current_lang() ?>" dir="<?= lang_dir() ?>">
<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
  <link rel="preload" as="image" href="/assets/gallery/1015.webp" fetchpriority="high">
  <link rel="stylesheet" href="/assets/home-scroll.css">
  <script src="/assets/home-scroll.js" defer></script>
</head>
<body class="home-scroll-page">
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
  <main id="main-content" class="home-scroll">
    <section class="home-hero" id="project-overview" aria-labelledby="home-title">
      <div class="home-hero__copy">
        <p class="home-kicker"><span class="pixel-mark" aria-hidden="true"></span> MC TSUKUYOMI PROJECT</p>
        <h1 id="home-title"><?= nl2br(h($home_value('hero_title', "物語の街を、\n歩ける世界に。"))) ?></h1>
        <p class="home-lead"><?= h($home_value('hero_intro', t('index_intro'))) ?></p>
        <div class="home-hero__actions">
          <a class="home-button" href="/pages/contact.php"><?= h(t('nav_contact')) ?><span aria-hidden="true">↗</span></a>
          <a class="home-text-link" href="#world"><?= h(t('index_status_h3')) ?><span aria-hidden="true">↓</span></a>
        </div>
        <div class="home-hero__note">A world built block by block.</div>
      </div>
      <figure class="home-hero__visual">
        <img width="1280" height="720" src="<?= h('/assets/gallery/' . basename($home_value('hero_image', '1015.webp'))) ?>" alt="<?= h($home_value('hero_image_alt', '星の海に浮かぶツクヨミの鳥居と光の道')) ?>" fetchpriority="high">
        <span class="hero-orbit" aria-hidden="true"></span>
        <figcaption><span>TSUKUYOMI / MOON GATE</span><span>星降る海へ</span></figcaption>
      </figure>
      <a class="home-hero__scroll" href="#world" aria-label="下へスクロール"><span></span> SCROLL TO EXPLORE</a>
      <span class="home-hero__index" aria-hidden="true">01 — 05</span>
    </section>

    <section class="home-intro reveal" id="world" aria-labelledby="world-title">
      <div class="section-label"><span>OUR VISION</span><i></i><span>02 / 05</span></div>
      <div class="home-intro__grid">
        <div class="reveal-side reveal-side--left">
          <p class="home-kicker">A CITY BETWEEN MOONLIGHT &amp; PIXELS</p>
          <h2 id="world-title">物語の街を、<br><em>歩ける世界</em>に。</h2>
          <p class="home-prose"><?= h(t('index_intro')) ?></p>
          <a class="home-text-link" href="/pages/gameinfo.php"><?= h(t('nav_gameinfo')) ?><span aria-hidden="true">↗</span></a>
        </div>
        <figure class="home-intro__image reveal-side reveal-side--right">
          <img width="1280" height="720" src="/assets/gallery/945.webp" alt="水辺に建つツクヨミの街への入口" loading="lazy">
          <figcaption><span>THE GATE TO TSUKUYOMI</span><span>その先に広がる、もうひとつの世界。</span></figcaption>
        </figure>
      </div>
    </section>

    <section class="home-showcase reveal" id="gallery" aria-labelledby="gallery-title">
      <div class="showcase-topline"><div class="section-label"><span>WALK THROUGH TSUKUYOMI</span><i></i><span>03 / 05</span></div><span class="showcase-moon" aria-hidden="true">☾</span></div>
      <div class="home-gallery__heading">
        <div><p class="home-kicker">ONE CITY · THREE MOMENTS</p><h2 id="gallery-title">物語の景色を、<em>めぐる。</em></h2></div>
        <p>ひとつの旅のように、3つの風景を順にご案内します。<br>スワイプ、または矢印で次の場所へ。</p>
      </div>
      <article class="feature-gallery" data-feature-gallery aria-roledescription="カルーセル" aria-label="ツクヨミの再現建築">
        <div class="feature-gallery__image-wrap">
          <img width="1280" height="720" data-feature-image src="/assets/gallery/1014.webp" alt="路上ライブが行われた道" loading="lazy">
          <div class="feature-gallery__shade"></div>
          <div class="feature-gallery__coordinates" aria-hidden="true"><span>35° 39' 12.0" N</span><i></i><span>BLOCK / BY / BLOCK</span></div>
          <div class="feature-gallery__caption" aria-live="polite" aria-atomic="true">
            <p data-feature-kicker>TSUKUYOMI — MEMORY 01</p>
            <h3 data-feature-title>路上ライブが行われた道</h3>
            <p data-feature-description>光に導かれて、ライブの余韻を歩く。</p>
          </div>
          <button class="feature-arrow feature-arrow--prev" type="button" data-feature-prev aria-label="前の景色">←</button>
          <button class="feature-arrow feature-arrow--next" type="button" data-feature-next aria-label="次の景色">→</button>
          <div class="feature-gallery__index" aria-hidden="true"><span data-feature-count>01</span><i></i> 03</div>
        </div>
        <div class="feature-gallery__rail" aria-label="景色の順番">
          <span data-feature-step="0" aria-current="step"><b>01</b><span>路上ライブの道</span></span>
          <span data-feature-step="1"><b>02</b><span>ネオン商店街</span></span>
          <span data-feature-step="2"><b>03</b><span>川床</span></span>
          <span class="feature-gallery__autoplay">AUTO <i></i></span>
        </div>
      </article>
      <script>window.HOMEPAGE_GALLERY = <?= json_encode($home_content['gallery'] ?? null, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;</script>
      <div class="home-builds">
        <div class="home-builds__intro"><p class="home-kicker">A LIVING CITY</p><h3>街のあちこちに、<br>つくり手の景色。</h3><p>再現エリアの外にも、メンバーが育ててきた風景が広がっています。</p></div>
        <figure><img width="1280" height="720" src="/assets/gallery/1011.webp" alt="灯りがともる和風の街並み" loading="lazy"><figcaption>夜の街並み</figcaption></figure>
        <figure><img width="1280" height="720" src="/assets/gallery/661.webp" alt="桜に囲まれた木造の門" loading="lazy"><figcaption>桜の門</figcaption></figure>
        <figure><img width="1280" height="720" src="/assets/gallery/767.webp" alt="夜空の下に広がる桜並木と町" loading="lazy"><figcaption>星明かりの町</figcaption></figure>
        <figure><img width="1280" height="720" src="/assets/gallery/893.webp" alt="水辺の灯りと遠くに見える塔" loading="lazy"><figcaption>水辺の塔</figcaption></figure>
      </div>
      <p class="gallery-swipe-hint"><span aria-hidden="true">↔</span> 3つの風景はスワイプ・矢印操作で順に切り替わります</p>
    </section>

    <section class="home-updates reveal" id="updates" aria-labelledby="updates-title">
      <div class="section-label"><span>FIELD NOTES</span><i></i><span>04 / 05</span></div>
      <div class="home-updates__grid">
        <div class="updates-copy reveal-side reveal-side--left"><p class="home-kicker">A PROJECT IN PROGRESS</p><h2 id="updates-title">完成までの道のりも、<br><em>この街の一部。</em></h2><p><?= h(t('site_description')) ?></p><a class="home-text-link" href="/pages/progress.php"><?= h(t('nav_progress')) ?><span aria-hidden="true">↗</span></a></div>
        <div class="updates-panel reveal-side reveal-side--right">
          <div class="updates-panel__head"><span>PROJECT STATUS</span><span class="status-live"><i></i> LIVE LOG</span></div>
          <h3><?= h(t('index_status_h3')) ?></h3>
          <ul class="home-status-list">
            <li><span><?= h(t('index_status_1')) ?></span><strong><?= h(t('index_status_1_v')) ?></strong></li>
            <li><span><?= h(t('index_status_2')) ?></span><strong><?= h(t('index_status_2_v')) ?></strong></li>
            <li><span><?= h(t('index_status_3')) ?></span><strong><?= h(t('index_status_3_v')) ?></strong></li>
            <li><span><?= h(t('index_status_4')) ?></span><strong><?= h(t('index_status_4_v')) ?></strong></li>
          </ul>
          <div class="updates-panel__foot"><span>UPDATED WITH THE COMMUNITY</span><a href="/pages/progress.php" aria-label="進捗状況を見る">↗</a></div>
        </div>
      </div>
      <div class="home-news"><div><p class="home-kicker">RECENT NEWS</p><h3><?= h(t('index_news_h3')) ?></h3></div><ul>
        <?php if (!empty($home_content['news'])): foreach ($home_content['news'] as $news): ?>
        <li><time><?= h($news['date'] ?? '') ?></time><span><?= h($news['text'] ?? '') ?></span></li>
        <?php endforeach; else: ?>
        <li><time datetime="2026-08-29">2026.08.29</time><span><?= h(t('news_3')) ?></span></li>
        <li><time datetime="2026-06-30">2026.06.30</time><span><?= h(t('news_2')) ?></span></li>
        <li><time datetime="2026-06-17">2026.06.17</time><span><?= h(t('news_1')) ?></span></li>
        <?php endif; ?>
      </ul></div>
    </section>

    <section class="home-join reveal" id="join" aria-labelledby="join-title">
      <img width="1280" height="720" src="/assets/gallery/903.webp" alt="ライブステージの背景となるツクヨミの建築" loading="lazy">
      <div class="home-join__veil"></div>
      <div class="home-join__content reveal-side reveal-side--left"><p class="home-kicker">YOUR NEXT ADVENTURE STARTS HERE</p><h2 id="join-title">この世界の続きを、<br><em>一緒につくろう。</em></h2><p><?= h(t('contact_discord_info')) ?> <a class="home-join__link" href="/pages/gameinfos/connect.php"><?= h(t('contact_discord_connect')) ?></a></p><a class="home-button home-button--light" href="/pages/contact.php"><?= h(t('contact_discord_link')) ?><span aria-hidden="true">↗</span></a></div>
      <span class="home-join__index">05 — 05 <i></i> JOIN THE PROJECT</span>
    </section>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
</body>
</html>
