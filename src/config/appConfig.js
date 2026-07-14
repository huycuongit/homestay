export const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || "http://localhost:4100/api";
export const ASSET_BASE_URL = API_BASE_URL.replace(/\/api\/?$/, "");
export const SOCKET_BASE_URL = ASSET_BASE_URL;
