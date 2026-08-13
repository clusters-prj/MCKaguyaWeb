<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
$page_title_key = 'gameinfo_page_title';
$page_desc_key  = 'gameinfo_intro';
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
          <h2><?= h(t('gameinfo_heading')) ?></h2>
					<p><?= h(t('gameinfo_intro')) ?></p>
      </section>
			<section id="links">
				<h3><?= h(t('gameinfo_connect_title')) ?></h3>
					<p><?= h(t('gameinfo_connect_info')) ?></p>
					<p><a href="/pages/gameinfos/connect.php"><?= h(t('gameinfo_connect_link')) ?></a></p>
					
				<h3><?= h(t('gameinfo_tools_title')) ?></h3>
					<p><?= h(t('gameinfo_tools_info')) ?></p>
					<p><a href="/pages/gameinfos/tools.php"><?= h(t('gameinfo_tools_link')) ?></a></p>
					
				<h3><?= h(t('gameinfo_build_manual_title')) ?></h3>
					<p><a href="/pages/gameinfos/build-manual.php"><?= h(t('gameinfo_build_manual_link')) ?></a></p>

				<h3><?= h(t('gameinfo_wra_title')) ?></h3>
					<p><?= h(t('gameinfo_wra_info')) ?></p>
					<p><a href="/pages/gameinfos/wra.php"><?= h(t('gameinfo_wra_link')) ?></a></p>

				<h3><?= h(t('gameinfo_status_title')) ?></h3>
					<p><?= t('gameinfo_status_info') ?></p>
					<p><a href="https://uptime.clusters-prj.com/status/ms-k" target="_blank" rel="noopener noreferrer"> <?= t('gameinfo_status_link') ?></a></p>

				<h3><?= h(t('gameinfo_map_title')) ?></h3>
					<p><?= h(t('gameinfo_map_info')) ?></p>
					<p><a href="https://map-town-kaguya.clusters-prj.com/" target="_blank" rel="noopener noreferrer"><?= h(t('gameinfo_map_town_link')) ?></a></p>
			</section>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
  </body>
</html>