import type { ElementType } from "react";

export function Raw({
  html,
  as: Tag = "span",
  ...rest
}: {
  html: string;
  as?: ElementType;
  [k: string]: unknown;
}) {
  return <Tag {...rest} dangerouslySetInnerHTML={{ __html: html }} />;
}
