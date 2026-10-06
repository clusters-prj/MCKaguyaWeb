import type { Viewport } from "next";
import { headers } from "next/headers";
import type { ReactNode } from "react";
import { DeferredFonts } from "@/components/DeferredFonts";
import { ErrorLabelsProvider } from "@/components/ErrorLabels";
import { errorLabels } from "@/lib/errorLabels";
import { getT } from "@/lib/i18n";

export const viewport: Viewport = {
  themeColor: "#f7f5ef",
  width: "device-width",
  initialScale: 1,
};

export default async function RootLayout({
  children,
}: {
  children: ReactNode;
}) {
  const { t, lang, dir } = await getT();
  const pathname = (await headers()).get("x-pathname") ?? "/";

  return (
    <html lang={lang} dir={dir}>
      <head>
        <DeferredFonts />
      </head>
      <body className={pathname === "/" ? "home-scroll-page" : undefined}>
        <ErrorLabelsProvider value={errorLabels(t, 500)}>
          {children}
        </ErrorLabelsProvider>
      </body>
    </html>
  );
}
