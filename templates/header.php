<header>
  <a href="/index.php">
    <img src="/assets/logo.JPG" alt="<?= h(t('logo_alt')) ?>" class="site-logo">
  </a>
</header>
<nav>
  <button id="menu-btn" class="menu-btn" aria-label="<?= h(t('nav_menu_aria')) ?>">
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
<button id="page-top" class="page-top" aria-label="<?= h(t('page_top_aria')) ?>">↑</button>
<hr>

<script>
  function applyTheme(theme) {
    const themeLink = document.getElementById('main-style');
    if (!themeLink) return;
    themeLink.href = theme === 'pre' ? '/assets/pre.css' : '/assets/style.css';
    localStorage.setItem('selected-theme', theme);
  }

  document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('nav a');

    navLinks.forEach(link => {
      const href = link.getAttribute('href');
      if (currentPath === href || (currentPath === '/' && href === '/index.php')) {
        link.classList.add('active');
      }
    });

    // 保存済みテーマの初期反映は templates/head.php 内のインライン
    // スクリプトで済ませてある（FOUC 防止のため）。ここでは切替のみ扱う。
    const toggleBtn = document.getElementById('theme-toggle');
    if (toggleBtn) {
      toggleBtn.addEventListener('click', function() {
        const currentTheme = localStorage.getItem('selected-theme') === 'pre' ? 'style' : 'pre';
        applyTheme(currentTheme);
      });
    }

    const menuBtn = document.getElementById('menu-btn');
    const navList = document.getElementById('nav-list');
    if (menuBtn && navList) {
      menuBtn.addEventListener('click', function() {
        menuBtn.classList.toggle('is-active');
        navList.classList.toggle('is-open');
      });
    }

    const pageTopBtn = document.getElementById('page-top');
    if (pageTopBtn) {
      window.addEventListener('scroll', function() {
        const scrollY = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollY > 200) {
          pageTopBtn.classList.add('is-visible');
        } else {
          pageTopBtn.classList.remove('is-visible');
        }
      });
      pageTopBtn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    }
  });
</script>
