import { cache } from "react";
import { cookies, headers } from "next/headers";
import {
  DEFAULT_LANG,
  RTL_LANGS,
  isLang,
  matchAcceptLanguage,
  type Lang,
} from "./site";

export const getLang = cache(async (): Promise<Lang> => {
  const h = await headers();
  const forced = h.get("x-lang");
  if (isLang(forced)) return forced;

  const cookie = (await cookies()).get("lang")?.value;
  if (isLang(cookie)) return cookie;

  const accept = h.get("accept-language");
  if (accept) {
    const match = matchAcceptLanguage(accept);
    if (match) return match;
  }
  return DEFAULT_LANG;
});

export const loadDict = cache(
  async (lang: Lang): Promise<Record<string, string>> => {
    return (await import(`../../messages/${lang}.json`)).default;
  },
);

export type T = (key: string) => string;

export function makeT(dict: Record<string, string>): T {
  return (key) => dict[key] ?? `[[${key}]]`;
}

export async function getT(): Promise<{
  t: T;
  lang: Lang;
  dir: "ltr" | "rtl";
}> {
  const lang = await getLang();
  const t = makeT(await loadDict(lang));
  return { t, lang, dir: RTL_LANGS.includes(lang) ? "rtl" : "ltr" };
}
