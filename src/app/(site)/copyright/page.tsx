import { getT } from "@/lib/i18n";
import { pageMetadata } from "@/lib/metadata";

export const generateMetadata = () =>
  pageMetadata("/copyright", "copyright_page_title", "copyright_intro");

export default async function CopyrightPage() {
  const { t } = await getT();
  return (
    <main id="main-content">
      <section id="overview">
        <h2>{t("copyright_heading")}</h2>
        <p>{t("copyright_intro")}</p>
      </section>
      <section id="credits">
        <h3>{t("copyright_site_content")}</h3>
        <p>{t("copyright_site_content_info")}</p>

        <h3>{t("copyright_minecraft")}</h3>
        <p>{t("copyright_minecraft_info")}</p>

        <h3>{t("copyright_external_license")}</h3>
        <p>{t("copyright_external_license_info")}</p>
        <ul>
          <li>
            <strong>BlueMap</strong> (MIT License) -{" "}
            {t("copyright_external_license_bluemap")}
          </li>
          <li>
            <strong>Font Awesome Free</strong> (Icons: CC BY 4.0, Webfonts: SIL
            OFL 1.1, Code: MIT) - {t("copyright_external_license_font_awesome")}
          </li>
        </ul>
      </section>
      <section id="guideline-policy">
        <h3>{t("copyright_guideline_policy")}</h3>
        <p>{t("copyright_guideline_policy_info")}</p>
        <p>
          {t("copyright_guideline_policy_link")}
          <i
            className="fa-solid fa-arrow-up-right-from-square"
            style={{ color: "#6366f1" }}
          ></i>
        </p>
      </section>
    </main>
  );
}
