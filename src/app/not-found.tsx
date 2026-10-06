import type { Metadata } from "next";
import { ErrorView } from "@/components/ErrorView";
import { errorLabels } from "@/lib/errorLabels";
import { getT } from "@/lib/i18n";

export async function generateMetadata(): Promise<Metadata> {
  const { t } = await getT();
  return { title: `404 - ${t("error_404_title")}`, robots: { index: false } };
}

export default async function NotFound() {
  const { t } = await getT();
  return <ErrorView labels={errorLabels(t, 404)} />;
}
