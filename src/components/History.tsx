import { getT } from "@/lib/i18n";
import { Raw } from "./Raw";

export async function History() {
  const { t } = await getT();
  return (
    <>
      <h3>{t("index_history_h3")}</h3>
      <ul>
        <li>2026/07/22 - {t("history_9")}</li>
        <li>2026/07/20 - {t("history_8")}</li>
        <li>
          2026/06/28 - <Raw html={t("history_7")} />
        </li>
        <li>2026/05/29 - {t("history_6")}</li>
        <li>2026/04/17 - {t("history_5")}</li>
        <li>2026/04/04 - {t("history_4")}</li>
        <li>2026/03/30 - {t("history_3")}</li>
        <li>2026/03/30 - {t("history_2")}</li>
        <li>
          <strong>2026/03/28 - {t("history_1")}</strong>
        </li>
      </ul>
    </>
  );
}
