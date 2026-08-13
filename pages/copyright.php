<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
$page_title_key = 'copyright_page_title';
$page_desc_key  = 'copyright_intro';
?>
<!DOCTYPE html>
<html lang="<?= current_lang() ?>" dir="<?= lang_dir() ?>">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
  <main>
      <section id="overview">
          <h2><?= h(t('copyright_heading')) ?></h2>
					<p><?= h(t('copyright_intro')) ?></p>
      </section>
			<section id="credits">
				<h3><?= h(t('copyright_site_content')) ?></h3>
					<p><?= h(t('copyright_site_content_info')) ?></p>

				<h3><?= h(t('copyright_minecraft')) ?></h3>
					<p><?= h(t('copyright_minecraft_info')) ?></p>

				<h3><?= h(t('copyright_external_license')) ?></h3>
					<p><?= h(t('copyright_external_license_info')) ?></p>
					<ul>
						<li><strong>BlueMap</strong> (MIT License) - <?= h(t('copyright_external_license_bluemap')) ?></li>
						<li><strong>Font Awesome Free</strong> (Icons: CC BY 4.0, Webfonts: SIL OFL 1.1, Code: MIT) - <?= h(t('copyright_external_license_font_awesome')) ?></li>
					</ul>
			</section>
			<section id="guideline-policy">
				<h3><?= h(t('copyright_guideline_policy')) ?></h3>
					<p><?= h(t('copyright_guideline_policy_info')) ?></p>
					<p><?= h(t('copyright_guideline_policy_link')) ?><i class="fa-solid fa-arrow-up-right-from-square" style="color: #6366f1;"></i></p>
			</section>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
  </body>
</html>
