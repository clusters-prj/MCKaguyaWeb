import { History } from "@/components/History";
import { getT } from "@/lib/i18n";
import { pageMetadata } from "@/lib/metadata";

export const generateMetadata = () =>
  pageMetadata("/progress", "progress_page_title", "progress_intro");

const css = `
.progress-container { margin-bottom: 20px; }
.progress-bar-bg { background-color: #e0e0e0; border-radius: 8px; height: 20px; width: 100%; overflow: hidden; }
.progress-bar-fill { background-color: #4caf50; height: 100%; text-align: center; color: white; font-size: 12px; line-height: 20px; }
`;

export default async function ProgressPage() {
  const { t } = await getT();
  return (
    <>
      <style>{css}</style>
      <main id="main-content">
        <section id="progress-detail">
          <h2>{t("progress_heading")}</h2>
          <p>{t("progress_intro")}</p>

          <div className="progress-container">
            <h4>{t("progress_water_stage")}</h4>
            <div className="progress-bar-bg">
              <div className="progress-bar-fill" style={{ width: "90%" }}>
                {t("progress_water_stage_status")}
              </div>
            </div>
            <p>{t("progress_water_stage_detail")}</p>

            <h4>{t("progress_tsukuyomi_town")}</h4>
            <div className="progress-bar-bg">
              <div className="progress-bar-fill" style={{ width: "40%" }}>
                {t("progress_tsukuyomi_town_status")}
              </div>
            </div>
            <p>{t("progress_tsukuyomi_town_detail")}</p>
          </div>
        </section>

        <section id="history">
          <History />
        </section>
      </main>
    </>
  );
}
