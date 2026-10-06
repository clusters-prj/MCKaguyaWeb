import { getT } from "@/lib/i18n";
import { pageMetadata } from "@/lib/metadata";

export const generateMetadata = () =>
  pageMetadata("/gameinfo/tools", "tools_page_title", "tools_intro_1");

export default async function Page() {
  const { t } = await getT();
  return (
    <main id="main-content">
      <section id="overview">
        <h2>{t("tools_heading")}</h2>
        <p>
          {t("tools_intro_1")}
          <br />
          {t("tools_intro_2")}
        </p>
      </section>

      <section id="tool-list">
        <h2>{t("tools_list_heading")}</h2>
        <ul>
          <li>
            <a href="#DoubleHot">{t("tools_doublehot_title")}</a>
          </li>
        </ul>
        <section id="hotbars">
          <h3>{t("tools_hotbars_heading")}</h3>
          <ul>
            <li>
              <a href="#ServerMove">{t("tools_servermove_title")}</a>
            </li>
            <li>
              <a href="#FlySpeed">{t("tools_flyspeed_title")}</a>
            </li>
            <li>
              <a href="#TP-Portal">{t("tools_tp_portal_title")}</a>
            </li>
            <li>
              <a href="#Bookmark-Manager">{t("tools_bookmark_title")}</a>
            </li>
            <li>
              <a href="#Nightvision">{t("tools_nightvision_title")}</a>
            </li>
          </ul>
        </section>
      </section>
      <section id="DoubleHot">
        <h3>{t("tools_doublehot_title")}</h3>
        <p>{t("tools_doublehot_intro")}</p>
        <h4>~{t("tools_doublehot_usage_heading")}~</h4>
        <p>
          {t("tools_doublehot_usage_1")}
          <br />
          {t("tools_doublehot_usage_2")}
          <br />
          {t("tools_doublehot_usage_3")}
          <br />
          <a href="#hotbars">{t("tools_doublehot_usage_4_link")}</a>
          {t("tools_doublehot_usage_4_after")}
        </p>
      </section>
      <section id="ServerMove">
        <h3>{t("tools_servermove_title")}</h3>
        <p>{t("tools_servermove_intro")}</p>
        <h4>~{t("tools_usage_heading")}~</h4>
        <p>
          <a href="#DoubleHot">{t("tools_doublehot_title")}</a>{" "}
          {t("tools_usage_1")}
        </p>
      </section>
      <section id="FlySpeed">
        <h3>{t("tools_flyspeed_title")}</h3>
        <p>{t("tools_flyspeed_intro")}</p>
        <h4>~{t("tools_usage_heading")}~</h4>
        <p>
          <a href="#DoubleHot">{t("tools_doublehot_title")}</a>{" "}
          {t("tools_usage_2")}
        </p>
      </section>

      <section id="TP-Portal">
        <h3>{t("tools_tp_portal_title")}</h3>
        <p>
          {t("tools_tp_portal_intro_1")}
          <br />
          {t("tools_tp_portal_intro_2_before")}
          <a href="#Bookmark-Manager">{t("tools_tp_portal_intro_2_link")}</a>
          {t("tools_tp_portal_intro_2_after")}
        </p>
        <h4>~{t("tools_usage_heading")}~</h4>
        <p>
          <a href="#DoubleHot">{t("tools_doublehot_title")}</a>{" "}
          {t("tools_usage_3")}
        </p>
      </section>

      <section id="Bookmark-Manager">
        <h3>{t("tools_bookmark_title")}</h3>
        <p>{t("tools_bookmark_intro")}</p>
        <h4>~{t("tools_usage_heading")}~</h4>
        <p>
          <a href="#DoubleHot">{t("tools_doublehot_title")}</a>{" "}
          {t("tools_usage_4")}
        </p>
      </section>

      <section id="Nightvision">
        <h3>{t("tools_nightvision_title")}</h3>
        <p>{t("tools_nightvision_intro")}</p>
        <h4>~{t("tools_usage_heading")}~</h4>
        <p>
          <a href="#DoubleHot">{t("tools_doublehot_title")}</a>{" "}
          {t("tools_usage_5")}
        </p>
      </section>
    </main>
  );
}
