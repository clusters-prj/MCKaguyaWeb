import type { ReactNode } from "react";
import { SiteFooter } from "@/components/SiteFooter";
import { SiteHeader } from "@/components/SiteHeader";
import { getT } from "@/lib/i18n";

export default async function SiteLayout({
  children,
}: {
  children: ReactNode;
}) {
  const { t } = await getT();

  const labels = {
    skip: t("skip_to_content"),
    logoAlt: t("logo_alt"),
    menuAria: t("nav_menu_aria"),
    pageTopAria: t("page_top_aria"),
    nav: [
      { href: "/", label: t("nav_top") },
      { href: "/progress", label: t("nav_progress") },
      { href: "/gameinfo", label: t("nav_gameinfo") },
      { href: "/cont", label: t("nav_contributors") },
      { href: "/contact", label: t("nav_contact") },
    ],
  };

  return (
    <>
      <link rel="stylesheet" href="/assets/style.css" precedence="default" />
      <link
        rel="stylesheet"
        href="/assets/site-refresh.css"
        precedence="default"
      />
      <SiteHeader labels={labels} />
      {children}
      <SiteFooter />
    </>
  );
}
