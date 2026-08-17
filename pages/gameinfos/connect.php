<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
$page_title_key = 'connect_page_title';
$page_desc_key  = 'connect_intro';
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
            <h2><?= h(t('connect_heading')) ?></h2>
            <p><?= h(t('connect_intro')) ?></p>
        </section>

        <section id="java-edition">
            <h2><?= h(t('connect_java_heading')) ?></h2>
            
            <h3><?= h(t('connect_supported_devices')) ?></h3>
            <ul>
                <li><?= h(t('connect_java_device_windows')) ?></li>
                <li><?= h(t('connect_java_device_mac')) ?></li>
                <li><?= h(t('connect_java_device_linux')) ?></li>
            </ul>

            <h3><?= h(t('connect_supported_versions')) ?></h3>
            <p><?= t('connect_java_version_info') ?></p>
            
            <h3><?= h(t('connect_recommended_version')) ?></h3>
            <p><?= h(t('connect_java_recommended_version')) ?></p>
            <h3><?= h(t('connect_method_heading')) ?></h3>
            <ol>
                <li><?= h(t('connect_java_step_1')) ?></li>
                <li><?= h(t('connect_java_step_2')) ?><br>
                    <img src="/assets/howtoconnect/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2026-04-06_212320.png" alt="<?= h(t('connect_java_alt_launch')) ?>">
                </li>
                <li><?= h(t('connect_java_step_3')) ?><br>
                    <img src="/assets/howtoconnect/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2026-04-06_212356.png" alt="<?= h(t('connect_java_alt_multiplayer')) ?>">
                </li>
                <li><?= h(t('connect_java_step_4')) ?><br>
                    <img src="/assets/howtoconnect/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2026-04-06_212438.png" alt="<?= h(t('connect_java_alt_add_server')) ?>">
                </li>
                <li><?= h(t('connect_java_step_5')) ?><br>
                    <img src="/assets/howtoconnect/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2026-04-06_212451.png" alt="<?= h(t('connect_java_alt_add_screen')) ?>">
                </li>
                <li><?= t('connect_java_step_6') ?><br>
                    <img src="/assets/howtoconnect/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2026-04-06_212530.png" alt="<?= h(t('connect_java_alt_input_done')) ?>">
                </li>
                <li><?= h(t('connect_java_step_7')) ?><br>
                    <img src="/assets/howtoconnect/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2026-04-06_212607.png" alt="<?= h(t('connect_java_alt_added_list')) ?>">
                </li>
                <li><?= h(t('connect_java_step_8')) ?><br>
                    <img src="/assets/howtoconnect/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2026-04-06_212614.png" alt="<?= h(t('connect_java_alt_click')) ?>">
                </li>
                <li><?= h(t('connect_java_step_9')) ?><br>
                    <img src="/assets/howtoconnect/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2026-04-06_212627.png" alt="<?= h(t('connect_java_alt_waiting')) ?>">
                </li>
                <li><?= h(t('connect_java_step_10')) ?><br>
                    <img src="/assets/howtoconnect/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2026-04-06_212716.png" alt="<?= h(t('connect_java_alt_complete')) ?>">
                </li>
            </ol>
        </section>

        <section id="bedrock-edition">
            <h2><?= h(t('connect_bedrock_heading')) ?></h2>
            
            <h3><?= h(t('connect_supported_devices')) ?></h3>
            <ul>
                <li><?= h(t('connect_bedrock_device_windows')) ?></li>
                <li><?= h(t('connect_bedrock_device_chromeos')) ?></li>
                <li><?= h(t('connect_bedrock_device_android')) ?></li>
                <li><?= h(t('connect_bedrock_device_ios')) ?></li>
                <li><?= h(t('connect_bedrock_device_ipados')) ?></li>
                <li><?= h(t('connect_bedrock_device_fireos')) ?></li>
                <li><?= h(t('connect_bedrock_device_ps4')) ?></li>
                <li><?= h(t('connect_bedrock_device_ps5')) ?></li>
                <li><?= h(t('connect_bedrock_device_switch')) ?></li>
                <li><?= h(t('connect_bedrock_device_switch2')) ?></li>
                <li><?= h(t('connect_bedrock_device_xboxone')) ?></li>
                <li><?= h(t('connect_bedrock_device_xboxseries')) ?></li>
            </ul>

            <h3><?= h(t('connect_supported_versions')) ?></h3>
            <p><?= t('connect_bedrock_version_info') ?></p> 

            <h3><?= h(t('connect_method_heading')) ?></h3>
            <h4><?= h(t('connect_bedrock_platform_heading')) ?></h4>
            <p>
                <strong><?= h(t('connect_bedrock_notice_strong')) ?></strong><br>
                <?= h(t('connect_bedrock_notice_line1')) ?><br>
                <?= h(t('connect_bedrock_notice_line2')) ?>
            </p>
            <ol>
                <li><?= h(t('connect_bedrock_step_1')) ?></li>
                <li><?= h(t('connect_bedrock_step_2')) ?><br>
                    <img src="/assets/howtoconnect/2910.png" alt="<?= h(t('connect_bedrock_alt_launcher')) ?>">
                </li>
                <li><?= h(t('connect_bedrock_step_3')) ?><br>
                    <img src="/assets/howtoconnect/2933.png" alt="<?= h(t('connect_bedrock_alt_play')) ?>">
                </li>
                <li><?= h(t('connect_bedrock_step_4')) ?><br>
                    <img src="/assets/howtoconnect/2942.png" alt="<?= h(t('connect_bedrock_alt_server_tab')) ?>">
                </li>
                <li><?= h(t('connect_bedrock_step_5')) ?><br>
                    <img src="/assets/howtoconnect/2949.png" alt="<?= h(t('connect_bedrock_alt_add_server')) ?>">
                </li>
                <li><?= t('connect_bedrock_step_6') ?><br>
                    <img src="/assets/howtoconnect/3115.png" alt="<?= h(t('connect_bedrock_alt_info_input')) ?>">
                </li>
                <li><?= h(t('connect_bedrock_step_7')) ?><br>
                    <img src="/assets/howtoconnect/3138.png" alt="<?= h(t('connect_bedrock_alt_confirm')) ?>">
                </li>
                <li><?= h(t('connect_bedrock_step_8')) ?><br>
                    <img src="/assets/howtoconnect/3156.png" alt="<?= h(t('connect_bedrock_alt_press_play')) ?>">
                </li>
                <li><?= h(t('connect_bedrock_step_9')) ?><br>
                    <img src="/assets/howtoconnect/3224.png" alt="<?= h(t('connect_bedrock_alt_waiting')) ?>">
                </li>
                <li><?= h(t('connect_bedrock_step_10')) ?><br>
                    <img src="/assets/howtoconnect/3251.png" alt="<?= h(t('connect_bedrock_alt_complete')) ?>">
                </li>
            </ol>

            <h4><?= h(t('connect_bedrock_console_heading')) ?></h4>
            <p><?= h(t('connect_bedrock_console_intro')) ?><br><a href="https://kuwa.app/tool/hjs/" target="_blank">https://kuwa.app/tool/hjs</a></p>
            <p><?= h(t('connect_bedrock_console_alt_intro')) ?><br><a href="https://app.notion.com/p/https-kuwa-app-tool-hjs-33b855055632805886c8da3a20bb6a4f?pvs=21" target="_blank">https://kuwa.app/tool/hjs/のコピー</a></p>
        </section>

        <section id="troubleshooting">
            <h2><?= h(t('connect_troubleshooting_heading')) ?></h2>
            
            <h3><?= h(t('connect_troubleshooting_not_working')) ?></h3>
            <img src="/assets/howtoconnect/image.webp" alt="<?= h(t('connect_troubleshooting_image_alt')) ?>" style="max-width: 100%; height: auto;">
            <ul>
                <li><?= h(t('connect_troubleshooting_not_working_1')) ?></li>
                <li><?= h(t('connect_troubleshooting_not_working_2')) ?></li>
                <li><?= h(t('connect_troubleshooting_not_working_3')) ?></li>
                <li><?= h(t('connect_troubleshooting_not_working_4')) ?></li>
            </ul>

            <h3><?= h(t('connect_troubleshooting_lag')) ?></h3>
            <ul>
                <li><?= h(t('connect_troubleshooting_lag_1')) ?></li>
                <li><?= h(t('connect_troubleshooting_lag_2')) ?></li>
            </ul>
        </section>
    </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
    </body>
</html>
