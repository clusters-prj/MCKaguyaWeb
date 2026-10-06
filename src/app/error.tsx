"use client";

import { ErrorView } from "@/components/ErrorView";
import { useErrorLabels } from "@/components/ErrorLabels";

export default function ErrorPage() {
  const labels = useErrorLabels();
  if (!labels) return null;
  return (
    <>
      <title>{`500 - ${labels.title}`}</title>
      <meta name="robots" content="noindex" />
      <ErrorView labels={labels} />
    </>
  );
}
