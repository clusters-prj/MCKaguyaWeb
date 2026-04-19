<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
  </head>
  <body>
    <!--#include virtual="../templates/header.html" -->
    <main>
        <section id="credits-intro">
            <h2>協力者一覧 / Credits</h2>
            <p>
                「超かぐや姫」再現プロジェクトは、多くの有志メンバーの協力によって支えられています。
                現在、総勢約168名の皆様と共にワールド構築を進めています。
            </p>
        </section>

        <section id="core-staff">
            <h3>運営・開発</h3>
            <table>
                <thead>
                    <tr>
                        <th>担当区分</th>
                        <th>メンバー名</th>
                        <th>主な役割</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>主催</strong></td>
                        <td>やちおに氏</td>
                        <td>インフラ構築・全体指揮</td>
                    </tr>
                    <tr>
                        <td><strong>建築リーダー</strong></td>
                        <td>建築担当者A氏</td>
                        <td>ワールド地形・建築物の設計・監修</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section id="contributors">
            <h3>プロジェクト・コントリビューター</h3>
            <p>建築、回路、プラグイン設定、テストプレイ等でご協力いただいた皆様です（五十音順・敬称略）。</p>
            
            <ul style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px; list-style: none; padding: 0;">
                <?php
                $f = fopen("../data/members.csv", "r");
                echo '<ul class="member-grid">';
                while (($line = fgetcsv($f)) !== FALSE) {
                    // line[0]が名前、line[1]が役割
                    echo "<li><strong>" . htmlspecialchars($line[0]) . "</strong> (" . htmlspecialchars($line[1]) . ")</li>";
                }
                echo '</ul>';
                fclose($f);
                ?>
            </ul>
        </section>

        <section id="special-thanks">
            <h3>スペシャルサンクス</h3>
            <ul>
                <li>「超かぐや姫！」制作関係者の皆様</li>
                <li>自宅サーバー・インフラ運用の先人達</li>
            </ul>
        </section>
    </main>
  </body>
</html>