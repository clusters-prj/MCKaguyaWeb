import Link from "next/link";
import { Fragment } from "react";
import { preload } from "react-dom";
import { HomeEnhancer } from "@/components/HomeEnhancer";
import { getT } from "@/lib/i18n";
import { loadHomeContent } from "@/lib/homepage";
import { pageMetadata } from "@/lib/metadata";

export const generateMetadata = () =>
  pageMetadata("/", "site_title", "site_description");

const DEFAULT_STEPS = ["路上ライブの道", "ネオン商店街", "川床"];

const basename = (p: string) => p.split(/[\\/]/).pop() ?? "";

export default async function HomePage() {
  const { t } = await getT();
  const home = loadHomeContent();

  const heroTitle = home.hero_title || "物語の街を、\n歩ける世界に。";
  const heroIntro = home.hero_intro || t("index_intro");
  const heroImage = `/assets/gallery/${basename(home.hero_image || "1015.webp")}`;
  const heroAlt = home.hero_image_alt || "星の海に浮かぶツクヨミの鳥居と光の道";
  const gallery =
    Array.isArray(home.gallery) && home.gallery.length === 3
      ? home.gallery
      : null;
  const steps = gallery
    ? gallery.map((g, i) => g.title || DEFAULT_STEPS[i])
    : DEFAULT_STEPS;
  const news = home.news?.length
    ? home.news
    : [
        { date: "2026.08.29", text: t("news_3") },
        { date: "2026.06.30", text: t("news_2") },
        { date: "2026.06.17", text: t("news_1") },
      ];

  preload(heroImage, { as: "image", fetchPriority: "high" });

  return (
    <main id="main-content" className="home-scroll">
      <link
        rel="stylesheet"
        href="/assets/home-scroll.css"
        precedence="default"
      />
      <HomeEnhancer gallery={gallery} />

      <section
        className="home-hero"
        id="project-overview"
        aria-labelledby="home-title"
      >
        <div className="home-hero__copy">
          <p className="home-kicker">
            <span className="pixel-mark" aria-hidden="true"></span> MC TSUKUYOMI
            PROJECT
          </p>
          <h1 id="home-title">
            {heroTitle.split(/\r?\n/).map((line, i) => (
              <Fragment key={i}>
                {i > 0 && <br />}
                {line}
              </Fragment>
            ))}
          </h1>
          <p className="home-lead">{heroIntro}</p>
          <div className="home-hero__actions">
            <Link className="home-button" href="/contact">
              {t("nav_contact")}
              <span aria-hidden="true">↗</span>
            </Link>
            <a className="home-text-link" href="#world">
              {t("index_status_h3")}
              <span aria-hidden="true">↓</span>
            </a>
          </div>
          <div className="home-hero__note">A world built block by block.</div>
        </div>
        <figure className="home-hero__visual">
          <img
            width="1280"
            height="720"
            src={heroImage}
            alt={heroAlt}
            fetchPriority="high"
          />
          <span className="hero-orbit" aria-hidden="true"></span>
          <figcaption>
            <span>TSUKUYOMI / MOON GATE</span>
            <span>星降る海へ</span>
          </figcaption>
        </figure>
        <a
          className="home-hero__scroll"
          href="#world"
          aria-label="下へスクロール"
        >
          <span></span> SCROLL TO EXPLORE
        </a>
        <span className="home-hero__index" aria-hidden="true">
          01 — 05
        </span>
      </section>

      <section
        className="home-intro reveal"
        id="world"
        aria-labelledby="world-title"
      >
        <div className="section-label">
          <span>OUR VISION</span>
          <i></i>
          <span>02 / 05</span>
        </div>
        <div className="home-intro__grid">
          <div className="reveal-side reveal-side--left">
            <p className="home-kicker">A CITY BETWEEN MOONLIGHT &amp; PIXELS</p>
            <h2 id="world-title">
              物語の街を、
              <br />
              <em>歩ける世界</em>に。
            </h2>
            <p className="home-prose">{t("index_intro")}</p>
            <Link className="home-text-link" href="/gameinfo">
              {t("nav_gameinfo")}
              <span aria-hidden="true">↗</span>
            </Link>
          </div>
          <figure className="home-intro__image reveal-side reveal-side--right">
            <img
              width="1280"
              height="720"
              src="/assets/gallery/945.webp"
              alt="水辺に建つツクヨミの街への入口"
              loading="lazy"
            />
            <figcaption>
              <span>THE GATE TO TSUKUYOMI</span>
              <span>その先に広がる、もうひとつの世界。</span>
            </figcaption>
          </figure>
        </div>
      </section>

      <section
        className="home-showcase reveal"
        id="gallery"
        aria-labelledby="gallery-title"
      >
        <div className="showcase-topline">
          <div className="section-label">
            <span>WALK THROUGH TSUKUYOMI</span>
            <i></i>
            <span>03 / 05</span>
          </div>
          <span className="showcase-moon" aria-hidden="true">
            ☾
          </span>
        </div>
        <div className="home-gallery__heading">
          <div>
            <p className="home-kicker">ONE CITY · THREE MOMENTS</p>
            <h2 id="gallery-title">
              物語の景色を、<em>めぐる。</em>
            </h2>
          </div>
          <p>
            ひとつの旅のように、3つの風景を順にご案内します。
            <br />
            スワイプ、または矢印で次の場所へ。
          </p>
        </div>
        <article
          className="feature-gallery"
          data-feature-gallery
          aria-roledescription="カルーセル"
          aria-label="ツクヨミの再現建築"
        >
          <div className="feature-gallery__image-wrap">
            <img
              width="1280"
              height="720"
              data-feature-image
              src="/assets/gallery/1014.webp"
              alt="路上ライブが行われた道"
              loading="lazy"
            />
            <div className="feature-gallery__shade"></div>
            <div className="feature-gallery__coordinates" aria-hidden="true">
              <span>35° 39&apos; 12.0&quot; N</span>
              <i></i>
              <span>BLOCK / BY / BLOCK</span>
            </div>
            <div
              className="feature-gallery__caption"
              aria-live="polite"
              aria-atomic="true"
            >
              <p data-feature-kicker>TSUKUYOMI — MEMORY 01</p>
              <h3 data-feature-title>路上ライブが行われた道</h3>
              <p data-feature-description>光に導かれて、ライブの余韻を歩く。</p>
            </div>
            <button
              className="feature-arrow feature-arrow--prev"
              type="button"
              data-feature-prev
              aria-label="前の景色"
            >
              ←
            </button>
            <button
              className="feature-arrow feature-arrow--next"
              type="button"
              data-feature-next
              aria-label="次の景色"
            >
              →
            </button>
            <div className="feature-gallery__index" aria-hidden="true">
              <span data-feature-count>01</span>
              <i></i> 03
            </div>
          </div>
          <div className="feature-gallery__rail" aria-label="景色の順番">
            {steps.map((label, i) => (
              <span
                key={i}
                data-feature-step={i}
                aria-current={i === 0 ? "step" : undefined}
              >
                <b>{`0${i + 1}`}</b>
                <span>{label}</span>
              </span>
            ))}
            <span className="feature-gallery__autoplay">
              AUTO <i></i>
            </span>
          </div>
        </article>
        <div className="home-builds">
          <div className="home-builds__intro">
            <p className="home-kicker">A LIVING CITY</p>
            <h3>
              街のあちこちに、
              <br />
              つくり手の景色。
            </h3>
            <p>
              再現エリアの外にも、メンバーが育ててきた風景が広がっています。
            </p>
          </div>
          <figure>
            <img
              width="1280"
              height="720"
              src="/assets/gallery/1011.webp"
              alt="灯りがともる和風の街並み"
              loading="lazy"
            />
            <figcaption>夜の街並み</figcaption>
          </figure>
          <figure>
            <img
              width="1280"
              height="720"
              src="/assets/gallery/661.webp"
              alt="桜に囲まれた木造の門"
              loading="lazy"
            />
            <figcaption>桜の門</figcaption>
          </figure>
          <figure>
            <img
              width="1280"
              height="720"
              src="/assets/gallery/767.webp"
              alt="夜空の下に広がる桜並木と町"
              loading="lazy"
            />
            <figcaption>星明かりの町</figcaption>
          </figure>
          <figure>
            <img
              width="1280"
              height="720"
              src="/assets/gallery/893.webp"
              alt="水辺の灯りと遠くに見える塔"
              loading="lazy"
            />
            <figcaption>水辺の塔</figcaption>
          </figure>
        </div>
        <p className="gallery-swipe-hint">
          <span aria-hidden="true">↔</span>{" "}
          3つの風景はスワイプ・矢印操作で順に切り替わります
        </p>
      </section>

      <section
        className="home-updates reveal"
        id="updates"
        aria-labelledby="updates-title"
      >
        <div className="section-label">
          <span>FIELD NOTES</span>
          <i></i>
          <span>04 / 05</span>
        </div>
        <div className="home-updates__grid">
          <div className="updates-copy reveal-side reveal-side--left">
            <p className="home-kicker">A PROJECT IN PROGRESS</p>
            <h2 id="updates-title">
              完成までの道のりも、
              <br />
              <em>この街の一部。</em>
            </h2>
            <p>{t("site_description")}</p>
            <Link className="home-text-link" href="/progress">
              {t("nav_progress")}
              <span aria-hidden="true">↗</span>
            </Link>
          </div>
          <div className="updates-panel reveal-side reveal-side--right">
            <div className="updates-panel__head">
              <span>PROJECT STATUS</span>
              <span className="status-live">
                <i></i> LIVE LOG
              </span>
            </div>
            <h3>{t("index_status_h3")}</h3>
            <ul className="home-status-list">
              {[1, 2, 3, 4].map((n) => (
                <li key={n}>
                  <span>{t(`index_status_${n}`)}</span>
                  <strong>{t(`index_status_${n}_v`)}</strong>
                </li>
              ))}
            </ul>
            <div className="updates-panel__foot">
              <span>UPDATED WITH THE COMMUNITY</span>
              <Link href="/progress" aria-label="進捗状況を見る">
                ↗
              </Link>
            </div>
          </div>
        </div>
        <div className="home-news">
          <div>
            <p className="home-kicker">RECENT NEWS</p>
            <h3>{t("index_news_h3")}</h3>
          </div>
          <ul>
            {news.map((item, i) => (
              <li key={i}>
                <time>{item.date}</time>
                <span>{item.text}</span>
              </li>
            ))}
          </ul>
        </div>
      </section>

      <section
        className="home-join reveal"
        id="join"
        aria-labelledby="join-title"
      >
        <img
          width="1280"
          height="720"
          src="/assets/gallery/903.webp"
          alt="ライブステージの背景となるツクヨミの建築"
          loading="lazy"
        />
        <div className="home-join__veil"></div>
        <div className="home-join__content reveal-side reveal-side--left">
          <p className="home-kicker">YOUR NEXT ADVENTURE STARTS HERE</p>
          <h2 id="join-title">
            この世界の続きを、
            <br />
            <em>一緒につくろう。</em>
          </h2>
          <p>
            {t("contact_discord_info")}{" "}
            <Link className="home-join__link" href="/gameinfo/connect">
              {t("contact_discord_connect")}
            </Link>
          </p>
          <Link className="home-button home-button--light" href="/contact">
            {t("contact_discord_link")}
            <span aria-hidden="true">↗</span>
          </Link>
        </div>
        <span className="home-join__index">
          05 — 05 <i></i> JOIN THE PROJECT
        </span>
      </section>
    </main>
  );
}
