import Link from "next/link";
import { getT } from "@/lib/i18n";
import { pageMetadata } from "@/lib/metadata";

export const generateMetadata = () =>
  pageMetadata("/contact", "contact_page_title", "contact_intro");

const css = `
.contact-container { max-width: 800px; margin: 0; }
.contact-method { background: var(--card-bg); border-left: 5px solid var(--primary-color); padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: var(--shadow); color: var(--text-main); }
.contact-method h3 { margin-top: 0; color: var(--primary-color); }
.contact-link { display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: var(--primary-color); color: #fff; text-decoration: none; border-radius: 4px; transition: background-color 0.3s ease, transform 0.2s ease; }
.contact-link:hover { background-color: var(--link-hover); transform: translateY(-1px); }
.contact-method a:not(.contact-link) { color: var(--primary-color); }
.contact-method iframe { max-width: 100%; border-radius: 8px; }
`;

export default async function ContactPage() {
  const { t } = await getT();
  return (
    <>
      <style>{css}</style>
      <main id="main-content" className="contact-container">
        <section id="contact-info">
          <h2>{t("contact_heading")}</h2>
          <p>{t("contact_intro")}</p>

          <div className="contact-method">
            <h3>{t("contact_discord_title")}</h3>
            <p>
              {t("contact_discord_info")}{" "}
              <Link href="/gameinfo/connect">
                {t("contact_discord_connect")}
              </Link>
            </p>
            <p>
              <a href="https://discord.gg/SAsYnPPrga" className="contact-link">
                {t("contact_discord_link")}
              </a>
            </p>
            <section id="discord">
              <iframe
                src="https://discord.com/widget?id=1487438553888849983&theme=dark"
                title={t("discord_widget_title")}
                width="350"
                height="500"
                loading="lazy"
                frameBorder="0"
                sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"
              ></iframe>
            </section>
          </div>

          <div className="contact-method">
            <h3>{t("contact_email_title")}</h3>
            <p>{t("contact_email_info")}</p>
            <p>
              <a
                href="mailto:kaguya-support@mail.clusters-prj.com"
                className="contact-link"
              >
                {t("contact_email_link")}
              </a>
            </p>
          </div>
        </section>
      </main>
    </>
  );
}
