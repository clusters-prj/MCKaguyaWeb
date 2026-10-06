const securityHeaders = [
  { key: "X-Content-Type-Options", value: "nosniff" },
  { key: "Referrer-Policy", value: "strict-origin-when-cross-origin" },
  {
    key: "Permissions-Policy",
    value: "camera=(), microphone=(), geolocation=(), payment=()",
  },
  { key: "Content-Security-Policy", value: "frame-ancestors 'self'" },
];

const legacyPages = [
  ["/index.php", "/"],
  ["/pages/progress.php", "/progress"],
  ["/pages/gameinfo.php", "/gameinfo"],
  ["/pages/system.php", "/system"],
  ["/pages/cont.php", "/cont"],
  ["/pages/contact.php", "/contact"],
  ["/pages/copyright.php", "/copyright"],
  ["/pages/gameinfos/:page.php", "/gameinfo/:page"],
];

/** @type {import('next').NextConfig} */
const nextConfig = {
  poweredByHeader: false,
  async redirects() {
    return legacyPages.map(([source, destination]) => ({
      source,
      destination,
      permanent: true,
    }));
  },
  async headers() {
    return [
      { source: "/:path*", headers: securityHeaders },
      {
        source: "/assets/:path*.(css|js)",
        headers: [{ key: "Cache-Control", value: "public, max-age=3600" }],
      },
      {
        source: "/assets/:path*.(jpg|jpeg|png|gif|webp|ico|svg|woff|woff2|JPG)",
        headers: [{ key: "Cache-Control", value: "public, max-age=2592000" }],
      },
    ];
  },
};

export default nextConfig;
