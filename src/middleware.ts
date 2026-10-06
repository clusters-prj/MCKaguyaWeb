import { NextResponse, type NextRequest } from "next/server";
import { isLang } from "@/lib/site";

export function middleware(request: NextRequest) {
  const requestHeaders = new Headers(request.headers);
  requestHeaders.set("x-pathname", request.nextUrl.pathname);

  const param = request.nextUrl.searchParams.get("lang");
  const forced = isLang(param) ? param : null;
  if (forced) requestHeaders.set("x-lang", forced);
  else requestHeaders.delete("x-lang");

  const response = NextResponse.next({ request: { headers: requestHeaders } });
  if (forced) {
    response.cookies.set("lang", forced, {
      path: "/",
      maxAge: 60 * 60 * 24 * 365,
      sameSite: "lax",
      httpOnly: true,
      secure: request.nextUrl.protocol === "https:",
    });
  }
  return response;
}

export const config = {
  matcher: ["/((?!_next/|assets/|docs/|favicon\.ico|robots\.txt).*)"],
};
