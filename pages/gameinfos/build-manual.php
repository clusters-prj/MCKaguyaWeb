<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
$page_title_key = 'build_manual_page_title';
$page_desc_key  = 'build_manual_intro';
?>
<!DOCTYPE html>
<html lang="<?= current_lang() ?>" dir="<?= lang_dir() ?>">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
  <main id="main-content">
      <section id="overview">
          <h2><?= h(t('build_manual_heading')) ?></h2>
          <p><?= h(t('build_manual_intro')) ?></p>
      </section>

      <section id="rules">
          <h3><?= h(t('build_manual_rule_1_title')) ?></h3>
          <p>1. <?= h(t('build_manual_rule_1_1')) ?></p>
          <p>2. <?= h(t('build_manual_rule_1_2')) ?></p>

          <h3><?= h(t('build_manual_rule_2_title')) ?></h3>
          <p>1. <?= h(t('build_manual_rule_2_1')) ?></p>
          <p>2. <?= h(t('build_manual_rule_2_2')) ?></p>

          <h3><?= h(t('build_manual_rule_3_title')) ?></h3>
          <p>1. <?= h(t('build_manual_rule_3_1')) ?></p>
          <p>2. <?= h(t('build_manual_rule_3_2')) ?></p>
          
          <h3><?= h(t('build_manual_rule_4_title')) ?></h3>
          <p>1. <?= h(t('build_manual_rule_4_1_before_link')) ?> <a href="/pages/gameinfos/wra.php"><?= h(t('build_manual_rule_4_link_text')) ?></a> <?= h(t('build_manual_rule_4_1_after_link')) ?></p>
          <p>2. <?= h(t('build_manual_rule_4_2')) ?></p>

          <h3><?= h(t('build_manual_rule_5_title')) ?></h3>
          <p>1. <?= h(t('build_manual_rule_5_1')) ?></p>
          <p>2. <?= h(t('build_manual_rule_5_2')) ?></p>
      </section>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
  </body>
</html>
