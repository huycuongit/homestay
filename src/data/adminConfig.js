export const adminResources = [
  { key: "branches", label: "Chi nhanh", fields: ["name", "slug", "address", "description", "province_id", "district_id", "ward_id", "lat", "lng", "iframe", "active", "position"] },
  { key: "rooms", label: "Phong", fields: ["branch_id", "name", "max_guests", "price_per_night", "price_per_hour", "type", "active", "position"] },
  { key: "room-images", label: "Anh phong", fields: ["room_id", "image_path", "alt_text", "active", "position"] },
  { key: "services", label: "Dich vu", fields: ["title", "slug", "description", "content", "avatar", "active", "position"] },
  { key: "news", label: "Tin tuc", fields: ["name", "slug", "avatar", "description", "content", "publish_time", "active", "position", "active_publish"] },
  { key: "pages", label: "Trang tinh", fields: ["name", "key", "slug", "content", "active", "position"] },
  { key: "galleries", label: "Bo suu tap", fields: ["name", "slug", "description", "active", "position"] },
  { key: "images", label: "Thu vien anh", fields: ["gallery_id", "url", "name", "description", "active", "position"] },
  { key: "homestays", label: "Homestay", fields: ["name", "slug", "address", "location", "description", "active", "position"] },
  { key: "commits", label: "Cam ket", fields: ["icon", "name", "description", "active", "position"] },
  { key: "contacts", label: "Lien he", fields: ["full_name", "phone", "branch_id", "email", "message", "status"] },
  { key: "admins", label: "Admin", fields: ["name", "user_name", "email", "password", "type", "status", "active", "position"] },
  { key: "systems", label: "Cau hinh", fields: ["key", "content", "order", "active"] }
];

export const textareaFields = new Set(["description", "content", "iframe", "message", "note", "address", "location"]);
export const imageFields = new Set(["avatar", "url", "image_path"]);
export const booleanFields = new Set(["active", "active_publish", "no_remove"]);
export const numberFields = new Set([
  "position",
  "order",
  "type",
  "branch_id",
  "room_id",
  "gallery_id",
  "province_id",
  "district_id",
  "ward_id",
  "max_guests",
  "price_per_night",
  "price_per_hour"
]);
