import { API_BASE_URL } from "../config/appConfig";

export async function apiFetch(path, options = {}) {
  const response = await fetch(`${API_BASE_URL}${path}`, {
    headers: {
      "Content-Type": "application/json",
      ...(options.headers || {})
    },
    ...options
  });
  const payload = await response.json().catch(() => ({}));

  if (!response.ok) {
    const details = payload.errors
      ? Object.values(payload.errors).filter(Boolean).join(". ")
      : payload.message;
    throw new Error(details || "Không kết nối được máy chủ.");
  }

  return payload;
}
