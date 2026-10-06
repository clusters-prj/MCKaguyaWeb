import Link from "next/link";
import type { Metadata } from "next";
import { SITE_URL } from "@/lib/site";

export const metadata: Metadata = {
  metadataBase: new URL(SITE_URL),
  title: {
    absolute: "経済システム API利用ガイド - 超かぐや姫！再現プロジェクト",
  },
  description:
    "fjeapiの公開エンドポイントとAPIキー認証付きエンドポイントの使い方をまとめた開発者向けガイドです。",
  alternates: { canonical: "/gameinfo/economy-api" },
};

const css =
  ".api-card {\r background: var(--card-bg);\r border-left: 5px solid var(--primary-color);\r padding: 15px;\r margin-bottom: 20px;\r border-radius: 8px;\r box-shadow: var(--shadow);\r color: var(--text-main);\r }\r .api-card h3 {\r margin-top: 0;\r color: var(--primary-color);\r }\r .endpoint-table {\r width: 100%;\r border-collapse: collapse;\r }\r .endpoint-table th, .endpoint-table td {\r border: 1px solid var(--border-color);\r padding: 6px 10px;\r text-align: left;\r font-size: 0.9em;\r }\r .endpoint-table th {\r background: var(--table-th-bg);\r }\r .method {\r display: inline-block;\r padding: 1px 6px;\r border-radius: 4px;\r font-family: monospace;\r font-weight: bold;\r font-size: 0.85em;\r }\r .method-get { background: #2b6cb0; color: #fff; }\r .method-post { background: #2f855a; color: #fff; }\r pre {\r background: var(--table-th-bg);\r color: var(--text-main);\r border: 1px solid var(--border-color);\r border-radius: 8px;\r padding: 12px;\r overflow-x: auto;\r font-size: 0.85em;\r }\r code {\r font-family: monospace;\r }\r .notice {\r background: var(--card-bg);\r border-left: 5px solid #d69e2e;\r padding: 12px 15px;\r border-radius: 8px;\r margin-bottom: 20px;\r }";

