<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php'; ?>
<!DOCTYPE html>
<html lang="<?= current_lang() ?>">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/style.css" id="main-style">
    <title>ゲーム内情報 - 超かぐや姫！再現プロジェクト</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
  <main>
      <section id="overview">
          <h2>ゲーム内情報</h2>
					<p>ゲーム内情報をまとめました。</p>
      </section>
			<section id="links">
				<h3>サーバーの参加方法</h3>
					<p>サーバーの参加方法です。</p>
					<p><a href="/pages/gameinfos/connect.shtml">こちらから</a></p>
					
				<h3>ゲーム内ツールの使い方</h3>
					<p>ホットバーで使えるツールやコマンド達です。</p>
					<p><a href="/pages/gameinfos/tools.shtml">こちらから</a></p>
					
				<h3>建築基準法</h3>
					<p><a href="/pages/gameinfos/build-manual.shtml">こちらから</a></p>

				<h3>保護のやり方(必須)</h3>
					<p><a href="/pages/gameinfos/wra.shtml">建築が終わったら必ず行うべきことです。</a></p>	

				<h3>ステータス</h3>
					<p>サーバーの運営状況を示しています。メンテナンス情報は作業中のみ表示されます。予告は<a href="https://discord.com/channels/1487438553888849983/1488080997135421510/1489956553149911080">Discord</a>をご覧ください。</p>
					<p><a href="https://uptime.clusters-prj.com/status/ms-k" target="_blank" rel="noopener noreferrer">専用サイトに飛びます<i class="fa-solid fa-arrow-up-right-from-square" style="color: #6366f1;"></i></a></p>

				<h3>ゲーム内地図</h3>
					<p>マップにはBluemapを使用しています。</p>
					<p><a href="https://map-town-kaguya.clusters-prj.com/" target="_blank" rel="noopener noreferrer">Townサーバー</p></a>
			</section>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
  </body>
</html>