(() => {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const reveals = [...document.querySelectorAll('.reveal')];
  if ('IntersectionObserver' in window && !reduceMotion) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.14, rootMargin: '0px 0px -6% 0px' });
    reveals.forEach(section => revealObserver.observe(section));
  } else {
    reveals.forEach(section => section.classList.add('is-visible'));
  }

  let themes = [
    [
      { src: '/assets/gallery/1014.webp', alt: '路上ライブが行われた道', title: '路上ライブが行われた道', description: '光に導かれて、ライブの余韻を歩く。' },
      { src: '/assets/gallery/1013.webp', alt: 'ランタンに照らされたライブの通り', title: '路上ライブが行われた道', description: 'ランタンの灯りが続く、夜の通り。' }
    ],
    [
      { src: '/assets/gallery/1010.webp', alt: 'ネオン商店街の街並み', title: 'ネオン商店街', description: '灯りが連なる、街のにぎわい。' },
      { src: '/assets/gallery/1009.webp', alt: '夜のネオン商店街を見上げた景色', title: 'ネオン商店街', description: '夜の路地を抜けて、街の奥へ。' }
    ],
    [
      { src: '/assets/gallery/1008.webp', alt: '水辺に広がる川床', title: '川床', description: '水辺に灯る、やわらかな時間。' },
      { src: '/assets/gallery/1007.webp', alt: '夕暮れの川床と水面', title: '川床', description: '夕暮れの光が水面にほどける。' }
    ]
  ];

  if (Array.isArray(window.HOMEPAGE_GALLERY) && window.HOMEPAGE_GALLERY.length === 3) {
    themes = window.HOMEPAGE_GALLERY.map((theme, index) => {
      const images = Array.isArray(theme.images) ? theme.images.filter(name => /^[\w.-]+\.(?:webp|png|jpe?g|avif)$/i.test(name)) : [];
      return images.length ? images.map(src => ({
        src: `/assets/gallery/${src}`,
        alt: theme.title,
        title: theme.title,
        description: theme.description || '',
      })) : themes[index];
    });
    document.querySelectorAll('[data-feature-step]').forEach((step, index) => {
      const label = step.querySelector('span');
      if (label && window.HOMEPAGE_GALLERY[index]?.title) label.textContent = window.HOMEPAGE_GALLERY[index].title;
    });
  }

  const gallery = document.querySelector('[data-feature-gallery]');
  if (!gallery) return;

  // Each theme gets one random view at page load; later navigation advances themes only.
  const views = themes.map(group => group[Math.floor(Math.random() * group.length)]);
  const image = gallery.querySelector('[data-feature-image]');
  const title = gallery.querySelector('[data-feature-title]');
  const description = gallery.querySelector('[data-feature-description]');
  const kicker = gallery.querySelector('[data-feature-kicker]');
  const count = gallery.querySelector('[data-feature-count]');
  const steps = [...gallery.querySelectorAll('[data-feature-step]')];
  let current = 0;
  let visible = false;
  let hovered = false;
  let focused = false;
  let pointerStart = null;
  let timer = null;
  let changeTimer = null;

  const render = () => {
    const view = views[current];
    gallery.classList.add('is-changing');
    window.clearTimeout(changeTimer);
    changeTimer = window.setTimeout(() => {
      image.src = view.src;
      image.alt = view.alt;
      title.textContent = view.title;
      description.textContent = view.description;
      kicker.textContent = `TSUKUYOMI — MEMORY 0${current + 1}`;
      count.textContent = `0${current + 1}`;
      steps.forEach((step, index) => {
        if (index === current) step.setAttribute('aria-current', 'step');
        else step.removeAttribute('aria-current');
      });
      gallery.classList.remove('is-changing');
    }, reduceMotion ? 0 : 130);
  };
  const stop = () => window.clearInterval(timer);
  const start = () => {
    stop();
    if (!reduceMotion && visible && !hovered && !focused && !document.hidden) {
      timer = window.setInterval(() => move(1), 7000);
    }
  };
  const move = direction => {
    current = (current + direction + views.length) % views.length;
    render();
    start();
  };

  gallery.querySelector('[data-feature-prev]')?.addEventListener('click', () => move(-1));
  gallery.querySelector('[data-feature-next]')?.addEventListener('click', () => move(1));
  gallery.addEventListener('keydown', event => {
    if (event.key === 'ArrowLeft') { event.preventDefault(); move(-1); }
    if (event.key === 'ArrowRight') { event.preventDefault(); move(1); }
  });
  gallery.addEventListener('pointerdown', event => {
    if (event.target.closest('button')) return;
    pointerStart = { x: event.clientX, y: event.clientY };
  });
  gallery.addEventListener('pointerup', event => {
    if (!pointerStart) return;
    const dx = event.clientX - pointerStart.x;
    const dy = event.clientY - pointerStart.y;
    pointerStart = null;
    if (Math.abs(dx) > 48 && Math.abs(dx) > Math.abs(dy) * 1.2) move(dx < 0 ? 1 : -1);
  });
  gallery.addEventListener('pointercancel', () => { pointerStart = null; });
  gallery.addEventListener('mouseenter', () => { hovered = true; stop(); });
  gallery.addEventListener('mouseleave', () => { hovered = false; start(); });
  gallery.addEventListener('focusin', () => { focused = true; stop(); });
  gallery.addEventListener('focusout', event => {
    if (!gallery.contains(event.relatedTarget)) { focused = false; start(); }
  });
  document.addEventListener('visibilitychange', () => document.hidden ? stop() : start());

  render();
  if ('IntersectionObserver' in window) {
    const galleryObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => { visible = entry.isIntersecting; visible ? start() : stop(); });
    }, { threshold: 0.12 });
    galleryObserver.observe(gallery);
  } else {
    visible = true;
    start();
  }
})();
