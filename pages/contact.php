<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
$page_title_key = 'contact_page_title';
$page_desc_key  = 'contact_intro';
?>
<!DOCTYPE html>
<html lang="<?= current_lang() ?>" dir="<?= lang_dir() ?>">
<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
    <style>
        .contact-container {
            max-width: 800px;
            margin: 0;
        }
        .contact-method {
            background: var(--card-bg);
            border-left: 5px solid var(--primary-color);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            color: var(--text-main);
        }
        .contact-method h3 {
            margin-top: 0;
            color: var(--primary-color);
        }
        .contact-link {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .contact-link:hover {
            background-color: var(--link-hover);
            transform: translateY(-1px);
        }
        .contact-method a:not(.contact-link) {
            color: var(--primary-color);
        }
        .contact-method iframe {
            max-width: 100%;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
    <main id="main-content" class="contact-container">
        <section id="contact-info">
            <h2><?= h(t('contact_heading')) ?></h2>
            <p><?= h(t('contact_intro')) ?></p>

            <div class="contact-method">
                <h3><?= h(t('contact_discord_title')) ?></h3>
                <p><?= h(t('contact_discord_info')) ?> <a href="/pages/gameinfos/connect.php"><?= h(t('contact_discord_connect')) ?></a></p>
                <p><a href="https://discord.gg/SAsYnPPrga" class="contact-link"><?= h(t('contact_discord_link')) ?></a></p>
                <section id="discord">
                <iframe src="https://discord.com/widget?id=1487438553888849983&amp;theme=dark"
                        title="<?= h(t('discord_widget_title')) ?>"
                        width="350" height="500" loading="lazy" frameborder="0"
                        sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                </section>
            </div>

            <div class="contact-method">
                <h3><?= h(t('contact_email_title')) ?></h3>
                <p><?= h(t('contact_email_info')) ?></p>
                <p><a href="mailto:milieus-74.arts@icloud.com" class="contact-link"><?= h(t('contact_email_link')) ?></a></p>
            </div>
        </section>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
  </body>
</html>
