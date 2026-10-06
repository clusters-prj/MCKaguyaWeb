export const SUPPORTED_LANGS = [
  "ja",
  "en",
  "es",
  "fr",
  "ko",
  "zh-CN",
  "zh-TW",
  "ar",
  "ru",
  "pt",
] as const;
export type Lang = (typeof SUPPORTED_LANGS)[number];

export const DEFAULT_LANG: Lang = "ja";
export const RTL_LANGS: readonly Lang[] = ["ar"];
export const SITE_URL = "https://web-kaguya.clusters-prj.com";

export const LANG_NAMES: Record<Lang, string> = {
  ja: "日本語",
  en: "English",
  es: "Español",
  fr: "Français",
  ko: "한국어",
  "zh-CN": "简体中文",
  "zh-TW": "繁體中文",
  ar: "العربية",
  ru: "Русский",
  pt: "Português",
};

export const PAGES: { path: string; priority: string }[] = [
  { path: "/", priority: "1.0" },
  { path: "/progress", priority: "0.8" },
  { path: "/gameinfo", priority: "0.8" },
  { path: "/system", priority: "0.8" },
  { path: "/cont", priority: "0.8" },
  { path: "/contact", priority: "0.8" },
  { path: "/copyright", priority: "0.5" },
  { path: "/gameinfo/connect", priority: "0.9" },
  { path: "/gameinfo/tools", priority: "0.6" },
  { path: "/gameinfo/wra", priority: "0.7" },
  { path: "/gameinfo/build-manual", priority: "0.7" },
];

export function isLang(value: string | null | undefined): value is Lang {
  return !!value && (SUPPORTED_LANGS as readonly string[]).includes(value);
}

const SCRIPT_ALIASES: Record<string, Lang> = {
  "zh-hans": "zh-CN",
  "zh-hant": "zh-TW",
  "zh-sg": "zh-CN",
  "zh-hk": "zh-TW",
  "zh-mo": "zh-TW",
};

export function matchAcceptLanguage(header: string): Lang | null {
  const supported = new Map<string, Lang>(
    SUPPORTED_LANGS.map((c) => [c.toLowerCase(), c]),
  );
  const byPrefix = new Map<string, Lang>();
  for (const code of SUPPORTED_LANGS) {
    const prefix = code.toLowerCase().split("-")[0];
    if (!byPrefix.has(prefix)) byPrefix.set(prefix, code);
  }

  const entries = header
    .split(",")
    .map((entry, order) => {
      const [rawTag, ...params] = entry.trim().split(";");
      let q = 1;
      for (const param of params) {
        const m = /^\s*q\s*=\s*([0-9.]+)\s*$/i.exec(param);
        if (m) q = parseFloat(m[1]);
      }
      return { tag: rawTag.trim().toLowerCase(), q, order };
    })
    .filter((e) => e.tag !== "" && e.q > 0)
    .sort((a, b) => b.q - a.q || a.order - b.order);

  for (const { tag } of entries) {
    if (tag === "*") continue;
    const exact = supported.get(tag);
    if (exact) return exact;
    const segments = tag.split("-");
    if (segments.length >= 2) {
      const alias = SCRIPT_ALIASES[`${segments[0]}-${segments[1]}`];
      if (alias) return alias;
    }
    const prefixMatch = byPrefix.get(segments[0]);
    if (prefixMatch) return prefixMatch;
  }
  return null;
}

export function absoluteUrl(path: string): string {
  return SITE_URL.replace(/\/$/, "") + path;
}

export function langUrl(path: string, lang: Lang | null): string {
  return lang ? `${path}?lang=${encodeURIComponent(lang)}` : path;
}
