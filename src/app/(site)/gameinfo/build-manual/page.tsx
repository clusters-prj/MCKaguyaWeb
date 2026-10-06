import Link from "next/link";
import { getT } from "@/lib/i18n";
import { pageMetadata } from "@/lib/metadata";

export const generateMetadata = () =>
  pageMetadata(
    "/gameinfo/build-manual",
    "build_manual_page_title",
    "build_manual_intro",
  );

export default async function Page() {
  const { t } = await getT();
  return (
    <main id="main-content">
      <section id="overview">
        <h2>{t("build_manual_heading")}</h2>
        <p>{t("build_manual_intro")}</p>
      </section>

      <section id="rules">
        <h3>{t("build_manual_rule_1_title")}</h3>
        <p>1. {t("build_manual_rule_1_1")}</p>
        <p>2. {t("build_manual_rule_1_2")}</p>

        <h3>{t("build_manual_rule_2_title")}</h3>
        <p>1. {t("build_manual_rule_2_1")}</p>
        <p>2. {t("build_manual_rule_2_2")}</p>

        <h3>{t("build_manual_rule_3_title")}</h3>
        <p>1. {t("build_manual_rule_3_1")}</p>
        <p>2. {t("build_manual_rule_3_2")}</p>

        <h3>{t("build_manual_rule_4_title")}</h3>
        <p>
          1. {t("build_manual_rule_4_1_before_link")}{" "}
          <Link href="/gameinfo/wra">{t("build_manual_rule_4_link_text")}</Link>{" "}
          {t("build_manual_rule_4_1_after_link")}
        </p>
        <p>2. {t("build_manual_rule_4_2")}</p>

        <h3>{t("build_manual_rule_5_title")}</h3>
        <p>1. {t("build_manual_rule_5_1")}</p>
        <p>2. {t("build_manual_rule_5_2")}</p>
      </section>
    </main>
  );
}
