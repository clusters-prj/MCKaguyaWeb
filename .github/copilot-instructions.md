# Next.js / TypeScript Coding Standards & Conventions

## 1. Architecture Rules

- **App Router**: ページは `src/app/` 配下に置く。ヘッダー・フッター付きのページは `src/app/(site)/` に配置し、エラーページ（`not-found.tsx` / `error.tsx`）のようにレイアウトを持たないものはその外に置く。
- **Server Components first**: 原則サーバーコンポーネントで書き、状態やイベントが必要な部分だけ `'use client'` の小さなコンポーネントに切り出す。
- **Import alias**: `src/` 内の import は `@/` エイリアスを使う。
- **Static assets**: CSS・画像・JS は `public/assets/` に置き、`/assets/...` で参照する。

## 2. Internationalization (i18n) & XSS Prevention

- **Translation Function**: テキスト出力には `const { t } = await getT()`（`@/lib/i18n`）で得た `t('key_name')` を使う。翻訳は `messages/<lang>.json` に追加し、全10言語にキーを揃える（`npm run check:lang` で検査）。
- **XSS Prevention**: 翻訳文は JSX の `{t('key')}` でそのまま出力する（自動でエスケープされる）。HTMLタグを含める特別な理由がある場合のみ `<Raw html={t('key')} />` を使う。
- **Language Detection**: 現在の言語は `getT()` が返す `lang` / `dir` を使う。`<html lang dir>` はルートレイアウトで設定済み。
- **Metadata**: 各ページは `generateMetadata = () => pageMetadata('/path', 'title_key', 'desc_key')` を定義し、canonical・hreflang・OGP を揃える。
- **Date Formatting**: 日付を出力する際は `lang` で分岐し、言語に応じたフォーマット（日本語なら `YYYY年M月D日`、英語等なら `YYYY-MM-DD`）を適用する。

## 3. HTML Markup & Semantics

- **Semantic HTML**: `<main>`, `<section>`, `<table>` などのセマンティックタグを適切に使用し、各セクションには構造に応じた `id` を付与する。
- **Internal links**: サイト内リンクは `next/link` の `Link` を使い、クリーンなURL（`/contact` など）で書く。
- **Page Structure**: `<main id="main-content">` の中に主要コンテンツを `<section>` ごとに整理する。ヘッダー・フッターは `(site)/layout.tsx` が付ける。
