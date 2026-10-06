import { getT } from "@/lib/i18n";
import { loadMembers } from "@/lib/members";
import { pageMetadata } from "@/lib/metadata";
import { MemberList } from "./MemberList";
import "./cont.css";

export const generateMetadata = () =>
  pageMetadata("/cont", "cont_page_title", "cont_intro_1");

export default async function ContPage() {
  const { t } = await getT();
  const { members, roles } = loadMembers();

  return (
    <main id="main-content">
      <section id="credits-intro">
        <h2>協力者一覧 / Credits</h2>
        <p>
          {t("cont_intro_1")}
          <br />
          {t("cont_intro_2")}
        </p>
      </section>

      <section id="core-staff">
        <h3>{t("cont_core_staff")}</h3>
        <table>
          <thead>
            <tr>
              <th>{t("cont_core_section")}</th>
              <th>{t("cont_core_name")}</th>
              <th>{t("cont_core_role")}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <strong>{t("cont_core_body_1_1")}</strong>
              </td>
              <td>{t("cont_core_body_1_2")}</td>
              <td>{t("cont_core_body_1_3")}</td>
            </tr>
            <tr>
              <td>
                <strong>{t("cont_core_body_2_1")}</strong>
              </td>
              <td>{t("cont_core_body_2_2")}</td>
              <td>{t("cont_core_body_2_3")}</td>
            </tr>
            <tr>
              <td></td>
              <td>
                <a
                  href="https://x.com/Kuma_gamesMk2"
                  target="_blank"
                  rel="noopener noreferrer"
                >
                  {t("cont_core_body_4_2")}
                </a>
              </td>
              <td>{t("cont_core_body_4_3")}</td>
            </tr>
            <tr>
              <td>
                <strong>{t("cont_core_body_3_1")}</strong>
              </td>
              <td>{t("cont_core_body_3_2")}</td>
              <td>{t("cont_core_body_3_3")}</td>
            </tr>
          </tbody>
        </table>
      </section>

      <section id="contributors">
        <h3>{t("cont_contributors")}</h3>
        <p>{t("cont_contributors_intro")}</p>
        <p>{t("cont_contributors_note")}</p>

        <MemberList
          members={members}
          roles={roles}
          labels={{
            placeholder: t("cont_search_placeholder"),
            count: t("cont_member_count"),
            unit: t("cont_contributors_unit"),
          }}
        />
      </section>

      <section id="special-thanks">
        <h3>{t("special_thanks")}</h3>
        <ul>
          <li>{t("special_thanks_1")}</li>
          <li>{t("special_thanks_2")}</li>
        </ul>
      </section>
    </main>
  );
}
