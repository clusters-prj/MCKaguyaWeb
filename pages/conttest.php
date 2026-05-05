<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>協力者一覧 | 「超かぐや姫」再現プロジェクト</title>
    <style>
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

        <!-- 1. 運営・開発の固定表 -->
        <section id="core-staff">
            <h3>運営・開発</h3>
            <table border="1" style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                <thead>
                    <tr style="background: #eee;">
                        <th style="padding: 10px;">担当区分</th>
                        <th style="padding: 10px;">メンバー名</th>
                        <th style="padding: 10px;">主な役割</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 10px;"><strong>主催</strong></td>
                        <td style="padding: 10px;">やちおに氏</td>
                        <td style="padding: 10px;">インフラ構築・全体指揮</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;"><strong>建築リーダー</strong></td>
                        <td style="padding: 10px;">建築担当者A氏</td>
                        <td style="padding: 10px;">ワールド地形・建築物の設計・監修</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- 2. CSVから読み込むコントリビューター一覧 -->
        <section id="contributors">
            <h3>プロジェクト・コントリビューター</h3>
            <p>建築、回路、プラグイン設定、テストプレイ等でご協力いただいた皆様です。</p>

            <div class="filter-container">
                <input type="text" id="memberSearch" placeholder="名前で検索...">
                <select id="roleFilter">
                    <option value="">すべての役割</option>
                    <option value="建築">建築</option>
                    <option value="回路">回路</option>
                    <option value="テストプレイ">テストプレイ</option>
                    <option value="応援">応援</option>
                </select>
                <span id="hitCount"></span>
            </div>

            <ul id="memberList" class="member-grid">
                <?php
                $csvPath = "../data/members.csv";
                if (file_exists($csvPath)) {
                    // SplFileObject を使うと文字化けに強くなるため採用
                    $file = new SplFileObject($csvPath);
                    $file->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);

                    $isFirstRow = true;
                    foreach ($file as $line) {
                        // ヘッダー（1行目）をスキップ
                        if ($isFirstRow) {
                            $isFirstRow = false;
                            continue;
                        }

                        // 各項目の文字コードを UTF-8 に変換
                        $line = array_map(function($value) {
                            return mb_convert_encoding($value, 'UTF-8', 'SJIS-win, UTF-8');
                        }, $line);

                        if (empty($line[0])) continue;

                        $name = htmlspecialchars(trim($line[0]));
                        $link = !empty($line[1]) ? htmlspecialchars(trim($line[1])) : "";
                        $rolesArray = array_filter(array_map('trim', array_slice($line, 2)));
                        $rolesStr = htmlspecialchars(implode(", ", $rolesArray));
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
                } else {
                    echo "<li>CSVファイルが見つかりません: " . htmlspecialchars($csvPath) . "</li>";
                }
                ?>
            </ul>
        </section>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('memberSearch');
        const roleFilter = document.getElementById('roleFilter');
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
        filterMembers();
    });
    </script>
</body>
</html>
