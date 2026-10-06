import type { Metadata } from "next";
import { getT } from "./i18n";
import { SITE_URL, SUPPORTED_LANGS, langUrl } from "./site";

export async function pageMetadata(
  path: string,
  titleKey: string,
  descKey?: string,
): Promise<Metadata> {
  const { t, lang } = await getT();
  const title = t(titleKey);
  const description = descKey ? t(descKey) : t("site_description");
  const languages: Record<string, string> = Object.fromEntries(
    SUPPORTED_LANGS.map((l) => [l, langUrl(path, l)]),
  );
  languages["x-default"] = path;

  return {
    metadataBase: new URL(SITE_URL),
    title: { absolute: title },
    description,
    icons: { icon: [{ url: "/favicon.ico", sizes: "any" }] },
    alternates: { canonical: langUrl(path, lang), languages },
    openGraph: {
      type: "website",
      siteName: t("site_title"),
      title,
      description,
      url: langUrl(path, lang),
      locale: lang.replace("-", "_"),
      images: ["/assets/logo.png"],
    },
    twitter: { card: "summary_large_image" },
  };
}
