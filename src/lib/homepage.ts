import fs from "node:fs";
import path from "node:path";

export type GalleryTheme = {
  title: string;
  description: string;
  images: string[];
};
export type NewsItem = { date: string; text: string };
export type HomeContent = {
  hero_title?: string;
  hero_intro?: string;
  hero_image?: string;
  hero_image_alt?: string;
  gallery?: GalleryTheme[];
  news?: NewsItem[];
};

export function loadHomeContent(): HomeContent {
  try {
    const raw = fs.readFileSync(
      path.join(process.cwd(), "data/homepage.json"),
      "utf8",
    );
    const data = JSON.parse(raw);
    return data && typeof data === "object" ? data : {};
  } catch {
    return {};
  }
}
