"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { useEffect, useState } from "react";

type Labels = {
  skip: string;
  logoAlt: string;
  menuAria: string;
  pageTopAria: string;
  nav: { href: string; label: string }[];
};

export function SiteHeader({ labels }: { labels: Labels }) {
  const pathname = usePathname();
  const [open, setOpen] = useState(false);
  const [showTop, setShowTop] = useState(false);

  useEffect(() => {
    if (!open) return;
    const onKey = (e: KeyboardEvent) => {
      if (e.key === "Escape") {
        setOpen(false);
        document.getElementById("menu-btn")?.focus();
      }
    };
    document.addEventListener("keydown", onKey);
    return () => document.removeEventListener("keydown", onKey);
  }, [open]);

  useEffect(() => {
    let ticking = false;
    const onScroll = () => {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(() => {
        setShowTop(
          (window.pageYOffset || document.documentElement.scrollTop) > 200,
        );
        ticking = false;
      });
    };
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  const scrollTop = () => {
    const reduce = window.matchMedia(
      "(prefers-reduced-motion: reduce)",
    ).matches;
    window.scrollTo({ top: 0, behavior: reduce ? "auto" : "smooth" });
  };

  return (
    <>
      <a className="skip-link" href="#main-content">
        {labels.skip}
      </a>
      <header>
        <Link href="/">
          <img
            src="/assets/logo.png"
            alt={labels.logoAlt}
            className="site-logo"
          />
        </Link>
      </header>
      <nav>
        <button
          id="menu-btn"
          className={`menu-btn${open ? " is-active" : ""}`}
          type="button"
          aria-label={labels.menuAria}
          aria-controls="nav-list"
          aria-expanded={open}
          onClick={() => setOpen((v) => !v)}
        >
          <span></span>
          <span></span>
          <span></span>
        </button>
        <ul
          id="nav-list"
          className={open ? "is-open" : undefined}
          onClick={(e) => {
            if ((e.target as HTMLElement).closest("a")) setOpen(false);
          }}
        >
          {labels.nav.map((item) => {
            const active = pathname === item.href;
            return (
              <li key={item.href}>
                <Link
                  href={item.href}
                  className={active ? "active" : undefined}
                  aria-current={active ? "page" : undefined}
                >
                  {item.label}
                </Link>
              </li>
            );
          })}
        </ul>
      </nav>
      <button
        id="page-top"
        className={`page-top${showTop ? " is-visible" : ""}`}
        type="button"
        aria-label={labels.pageTopAria}
        onClick={scrollTop}
      >
        ↑
      </button>
      <hr />
    </>
  );
}
