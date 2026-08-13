<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
$page_title_key = 'tools_page_title';
$page_desc_key  = 'tools_intro_1';
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
            <h2><?= h(t('tools_heading')) ?></h2>
            <p><?= h(t('tools_intro_1')) ?><br><?= h(t('tools_intro_2')) ?></p>
        </section>

        <section id="tool-list">
            <h2><?= h(t('tools_list_heading')) ?></h2>
            <ul>
                <li>
                    <a href="#DoubleHot"><?= h(t('tools_doublehot_title')) ?></a>
                </li>
            </ul>
            <section id="hotbars">
                <h3><?= h(t('tools_hotbars_heading')) ?></h3>
                <ul>
                    <li>
                        <a href="#ServerMove"><?= h(t('tools_servermove_title')) ?></a>
                    </li>
                    <li>
                        <a href="#FlySpeed"><?= h(t('tools_flyspeed_title')) ?></a>
                    </li>
                    <li>
                        <a href="#TP-Portal"><?= h(t('tools_tp_portal_title')) ?></a>
                    </li>
                    <li>
                        <a href="#Bookmark-Manager"><?= h(t('tools_bookmark_title')) ?></a>
                    </li>
                    <li>
                        <a href="#Nightvision"><?= h(t('tools_nightvision_title')) ?></a>
                    </li>
                </ul>
            </section>
        </section>
        <section id="DoubleHot">
            <h3><?= h(t('tools_doublehot_title')) ?></h3>
            <p>
                <?= h(t('tools_doublehot_intro')) ?>
            </p>
            <h4>~<?= h(t('tools_doublehot_usage_heading')) ?>~</h4>
            <p>
                <?= h(t('tools_doublehot_usage_1')) ?><br>
                <?= h(t('tools_doublehot_usage_2')) ?><br>
                <?= h(t('tools_doublehot_usage_3')) ?><br>
                <a href="#hotbars"><?= h(t('tools_doublehot_usage_4_link')) ?></a><?= h(t('tools_doublehot_usage_4_after')) ?>
            </p>
        </section>
        <section id="ServerMove">
            <h3><?= h(t('tools_servermove_title')) ?></h3>
            <p>
                <?= h(t('tools_servermove_intro')) ?>
            </p>
            <h4>~<?= h(t('tools_usage_heading')) ?>~</h4>
            <p>
                <a href="#DoubleHot"><?= h(t('tools_doublehot_title')) ?></a> <?= h(t('tools_usage_1')) ?>
            </p>
        </section>
        <section id="FlySpeed">
            <h3><?= h(t('tools_flyspeed_title')) ?></h3>
            <p>
                <?= h(t('tools_flyspeed_intro')) ?>
            </p>
            <h4>~<?= h(t('tools_usage_heading')) ?>~</h4>
            <p>
                <a href="#DoubleHot"><?= h(t('tools_doublehot_title')) ?></a> <?= h(t('tools_usage_2')) ?>
            </p>
        </section>

        <section id="TP-Portal">
            <h3><?= h(t('tools_tp_portal_title')) ?></h3>
            <p>
                <?= h(t('tools_tp_portal_intro_1')) ?><br>
                <?= h(t('tools_tp_portal_intro_2_before')) ?><a href="#Bookmark-Manager"><?= h(t('tools_tp_portal_intro_2_link')) ?></a><?= h(t('tools_tp_portal_intro_2_after')) ?>
            </p>
            <h4>~<?= h(t('tools_usage_heading')) ?>~</h4>
            <p>
                <a href="#DoubleHot"><?= h(t('tools_doublehot_title')) ?></a> <?= h(t('tools_usage_3')) ?>
            </p>
        </section>

        <section id="Bookmark-Manager">
            <h3><?= h(t('tools_bookmark_title')) ?></h3>
            <p>
                <?= h(t('tools_bookmark_intro')) ?>
            </p>
            <h4>~<?= h(t('tools_usage_heading')) ?>~</h4>
            <p>
                <a href="#DoubleHot"><?= h(t('tools_doublehot_title')) ?></a> <?= h(t('tools_usage_4')) ?>
            </p>
        </section>

        <section id="Nightvision">
            <h3><?= h(t('tools_nightvision_title')) ?></h3>
            <p>
                <?= h(t('tools_nightvision_intro')) ?>
            </p>
            <h4>~<?= h(t('tools_usage_heading')) ?>~</h4>
            <p>
                <a href="#DoubleHot"><?= h(t('tools_doublehot_title')) ?></a> <?= h(t('tools_usage_5')) ?>
            </p>
        </section>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
    </body>
</html>