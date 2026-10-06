export type ErrorCode = 403 | 404 | 500;

const HINTS: Record<ErrorCode, string[]> = {
  403: ["error_hint_url", "error_hint_permission", "error_hint_contact"],
  404: ["error_hint_url", "error_hint_removed", "error_hint_contact"],
  500: ["error_hint_retry", "error_hint_contact"],
};

export type ErrorLabels = ReturnType<typeof errorLabels>;

export function errorLabels(t: (key: string) => string, code: ErrorCode) {
  return {
    code,
    title: t(`error_${code}_title`),
    description: t(`error_${code}_desc`),
    hints: HINTS[code].map((key) => t(key)),
    whatToDo: t("error_what_to_do"),
    goHome: t("error_go_home"),
    browse: t("error_browse_menu"),
    contact: t("error_contact"),
    goBack: t("error_go_back"),
    faq: t("error_faq"),
    codeLabel: t("error_code_label"),
  };
}
