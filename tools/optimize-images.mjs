/**
 * 画像の最適化スクリプト（開発用。サイトの実行時には使いません）。
 *
 *   npm install            # 初回のみ
 *   npm run optimize       # ドライラン: 変換後のサイズを表示するだけ（何も書き込まない）
 *   npm run optimize -- --write
 *   npm run optimize -- --write --delete-original assets/howtoconnect
 *
 * 動作:
 *   - PNG / JPEG を長辺 --max px 以内に縮小して WebP に変換（同じ場所に .webp を作成）
 *   - 既存の WebP は、縮小/再圧縮して小さくなる場合だけ上書き
 *   - 変換後のほうが小さくならないファイルは触らない
 *   - 元画像は既定で残す（--delete-original で削除）。ページ側の参照パスは書き換えないので、
 *     拡張子が変わった画像は参照箇所を手で直すこと。
 *
 * オプション:
 *   --write             実際に書き込む（省略時はドライラン）
 *   --delete-original   変換に成功した PNG/JPEG を削除する（--write が必要）
 *   --max <px>          長辺の上限（既定 1920）
 *   --quality <1-100>   WebP の品質（既定 80）
 *   対象ディレクトリ    省略時は assets/howtoconnect と assets/gallery
 */
import { readdir, readFile, writeFile, unlink } from 'node:fs/promises';
import { existsSync } from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import sharp from 'sharp';

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const args = process.argv.slice(2);

const flag = (name) => args.includes(name);
const option = (name, fallback) => {
  const i = args.indexOf(name);
  return i === -1 ? fallback : Number(args[i + 1]);
};
const valueIndexes = new Set(['--max', '--quality'].map((n) => args.indexOf(n) + 1).filter((i) => i > 0));
const dirs = args.filter((a, i) => !a.startsWith('--') && !valueIndexes.has(i));

const write = flag('--write');
const deleteOriginal = flag('--delete-original');
const maxSize = option('--max', 1920);
const quality = option('--quality', 80);

if (deleteOriginal && !write) {
  console.error('--delete-original は --write と一緒に指定してください。');
  process.exit(1);
}

const targets = (dirs.length ? dirs : ['assets/howtoconnect', 'assets/gallery']).map((d) => path.resolve(root, d));
const exts = new Set(['.png', '.jpg', '.jpeg', '.webp']);

async function* walk(dir) {
  for (const entry of await readdir(dir, { withFileTypes: true })) {
    const full = path.join(dir, entry.name);
    if (entry.isDirectory()) yield* walk(full);
    else if (exts.has(path.extname(entry.name).toLowerCase())) yield full;
  }
}

const mb = (n) => (n / 1048576).toFixed(2) + ' MB';
let before = 0;
let after = 0;

for (const dir of targets) {
  if (!existsSync(dir)) {
    console.warn(`スキップ（存在しません）: ${path.relative(root, dir)}`);
    continue;
  }
  for await (const file of walk(dir)) {
    const ext = path.extname(file).toLowerCase();
    const isWebp = ext === '.webp';
    const outFile = isWebp ? file : file.slice(0, -ext.length) + '.webp';
    const rel = path.relative(root, file);

    // 同名の .webp が既にある PNG/JPEG は二重変換しない
    if (!isWebp && existsSync(outFile)) {
      console.log(`skip   ${rel}（${path.basename(outFile)} が既にあります）`);
      continue;
    }

    const input = await readFile(file);
    const output = await sharp(input)
      .rotate()
      .resize({ width: maxSize, height: maxSize, fit: 'inside', withoutEnlargement: true })
      .webp({ quality, effort: 5 })
      .toBuffer();

    before += input.length;
    if (output.length >= input.length) {
      after += input.length;
      console.log(`keep   ${rel}  ${mb(input.length)}（変換しても小さくならない）`);
      continue;
    }
    after += output.length;

    const saved = Math.round((1 - output.length / input.length) * 100);
    console.log(`${write ? 'write ' : 'would '} ${rel}  ${mb(input.length)} -> ${mb(output.length)} (-${saved}%)`);

    if (write) {
      await writeFile(outFile, output);
      if (deleteOriginal && !isWebp) await unlink(file);
    }
  }
}

console.log(`\n合計: ${mb(before)} -> ${mb(after)}${write ? '' : '（ドライラン: 何も書き込んでいません）'}`);
