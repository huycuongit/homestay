import { ASSET_BASE_URL } from "../config/appConfig";

export function assetUrl(value) {
  if (!value) return "/assets/imgs/feboking-home.png";
  if (/^https?:\/\//.test(value)) return value;
  if (value.startsWith("/assets/") || value.startsWith("/icons/")) return value;
  return `${ASSET_BASE_URL}${value.startsWith("/") ? value : `/${value}`}`;
}

export function money(value) {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
    maximumFractionDigits: 0
  }).format(Number(value || 0));
}

export function compactMoney(value) {
  return new Intl.NumberFormat("vi-VN", {
    maximumFractionDigits: 0
  }).format(Number(value || 0));
}
