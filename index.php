<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';
$page_title_key = 'site_title';
$page_desc_key  = 'site_description';
?>
<!DOCTYPE html>
<html lang="<?= current_lang() ?>" dir="<?= lang_dir() ?>">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
  <main id="main-content">
      <section id="project-overview">
          <h2><?= h(t('index_h2')) ?></h2>
					<picture>
					  <source srcset="/assets/header_night.JPG" media="(prefers-color-scheme: dark)">
					  <img src="/assets/header_light.JPG" alt="<?= h(t('index_header_alt')) ?>" class="header-img">
					</picture>
          <p>
              <?= h(t('index_intro')) ?>
          </p>
      </section>

      <section id="status">
          <h3><?= h(t('index_status_h3')) ?></h3>
          <ul>
              <li><strong><?= h(t('index_status_1')) ?></strong> <?= h(t('index_status_1_v')) ?></li>
              <li><strong><?= h(t('index_status_2')) ?></strong> <?= h(t('index_status_2_v')) ?></li>
              <li><strong><?= h(t('index_status_3')) ?></strong> <?= h(t('index_status_3_v')) ?></li>
              <li><strong><?= h(t('index_status_4')) ?></strong> <?= h(t('index_status_4_v')) ?></li>
          </ul>
      </section>

      <section id="osirase">
          <h3><?= h(t('index_news_h3')) ?></h3>
          <table>
              <thead>
                  <tr>
                      <th><?= h(t('index_news_date')) ?></th>
                      <th><?= h(t('index_news_content')) ?></th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>2026<?= current_lang() === 'ja' ? '年8月29日' : '-08-29' ?></td>
                      <td>統合版26.45に対応しました</td>
                  </tr>
                  <tr>
                      <td>2026<?= current_lang() === 'ja' ? '年6月30日' : '-06-30' ?></td>
                      <td><?= h(t('news_3')) ?></td>
                  </tr>
                  <tr>
                      <td>2026<?= current_lang() === 'ja' ? '年6月17日' : '-06-17' ?></td>
                      <td><?= h(t('news_2')) ?></td>
                  </tr>
                  <tr>
                      <td>2026<?= current_lang() === 'ja' ? '年6月4日' : '-06-04' ?></td>
                      <td><?= t('news_1') ?></td>
                  </tr>
              </tbody>
          </table>
      </section>



        <section id="members">
            <h3><?= h(t('index_members_h3')) ?></h3>
            <ul>
                <li><strong><?= h(t('index_members_host')) ?></strong> Yationi</li>
            </ul>
            <p><a href="/pages/cont.php"><?= h(t('index_members_more')) ?></a></p>
        </section>

        <section id="history">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/history.php'; ?>
        </section>

        <section id="systeminfo">
            <h3><?= h(t('systeminfo_h3')) ?></h3>
            <p><a href="/pages/system.php"> <?= h(t('systeminfo_link')) ?></a></p>
        </section>

        <section id="discord">
		    <iframe src="https://discord.com/widget?id=1487438553888849983&amp;theme=dark"
                        title="<?= h(t('discord_widget_title')) ?>"
                        width="350" height="500" loading="lazy" frameborder="0"
                        sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
		</section>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
  </body>
</html>