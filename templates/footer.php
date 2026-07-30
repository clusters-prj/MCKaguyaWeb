<footer>
  <div class="container">
    <div class="footer-content">
      <p><?= t('footer_copyright') ?></p>
      <p><a href="/pages/copyright.php"><?= h(t('footer_copyright_link')) ?></a></p>

      <p><button id="theme-toggle"><?= h(t('nav_theme_toggle')) ?></button></p>
      <p class="lang-switch">
        <label for="lang-select" class="sr-only"><?= h(t('lang_switch_label')) ?></label>
        <select id="lang-select" onchange="location.href='?lang='+this.value">
          <?php foreach (SUPPORTED_LANGS as $code): ?>
            <option value="<?= $code ?>" <?= $code === current_lang() ? 'selected' : '' ?>><?= strtoupper($code) ?></option>
          <?php endforeach; ?>
        </select>
      </p>
    </div>
  </div>
</footer>
