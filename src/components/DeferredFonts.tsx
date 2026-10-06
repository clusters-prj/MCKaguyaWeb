"use client";

import { useEffect } from "react";

const FONTS_HREF =
  "https://fonts.googleapis.com/css2?family=Kiwi+Maru:wght@400;500&family=Noto+Sans+JP:wght@400;500;700&family=Silkscreen:wght@400;700&family=Zen+Old+Mincho:wght@500;700&display=swap";

export function DeferredFonts() {
  useEffect(() => {
    const link = document.getElementById(
      "site-fonts",
    ) as HTMLLinkElement | null;
    if (link) link.media = "all";
  }, []);
  return (
    <>
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin="" />
      <link id="site-fonts" rel="stylesheet" href={FONTS_HREF} media="print" />
      <noscript>
        <link rel="stylesheet" href={FONTS_HREF} />
      </noscript>
    </>
  );
}
