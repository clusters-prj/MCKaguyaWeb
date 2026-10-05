<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
$page_title_key = 'wra_page_title';
$page_desc_key  = 'wra_intro_1';
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
            <h2><?= h(t('wra_heading')) ?></h2>
            <p>
                <?= h(t('wra_intro_1')) ?><br>
                <?= h(t('wra_intro_2')) ?>
            </p>
        </section>

        <section id="features">
            <h2><?= h(t('wra_features_heading')) ?></h2>
            <p>
                <?= h(t('wra_features_intro')) ?>
            </p>
            <ul>
                <li><strong><?= h(t('wra_feature_1_title')) ?>：</strong> <?= h(t('wra_feature_1_body')) ?></li>
                <li><strong><?= h(t('wra_feature_2_title')) ?>：</strong> <?= h(t('wra_feature_2_body')) ?></li>
            </ul>
        </section>

        <section id="how-to-use">
            <h2>~ <?= h(t('wra_howto_heading')) ?> ~</h2>
            <ol>
                <li>
                    <strong><?= h(t('wra_step_1_title')) ?></strong>
                    <p>
                        <?= h(t('wra_step_1_body_1')) ?><br>
                        <?= h(t('wra_step_1_body_2_left')) ?> <strong><?= h(t('wra_step_1_body_2_right')) ?></strong><br>
                        <?= h(t('wra_step_1_body_3_left')) ?> <strong><?= h(t('wra_step_1_body_3_right')) ?></strong>
                    </p>
                </li>
                <li>
                    <strong><?= h(t('wra_step_2_title')) ?></strong>
                    <p>
                        <?= h(t('wra_step_2_body')) ?>
                    </p>
                </li>
                <li>
                    <strong><?= h(t('wra_step_3_title')) ?></strong>
                    <p>
                        <?= h(t('wra_step_3_body_1')) ?> <strong><?= h(t('wra_step_3_body_2')) ?></strong><?= h(t('wra_step_3_body_3')) ?><br>
                        <?= h(t('wra_step_3_body_4')) ?> <span style="color: #55ff55;"><?= h(t('wra_step_3_body_5')) ?></span><?= h(t('wra_step_3_body_6')) ?>
                    </p>
                </li>
            </ol>
        </section>

        <section id="notice" style="border-left: 4px solid #ff5555; padding-left: 15px; margin-top: 30px;">
            <h3 style="color: #ff5555;">⚠️ <?= h(t('wra_notice_heading')) ?></h3>
            <ul>
                <li>
                    <strong><?= h(t('wra_notice_1_title')) ?></strong><br>
                    <?= h(t('wra_notice_1_body_1')) ?>
                </li>
                <li>
                    <strong><?= h(t('wra_notice_2_title')) ?></strong><br>
                    <?= h(t('wra_notice_2_body')) ?>
                </li>
                <li>
                    <strong><?= h(t('wra_notice_3_title')) ?></strong><br>
                    <?= h(t('wra_notice_3_body')) ?>
                </li>
            </ul>
        </section>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
    </body>
</html>
