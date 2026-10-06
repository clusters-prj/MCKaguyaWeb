import Link from "next/link";
import type { Metadata } from "next";
import { SITE_URL } from "@/lib/site";

export const metadata: Metadata = {
  metadataBase: new URL(SITE_URL),
  title: { absolute: "経済システムの解説 - 超かぐや姫！再現プロジェクト" },
  description:
    "かぐや鯖の経済システム（FJEconomy）の使い方を解説します。ゲーム内コマンド、Webダッシュボード、アリーナの賞金・ベット機能まで。",
  alternates: { canonical: "/gameinfo/economy" },
};

const css =
  ".eco-card {\r background: var(--card-bg);\r border-left: 5px solid var(--primary-color);\r padding: 15px;\r margin-bottom: 20px;\r border-radius: 8px;\r box-shadow: var(--shadow);\r color: var(--text-main);\r }\r .eco-card h3 {\r margin-top: 0;\r color: var(--primary-color);\r }\r .cmd {\r display: inline-block;\r background: var(--table-th-bg);\r color: var(--text-main);\r padding: 2px 8px;\r border-radius: 6px;\r font-family: monospace;\r border: 1px solid var(--border-color);\r }";

export default function Page() {
  return (
    <>
      <style>{css}</style>
      <main id="main-content">
        <section id="overview">
          <h2>経済システムの解説</h2>
          <p>
            かぐや鯖には、プレイヤー間の売買・送金・税金・国庫（政府口座）を扱う独自の経済システム
            「<strong>FJEconomy</strong>
            」が導入されています。残高や価格はすべて整数（円）で管理され、
            Minecraft内のコマンドと、Web上の管理画面「
            <strong>ふじゅ〜ペイ</strong>」の両方から操作できます。
          </p>
        </section>

        <section id="commands">
          <h3>ゲーム内コマンド</h3>
          <div className="eco-card">
            <h3>基本操作</h3>
            <ul>
              <li>
                <span className="cmd">/fj balance</span> 自分の残高を確認します
              </li>
              <li>
                <span className="cmd">
                  /fj pay &lt;プレイヤー名&gt; &lt;金額&gt;
                </span>{" "}
                他のプレイヤーに送金します
              </li>
              <li>
                <span className="cmd">/fj link</span>{" "}
                Webダッシュボードとアカウントを連携するための6桁コードを発行します
              </li>
            </ul>
          </div>
          <div className="eco-card">
            <h3>ショップ</h3>
            <p>
              <span className="cmd">/shop</span>（エイリアス:{" "}
              <span className="cmd">/s</span>）でショップ用GUIを開けます。
              自分のショップの作成・価格変更・在庫管理ができ、購入時には自動で税金が政府口座へ徴収されます。
            </p>
          </div>
          <div className="eco-card">
            <h3>政府口座・税金</h3>
            <p>
              ショップでの取引には設定された税率が課され、税収は政府口座（国庫）にプールされます。
              政府口座からの給付金配布などは{" "}
              <span className="cmd">/fjegovernment</span>（エイリアス:{" "}
              <span className="cmd">/gov</span>）で運営が行います。
              政府の収支は誰でも確認可能で、Webダッシュボードや外部APIから参照できます。
            </p>
          </div>
          <div className="eco-card">
            <h3>ログインボーナス</h3>
            <p>
              ログインすると一定間隔でログインボーナスが自動的に付与されます。
            </p>
          </div>
        </section>

        <section id="web">
          <h3>Webダッシュボード「ふじゅ〜ペイ」</h3>
          <p>
            ゲーム内で <span className="cmd">/fje link</span>{" "}
            を実行して表示される6桁コードを入力すると、
            Webアカウントとマイクラアカウントを連携できます。連携後は以下がWeb上から行えます。
          </p>
          <ul>
            <li>残高確認・送金・取引履歴の閲覧</li>
            <li>
              <strong>法人口座</strong>
              ：実在のマイクラアカウントに紐づかない、商店や団体専用の仮想口座を最大5個まで作成できます（設定画面）
            </li>
            <li>
              法人口座向けの<strong>APIキー発行</strong>
              （詳しくは下記「外部APIについて」を参照）
            </li>
          </ul>
        </section>

        <section id="arena">
          <h3>アリーナ（闘技場）</h3>
          <p>
            運営が管理画面から座標・半径・対戦カード・優勝賞金を設定すると、その円形エリア内で
            対象プレイヤー同士がキルを決めた時点で自動的に試合が成立します。
          </p>
          <ul>
            <li>
              試合が始まると対象プレイヤーはサバイバルモードになり、持ち物は退避されます（試合終了後に自動返却）
            </li>
            <li>対戦者以外はエリアに立ち入れません</li>
            <li>エリア内では対戦者同士のPvPが許可されます</li>
            <li>優勝すると政府口座から賞金が支払われます</li>
            <li>
              他のプレイヤーはWeb上から優勝者を予想してベットに参加でき、的中者には賭け金プールが配分されます
            </li>
          </ul>
        </section>

        <section id="api-link">
          <h3>外部APIについて</h3>
          <p>
            経済データや送金機能は外部プログラム・Botからも利用できる公開APIとして提供されています。
            詳しい使い方は下記のAPI利用ガイドをご覧ください。
          </p>
          <p>
            <Link href="/gameinfo/economy-api">→ API利用ガイドを見る</Link>
          </p>
        </section>
      </main>
    </>
  );
}
