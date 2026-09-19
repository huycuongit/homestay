import { ASSET_BASE_URL } from "../config/appConfig";

export function assetUrl(value) {
  if (!value) return "https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=900&q=80";
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