export default function Page() {
  return (
    <>
      <style>{css}</style>
      <main id="main-content">
        <section id="overview">
          <h2>経済システム API利用ガイド</h2>
          <p>
            かぐや鯖の経済データは、外部プログラムやBotから利用できる公開API（
            <strong>fjeapi</strong>）としても
            提供されています。ベースURLは以下です。
          </p>
          <pre>
            <code>{"https://fjeapi.clusters-prj.com"}</code>
          </pre>
          <div className="notice">
            <p>
              このAPIは常時稼働を保証するものではありません。運営都合でサーバーが停止している場合、
              一時的にアクセスできないことがあります。ご了承ください。
            </p>
          </div>
        </section>

        <section id="public">
          <h3>公開エンドポイント（認証不要・GETのみ）</h3>
          <p>誰でも呼び出せる読み取り専用のエンドポイントです。</p>
          <div className="api-card">
            <table className="endpoint-table">
              <thead>
                <tr>
                  <th>メソッド</th>
                  <th>パス</th>
                  <th>内容</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/economy/balance/:uuid</code>
                  </td>
                  <td>指定UUIDの残高・プレイヤー名を取得</td>
                </tr>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/economy/ranking</code>
                  </td>
                  <td>残高ランキングTOP100（政府口座を除く）</td>
                </tr>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/shops</code>
                  </td>
                  <td>
                    全ショップ一覧（<code>?item=</code>・
                    <code>?server_id=</code>で絞り込み可）
                  </td>
                </tr>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/shops/owner/:uuid</code>
                  </td>
                  <td>指定オーナーのショップ一覧</td>
                </tr>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/transactions</code>
                  </td>
                  <td>直近100件の全取引履歴</td>
                </tr>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/transactions/player/:uuid</code>
                  </td>
                  <td>指定プレイヤーが関わった取引履歴（直近50件）</td>
                </tr>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/analytics/shop/:uuid</code>
                  </td>
                  <td>指定オーナーの日別売上統計（直近30日）</td>
                </tr>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/admin/economy/summary</code>
                  </td>
                  <td>市場流通額・政府準備金・徴税総額のサマリー</td>
                </tr>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/admin/government/ledger</code>
                  </td>
                  <td>政府収支台帳（直近100件）</td>
                </tr>
              </tbody>
            </table>
          </div>
          <p>
            例：
            <code>GET https://fjeapi.clusters-prj.com/api/economy/ranking</code>
          </p>
        </section>

        <section id="apikey">
          <h3>APIキーの入手方法</h3>
          <p>
            自分の口座の残高・送金など、認証が必要なエンドポイントを使うにはAPIキーが必要です。
            APIキーは1つのマイクラアカウント（またはWeb上の
            <strong>法人口座</strong>）に紐づき、
            そのアカウント本人としてしか操作できません。
          </p>
          <div className="api-card">
            <h3>法人口座の場合（誰でも自分で発行可能）</h3>
            <ol>
              <li>
                「ふじゅ〜ペイ」にログインし、設定画面で法人口座を作成する
              </li>
              <li>
                作成した法人口座の「新規発行」ボタンを押すと、その場でAPIキーが表示される
              </li>
              <li>表示は一度きりなので、必ずその場でコピーして保管する</li>
            </ol>
          </div>
          <div className="api-card">
            <h3>実在のマイクラアカウント本人の場合</h3>
            <p>
              こちらは誤発行・アカウント乗っ取りのリスクがあるため自己発行はできません。
              運営（管理者）に発行を依頼してください。
            </p>
          </div>
        </section>

        <section id="authenticated">
          <h3>認証が必要なエンドポイント</h3>
          <p>
            <code>Authorization: Bearer &lt;APIキー&gt;</code>{" "}
            ヘッダーを付けて呼び出します。
            いずれもキーに紐づくアカウント本人のデータのみ操作でき、他人のUUIDを指定することはできません。
            また、1分間あたり60リクエストのレート制限があります。
          </p>
          <div className="api-card">
            <table className="endpoint-table">
              <thead>
                <tr>
                  <th>メソッド</th>
                  <th>パス</th>
                  <th>内容</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/v1/wallet/me</code>
                  </td>
                  <td>自分の残高・プレイヤー名を取得</td>
                </tr>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/v1/wallet/transactions</code>
                  </td>
                  <td>自分の取引履歴（直近50件）</td>
                </tr>
                <tr>
                  <td>
                    <span className="method method-get">GET</span>
                  </td>
                  <td>
                    <code>/api/v1/wallet/analytics</code>
                  </td>
                  <td>自分の日別売上統計（直近30日）</td>
                </tr>
                <tr>
                  <td>
                    <span className="method method-post">POST</span>
                  </td>
                  <td>
                    <code>/api/v1/wallet/send</code>
                  </td>
                  <td>自分の口座から送金する</td>
                </tr>
              </tbody>
            </table>
          </div>

          <h4>残高を確認する</h4>
          <pre>
            <code>
              {
                'curl https://fjeapi.clusters-prj.com/api/v1/wallet/me \\\r\n  -H "Authorization: Bearer fjp_xxxxxxxxxxxxxxxx"'
              }
            </code>
          </pre>

          <h4>送金する</h4>
          <p>
            <code>to_player</code>{" "}
            にはプレイヤー名またはUUIDのどちらでも指定できます。
            <code>amount</code> は整数（円）のみで、小数は使えません。
          </p>
          <pre>
            <code>
              {
                'curl -X POST https://fjeapi.clusters-prj.com/api/v1/wallet/send \\\r\n  -H "Authorization: Bearer fjp_xxxxxxxxxxxxxxxx" \\\r\n  -H "Content-Type: application/json" \\\r\n  -d \'{"to_player": "プレイヤー名", "amount": 1000}\''
              }
            </code>
          </pre>
        </section>

        <section id="notes">
          <h3>注意事項</h3>
          <ul>
            <li>
              APIキーは絶対に公開リポジトリやDiscordなどに貼らないでください。第三者に知られると、そのアカウントとして送金されてしまいます。
            </li>
            <li>
              APIキーを紛失・流出させた場合は、法人口座なら設定画面からいつでも失効できます。実在アカウントの分は運営に連絡してください。
            </li>
            <li>
              送金APIで作られる取引は <code>item_id: BOT_TRANSFER</code>{" "}
              として記録され、通常の送金と区別できます。
            </li>
          </ul>
        </section>

        <p>
          <Link href="/gameinfo/economy">← 経済システムの解説にもどる</Link>
        </p>
      </main>
    </>
  );
}
