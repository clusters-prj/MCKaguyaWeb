import type { ErrorLabels } from "@/lib/errorLabels";
import { ErrorBackButton } from "./ErrorBackButton";

export function ErrorView({ labels }: { labels: ErrorLabels }) {
  return (
    <>
      <link rel="stylesheet" href="/assets/error.css" precedence="default" />
      <div className="container">
        <div className="error-section">
          <div className="error-code">{labels.code}</div>
          <h1 className="error-title">{labels.title}</h1>
          <p className="error-description">{labels.description}</p>
        </div>

        <section>
          <h2>{labels.whatToDo}</h2>
          <div className="suggestions">
            <a className="suggestion-card" href="/">
              <span className="suggestion-emoji" aria-hidden="true">
                🏠
              </span>
              <div className="suggestion-text">{labels.goHome}</div>
            </a>
            <a className="suggestion-card" href="/gameinfo">
              <span className="suggestion-emoji" aria-hidden="true">
                🔍
              </span>
              <div className="suggestion-text">{labels.browse}</div>
            </a>
            <a className="suggestion-card" href="/contact">
              <span className="suggestion-emoji" aria-hidden="true">
                ✉️
              </span>
              <div className="suggestion-text">{labels.contact}</div>
            </a>
          </div>
          <div className="action-buttons">
            <a className="btn primary" href="/">
              {labels.goHome}
            </a>
            <ErrorBackButton>{labels.goBack}</ErrorBackButton>
          </div>
        </section>

        {labels.hints.length > 0 && (
          <section>
            <h2>{labels.faq}</h2>
            <ul>
              {labels.hints.map((hint, i) => (
                <li key={i}>{hint}</li>
              ))}
            </ul>
          </section>
        )}

        <p
          className="text-muted"
          style={{ textAlign: "center", marginTop: 24 }}
        >
          {labels.codeLabel}: {labels.code} | {labels.title}
        </p>
      </div>
    </>
  );
}
