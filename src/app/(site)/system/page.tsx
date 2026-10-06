import type { Metadata } from "next";
import { SITE_URL } from "@/lib/site";

export const metadata: Metadata = {
  metadataBase: new URL(SITE_URL),
  title: { absolute: "サーバー構成 - 超かぐや姫！再現プロジェクト" },
  alternates: { canonical: "/system" },
};

const css = `
.system-card { background: var(--card-bg); border-left: 5px solid var(--primary-color); padding: 15px; margin-bottom: 20px; border-radius: 8px; box-shadow: var(--shadow); color: var(--text-main); }
.system-card h3 { margin-top: 0; color: var(--primary-color); }
.tech-tag { display: inline-block; background: var(--table-th-bg); color: var(--text-main); padding: 2px 8px; border-radius: 999px; font-size: 0.9em; margin-right: 5px; margin-bottom: 5px; border: 1px solid var(--border-color); }
`;

export default function SystemPage() {
  return (
    <>
      <style>{css}</style>
      <main id="main-content">
        <section id="system-overview">
          <h2>サーバーシステム構成</h2>
          <p>
            本プロジェクトを支えるインフラおよびソフトウェアの構成詳細です。
          </p>

          <div className="system-card">
            <h3>インフラストラクチャ</h3>
            <p>安定した動作と柔軟な管理のため、仮想化環境を採用しています。</p>
            <span className="tech-tag">Proxmox VE</span>
            <span className="tech-tag">Ubuntu Server</span>
            <span className="tech-tag">自宅サーバー</span>
          </div>

          <div className="system-card">
            <h3>ネットワーク・プロキシ</h3>
            <p>
              Velocityをフロントエンドに配置し、複数のバックエンドサーバーを統合しています。
            </p>
            <span className="tech-tag">Velocity (Proxy)</span>
            <span className="tech-tag">Paper (Backend)</span>
            <span className="tech-tag">MariaDB (Database)</span>
          </div>

          <div className="system-card">
            <h3>主要プラグイン構成</h3>
            <p>「超かぐや姫！」の世界を再現するための基幹システムです。</p>
            <ul>
              <li>
                <strong>LuckPerms:</strong> 高度な権限管理システム
              </li>
              <li>
                <strong>MythicMobs:</strong> ボスや特殊Mobの挙動制御
              </li>
              <li>
                <strong>ModelEngine:</strong> 独自3Dモデルのレンダリング
              </li>
              <li>
                <strong>WorldGuard/Edit:</strong> 地形保護および大規模造形
              </li>
            </ul>
          </div>

          <div className="system-card">
            <h3>Web・配信システム</h3>
            <p>進捗公開および管理用Webサーバーの構成です。</p>
            <span className="tech-tag">Next.js</span>
            <span className="tech-tag">Node.js</span>
            <span className="tech-tag">TypeScript</span>
          </div>
        </section>

        <section id="spec">
          <h3>ハードウェアスペック</h3>
          <table>
            <tbody>
              <tr>
                <th>CPU</th>
                <td>Intel Core i7 相当 (仮想割り当て)</td>
              </tr>
              <tr>
                <th>RAM</th>
                <td>4+4GB DDR4</td>
              </tr>
              <tr>
                <th>Storage</th>
                <td>HDD/NVMe SSD</td>
              </tr>
              <tr>
                <th>OS</th>
                <td>Linux (Ubuntu based)</td>
              </tr>
            </tbody>
          </table>
        </section>
      </main>
    </>
  );
}
