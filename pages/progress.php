<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
$page_title_key = 'progress_page_title';
$page_desc_key  = 'progress_intro';
?>
<!DOCTYPE html>
<html lang="<?= current_lang() ?>" dir="<?= lang_dir() ?>">
<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
    <style>
        .progress-container {
            margin-bottom: 20px;
        }
        .progress-bar-bg {
            background-color: #e0e0e0;
            border-radius: 8px;
            height: 20px;
            width: 100%;
            overflow: hidden;
        }
        .progress-bar-fill {
            background-color: #4caf50;
            height: 100%;
            text-align: center;
            color: white;
            font-size: 12px;
            line-height: 20px;
        }
    </style>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
    <main>
        <section id="progress-detail">
            <h2><?= h(t('progress_heading')) ?></h2>
            <p><?= h(t('progress_intro')) ?></p>

            <div class="progress-container">
                <h4><?= h(t('progress_water_stage')) ?></h4>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: 90%;"><?= h(t('progress_water_stage_status')) ?></div>
                </div>
                <p><?= h(t('progress_water_stage_detail')) ?></p>

                <h4><?= h(t('progress_tsukuyomi_town')) ?></h4>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: 40%;"><?= h(t('progress_tsukuyomi_town_status')) ?></div>
                </div>
                <p><?= h(t('progress_tsukuyomi_town_detail')) ?></p>
            </div>
        </section>

        <section id="history">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/history.php'; ?>
        </section>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
  </body>
</html>

