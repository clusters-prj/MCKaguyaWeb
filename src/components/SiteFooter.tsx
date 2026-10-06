import { Suspense } from "react";
import Link from "next/link";
import { getT } from "@/lib/i18n";
import { LangSwitch } from "./LangSwitch";
import { Raw } from "./Raw";

export async function SiteFooter() {
  const { t, lang } = await getT();
  return (
    <footer>
      <div className="container">
        <div className="footer-content">
          <Raw as="p" html={t("footer_copyright")} />
          <p>
            <Link href="/copyright">{t("footer_copyright_link")}</Link>
          </p>
          <Suspense fallback={null}>
            <LangSwitch current={lang} label={t("lang_switch_label")} />
          </Suspense>
        </div>
      </div>
    </footer>
  );
}
