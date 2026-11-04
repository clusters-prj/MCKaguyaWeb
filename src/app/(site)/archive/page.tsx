import fs from "node:fs";
import path from "node:path";
import Link from "next/link";
import { History } from "@/components/History";
import { getT } from "@/lib/i18n";
import { pageMetadata } from "@/lib/metadata";

export const generateMetadata = () =>
  pageMetadata("/archive", "archive_page_title", "archive_notice_body");

type Download = { labelKey: string; url: string };

/** data/archive.json の downloads。url が空なら「準備中」と表示する。 */
function loadDownloads(): Download[] {
  try {
    const raw = fs.readFileSync(
      path.join(process.cwd(), "data/archive.json"),
      "utf8",
    );
    const list = JSON.parse(raw)?.downloads;
    return Array.isArray(list) ? list : [];
  } catch {
    return [];
  }
}

function loadGalleryImages(): string[] {
  try {
    return fs
      .readdirSync(path.join(process.cwd(), "public/assets/gallery"))
      .filter((f) => f.endsWith(".webp"))
      .sort((a, b) => parseInt(a) - parseInt(b));
  } catch {
    return [];
  }
}

const css = `
.archive-notice { border-left: 4px solid #d17b70; }
.archive-gallery { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 10px; margin-top: 12px; }
.archive-gallery a { display: block; overflow: hidden; border-radius: 6px; line-height: 0; }
.archive-gallery img { width: 100%; height: auto; aspect-ratio: 16 / 9; object-fit: cover; transition: transform .2s; }
.archive-gallery a:hover img, .archive-gallery a:focus-visible img { transform: scale(1.04); }
.archive-final .progress-container { margin-bottom: 8px; }
.progress-bar-bg { background-color: #e0e0e0; border-radius: 8px; height: 20px; width: 100%; overflow: hidden; }
.progress-bar-fill { background-color: #4caf50; height: 100%; text-align: center; color: white; font-size: 12px; line-height: 20px; }
`;

export default async function ArchivePage() {
  const { t } = await getT();
  const images = loadGalleryImages();
  const downloads = loadDownloads();

  return (
    <>
      <style>{css}</style>
      <main id="main-content">
        <section id="overview" className="archive-notice">
          <h2>{t("archive_heading")}</h2>
          <h3>{t("archive_notice_title")}</h3>
          <p>{t("archive_notice_body")}</p>
        </section>

        <section id="gallery">
          <h3>{t("archive_gallery_title")}</h3>
          <p>{t("archive_gallery_info")}</p>
          <div className="archive-gallery">
            {images.map((file) => (
              <a
                key={file}
                href={`/assets/gallery/${file}`}
                target="_blank"
                rel="noopener noreferrer"
              >
                <img
                  src={`/assets/gallery/${file}`}
                  alt={t("archive_gallery_alt")}
                  width="1280"
                  height="720"
                  loading="lazy"
                />
              </a>
            ))}
          </div>
        </section>

        <section id="final" className="archive-final">
          <h3>{t("archive_final_title")}</h3>
          <p>{t("archive_final_info")}</p>
          <div className="progress-container">
            <h4>{t("progress_water_stage")}</h4>
            <div className="progress-bar-bg">
              <div className="progress-bar-fill" style={{ width: "90%" }}>
                90%
              </div>
            </div>
            <h4>{t("progress_tsukuyomi_town")}</h4>
            <div className="progress-bar-bg">
              <div className="progress-bar-fill" style={{ width: "40%" }}>
                40%
              </div>
            </div>
          </div>
        </section>

        <section id="history">
          <History />
        </section>

        <section id="downloads">
          <h3>{t("archive_download_title")}</h3>
          <p>{t("archive_download_info")}</p>
          <ul>
            {downloads.map((d) => (
              <li key={d.labelKey}>
                {t(d.labelKey)} -{" "}
                {d.url ? (
                  <a href={d.url} target="_blank" rel="noopener noreferrer">
                    {t("archive_dl_link")}
                  </a>
                ) : (
                  t("archive_dl_preparing")
                )}
              </li>
            ))}
          </ul>
          <p>
            <Link href="/copyright">{t("archive_copyright_note")}</Link>
          </p>
        </section>

        <section id="docs">
          <h3>{t("archive_docs_title")}</h3>
          <p>{t("archive_docs_info")}</p>
          <ul>
            <li>
              <Link href="/gameinfo/connect">
                {t("gameinfo_connect_title")}
              </Link>
            </li>
            <li>
              <Link href="/gameinfo/build-manual">
                {t("gameinfo_build_manual_title")}
              </Link>
            </li>
            <li>
              <Link href="/gameinfo/wra">{t("gameinfo_wra_title")}</Link>
            </li>
            <li>
              <Link href="/gameinfo/economy">
                {t("gameinfo_economy_title")}
              </Link>
            </li>
            <li>
              <Link href="/gameinfo/tools">{t("gameinfo_tools_title")}</Link>
            </li>
            <li>
              <Link href="/system">{t("archive_docs_system")}</Link>
            </li>
            <li>
              <a
                href="/docs/report_2645.pdf"
                target="_blank"
                rel="noopener noreferrer"
              >
                {t("archive_docs_report")}
              </a>
            </li>
          </ul>
        </section>
      </main>
    </>
  );
}
