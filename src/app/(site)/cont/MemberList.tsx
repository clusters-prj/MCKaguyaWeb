"use client";

import { useMemo, useState } from "react";
import type { Member } from "@/lib/members";

type Props = {
  members: Member[];
  roles: string[];
  labels: { placeholder: string; count: string; unit: string };
};

export function MemberList({ members, roles, labels }: Props) {
  const [query, setQuery] = useState("");
  const [filter, setFilter] = useState("all");

  const visible = useMemo(() => {
    const term = query.toLowerCase();
    return members.map((m) => {
      const matchesSearch = m.name.toLowerCase().includes(term);
      const matchesFilter =
        filter === "all" ||
        m.roles.some((r) => r.toLowerCase() === filter.toLowerCase());
      return matchesSearch && matchesFilter;
    });
  }, [members, query, filter]);
  const count = visible.filter(Boolean).length;

  return (
    <>
      <div id="member-controls">
        <div className="search-container">
          <input
            type="text"
            id="search-input"
            className="search-input"
            placeholder={labels.placeholder}
            autoComplete="off"
            value={query}
            onChange={(e) => setQuery(e.target.value)}
          />
        </div>
        <div className="filter-buttons">
          <button
            className={`filter-btn${filter === "all" ? " active" : ""}`}
            onClick={() => {
              setFilter("all");
              setQuery("");
            }}
          >
            全て表示
          </button>
          {roles.map((role) => (
            <button
              key={role}
              className={`filter-btn${filter === role ? " active" : ""}`}
              onClick={() => {
                setFilter(role);
                setQuery("");
              }}
            >
              {role}
            </button>
          ))}
        </div>
      </div>

      <ul className="member-grid" id="member-list">
        {members.map((m, i) => (
          <li
            key={`${m.name}-${i}`}
            className="member-card"
            style={{ display: visible[i] ? "flex" : "none" }}
          >
            <div className="member-name">
              {m.links[0] ? (
                <a
                  href={m.links[0].url}
                  target="_blank"
                  rel="noopener noreferrer"
                >
                  {m.name}
                </a>
              ) : (
                m.name
              )}
            </div>
            {m.roles.length > 0 && (
              <div className="member-role">
                {m.roles.map((role) => (
                  <span key={role} className="member-role-tag">
                    {role}
                  </span>
                ))}
              </div>
            )}
            {m.links.length > 0 && (
              <div className="member-social">
                {m.links.map((link, j) => (
                  <a
                    key={j}
                    href={link.url}
                    target="_blank"
                    rel="noopener noreferrer"
                  >
                    → {link.label}
                  </a>
                ))}
              </div>
            )}
          </li>
        ))}
        {count === 0 && (
          <div className="no-results">
            <div className="no-results-emoji">🔍</div>
            <p>条件に合うメンバーが見つかりません</p>
          </div>
        )}
      </ul>

      <div className="member-count">
        {labels.count}: <span id="result-count">{count}</span> {labels.unit}
      </div>
    </>
  );
}
