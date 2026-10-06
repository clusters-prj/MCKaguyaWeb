# MCツクヨミ制作委員会 公式サイト

MCツクヨミ制作委員会の公式ウェブサイトです。Minecraft上に「超かぐや姫！」の舞台・ツクヨミを再現するプロジェクトや、コミュニティの活動を紹介します。

## 必要な環境

- Node.js 20以降
- Webブラウザー

## 開発・起動

```bash
npm install
npm run dev     # 開発サーバー (http://localhost:3000)
npm run build   # 本番ビルド
npm run start   # 本番サーバー（build後。PORT環境変数でポート変更）
```

## 主な構成

- `src/app/` — Next.js (App Router) のページ。`(site)/` 配下がヘッダー・フッター付きの通常ページ
- `src/components/` — 共通ヘッダー、フッター、言語切り替えなどのコンポーネント
- `src/lib/` — 言語判定・メタデータ・メンバー一覧／トップページデータの読み込み
- `src/middleware.ts` — `?lang=` のCookie保存とパス情報の受け渡し
- `messages/` — 多言語テキスト（10言語、`ja.json` が基準）
- `public/` — CSS、JavaScript、画像、robots.txt など（`/assets/...` として配信）
- `data/homepage.json` — トップページの内容（`tools/editor.php` で編集）
- `data/members.csv` — 協力者一覧
- `tools/` — 開発用ツール

## よく使うコマンド

```bash
npm run check:lang   # 翻訳キーの過不足と、ソース内で使われているキーの存在を検査
npm run typecheck    # TypeScriptの型チェック
npm run optimize     # 画像の最適化（ドライラン）
```

## 運用上の注意

サイトは Node.js サーバーで動作します（以前の PHP + Apache 構成とは異なります）。旧URL（`/index.php`、`/pages/*.php`）は新URLへ恒久リダイレクトします。デプロイは手動です。ライセンスは設定しておらず、著作権は権利者に帰属します。
