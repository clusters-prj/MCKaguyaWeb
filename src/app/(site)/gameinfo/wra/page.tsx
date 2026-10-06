import { getT } from "@/lib/i18n";
import { pageMetadata } from "@/lib/metadata";

export const generateMetadata = () =>
  pageMetadata("/gameinfo/wra", "wra_page_title", "wra_intro_1");

export default async function Page() {
  const { t } = await getT();
  return (
    <main id="main-content">
      <section id="overview">
        <h2>{t("wra_heading")}</h2>
        <p>
          {t("wra_intro_1")}
          <br />
          {t("wra_intro_2")}
        </p>
      </section>

      <section id="features">
        <h2>{t("wra_features_heading")}</h2>
        <p>{t("wra_features_intro")}</p>
        <ul>
          <li>
            <strong>{t("wra_feature_1_title")}：</strong>{" "}
            {t("wra_feature_1_body")}
          </li>
          <li>
            <strong>{t("wra_feature_2_title")}：</strong>{" "}
            {t("wra_feature_2_body")}
          </li>
        </ul>
      </section>

      <section id="how-to-use">
        <h2>~ {t("wra_howto_heading")} ~</h2>
        <ol>
          <li>
            <strong>{t("wra_step_1_title")}</strong>
            <p>
              {t("wra_step_1_body_1")}
              <br />
              {t("wra_step_1_body_2_left")}{" "}
              <strong>{t("wra_step_1_body_2_right")}</strong>
              <br />
              {t("wra_step_1_body_3_left")}{" "}
              <strong>{t("wra_step_1_body_3_right")}</strong>
            </p>
          </li>
          <li>
            <strong>{t("wra_step_2_title")}</strong>
            <p>{t("wra_step_2_body")}</p>
          </li>
          <li>
            <strong>{t("wra_step_3_title")}</strong>
            <p>
              {t("wra_step_3_body_1")} <strong>{t("wra_step_3_body_2")}</strong>
              {t("wra_step_3_body_3")}
              <br />
              {t("wra_step_3_body_4")}{" "}
              <span style={{ color: "#55ff55" }}>{t("wra_step_3_body_5")}</span>
              {t("wra_step_3_body_6")}
            </p>
          </li>
        </ol>
      </section>

      <section
        id="notice"
        style={{
          borderLeft: "4px solid #ff5555",
          paddingLeft: "15px",
          marginTop: "30px",
        }}
      >
        <h3 style={{ color: "#ff5555" }}>⚠️ {t("wra_notice_heading")}</h3>
        <ul>
          <li>
            <strong>{t("wra_notice_1_title")}</strong>
            <br />
            {t("wra_notice_1_body_1")}
          </li>
          <li>
            <strong>{t("wra_notice_2_title")}</strong>
            <br />
            {t("wra_notice_2_body")}
          </li>
          <li>
            <strong>{t("wra_notice_3_title")}</strong>
            <br />
            {t("wra_notice_3_body")}
          </li>
        </ul>
      </section>
    </main>
  );
}
