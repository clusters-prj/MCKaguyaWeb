import { Raw } from "@/components/Raw";
import { getT } from "@/lib/i18n";
import { pageMetadata } from "@/lib/metadata";

export const generateMetadata = () =>
  pageMetadata("/gameinfo/connect", "connect_page_title", "connect_intro");

export default async function Page() {
  const { t } = await getT();
  return (
    <main id="main-content">
      <section id="overview">
        <h2>{t("connect_heading")}</h2>
        <p>{t("connect_intro")}</p>
      </section>

      <section id="java-edition">
        <h2>{t("connect_java_heading")}</h2>

        <h3>{t("connect_supported_devices")}</h3>
        <ul>
          <li>{t("connect_java_device_windows")}</li>
          <li>{t("connect_java_device_mac")}</li>
          <li>{t("connect_java_device_linux")}</li>
        </ul>

        <h3>{t("connect_supported_versions")}</h3>
        <p>
          <Raw html={t("connect_java_version_info")} />
        </p>

        <h3>{t("connect_recommended_version")}</h3>
        <p>{t("connect_java_recommended_version")}</p>
        <h3>{t("connect_method_heading")}</h3>
        <ol>
          <li>{t("connect_java_step_1")}</li>
          <li>
            {t("connect_java_step_2")}
            <br />
            <img
              src="/assets/howtoconnect/2320.webp"
              alt={t("connect_java_alt_launch")}
            />
          </li>
          <li>
            {t("connect_java_step_3")}
            <br />
            <img
              src="/assets/howtoconnect/2356.webp"
              alt={t("connect_java_alt_multiplayer")}
            />
          </li>
          <li>
            {t("connect_java_step_4")}
            <br />
            <img
              src="/assets/howtoconnect/2438.webp"
              alt={t("connect_java_alt_add_server")}
            />
          </li>
          <li>
            {t("connect_java_step_5")}
            <br />
            <img
              src="/assets/howtoconnect/2451.webp"
              alt={t("connect_java_alt_add_screen")}
            />
          </li>
          <li>
            <Raw html={t("connect_java_step_6")} />
            <br />
            <img
              src="/assets/howtoconnect/2530.webp"
              alt={t("connect_java_alt_input_done")}
            />
          </li>
          <li>
            {t("connect_java_step_7")}
            <br />
            <img
              src="/assets/howtoconnect/2607.webp"
              alt={t("connect_java_alt_added_list")}
            />
          </li>
          <li>
            {t("connect_java_step_8")}
            <br />
            <img
              src="/assets/howtoconnect/2614.webp"
              alt={t("connect_java_alt_click")}
            />
          </li>
          <li>
            {t("connect_java_step_9")}
            <br />
            <img
              src="/assets/howtoconnect/2627.webp"
              alt={t("connect_java_alt_waiting")}
            />
          </li>
          <li>
            {t("connect_java_step_10")}
            <br />
            <img
              src="/assets/howtoconnect/2716.webp"
              alt={t("connect_java_alt_complete")}
            />
          </li>
        </ol>
      </section>

      <section id="bedrock-edition">
        <h2>{t("connect_bedrock_heading")}</h2>

        <h3>{t("connect_supported_devices")}</h3>
        <ul>
          <li>{t("connect_bedrock_device_windows")}</li>
          <li>{t("connect_bedrock_device_chromeos")}</li>
          <li>{t("connect_bedrock_device_android")}</li>
          <li>{t("connect_bedrock_device_ios")}</li>
          <li>{t("connect_bedrock_device_ipados")}</li>
          <li>{t("connect_bedrock_device_fireos")}</li>
          <li>{t("connect_bedrock_device_ps4")}</li>
          <li>{t("connect_bedrock_device_ps5")}</li>
          <li>{t("connect_bedrock_device_switch")}</li>
          <li>{t("connect_bedrock_device_switch2")}</li>
          <li>{t("connect_bedrock_device_xboxone")}</li>
          <li>{t("connect_bedrock_device_xboxseries")}</li>
        </ul>

        <h3>{t("connect_supported_versions")}</h3>
        <p>
          <Raw html={t("connect_bedrock_version_info")} />
        </p>

        <h3>{t("connect_method_heading")}</h3>
        <h4>{t("connect_bedrock_platform_heading")}</h4>
        <p>
          <strong>{t("connect_bedrock_notice_strong")}</strong>
          <br />
          {t("connect_bedrock_notice_line1")}
          <br />
          {t("connect_bedrock_notice_line2")}
        </p>
        <ol>
          <li>{t("connect_bedrock_step_1")}</li>
          <li>
            {t("connect_bedrock_step_2")}
            <br />
            <img
              src="/assets/howtoconnect/2910.webp"
              alt={t("connect_bedrock_alt_launcher")}
            />
          </li>
          <li>
            {t("connect_bedrock_step_3")}
            <br />
            <img
              src="/assets/howtoconnect/2933.webp"
              alt={t("connect_bedrock_alt_play")}
            />
          </li>
          <li>
            {t("connect_bedrock_step_4")}
            <br />
            <img
              src="/assets/howtoconnect/2942.webp"
              alt={t("connect_bedrock_alt_server_tab")}
            />
          </li>
          <li>
            {t("connect_bedrock_step_5")}
            <br />
            <img
              src="/assets/howtoconnect/2949.webp"
              alt={t("connect_bedrock_alt_add_server")}
            />
          </li>
          <li>
            <Raw html={t("connect_bedrock_step_6")} />
            <br />
            <img
              src="/assets/howtoconnect/3115.webp"
              alt={t("connect_bedrock_alt_info_input")}
            />
          </li>
          <li>
            {t("connect_bedrock_step_7")}
            <br />
            <img
              src="/assets/howtoconnect/3138.webp"
              alt={t("connect_bedrock_alt_confirm")}
            />
          </li>
          <li>
            {t("connect_bedrock_step_8")}
            <br />
            <img
              src="/assets/howtoconnect/3156.webp"
              alt={t("connect_bedrock_alt_press_play")}
            />
          </li>
          <li>
            {t("connect_bedrock_step_9")}
            <br />
            <img
              src="/assets/howtoconnect/3224.webp"
              alt={t("connect_bedrock_alt_waiting")}
            />
          </li>
          <li>
            {t("connect_bedrock_step_10")}
            <br />
            <img
              src="/assets/howtoconnect/3251.webp"
              alt={t("connect_bedrock_alt_complete")}
            />
          </li>
        </ol>

        <h4>{t("connect_bedrock_console_heading")}</h4>
        <p>
          {t("connect_bedrock_console_intro")}
          <br />
          <a href="https://kuwa.app/tool/hjs/" target="_blank">
            https://kuwa.app/tool/hjs
          </a>
        </p>
        <p>
          {t("connect_bedrock_console_alt_intro")}
          <br />
          <a
            href="https://app.notion.com/p/https-kuwa-app-tool-hjs-33b855055632805886c8da3a20bb6a4f?pvs=21"
            target="_blank"
          >
            https://kuwa.app/tool/hjs/のコピー
          </a>
        </p>
      </section>

      <section id="troubleshooting">
        <h2>{t("connect_troubleshooting_heading")}</h2>

        <h3>{t("connect_troubleshooting_not_working")}</h3>
        <img
          src="/assets/howtoconnect/3300.webp"
          alt={t("connect_troubleshooting_image_alt")}
          style={{ maxWidth: "100%", height: "auto" }}
        />
        <ul>
          <li>{t("connect_troubleshooting_not_working_1")}</li>
          <li>{t("connect_troubleshooting_not_working_2")}</li>
          <li>{t("connect_troubleshooting_not_working_3")}</li>
          <li>{t("connect_troubleshooting_not_working_4")}</li>
        </ul>

        <h3>{t("connect_troubleshooting_lag")}</h3>
        <ul>
          <li>{t("connect_troubleshooting_lag_1")}</li>
          <li>{t("connect_troubleshooting_lag_2")}</li>
        </ul>
      </section>
    </main>
  );
}
