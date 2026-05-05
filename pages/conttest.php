<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <style>
      :root {
        --indigo-primary: #4f46e5;
        --indigo-light: #eef2ff;
        --indigo-dark: #312e81;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --border-color: #e5e7eb;
      }

      /* Kiwi Maru フォント */
      @import url('https://fonts.googleapis.com/css2?family=Kiwi+Maru:wght@400;500;700&display=swap');

      body {
        font-family: 'Kiwi Maru', serif;
      }

      #member-controls {
        margin: 2rem 0;
        padding: 1.5rem;
        background: linear-gradient(135deg, var(--indigo-light) 0%, #f0f4ff 100%);
        border-radius: 12px;
        border-left: 4px solid var(--indigo-primary);
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
        background: white;
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
        background: white;
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
      }

      .member-social {
        margin-top: 0.5rem;
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
    </style>
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
            <p>建築、回路、プラグイン設定、テストプレイ等でご協力いただいた皆様です。</p>

            <!-- 検索・フィルター機能 -->
            <div id="member-controls">
                <div class="search-container">
                    <input 
                        type="text" 
                        id="search-input" 
                        class="search-input" 
                        placeholder="メンバー名で検索..."
                        autocomplete="off"
                    >
                </div>
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">全て表示</button>
                    <?php
                    // CSVから役割を取得してフィルターボタンを動的生成
                    $roles = array();
                    $f = fopen("../data/members.csv", "r");
                    $header = fgetcsv($f);
                    while (($line = fgetcsv($f)) !== FALSE) {
                        if (!empty($line[2])) {
                            // 複数の役割がカンマ(、または,)で区切られている場合に対応
                            $role_string = $line[2];
                            // 全角カンマと半角カンマの両方に対応
                            $role_string = str_replace(',', '、', $role_string);
                            $role_list = explode('、', $role_string);
                            
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
                        echo '<button class="filter-btn" data-filter="' . htmlspecialchars($role) . '">' . htmlspecialchars($role) . '</button>' . "\n";
                    }
                    ?>
                </div>
            </div>

            <!-- メンバーリスト -->
            <ul class="member-grid" id="member-list">
                <?php
                // メンバーデータを配列に読み込む
                $members = array();
                $f = fopen("../data/members.csv", "r");
                $header = fgetcsv($f);
                while (($line = fgetcsv($f)) !== FALSE) {
                    if (empty($line[0])) continue;
                    $members[] = $line;
                }
                fclose($f);
                
                // 50音順（ひらがな、カタカナ、漢字も含む）でソート
                usort($members, function($a, $b) {
                    return strcmp($a[0], $b[0]);
                });
                
                // ソート済みのメンバーを出力
                foreach ($members as $line) {
                    $name = htmlspecialchars($line[0]);
                    $link = isset($line[1]) ? htmlspecialchars(trim($line[1])) : '';
                    $role = isset($line[2]) ? htmlspecialchars(trim($line[2])) : '';
                    
                    // 役割タグ用にデータ属性を生成
                    $role_list = array_map('trim', explode(',', str_replace('、', ',', $line[2])));
                    $data_roles = implode(',', array_map('htmlspecialchars', $role_list));
                    
                    echo '<li class="member-card" data-name="' . htmlspecialchars($line[0]) . '" data-roles="' . htmlspecialchars($data_roles) . '">';
                    
                    echo '<div class="member-name">';
                    if (!empty($link) && filter_var($link, FILTER_VALIDATE_URL)) {
                        echo '<a href="' . $link . '" target="_blank" rel="noopener noreferrer">' . $name . '</a>';
                    } else {
                        echo $name;
                    }
                    echo '</div>';
                    
                    // 役割をタグとして表示
                    if (!empty($line[2])) {
                        echo '<div class="member-role">';
                        $role_tags = array_map('trim', explode(',', str_replace('、', ',', $line[2])));
                        foreach ($role_tags as $tag) {
                            if (!empty($tag)) {
                                echo '<span class="member-role-tag">' . htmlspecialchars($tag) . '</span>';
                            }
                        }
                        echo '</div>';
                    }
                    
                    // ソーシャルリンクがあれば表示
                    if (!empty($link) && filter_var($link, FILTER_VALIDATE_URL)) {
                        echo '<div class="member-social">';
                        if (strpos($link, 'twitter.com') !== false || strpos($link, 'x.com') !== false) {
                            echo '<a href="' . $link . '" target="_blank" rel="noopener noreferrer">→ X/Twitter</a>';
                        } elseif (strpos($link, 'youtube') !== false) {
                            echo '<a href="' . $link . '" target="_blank" rel="noopener noreferrer">→ YouTube</a>';
                        } elseif (strpos($link, 'twitch') !== false) {
                            echo '<a href="' . $link . '" target="_blank" rel="noopener noreferrer">→ Twitch</a>';
                        } else {
                            echo '<a href="' . $link . '" target="_blank" rel="noopener noreferrer">→ リンク</a>';
                        }
                        echo '</div>';
                    }
                    
                    echo '</li>';
                }
                ?>
            </ul>

            <div class="member-count">
                検索結果: <span id="result-count">0</span> 名
            </div>
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
