"use client";

import type { ReactNode } from "react";

export function ErrorBackButton({ children }: { children: ReactNode }) {
  return (
    <button
      className="btn"
      id="go-back"
      type="button"
      onClick={() => {
        if (window.history.length > 1) window.history.back();
        else window.location.href = "/";
      }}
    >
      {children}
    </button>
  );
}
