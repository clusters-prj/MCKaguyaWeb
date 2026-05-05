<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>協力者一覧 | 「超かぐや姫」再現プロジェクト</title>
    <style>
        /* 検索エリアの簡易スタイル */
        .filter-container {
            background: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }
        .filter-container input, .filter-container select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .member-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            list-style: none;
            padding: 0;
        }
        .member-item {
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 5px;
            background: #fff;
            transition: transform 0.2s;
        }
        .member-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .role-label {
            display: block;
            font-size: 0.85em;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <!--#include virtual="../templates/header.html" -->
    <main>
        <section id="credits-intro">
            <h2>協力者一覧 / Credits</h2>
            <p>
                「超かぐや姫」再現プロジェクトは、多くの有志メンバーの協力によって支えられています。<br>
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

            <!-- 検索・絞り込みフォーム -->
            <div class="filter-container">
                <input type="text" id="memberSearch" placeholder="名前で検索...">
                <select id="roleFilter">
                    <option value="">すべての役割</option>
                    <option value="建築">建築</option>
                    <option value="回路">回路</option>
                    <option value="プラグイン設定">プラグイン設定</option>
                    <option value="テストプレイ">テストプレイ</option>
                    <option value="応援">応援</option>
                </select>
                <span id="hitCount" style="font-size: 0.9em; color: #888;"></span>
            </div>

            <ul id="memberList" class="member-grid">
                <?php
                $csvPath = "../data/members.csv";
                
                if (file_exists($csvPath)) {
                    // ファイルの中身を丸ごと読み込む
                    $buffer = file_get_contents($csvPath);
                    
                    // 文字コードを UTF-8 に変換（SJIS-win, UTF-8 の順で自動判別）
                    $buffer = mb_convert_encoding($buffer, 'UTF-8', 'SJIS-win, UTF-8');
                    
                    // 一時的なストリーム（メモリ上）に書き込んで fgetcsv で扱えるようにする
                    $fp = tmpfile();
                    fwrite($fp, $buffer);
                    rewind($fp);
                
                    // ヘッダー行（1行目）をスキップ
                    fgetcsv($fp);
                
                    while (($line = fgetcsv($fp)) !== FALSE) {
                        if (empty($line[0])) continue;
                
                        $name = htmlspecialchars(trim($line[0]));
                        $link = !empty($line[1]) ? htmlspecialchars(trim($line[1])) : "";
                        
                        // 3列目以降をすべて「役割」として取得
                        $rolesArray = array_filter(array_map('trim', array_slice($line, 2)));
                        $rolesStr = htmlspecialchars(implode(", ", $rolesArray));
                        
                        // JS絞り込み用のデータ
                        $dataRoles = htmlspecialchars(implode("|", $rolesArray));
                
                        echo "<li class='member-item' data-name='{$name}' data-roles='{$dataRoles}'>";
                        
                        if ($link) {
                            echo "<strong><a href='{$link}' target='_blank' rel='noopener'>{$name}</a></strong>";
                        } else {
                            echo "<strong>{$name}</strong>";
                        }
                        
                        echo "<span class='role-label'>({$rolesStr})</span>";
                        echo "</li>";
                    }
                    fclose($fp);
                } else {
                    echo "<li>メンバーリストを読み込めませんでした。</li>";
                }
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('memberSearch');
        const roleFilter = document.getElementById('roleFilter');
        const memberList = document.getElementById('memberList');
        const memberItems = document.querySelectorAll('.member-item');
        const hitCount = document.getElementById('hitCount');

        function filterMembers() {
            const searchText = searchInput.value.toLowerCase();
            const selectedRole = roleFilter.value;
            let visibleCount = 0;

            memberItems.forEach(item => {
                const name = item.getAttribute('data-name').toLowerCase();
                const roles = item.getAttribute('data-roles').split('|');
                
                const matchesSearch = name.includes(searchText);
                const matchesRole = (selectedRole === "") || roles.some(r => r.includes(selectedRole));

                if (matchesSearch && matchesRole) {
                    item.style.display = "";
                    visibleCount++;
                } else {
                    item.style.display = "none";
                }
            });

            hitCount.textContent = `表示中: ${visibleCount}名`;
        }

        searchInput.addEventListener('input', filterMembers);
        roleFilter.addEventListener('change', filterMembers);
        
        // 初回カウント表示
        filterMembers();
    });
    </script>
</body>
</html>
