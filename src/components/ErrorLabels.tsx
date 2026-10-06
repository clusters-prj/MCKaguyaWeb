"use client";

import { createContext, useContext, type ReactNode } from "react";
import type { ErrorLabels } from "@/lib/errorLabels";

const Ctx = createContext<ErrorLabels | null>(null);

export function ErrorLabelsProvider({
  value,
  children,
}: {
  value: ErrorLabels;
  children: ReactNode;
}) {
  return <Ctx.Provider value={value}>{children}</Ctx.Provider>;
}

export function useErrorLabels(): ErrorLabels | null {
  return useContext(Ctx);
}
