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

export function defaultBookingDate() {
  return localDateKey(new Date());
}

export function buildSlotDateRange(dateKey, slot) {
  if (!dateKey || !slot?.start || !slot?.end) return null;

  const start = new Date(`${dateKey}T${slot.start}:00`);
  const end = new Date(`${dateKey}T${slot.end}:00`);
  if (slot.crossesMidnight) end.setDate(end.getDate() + 1);

  return {
    checkIn: formatLocalInput(start),
    checkOut: formatLocalInput(end)
  };
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

export function upcomingBookingDays(count = 8, startDateKey) {
  const formatter = new Intl.DateTimeFormat("vi-VN", {
    weekday: "short"
  });
  const today = startDateKey ? new Date(`${startDateKey}T00:00:00`) : new Date();
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
