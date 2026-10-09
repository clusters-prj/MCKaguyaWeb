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
.system-3d { display: block; width: 100%; height: 760px; max-height: 85vh; border: 1px solid var(--border-color); border-radius: 8px; margin-bottom: 20px; background: #0a0d1a; }
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
            <h3>3Dマップで見る構成</h3>
            <p>
              自宅のProxmox 4ノードと、外部データセンターの間借りコンテナを、Cloudflare
              Tunnelでつないでいます。ドラッグで回転、部品や線をタップすると解説が出ます。
            </p>
            <span className="tech-tag">Proxmox VE</span>
            <span className="tech-tag">Cloudflare Tunnel</span>
            <span className="tech-tag">Velocity (Proxy)</span>
            <span className="tech-tag">Paper (Backend)</span>
            <span className="tech-tag">MariaDB (Database)</span>
          </div>

          <iframe
            src="/system-3d.html"
            title="サーバー構成の3Dマップ"
            loading="lazy"
            className="system-3d"
          />

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
      </main>
    </>
  );
}
