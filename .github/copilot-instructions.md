# PHP / HTML Coding Standards & Conventions

## 1. PHP & Architecture Rules

- **Include Paths**: テンプレートや include ファイルを読み込む際は、必ず `$_SERVER['DOCUMENT_ROOT']` を起算とした絶対パスを使用してください。
  - 例: `require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/i18n.php';`
  - 例: `include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';`
- **Component Separation**: ヘッダー、フッター、共通パーツ（履歴など）は `/templates/` 配下に分離し、`include` で読み込んでください。

## 2. Internationalization (i18n) & XSS Prevention

- **Translation Function**: テキスト出力には `t('key_name')` 関数を使用してください。
- **XSS Prevention**: 原則として、翻訳関数や動的テキストを出力する際は `h()` エスケープ関数で囲んでください。
  - 例: `<?= h(t('site_title')) ?>`
  - ※HTMLタグを含める特別な理由がある場合のみ `t()` 単体で出力します。
- **Language Detection**: 現在の言語判定には `current_lang()` を使用してください。
  - 例: `<html lang="<?= current_lang() ?>">`
- **Date Formatting**: 日付を出力する際は `current_lang()` で分岐し、言語に応じたフォーマット（日本語なら `YYYY年M月D日`、英語等なら `YYYY-MM-DD`）を適用してください。

## 3. HTML Markup & Semantics

- **Semantic HTML**: `<main>`, `<section>`, `<table>` などのセマンティックタグを適切に使用し、各セクションには構造に応じた `id` を付与してください。
- **Dark Mode Support**: ヘッダー画像などのビジュアル要素には `<picture>` タグを使用し、`(prefers-color-scheme: dark)` に対応した画像を個別に指定してください。
- **Page Structure**:
  1. `<head>` 内で i18n 対応の title と description を指定
  2. `header.php` のインクルード
  3. `<main>` 要素内に主要コンテンツを `<section>` ごとに整理
  4. `footer.php` のインクルード
