import Link from "next/link";
import { Raw } from "@/components/Raw";
import { getT } from "@/lib/i18n";
import { pageMetadata } from "@/lib/metadata";

export const generateMetadata = () =>
  pageMetadata("/gameinfo", "gameinfo_page_title", "gameinfo_intro");

export default async function GameInfoPage() {
  const { t } = await getT();
  return (
    <main id="main-content">
      <section id="overview">
        <h2>{t("gameinfo_heading")}</h2>
        <p>{t("gameinfo_intro")}</p>
      </section>
      <section id="links">
        <h3>{t("gameinfo_connect_title")}</h3>
        <p>{t("gameinfo_connect_info")}</p>
        <p>
          <Link href="/gameinfo/connect">{t("gameinfo_connect_link")}</Link>
        </p>

        <h3>{t("gameinfo_tools_title")}</h3>
        <p>{t("gameinfo_tools_info")}</p>
        <p>
          <Link href="/gameinfo/tools">{t("gameinfo_tools_link")}</Link>
        </p>

        <h3>{t("gameinfo_build_manual_title")}</h3>
        <p>
          <Link href="/gameinfo/build-manual">
            {t("gameinfo_build_manual_link")}
          </Link>
        </p>

        <h3>{t("gameinfo_wra_title")}</h3>
        <p>{t("gameinfo_wra_info")}</p>
        <p>
          <Link href="/gameinfo/wra">{t("gameinfo_wra_link")}</Link>
        </p>

        <h3>{t("gameinfo_economy_title")}</h3>
        <p>{t("gameinfo_economy_info")}</p>
        <p>
          <Link href="/gameinfo/economy">{t("gameinfo_economy_link")}</Link>
        </p>

        <h3>{t("gameinfo_status_title")}</h3>
        <Raw as="p" html={t("gameinfo_status_info")} />
        <p>
          <a
            href="https://uptime.clusters-prj.com/status/ms-k"
            target="_blank"
            rel="noopener noreferrer"
          >
            {" "}
            <Raw html={t("gameinfo_status_link")} />
          </a>
        </p>

        <h3>{t("gameinfo_map_title")}</h3>
        <p>{t("gameinfo_map_info")}</p>
        <p>
          <a
            href="https://map-town-kaguya.clusters-prj.com/"
            target="_blank"
            rel="noopener noreferrer"
          >
            {t("gameinfo_map_town_link")}
          </a>
        </p>
      </section>
    </main>
  );
}
