<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/style.css" id="main-style">
    <title>サーバー構成 - 超かぐや姫！再現プロジェクト</title>
    <style>
        .system-card {
            background: #f9f9f9;
            border-left: 5px solid #4caf50;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .system-card h3 {
            margin-top: 0;
            color: #333;
        }
        .tech-tag {
            display: inline-block;
            background: #e0e0e0;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.9em;
            margin-right: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <!--#include virtual="/templates/header.html" -->
    <main>
        <section id="system-overview">
            <h2>サーバーシステム構成</h2>
            <p>本プロジェクトを支えるインフラおよびソフトウェアの構成詳細です。</p>

            <div class="system-card">
                <h3>インフラストラクチャ</h3>
                <p>安定した動作と柔軟な管理のため、仮想化環境を採用しています。</p>
                <span class="tech-tag">Proxmox VE</span>
                <span class="tech-tag">Ubuntu Server</span>
                <span class="tech-tag">自宅サーバー</span>
            </div>

            <div class="system-card">
                <h3>ネットワーク・プロキシ</h3>
                <p>Velocityをフロントエンドに配置し、複数のバックエンドサーバーを統合しています。</p>
                <span class="tech-tag">Velocity (Proxy)</span>
                <span class="tech-tag">Paper (Backend)</span>
                <span class="tech-tag">MariaDB (Database)</span>
            </div>

            <div class="system-card">
                <h3>主要プラグイン構成</h3>
                <p>「超かぐや姫！」の世界を再現するための基幹システムです。</p>
                <ul>
                    <li><strong>LuckPerms:</strong> 高度な権限管理システム</li>
                    <li><strong>MythicMobs:</strong> ボスや特殊Mobの挙動制御</li>
                    <li><strong>ModelEngine:</strong> 独自3Dモデルのレンダリング</li>
                    <li><strong>WorldGuard/Edit:</strong> 地形保護および大規模造形</li>
                </ul>
            </div>

            <div class="system-card">
                <h3>Web・配信システム</h3>
                <p>進捗公開および管理用Webサーバーの構成です。</p>
                <span class="tech-tag">Apache2</span>
                <span class="tech-tag">PHP 8.x</span>
                <span class="tech-tag">SSI (Server Side Includes)</span>
            </div>
        </section>

        <section id="spec">
            <h3>ハードウェアスペック</h3>
            <table>
                <tr><th>CPU</th><td>Intel Core i7 相当 (仮想割り当て)</td></tr>
                <tr><th>RAM</th><td>4+4GB DDR4</td></tr>
                <tr><th>Storage</th><td>HDD/NVMe SSD</td></tr>
                <tr><th>OS</th><td>Linux (Ubuntu based)</td></tr>
            </table>
        </section>
    </main>
    <!--#include virtual="/templates/footer.html" -->
  </body>
</html>
