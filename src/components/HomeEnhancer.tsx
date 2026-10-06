"use client";

import { useEffect } from "react";
import type { GalleryTheme } from "@/lib/homepage";

type View = { src: string; alt: string; title: string; description: string };

const DEFAULT_THEMES: View[][] = [
  [
    {
      src: "/assets/gallery/1014.webp",
      alt: "路上ライブが行われた道",
      title: "路上ライブが行われた道",
      description: "光に導かれて、ライブの余韻を歩く。",
    },
    {
      src: "/assets/gallery/1013.webp",
      alt: "ランタンに照らされたライブの通り",
      title: "路上ライブが行われた道",
      description: "ランタンの灯りが続く、夜の通り。",
    },
  ],
  [
    {
      src: "/assets/gallery/1010.webp",
      alt: "ネオン商店街の街並み",
      title: "ネオン商店街",
      description: "灯りが連なる、街のにぎわい。",
    },
    {
      src: "/assets/gallery/1009.webp",
      alt: "夜のネオン商店街を見上げた景色",
      title: "ネオン商店街",
      description: "夜の路地を抜けて、街の奥へ。",
    },
  ],
  [
    {
      src: "/assets/gallery/1008.webp",
      alt: "水辺に広がる川床",
      title: "川床",
      description: "水辺に灯る、やわらかな時間。",
    },
    {
      src: "/assets/gallery/1007.webp",
      alt: "夕暮れの川床と水面",
      title: "川床",
      description: "夕暮れの光が水面にほどける。",
    },
  ],
];

const IMAGE_NAME = /^[\w.-]+\.(?:webp|png|jpe?g|avif)$/i;

function resolveThemes(gallery: GalleryTheme[] | null): View[][] {
  if (!Array.isArray(gallery) || gallery.length !== 3) return DEFAULT_THEMES;
  return gallery.map((theme, index) => {
    const images = Array.isArray(theme.images)
      ? theme.images.filter((n) => IMAGE_NAME.test(n))
      : [];
    return images.length
      ? images.map((name) => ({
          src: `/assets/gallery/${name}`,
          alt: theme.title,
          title: theme.title,
          description: theme.description || "",
        }))
      : DEFAULT_THEMES[index];
  });
}

export function HomeEnhancer({ gallery }: { gallery: GalleryTheme[] | null }) {
  useEffect(() => {
    document.body.classList.add("home-scroll-page");

    const reduceMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)",
    ).matches;
    const cleanups: Array<() => void> = [];
    const reveals = [...document.querySelectorAll(".reveal")];

    if ("IntersectionObserver" in window && !reduceMotion) {
      const revealObserver = new IntersectionObserver(
        (entries, observer) => {
          entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          });
        },
        { threshold: 0.14, rootMargin: "0px 0px -6% 0px" },
      );
      reveals.forEach((section) => revealObserver.observe(section));
      cleanups.push(() => revealObserver.disconnect());
    } else {
      reveals.forEach((section) => section.classList.add("is-visible"));
    }

    const root = document.querySelector<HTMLElement>("[data-feature-gallery]");
    if (root) {
      const gallery_ = root;
      const themes = resolveThemes(gallery);
      const views = themes.map(
        (group) => group[Math.floor(Math.random() * group.length)],
      );
      const image = gallery_.querySelector<HTMLImageElement>(
        "[data-feature-image]",
      )!;
      const title = gallery_.querySelector<HTMLElement>(
        "[data-feature-title]",
      )!;
      const description = gallery_.querySelector<HTMLElement>(
        "[data-feature-description]",
      )!;
      const kicker = gallery_.querySelector<HTMLElement>(
        "[data-feature-kicker]",
      )!;
      const count = gallery_.querySelector<HTMLElement>(
        "[data-feature-count]",
      )!;
      const steps = [
        ...gallery_.querySelectorAll<HTMLElement>("[data-feature-step]"),
      ];
      let current = 0;
      let visible = false;
      let hovered = false;
      let focused = false;
      let pointerStart: { x: number; y: number } | null = null;
      let timer: number | undefined;
      let changeTimer: number | undefined;

      const render = () => {
        const view = views[current];
        gallery_.classList.add("is-changing");
        window.clearTimeout(changeTimer);
        changeTimer = window.setTimeout(
          () => {
            image.src = view.src;
            image.alt = view.alt;
            title.textContent = view.title;
            description.textContent = view.description;
            kicker.textContent = `TSUKUYOMI — MEMORY 0${current + 1}`;
            count.textContent = `0${current + 1}`;
            steps.forEach((step, index) => {
              if (index === current) step.setAttribute("aria-current", "step");
              else step.removeAttribute("aria-current");
            });
            gallery_.classList.remove("is-changing");
          },
          reduceMotion ? 0 : 130,
        );
      };
      const stop = () => window.clearInterval(timer);
      const start = () => {
        stop();
        if (
          !reduceMotion &&
          visible &&
          !hovered &&
          !focused &&
          !document.hidden
        ) {
          timer = window.setInterval(() => move(1), 7000);
        }
      };
      const move = (direction: number) => {
        current = (current + direction + views.length) % views.length;
        render();
        start();
      };

      const on = <T extends EventTarget>(
        target: T,
        type: string,
        handler: (e: any) => void,
      ) => {
        target.addEventListener(type, handler);
        cleanups.push(() => target.removeEventListener(type, handler));
      };

      on(gallery_.querySelector("[data-feature-prev]")!, "click", () =>
        move(-1),
      );
      on(gallery_.querySelector("[data-feature-next]")!, "click", () =>
        move(1),
      );
      on(gallery_, "keydown", (event: KeyboardEvent) => {
        if (event.key === "ArrowLeft") {
          event.preventDefault();
          move(-1);
        }
        if (event.key === "ArrowRight") {
          event.preventDefault();
          move(1);
        }
      });
      on(gallery_, "pointerdown", (event: PointerEvent) => {
        if ((event.target as Element).closest("button")) return;
        pointerStart = { x: event.clientX, y: event.clientY };
      });
      on(gallery_, "pointerup", (event: PointerEvent) => {
        if (!pointerStart) return;
        const dx = event.clientX - pointerStart.x;
        const dy = event.clientY - pointerStart.y;
        pointerStart = null;
        if (Math.abs(dx) > 48 && Math.abs(dx) > Math.abs(dy) * 1.2)
          move(dx < 0 ? 1 : -1);
      });
      on(gallery_, "pointercancel", () => {
        pointerStart = null;
      });
      on(gallery_, "mouseenter", () => {
        hovered = true;
        stop();
      });
      on(gallery_, "mouseleave", () => {
        hovered = false;
        start();
      });
      on(gallery_, "focusin", () => {
        focused = true;
        stop();
      });
      on(gallery_, "focusout", (event: FocusEvent) => {
        if (!gallery_.contains(event.relatedTarget as Node | null)) {
          focused = false;
          start();
        }
      });
      on(document, "visibilitychange", () =>
        document.hidden ? stop() : start(),
      );

      render();
      if ("IntersectionObserver" in window) {
        const galleryObserver = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              visible = entry.isIntersecting;
              if (visible) start();
              else stop();
            });
          },
          { threshold: 0.12 },
        );
        galleryObserver.observe(gallery_);
        cleanups.push(() => galleryObserver.disconnect());
      } else {
        visible = true;
        start();
      }
      cleanups.push(() => {
        stop();
        window.clearTimeout(changeTimer);
      });
    }

    return () => {
      cleanups.forEach((fn) => fn());
      document.body.classList.remove("home-scroll-page");
    };
  }, [gallery]);

  return null;
}
