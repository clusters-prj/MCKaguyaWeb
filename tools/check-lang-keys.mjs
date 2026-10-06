// messages/*.json のキーの過不足を検査する CI 用スクリプト。
//   node tools/check-lang-keys.mjs
// 基準は messages/ja.json。足りないキーは画面に [[key]] と出てしまい、
// 余分なキーは使われていない翻訳（多くは名前の打ち間違い）になる。
// 加えて、src 内で t('...') と書かれたキーが ja.json に存在するかも確認する。

import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");
const dir = path.join(root, "messages");
const base = "ja";

const files = fs
  .readdirSync(dir)
  .filter((f) => f.endsWith(".json"))
  .sort();
if (!files.length) {
  console.error("messages ディレクトリに翻訳ファイルが見つかりません");
  process.exit(1);
}

const load = (file) =>
  JSON.parse(fs.readFileSync(path.join(dir, file), "utf8"));
const baseKeys = new Set(Object.keys(load(`${base}.json`)));
let failed = false;

for (const file of files) {
  if (file === `${base}.json`) continue;
  const keys = new Set(Object.keys(load(file)));
  const missing = [...baseKeys].filter((k) => !keys.has(k));
  const extra = [...keys].filter((k) => !baseKeys.has(k));
  if (missing.length || extra.length) {
    failed = true;
    console.log(file);
    missing.forEach((k) => console.log(`  - 不足: ${k}`));
    extra.forEach((k) => console.log(`  - 余分: ${k}`));
  }
}

const walk = (d) =>
  fs.readdirSync(d, { withFileTypes: true }).flatMap((e) => {
    const p = path.join(d, e.name);
    return e.isDirectory() ? walk(p) : /\.(ts|tsx)$/.test(e.name) ? [p] : [];
  });

const unknown = new Map();
for (const file of walk(path.join(root, "src"))) {
  const src = fs.readFileSync(file, "utf8");
  for (const m of src.matchAll(/\bt\(\s*'([A-Za-z0-9_]+)'/g)) {
    if (!baseKeys.has(m[1])) unknown.set(m[1], path.relative(root, file));
  }
}
if (unknown.size) {
  failed = true;
  console.log("ソース内で使われているが ja.json に無いキー:");
  for (const [k, f] of unknown) console.log(`  - ${k} (${f})`);
}

if (failed) process.exit(1);
console.log(`OK: ${files.length} 言語, ${baseKeys.size} キー`);
