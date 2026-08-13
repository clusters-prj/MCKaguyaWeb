<!-- キーボード利用者がナビゲーションを読み飛ばして本文に移れるようにする -->
<a class="skip-link" href="#main-content"><?= h(t('skip_to_content')) ?></a>
<header>
  <a href="/index.php">
    <img src="/assets/logo.JPG" alt="<?= h(t('logo_alt')) ?>" class="site-logo">
  </a>
</header>
<nav>
  <button id="menu-btn" class="menu-btn" type="button"
          aria-label="<?= h(t('nav_menu_aria')) ?>"
          aria-controls="nav-list" aria-expanded="false">
    <span></span><span></span><span></span>
  </button>
  <ul id="nav-list">
    <li><a href="/index.php"><?= h(t('nav_top')) ?></a></li>
    <li><a href="/pages/progress.php"><?= h(t('nav_progress')) ?></a></li>
    <li><a href="/pages/gameinfo.php"><?= h(t('nav_gameinfo')) ?></a></li>
    <li><a href="/pages/cont.php"><?= h(t('nav_contributors')) ?></a></li>
    <li><a href="/pages/contact.php"><?= h(t('nav_contact')) ?></a></li>
  </ul>
</nav>
<button id="page-top" class="page-top" type="button" aria-label="<?= h(t('page_top_aria')) ?>">↑</button>
<hr>

<script>
  function applyTheme(theme) {
    const themeLink = document.getElementById('main-style');
    if (!themeLink) return;
    themeLink.href = theme === 'pre' ? '/assets/pre.css' : '/assets/style.css';
    try {
      localStorage.setItem('selected-theme', theme);
    } catch (e) {
      // localStorage が使えない環境では、このページ内でのみ切り替わる
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('nav a');

    navLinks.forEach(link => {
      const href = link.getAttribute('href');
      if (currentPath === href || (currentPath === '/' && href === '/index.php')) {
        link.classList.add('active');
        // 見た目だけでなく、支援技術にも「現在のページ」だと伝える
        link.setAttribute('aria-current', 'page');
      }
    });

    // 保存済みテーマの初期反映は templates/head.php 内のインライン
    // スクリプトで済ませてある（FOUC 防止のため）。ここでは切替のみ扱う。
    const toggleBtn = document.getElementById('theme-toggle');
    if (toggleBtn) {
      toggleBtn.addEventListener('click', function() {
        let saved = null;
        try {
          saved = localStorage.getItem('selected-theme');
        } catch (e) { /* 読めなければ既定テーマ扱い */ }
        applyTheme(saved === 'pre' ? 'style' : 'pre');
      });
    }

    const menuBtn = document.getElementById('menu-btn');
    const navList = document.getElementById('nav-list');
    if (menuBtn && navList) {
      const setMenu = function(open) {
        menuBtn.classList.toggle('is-active', open);
        navList.classList.toggle('is-open', open);
        menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
      };

      menuBtn.addEventListener('click', function() {
        setMenu(!navList.classList.contains('is-open'));
      });

      // 全画面メニューを開いたまま身動きが取れなくならないよう、
      // Esc とリンク選択で閉じる
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && navList.classList.contains('is-open')) {
          setMenu(false);
          menuBtn.focus();
        }
      });
      navList.addEventListener('click', function(e) {
        if (e.target.closest('a')) {
          setMenu(false);
        }
      });
    }

    const pageTopBtn = document.getElementById('page-top');
    if (pageTopBtn) {
      // スクロールのたびにレイアウトを触らないよう requestAnimationFrame でまとめる
      let ticking = false;
      window.addEventListener('scroll', function() {
        if (ticking) return;
        ticking = true;
        window.requestAnimationFrame(function() {
          const scrollY = window.pageYOffset || document.documentElement.scrollTop;
          pageTopBtn.classList.toggle('is-visible', scrollY > 200);
          ticking = false;
        });
      }, { passive: true });

      pageTopBtn.addEventListener('click', function() {
        // 「視差効果を減らす」設定を尊重する
        const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
      });
    }
  });
</script>
