import fs from "node:fs";
import path from "node:path";

export type MemberLink = { url: string; label: string };
export type Member = { name: string; roles: string[]; links: MemberLink[] };

const byteCompare = (a: string, b: string) =>
  Buffer.compare(Buffer.from(a), Buffer.from(b));

function parseCsv(text: string): string[][] {
  const rows: string[][] = [];
  let row: string[] = [];
  let field = "";
  let quoted = false;
  const src = text.replace(/^﻿/, "");
  for (let i = 0; i < src.length; i++) {
    const c = src[i];
    if (quoted) {
      if (c === '"') {
        if (src[i + 1] === '"') {
          field += '"';
          i++;
        } else quoted = false;
      } else field += c;
    } else if (c === '"') quoted = true;
    else if (c === ",") {
      row.push(field);
      field = "";
    } else if (c === "\n" || c === "\r") {
      if (c === "\r" && src[i + 1] === "\n") i++;
      row.push(field);
      field = "";
      if (row.length > 1 || row[0] !== "") rows.push(row);
      row = [];
    } else field += c;
  }
  if (field !== "" || row.length) {
    row.push(field);
    rows.push(row);
  }
  return rows;
}

const LABEL_PATTERNS: [string, string][] = [
  ["youtube", "YouTube"],
  ["youtu.be", "YouTube"],
  ["twitch", "Twitch"],
  ["tiktok", "TikTok"],
  ["bilibili", "bilibili"],
  ["nicovideo", "ニコニコ"],
  ["discord", "Discord"],
  ["github", "GitHub"],
];

function guessLinkLabel(url: string): string {
  let host = "";
  try {
    host = new URL(url).hostname.toLowerCase().replace(/^www\./, "");
  } catch {
    return "リンク";
  }
  if (host === "x.com" || host === "twitter.com") return "X/Twitter";
  for (const [needle, label] of LABEL_PATTERNS) {
    if (host.includes(needle)) return label;
  }
  return "リンク";
}

function parseMemberLinks(raw: string): MemberLink[] {
  const links: MemberLink[] = [];
  const parts = raw
    .trim()
    .split(/[\s　]+/)
    .filter(Boolean);
  for (let part of parts) {
    let label = "";
    const m = /^(.+?)[(（]([^)）]+)[)）]$/u.exec(part);
    if (m) {
      part = m[1];
      label = m[2].trim();
    }
    const lower = part.toLowerCase();
    let at = lower.indexOf("http://");
    if (at === -1) at = lower.indexOf("https://");
    if (at > 0) part = part.slice(at);
    if (!/^https?:\/\//i.test(part))
      part = "https://" + part.replace(/^\/+/, "");
    try {
      new URL(part);
    } catch {
      continue;
    }
    links.push({ url: part, label: label || guessLinkLabel(part) });
  }
  return links;
}

export function loadMembers(): { members: Member[]; roles: string[] } {
  const csv = fs.readFileSync(
    path.join(process.cwd(), "data/members.csv"),
    "utf8",
  );
  const rows = parseCsv(csv).slice(1);

  const members: Member[] = rows
    .filter((r) => r[0])
    .map((r) => ({
      name: r[0],
      roles: (r[2] ?? "")
        .replace(/,/g, "、")
        .split("、")
        .map((x) => x.trim())
        .filter(Boolean),
      links: parseMemberLinks(r[1] ?? ""),
    }))
    .sort((a, b) => byteCompare(a.name, b.name));

  const roles = [...new Set(members.flatMap((m) => m.roles))].sort(byteCompare);
  return { members, roles };
}
