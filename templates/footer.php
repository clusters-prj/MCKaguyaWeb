<?php
// 言語名は、その言語自身の表記で出す（英語話者でなくても自分の言語を見つけられるように）
$lang_names = [
    'ja'    => '日本語',
    'en'    => 'English',
    'es'    => 'Español',
    'fr'    => 'Français',
    'ko'    => '한국어',
    'zh-CN' => '简体中文',
    'zh-TW' => '繁體中文',
    'ar'    => 'العربية',
    'ru'    => 'Русский',
    'pt'    => 'Português',
];
?>
<footer>
  <div class="container">
    <div class="footer-content">
      <p><?= t('footer_copyright') ?></p>
      <p><a href="/pages/copyright.php"><?= h(t('footer_copyright_link')) ?></a></p>

      <!--
        JavaScript が無効でも言語を切り替えられるよう <form> で組んでいる。
        現在のクエリ文字列は hidden で引き継ぐので、?lang= 以外の
        パラメータが切替時に消えることはない。
      -->
      <form class="lang-switch" method="get" action="<?= h(current_path()) ?>">
        <?php
        $carry = [];
        parse_str((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_QUERY), $carry);
        unset($carry['lang']);
        foreach ($carry as $carry_key => $carry_value):
            if (!is_scalar($carry_value)) {
                continue;
            }
        ?>
        <input type="hidden" name="<?= h($carry_key) ?>" value="<?= h((string) $carry_value) ?>">
        <?php endforeach; ?>

        <label for="lang-select" class="sr-only"><?= h(t('lang_switch_label')) ?></label>
        <select id="lang-select" name="lang" onchange="this.form.submit()">
          <?php foreach (SUPPORTED_LANGS as $code): ?>
            <option value="<?= h($code) ?>" <?= $code === current_lang() ? 'selected' : '' ?>><?= h($lang_names[$code] ?? strtoupper($code)) ?></option>
          <?php endforeach; ?>
        </select>
        <noscript><button type="submit"><?= h(t('lang_switch_label')) ?></button></noscript>
      </form>
      <p><button id="theme-toggle" type="button"><?= h(t('nav_theme_toggle')) ?></button></p>
    </div>
  </div>
</footer>
