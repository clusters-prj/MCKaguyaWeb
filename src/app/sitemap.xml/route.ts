import fs from "node:fs";
import path from "node:path";
import { PAGES, SITE_URL, SUPPORTED_LANGS } from "@/lib/site";

export const dynamic = "force-dynamic";

const esc = (s: string) =>
  s
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;");

function lastModified(pagePath: string): string {
  const rel = pagePath === "/" ? "page.tsx" : `${pagePath.slice(1)}/page.tsx`;
  try {
    return fs
      .statSync(path.join(process.cwd(), "src/app/(site)", rel))
      .mtime.toISOString();
  } catch {
    return new Date().toISOString();
  }
}

export function GET() {
  const entries: string[] = [];
  for (const page of PAGES) {
    const lastmod = lastModified(page.path);
    const alternates: [string, string][] = SUPPORTED_LANGS.map((lang) => [
      lang,
      `${SITE_URL}${page.path}?lang=${encodeURIComponent(lang)}`,
    ]);
    alternates.push(["x-default", `${SITE_URL}${page.path}`]);

    for (const [, loc] of alternates.slice(0, SUPPORTED_LANGS.length)) {
      entries.push(
        [
          "  <url>",
          `    <loc>${esc(loc)}</loc>`,
          `    <lastmod>${esc(lastmod)}</lastmod>`,
          `    <priority>${esc(String(page.priority))}</priority>`,
          ...alternates.map(
            ([hl, href]) =>
              `    <xhtml:link rel="alternate" hreflang="${esc(hl)}" href="${esc(href)}" />`,
          ),
          "  </url>",
        ].join("\n"),
      );
    }
  }

  const xml = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
${entries.join("\n")}
</urlset>
`;
  return new Response(xml, {
    headers: { "Content-Type": "application/xml; charset=UTF-8" },
  });
}
