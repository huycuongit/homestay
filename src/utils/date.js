export function formatLocalInput(date) {
  const pad = (value) => String(value).padStart(2, "0");
  return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T${pad(date.getHours())}:${pad(date.getMinutes())}`;
}

export function defaultCheckIn() {
  const date = new Date();
  date.setMinutes(0, 0, 0);
  date.setHours(date.getHours() + 2);
  return formatLocalInput(date);
}

export function defaultCheckOut() {
  const date = new Date();
  date.setMinutes(0, 0, 0);
  date.setDate(date.getDate() + 1);
  date.setHours(12);
  return formatLocalInput(date);
}

export function toApiDate(value) {
  return new Date(value).toISOString();
}

export function localDateKey(date) {
  const pad = (value) => String(value).padStart(2, "0");
  return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}`;
}

export function normalizeDateKey(value) {
  if (!value) return "";
  return String(value).slice(0, 10);
}

export function upcomingBookingDays(count = 8) {
  const formatter = new Intl.DateTimeFormat("vi-VN", {
    weekday: "short"
  });
  const today = new Date();
  return Array.from({ length: count }, (_, index) => {
    const date = new Date(today);
    date.setDate(today.getDate() + index);
    const iso = localDateKey(date);
    const label = index === 0 ? "Hom nay" : formatter.format(date).replace(".", "");
    const dateText = [
      String(date.getDate()).padStart(2, "0"),
      String(date.getMonth() + 1).padStart(2, "0"),
      date.getFullYear()
    ].join("-");
    return { index, iso, label, dateText };
  });
}
