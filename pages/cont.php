<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/includes/i18n.php";
$page_title_key = 'cont_page_title';
$page_desc_key  = 'cont_intro_1';
?>
<!DOCTYPE html>
<html lang="<?= current_lang() ?>" dir="<?= lang_dir() ?>">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
    <style>
        :root {
            --indigo-primary: var(--primary-color, #4f46e5);
            --indigo-light: rgba(79, 70, 229, 0.12);
            --indigo-dark: var(--text-main, #312e81);
            --text-primary: var(--text-main, #1f2937);
            --text-secondary: var(--text-muted, #6b7280);
            --border-color: var(--border-color, #e5e7eb);
        }

        #member-controls {
            margin: 2rem 0;
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--indigo-light) 0%, color-mix(in srgb, var(--card-bg) 70%, var(--indigo-light) 30%) 100%);
            border-radius: 12px;
            border-left: 4px solid var(--indigo-primary);
            color: var(--text-primary);
        }

        .search-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 1;
            min-width: 200px;
            padding: 0.75rem 1rem;
            border: 2px solid var(--indigo-primary);
            border-radius: 8px;
            font-family: 'Kiwi Maru', serif;
            font-size: 1rem;
            background: var(--card-bg);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            transform: translateY(-2px);
        }

        .filter-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: 2px solid var(--indigo-primary);
            background: var(--card-bg);
            color: var(--indigo-primary);
            border-radius: 20px;
            cursor: pointer;
            font-family: 'Kiwi Maru', serif;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            background: var(--indigo-primary);
            color: white;
            transform: translateY(-2px);
        }

        .filter-btn.active {
            background: var(--indigo-primary);
            color: white;
        }

        .member-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }

        .member-card {
            padding: 1.5rem;
            border: 2px solid var(--indigo-primary);
            border-radius: 12px;
            background: var(--card-bg);
            color: var(--text-primary);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .member-card:hover {
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.15);
            transform: translateY(-4px);
        }

        .member-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--indigo-dark);
        }

        .member-name a {
            color: var(--indigo-primary);
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .member-name a:hover {
            border-bottom-color: var(--indigo-primary);
        }

        .member-role {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .member-role-tag {
            display: inline-block;
            background: var(--indigo-light);
            color: var(--indigo-primary);
            padding: 0.25rem 0.75rem;
            border-radius: 16px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            border: 1px solid color-mix(in srgb, var(--indigo-primary) 20%, transparent);
        }

        .member-social {
            margin-top: 0.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .member-social a {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: var(--indigo-light);
            color: var(--indigo-primary);
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid color-mix(in srgb, var(--indigo-primary) 20%, transparent);
        }

        .member-social a:hover {
            background: var(--indigo-primary);
            color: white;
            transform: translateX(4px);
        }

        .member-count {
            text-align: center;
            margin: 2rem 0 1rem 0;
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .no-results {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .no-results-emoji {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .search-container {
            flex-direction: column;
            }

            .search-input {
            min-width: 100%;
            }

            .member-grid {
            grid-template-columns: 1fr;
            }

            .filter-buttons {
            width: 100%;
            }
        }

        /* 簡体字中国語（zh-CN）用のフォント指定 */
        :lang(zh-CN) {
        font-family:
            "PingFang SC",        /* macOS / iOS */
            "Hiragino Sans GB",   /* macOS（旧バージョン向け） */
            "Microsoft YaHei",    /* Windows */
            "Noto Sans SC",       /* Webフォント / Androidなど */
            sans-serif;
        }
    </style>
  </head>
  <body>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/templates/header.php"; ?>
    <main>
        <section id="credits-intro">
            <h2>協力者一覧 / Credits</h2>
            <p>
                <?= h(t("cont_intro_1")) ?><br>
                <?= h(t("cont_intro_2")) ?>
            </p>
        </section>

        <section id="core-staff">
            <h3><?= h(t("cont_core_staff")) ?></h3>
            <table>
                <thead>
                    <tr>
                        <th><?= h(t("cont_core_section")) ?></th>
                        <th><?= h(t("cont_core_name")) ?></th>
                        <th><?= h(t("cont_core_role")) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong><?= h(t("cont_core_body_1_1")) ?></strong></td>
                        <td><?= h(t("cont_core_body_1_2")) ?></td>
                        <td><?= h(t("cont_core_body_1_3")) ?></td>
                    </tr>
                    <tr>
                        <td><strong><?= h(t("cont_core_body_2_1")) ?></strong></td>
                        <td><?= h(t("cont_core_body_2_2")) ?></td>
                        <td><?= h(t("cont_core_body_2_3")) ?></td>
                    </tr>
                    <tr>
                        <td><strong><?= h(t("cont_core_body_3_1")) ?></strong></td>
                        <td><?= h(t("cont_core_body_3_2")) ?></td>
                        <td><?= h(t("cont_core_body_3_3")) ?></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section id="contributors">
            <h3><?= h(t("cont_contributors")) ?></h3>
            <p><?= h(t("cont_contributors_intro")) ?></p>
            <p><?= h(t("cont_contributors_note")) ?></p>

            <!-- 検索・フィルター機能 -->
            <div id="member-controls">
                <div class="search-container">
                    <input 
                        type="text" 
                        id="search-input" 
                        class="search-input" 
                        placeholder="<?= h(t("cont_search_placeholder")) ?>"
                        autocomplete="off"
                    >
                </div>
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">全て表示</button>
                    <?php
                    // CSVから役割を取得してフィルターボタンを動的生成
                    $roles = [];
                    $f = fopen("../data/members.csv", "r");
                    $header = fgetcsv($f);
                    while (($line = fgetcsv($f)) !== false) {
                        if (!empty($line[2])) {
                            // 複数の役割がカンマ(、または,)で区切られている場合に対応
                            $role_string = $line[2];
                            // 全角カンマと半角カンマの両方に対応
                            $role_string = str_replace(",", "、", $role_string);
                            $role_list = explode("、", $role_string);

                            foreach ($role_list as $role) {
                                $role = trim($role);
                                if (!empty($role)) {
                                    $roles[$role] = true;
                                }
                            }
                        }
                    }
                    fclose($f);

                    ksort($roles);
                    foreach (array_keys($roles) as $role) {
                        echo '<button class="filter-btn" data-filter="' . h($role) . '">' . h($role) . "</button>" . "\n";
                    }
                    ?>
                </div>
            </div>

            <!-- メンバーリスト -->
            <ul class="member-grid" id="member-list">
                <?php
                // URLのホスト名からリンクの表示ラベルを推測する
                function guess_link_label($url)
                {
                    $host = strtolower((string) parse_url($url, PHP_URL_HOST));
                    $host = preg_replace("/^www\./", "", $host);

                    if ($host === "x.com" || $host === "twitter.com") {
                        return "X/Twitter";
                    }

                    $patterns = [
                        "youtube" => "YouTube",
                        "youtu.be" => "YouTube",
                        "twitch" => "Twitch",
                        "tiktok" => "TikTok",
                        "bilibili" => "bilibili",
                        "nicovideo" => "ニコニコ",
                        "discord" => "Discord",
                        "github" => "GitHub",
                    ];
                    foreach ($patterns as $needle => $label) {
                        if (strpos($host, $needle) !== false) {
                            return $label;
                        }
                    }
                    return "リンク";
                }

                // SNSリンク欄をパースして複数リンクに分解する。
                // 半角スペース・全角スペース・改行区切りに対応し、
                // 末尾の「(TikTok)」のような注記があれば表示ラベルとして使う。
                function parse_member_links($raw)
                {
                    $links = [];
                    $parts = preg_split('/[\s\x{3000}]+/u', trim((string) $raw), -1, PREG_SPLIT_NO_EMPTY);
                    if ($parts === false) {
                        return $links;
                    }

                    foreach ($parts as $part) {
                        $label = "";
                        if (preg_match('/^(.+?)[(（]([^)）]+)[)）]$/u', $part, $m)) {
                            $part = $m[1];
                            $label = trim($m[2]);
                        }

                        // 「X:https://...」のような接頭辞は取り除く
                        // （表記ゆれが多いのでラベルには使わず、ホスト名から推測する）
                        $scheme_at = stripos($part, "http://");
                        if ($scheme_at === false) {
                            $scheme_at = stripos($part, "https://");
                        }
                        if ($scheme_at !== false && $scheme_at > 0) {
                            $part = substr($part, $scheme_at);
                        }

                        // スキームが省略されている場合は https を補う
                        if (!preg_match("#^https?://#i", $part)) {
                            $part = "https://" . ltrim($part, "/");
                        }
                        if (!filter_var($part, FILTER_VALIDATE_URL)) {
                            continue;
                        }

                        if ($label === "") {
                            $label = guess_link_label($part);
                        }
                        $links[] = ["url" => $part, "label" => $label];
                    }
                    return $links;
                }

                // メンバーデータを配列に読み込む
                $members = [];
                $f = fopen("../data/members.csv", "r");
                $header = fgetcsv($f);
                while (($line = fgetcsv($f)) !== false) {
                    if (empty($line[0])) {
                        continue;
                    }
                    $members[] = $line;
                }
                fclose($f);

                // 50音順（ひらがな、カタカナ、漢字も含む）でソート
                usort($members, function ($a, $b) {
                    return strcmp($a[0], $b[0]);
                });

                // ソート済みのメンバーを出力
                foreach ($members as $line) {
                    $name = h($line[0]);
                    $links = parse_member_links(isset($line[1]) ? $line[1] : "");
                    $primary_link = !empty($links) ? $links[0]["url"] : "";
                    $role = isset($line[2]) ? h(trim($line[2])) : "";

                    // 役割タグ用にデータ属性を生成
                    $role_list = array_map("trim", explode(",", str_replace("、", ",", $line[2])));
                    $data_roles = implode(",", array_map("htmlspecialchars", $role_list));

                    echo '<li class="member-card" data-name="' . h($line[0]) . '" data-roles="' . h($data_roles) . '">';

                    echo '<div class="member-name">';
                    if ($primary_link !== "") {
                        echo '<a href="' . h($primary_link) . '" target="_blank" rel="noopener noreferrer">' . $name . "</a>";
                    } else {
                        echo $name;
                    }
                    echo "</div>";

                    // 役割をタグとして表示
                    if (!empty($line[2])) {
                        echo '<div class="member-role">';
                        $role_tags = array_map("trim", explode(",", str_replace("、", ",", $line[2])));
                        foreach ($role_tags as $tag) {
                            if (!empty($tag)) {
                                echo '<span class="member-role-tag">' . h($tag) . "</span>";
                            }
                        }
                        echo "</div>";
                    }

                    // ソーシャルリンクがあれば表示（複数リンクにも対応）
                    if (!empty($links)) {
                        echo '<div class="member-social">';
                        foreach ($links as $social) {
                            echo '<a href="' . h($social["url"]) . '" target="_blank" rel="noopener noreferrer">→ ' . h($social["label"]) . "</a>";
                        }
                        echo "</div>";
                    }

                    echo "</li>";
                }
                ?>
            </ul>

            <div class="member-count">
                <?= h(t("cont_member_count")) ?>: <span id="result-count">0</span> <?= h(t("cont_contributors_unit")) ?>
            </div>
        </section>

        <section id="special-thanks">
            <h3><?= h(t("special_thanks")) ?></h3>
            <ul>
                <li><?= h(t("special_thanks_1")) ?></li>
                <li><?= h(t("special_thanks_2")) ?></li>
            </ul>
        </section>
    </main>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/templates/footer.php"; ?>

    <script>
        const searchInput = document.getElementById('search-input');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const memberList = document.getElementById('member-list');
        const resultCount = document.getElementById('result-count');
        const memberCards = memberList.querySelectorAll('.member-card');

        let currentFilter = 'all';

        function updateDisplay() {
            const searchTerm = searchInput.value.toLowerCase();
            let visibleCount = 0;

            memberCards.forEach(card => {
                const name = card.dataset.name.toLowerCase();
                const roles = card.dataset.roles.split(',').map(r => r.trim().toLowerCase());

                // 検索条件
                const matchesSearch = name.includes(searchTerm);

                // フィルター条件
                let matchesFilter = currentFilter === 'all';
                if (!matchesFilter) {
                    matchesFilter = roles.includes(currentFilter.toLowerCase());
                }

                // 両方の条件を満たすかチェック
                const shouldShow = matchesSearch && matchesFilter;

                if (shouldShow) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            resultCount.textContent = visibleCount;

            // 結果がない場合のメッセージ
            if (visibleCount === 0) {
                if (!memberList.querySelector('.no-results')) {
                    const noResults = document.createElement('div');
                    noResults.className = 'no-results';
                    noResults.innerHTML = '<div class="no-results-emoji">🔍</div><p>条件に合うメンバーが見つかりません</p>';
                    memberList.appendChild(noResults);
                }
            } else {
                const noResults = memberList.querySelector('.no-results');
                if (noResults) {
                    noResults.remove();
                }
            }
        }

        // 検索入力のイベントリスナー
        searchInput.addEventListener('input', updateDisplay);

        // フィルターボタンのイベントリスナー
        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                filterButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.dataset.filter;
                searchInput.value = '';
                updateDisplay();
            });
        });

        // 初期表示
        updateDisplay();
    </script>
  </body>
</html>
