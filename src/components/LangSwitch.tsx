"use client";

import { usePathname, useSearchParams } from "next/navigation";
import { LANG_NAMES, SUPPORTED_LANGS, type Lang } from "@/lib/site";

export function LangSwitch({
  current,
  label,
}: {
  current: Lang;
  label: string;
}) {
  const pathname = usePathname();
  const params = useSearchParams();
  const carry = [...(params?.entries() ?? [])].filter(
    ([key]) => key !== "lang",
  );

  return (
    <form className="lang-switch" method="get" action={pathname ?? "/"}>
      {carry.map(([key, value], i) => (
        <input key={`${key}-${i}`} type="hidden" name={key} value={value} />
      ))}
      <label htmlFor="lang-select" className="sr-only">
        {label}
      </label>
      <select
        id="lang-select"
        name="lang"
        defaultValue={current}
        onChange={(e) => e.currentTarget.form?.requestSubmit()}
      >
        {SUPPORTED_LANGS.map((code) => (
          <option key={code} value={code}>
            {LANG_NAMES[code]}
          </option>
        ))}
      </select>
      <noscript>
        <button type="submit">{label}</button>
      </noscript>
    </form>
  );
}
