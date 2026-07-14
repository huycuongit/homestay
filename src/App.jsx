import { useEffect, useMemo, useState } from "react";
import { io } from "socket.io-client";
import {
  ArrowLeft,
  ArrowUp,
  Bath,
  BedDouble,
  Building2,
  CalendarCheck,
  ChevronLeft,
  ChevronRight,
  CheckCircle2,
  Clock,
  Copy,
  CreditCard,
  Edit3,
  Film,
  Gamepad2,
  Hotel,
  ImagePlus,
  LayoutDashboard,
  Loader2,
  LogOut,
  MessageCircle,
  MapPin,
  Phone,
  Plus,
  Projector,
  RefreshCw,
  Save,
  Search,
  ShieldCheck,
  Sofa,
  Star,
  Trash2,
  Utensils,
  Users,
  Wifi,
  WashingMachine,
  X
} from "lucide-react";

import BookingModal from "./components/booking/BookingModal";
import AuthModal from "./components/auth/AuthModal";
import FloatingContact from "./components/layout/FloatingContact";
import Footer from "./components/layout/Footer";
import Header from "./components/layout/Header";
import HeroSection from "./components/home/HeroSection";
import IntroSection from "./components/home/IntroSection";
import RoomsSection from "./components/home/RoomsSection";
import { API_BASE_URL, SOCKET_BASE_URL } from "./config/appConfig";
import { adminResources, booleanFields, imageFields, numberFields, textareaFields } from "./data/adminConfig";
import { bookingSlots } from "./data/homeContent";
import { apiFetch } from "./services/api";
import { defaultCheckIn, defaultCheckOut, normalizeDateKey, toApiDate, upcomingBookingDays } from "./utils/date";
import { assetUrl, compactMoney, money } from "./utils/format";

function getRoomIdFromPath() {
  const match = window.location.pathname.match(/^\/rooms\/(\d+)/);
  return match ? match[1] : null;
}

function readStoredUser() {
  try {
    return JSON.parse(localStorage.getItem("homestay_user") || "null");
  } catch (error) {
    return null;
  }
}

function App() {
  const [currentRoomId, setCurrentRoomId] = useState(getRoomIdFromPath());
  const [isAdminRoute, setIsAdminRoute] = useState(window.location.pathname.startsWith("/admin"));
  const [detailRoom, setDetailRoom] = useState(null);
  const [detailLoading, setDetailLoading] = useState(false);
  const [search, setSearch] = useState({
    check_in: defaultCheckIn(),
    check_out: defaultCheckOut(),
    booking_type: "night",
    guests: 2
  });
  const [rooms, setRooms] = useState([]);
  const [loading, setLoading] = useState(false);
  const [notice, setNotice] = useState(null);
  const [selectedRoom, setSelectedRoom] = useState(null);
  const [bookingForm, setBookingForm] = useState({
    customer_name: "",
    customer_phone: "",
    customer_email: "",
    note: ""
  });
  const [submitting, setSubmitting] = useState(false);
  const [authUser, setAuthUser] = useState(readStoredUser);
  const [authToken, setAuthToken] = useState(() => localStorage.getItem("homestay_user_token") || "");
  const [authOpen, setAuthOpen] = useState(false);
  const [authMode, setAuthMode] = useState("login");
  const [authForm, setAuthForm] = useState({ name: "", phone: "", email: "", password: "" });
  const [authLoading, setAuthLoading] = useState(false);
  const [authNotice, setAuthNotice] = useState(null);

  const selectedTotalPreview = useMemo(() => {
    if (!selectedRoom) return 0;
    return search.booking_type === "hour" ? selectedRoom.price_per_hour : selectedRoom.price_per_night;
  }, [search.booking_type, selectedRoom]);

  async function loadRooms(event) {
    event?.preventDefault();
    setLoading(true);
    setNotice(null);

    try {
      const params = new URLSearchParams({
        check_in: toApiDate(search.check_in),
        check_out: toApiDate(search.check_out),
        guests: String(search.guests)
      });
      const payload = await apiFetch(`/rooms/available?${params.toString()}`);
      setRooms(payload.data || []);
      if (!payload.data?.length) {
        setNotice({ type: "muted", text: "Khong co phong trong theo thoi gian nay. Thu doi ngay hoac so khach." });
      }
    } catch (error) {
      setRooms([]);
      setNotice({ type: "error", text: error.message });
    } finally {
      setLoading(false);
    }
  }

  function updateSearch(field, value) {
    setSearch((current) => ({ ...current, [field]: value }));
  }

  function openBooking(room) {
    setSelectedRoom(room);
    setBookingForm({
      customer_name: authUser?.name || "",
      customer_phone: authUser?.phone || "",
      customer_email: authUser?.email || "",
      note: ""
    });
    setNotice(null);
  }

  function closeBooking() {
    if (!submitting) setSelectedRoom(null);
  }

  function openRoomDetail(room) {
    window.history.pushState({}, "", `/rooms/${room.id}`);
    setCurrentRoomId(String(room.id));
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  function backToHome() {
    window.history.pushState({}, "", "/");
    setCurrentRoomId(null);
    setDetailRoom(null);
    setTimeout(() => document.getElementById("rooms")?.scrollIntoView({ behavior: "smooth" }), 0);
  }

  async function loadRoomDetail(roomId) {
    if (!roomId) return;
    setDetailLoading(true);
    setNotice(null);

    try {
      const [roomPayload, imagePayload] = await Promise.all([
        apiFetch(`/rooms/${roomId}`),
        apiFetch(`/room-images?room_id=${roomId}`)
      ]);
      const apiImages = roomPayload.data?.images || [];
      const legacyImages = imagePayload.data || [];
      setDetailRoom({
        ...roomPayload.data,
        images: apiImages.length ? apiImages : legacyImages
      });
    } catch (error) {
      setDetailRoom(null);
      setNotice({ type: "error", text: error.message });
    } finally {
      setDetailLoading(false);
    }
  }

  async function submitBooking(event) {
    event.preventDefault();
    if (!selectedRoom) return;

    setSubmitting(true);
    setNotice(null);

    try {
      const payload = await apiFetch("/bookings", {
        method: "POST",
        body: JSON.stringify({
          room_id: selectedRoom.id,
          customer_name: bookingForm.customer_name,
          customer_phone: bookingForm.customer_phone,
          customer_email: bookingForm.customer_email,
          note: bookingForm.note,
          check_in: toApiDate(search.check_in),
          check_out: toApiDate(search.check_out),
          booking_type: search.booking_type,
          guests: Number(search.guests)
        })
      });

      setSelectedRoom(null);
      setNotice({
        type: "success",
        text: `Da gui booking #${payload.data.id}. Tong tien tam tinh ${money(payload.data.total_price)}.`
      });
      await loadRooms();
    } catch (error) {
      setNotice({ type: "error", text: error.message });
    } finally {
      setSubmitting(false);
    }
  }

  function openAuth(mode = "login") {
    setAuthMode(mode);
    setAuthForm({
      name: authUser?.name || "",
      phone: authUser?.phone || "",
      email: authUser?.email || "",
      password: ""
    });
    setAuthNotice(null);
    setAuthOpen(true);
  }

  function closeAuth() {
    if (!authLoading) setAuthOpen(false);
  }

  function logoutUser() {
    localStorage.removeItem("homestay_user_token");
    localStorage.removeItem("homestay_user");
    setAuthToken("");
    setAuthUser(null);
    setNotice({ type: "muted", text: "Da dang xuat tai khoan khach." });
  }

  async function submitAuth(event) {
    event.preventDefault();
    setAuthLoading(true);
    setAuthNotice(null);

    try {
      const endpoint = authMode === "login" ? "/auth/login" : "/auth/register";
      const payload = await apiFetch(endpoint, {
        method: "POST",
        body: JSON.stringify({
          name: authForm.name,
          phone: authForm.phone,
          email: authForm.email,
          username: authForm.phone,
          password: authForm.password
        })
      });

      localStorage.setItem("homestay_user_token", payload.token);
      localStorage.setItem("homestay_user", JSON.stringify(payload.user));
      setAuthToken(payload.token);
      setAuthUser(payload.user);
      setAuthOpen(false);
      setNotice({ type: "success", text: `Xin chao ${payload.user?.name || payload.user?.phone || "ban"}!` });
    } catch (error) {
      setAuthNotice({ type: "error", text: error.message });
    } finally {
      setAuthLoading(false);
    }
  }

  useEffect(() => {
    loadRooms();
  }, []);

  useEffect(() => {
    function handlePopState() {
      setCurrentRoomId(getRoomIdFromPath());
      setIsAdminRoute(window.location.pathname.startsWith("/admin"));
    }

    window.addEventListener("popstate", handlePopState);
    return () => window.removeEventListener("popstate", handlePopState);
  }, []);

  useEffect(() => {
    if (currentRoomId) {
      loadRoomDetail(currentRoomId);
    }
  }, [currentRoomId]);

  if (isAdminRoute) {
    return <AdminPage />;
  }

  return (
    <div className="app-shell">
      <Header user={authUser} onLoginClick={() => openAuth("login")} onLogout={logoutUser} />

      <main id="top">
        {currentRoomId ? (
          <RoomDetailPage
            room={detailRoom}
            loading={detailLoading}
            notice={notice}
            search={search}
            updateSearch={updateSearch}
            onBack={backToHome}
            onBook={openBooking}
          />
        ) : (
        <>
        <HeroSection search={search} loading={loading} onSearch={loadRooms} onUpdateSearch={updateSearch} />
        <IntroSection />
        <RoomsSection
          rooms={rooms}
          loading={loading}
          notice={notice}
          onOpenBooking={openBooking}
          onOpenRoomDetail={openRoomDetail}
        />
        </>
        )}
      </main>

      <FloatingContact />
      <Footer />
      <BookingModal
        room={selectedRoom}
        search={search}
        form={bookingForm}
        totalPreview={selectedTotalPreview}
        submitting={submitting}
        onClose={closeBooking}
        onSubmit={submitBooking}
        onChangeForm={setBookingForm}
        money={money}
      />
      {authOpen && (
        <AuthModal
          mode={authMode}
          form={authForm}
          loading={authLoading}
          notice={authNotice}
          onClose={closeAuth}
          onSubmit={submitAuth}
          onChange={(field, value) => setAuthForm((current) => ({ ...current, [field]: value }))}
          onSwitchMode={() => {
            setAuthMode((current) => (current === "login" ? "register" : "login"));
            setAuthNotice(null);
          }}
        />
      )}
    </div>
  );
}

function AdminPage() {
  const [token, setToken] = useState(() => localStorage.getItem("homestay_admin_token") || "");
  const [loginForm, setLoginForm] = useState({ username: "admin", password: "admin123" });
  const [activeKey, setActiveKey] = useState(adminResources[0].key);
  const [rows, setRows] = useState([]);
  const [searchText, setSearchText] = useState("");
  const [selectedRow, setSelectedRow] = useState(null);
  const [form, setForm] = useState({});
  const [loading, setLoading] = useState(false);
  const [saving, setSaving] = useState(false);
  const [notice, setNotice] = useState(null);

  const activeResource = adminResources.find((item) => item.key === activeKey) || adminResources[0];

  function blankForm(resource = activeResource) {
    return resource.fields.reduce((result, field) => {
      if (booleanFields.has(field)) result[field] = true;
      else result[field] = "";
      return result;
    }, {});
  }

  async function adminRequest(path, options = {}) {
    const isFormData = options.body instanceof FormData;
    const response = await fetch(`${API_BASE_URL}${path}`, {
      ...options,
      headers: {
        ...(isFormData ? {} : { "Content-Type": "application/json" }),
        ...(token ? { Authorization: `Bearer ${token}` } : {}),
        ...(options.headers || {})
      }
    });
    const payload = await response.json().catch(() => ({}));
    if (!response.ok) {
      throw new Error(payload.message || "Thao tac khong thanh cong.");
    }
    return payload;
  }

  async function login(event) {
    event.preventDefault();
    setSaving(true);
    setNotice(null);

    try {
      const payload = await adminRequest("/auth/login", {
        method: "POST",
        body: JSON.stringify({
          username: loginForm.username,
          password: loginForm.password
        })
      });
      localStorage.setItem("homestay_admin_token", payload.token);
      setToken(payload.token);
      setNotice({ type: "success", text: "Dang nhap admin thanh cong." });
    } catch (error) {
      setNotice({ type: "error", text: error.message });
    } finally {
      setSaving(false);
    }
  }

  function logout() {
    localStorage.removeItem("homestay_admin_token");
    setToken("");
    setRows([]);
  }

  async function loadAdminRows(resource = activeResource) {
    setLoading(true);
    setNotice(null);

    try {
      const params = new URLSearchParams({ per_page: "200" });
      if (searchText.trim()) params.set("search", searchText.trim());
      const payload = await adminRequest(`/${resource.key}?${params.toString()}`);
      setRows(payload.data || []);
    } catch (error) {
      setRows([]);
      setNotice({ type: "error", text: error.message });
    } finally {
      setLoading(false);
    }
  }

  function chooseResource(resource) {
    setActiveKey(resource.key);
    setSelectedRow(null);
    setForm(blankForm(resource));
    setSearchText("");
  }

  function startCreate() {
    setSelectedRow(null);
    setForm(blankForm());
    setNotice(null);
  }

  function startEdit(row) {
    setSelectedRow(row);
    setForm(
      activeResource.fields.reduce((result, field) => {
        result[field] = field === "password" ? "" : row[field] ?? (booleanFields.has(field) ? false : "");
        return result;
      }, {})
    );
    setNotice(null);
  }

  function updateAdminField(field, value) {
    setForm((current) => ({ ...current, [field]: value }));
  }

  function normalizeAdminPayload() {
    return activeResource.fields.reduce((payload, field) => {
      if (field === "password" && selectedRow && !form[field]) return payload;
      if (booleanFields.has(field)) payload[field] = Boolean(form[field]);
      else if (numberFields.has(field) && form[field] !== "") payload[field] = Number(form[field]);
      else payload[field] = form[field];
      return payload;
    }, {});
  }

  async function saveRow(event) {
    event.preventDefault();
    setSaving(true);
    setNotice(null);

    try {
      const payload = normalizeAdminPayload();
      const path = selectedRow ? `/${activeResource.key}/${selectedRow.id}` : `/${activeResource.key}`;
      await adminRequest(path, {
        method: selectedRow ? "PUT" : "POST",
        body: JSON.stringify(payload)
      });
      setNotice({ type: "success", text: selectedRow ? "Da cap nhat noi dung." : "Da tao noi dung moi." });
      setSelectedRow(null);
      setForm(blankForm());
      await loadAdminRows();
    } catch (error) {
      setNotice({ type: "error", text: error.message });
    } finally {
      setSaving(false);
    }
  }

  async function deleteRow(row) {
    const ok = window.confirm(`Xoa #${row.id}?`);
    if (!ok) return;
    setSaving(true);

    try {
      await adminRequest(`/${activeResource.key}/${row.id}`, { method: "DELETE" });
      setNotice({ type: "success", text: "Da xoa noi dung." });
      await loadAdminRows();
      if (selectedRow?.id === row.id) startCreate();
    } catch (error) {
      setNotice({ type: "error", text: error.message });
    } finally {
      setSaving(false);
    }
  }

  async function uploadAsset(field, file) {
    if (!file) return;
    setSaving(true);
    setNotice(null);

    try {
      const body = new FormData();
      body.append("file", file);
      const payload = await adminRequest("/upload", {
        method: "POST",
        body
      });
      updateAdminField(field, payload.data?.url || "");
      setNotice({ type: "success", text: "Upload anh thanh cong." });
    } catch (error) {
      setNotice({ type: "error", text: error.message });
    } finally {
      setSaving(false);
    }
  }

  function previewValue(row) {
    return row.name || row.title || row.full_name || row.key || row.slug || row.email || `#${row.id}`;
  }

  useEffect(() => {
    setForm(blankForm());
  }, []);

  useEffect(() => {
    if (token) loadAdminRows(activeResource);
  }, [token, activeKey]);

  if (!token) {
    return (
      <main className="admin-login-shell">
        <form className="admin-login" onSubmit={login}>
          <div className="admin-login-brand">
            <span><ShieldCheck size={24} /></span>
            <div>
              <h1>Homestay CMS</h1>
              <p>Quan tri content, phong va booking data.</p>
            </div>
          </div>
          {notice && <div className={`notice ${notice.type}`}>{notice.text}</div>}
          <label>
            Tai khoan
            <input value={loginForm.username} onChange={(event) => setLoginForm((current) => ({ ...current, username: event.target.value }))} />
          </label>
          <label>
            Mat khau
            <input type="password" value={loginForm.password} onChange={(event) => setLoginForm((current) => ({ ...current, password: event.target.value }))} />
          </label>
          <button className="primary-btn full" type="submit" disabled={saving}>
            {saving ? <Loader2 className="spin" size={18} /> : <ShieldCheck size={18} />}
            Dang nhap
          </button>
        </form>
      </main>
    );
  }

  return (
    <main className="admin-shell">
      <aside className="admin-sidebar">
        <div className="admin-brand">
          <LayoutDashboard size={22} />
          <div>
            <strong>Homestay CMS</strong>
            <span>Content manager</span>
          </div>
        </div>
        <nav className="admin-resource-nav">
          {adminResources.map((resource) => (
            <button
              key={resource.key}
              type="button"
              className={resource.key === activeKey ? "active" : ""}
              onClick={() => chooseResource(resource)}
            >
              {resource.label}
            </button>
          ))}
        </nav>
        <button className="admin-logout" type="button" onClick={logout}>
          <LogOut size={16} />
          Dang xuat
        </button>
      </aside>

      <section className="admin-main">
        <header className="admin-toolbar">
          <div>
            <h1>{activeResource.label}</h1>
            <p>{rows.length} ban ghi trong CMS</p>
          </div>
          <div className="admin-actions">
            <div className="admin-search">
              <Search size={17} />
              <input
                value={searchText}
                placeholder="Tim noi dung..."
                onChange={(event) => setSearchText(event.target.value)}
                onKeyDown={(event) => {
                  if (event.key === "Enter") loadAdminRows();
                }}
              />
            </div>
            <button className="icon-btn admin-icon-btn" type="button" onClick={() => loadAdminRows()} aria-label="Tai lai">
              <RefreshCw size={18} />
            </button>
            <button className="primary-btn" type="button" onClick={startCreate}>
              <Plus size={17} />
              Tao moi
            </button>
          </div>
        </header>

        {notice && <div className={`notice ${notice.type}`}>{notice.text}</div>}

        <div className="admin-workspace">
          <section className="admin-table-panel">
            {loading ? (
              <div className="admin-loading"><Loader2 className="spin" size={20} /> Dang tai du lieu...</div>
            ) : (
              <div className="admin-table-wrap">
                <table className="admin-table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Noi dung</th>
                      <th>Trang thai</th>
                      <th>Cap nhat</th>
                      <th aria-label="Tac vu" />
                    </tr>
                  </thead>
                  <tbody>
                    {rows.map((row) => (
                      <tr key={row.id} className={selectedRow?.id === row.id ? "selected" : ""}>
                        <td>#{row.id}</td>
                        <td>
                          <button type="button" className="admin-row-title" onClick={() => startEdit(row)}>
                            {previewValue(row)}
                          </button>
                          <span>{row.description || row.address || row.phone || row.slug || ""}</span>
                        </td>
                        <td>
                          <i className={row.active === false || row.status === "cancelled" ? "status-dot off" : "status-dot"} />
                          {row.active === false ? "An" : row.status || "Active"}
                        </td>
                        <td>{row.updated_at ? new Date(row.updated_at).toLocaleDateString("vi-VN") : "-"}</td>
                        <td>
                          <div className="admin-row-actions">
                            <button type="button" onClick={() => startEdit(row)} aria-label="Sua"><Edit3 size={16} /></button>
                            <button type="button" onClick={() => deleteRow(row)} aria-label="Xoa"><Trash2 size={16} /></button>
                          </div>
                        </td>
                      </tr>
                    ))}
                    {!rows.length && (
                      <tr>
                        <td colSpan="5" className="admin-empty">Chua co du lieu.</td>
                      </tr>
                    )}
                  </tbody>
                </table>
              </div>
            )}
          </section>

          <form className="admin-editor" onSubmit={saveRow}>
            <div className="admin-editor-head">
              <div>
                <h2>{selectedRow ? `Sua #${selectedRow.id}` : "Tao moi"}</h2>
                <p>{activeResource.label}</p>
              </div>
              <button className="ghost-btn" type="button" onClick={startCreate}>Reset</button>
            </div>

            <div className="admin-field-grid">
              {activeResource.fields.map((field) => (
                <label key={field} className={textareaFields.has(field) ? "wide" : ""}>
                  <span>{field}</span>
                  {booleanFields.has(field) ? (
                    <input
                      type="checkbox"
                      checked={Boolean(form[field])}
                      onChange={(event) => updateAdminField(field, event.target.checked)}
                    />
                  ) : textareaFields.has(field) ? (
                    <textarea
                      value={form[field] || ""}
                      onChange={(event) => updateAdminField(field, event.target.value)}
                    />
                  ) : (
                    <input
                      type={field === "password" ? "password" : numberFields.has(field) ? "number" : "text"}
                      value={form[field] || ""}
                      placeholder={field === "password" && selectedRow ? "De trong neu khong doi" : ""}
                      onChange={(event) => updateAdminField(field, event.target.value)}
                    />
                  )}
                  {imageFields.has(field) && (
                    <div className="admin-upload-row">
                      <input type="file" accept="image/*" onChange={(event) => uploadAsset(field, event.target.files?.[0])} />
                      {form[field] && <img src={assetUrl(form[field])} alt="" />}
                    </div>
                  )}
                </label>
              ))}
            </div>

            <button className="primary-btn full admin-save-btn" type="submit" disabled={saving}>
              {saving ? <Loader2 className="spin" size={18} /> : <Save size={18} />}
              {selectedRow ? "Luu thay doi" : "Tao noi dung"}
            </button>
          </form>
        </div>
      </section>
    </main>
  );
}

function RoomDetailPage({ room, loading, notice, search, updateSearch, onBack, onBook }) {
  const [selectedSlots, setSelectedSlots] = useState([]);
  const [availabilityRows, setAvailabilityRows] = useState([]);
  const [availabilityLoading, setAvailabilityLoading] = useState(false);
  const [detailForm, setDetailForm] = useState({
    full_name: "",
    phone: "",
    note: "",
    adult_confirm: false,
    return_confirm: false
  });
  const [detailSubmitting, setDetailSubmitting] = useState(false);
  const [detailNotice, setDetailNotice] = useState(null);
  const [paymentBooking, setPaymentBooking] = useState(null);
  const gallery = room?.images?.length
    ? room.images.map((image) => assetUrl(image.image_url || image.image_path))
    : [
        "https://images.unsplash.com/photo-1616594039964-ae9021a400a0?auto=format&fit=crop&w=1000&q=85",
        "https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=85",
        "https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=900&q=85"
      ];
  const bookingDays = upcomingBookingDays(8);
  const firstBookingDate = bookingDays[0]?.iso;
  const detailSlots = room?.time_slots?.length
    ? room.time_slots.map((slot) => ({
        id: String(slot.id),
        code: slot.code,
        label: slot.label,
        subLabel: slot.crosses_midnight ? "(Qua dem)" : "",
        price: slot.price_amount
      }))
    : bookingSlots.map((slot) => ({ ...slot, code: slot.id }));
  const slotStatusMap = useMemo(() => {
    return availabilityRows.reduce((result, item) => {
      result.set(`${normalizeDateKey(item.booking_date)}|${String(item.room_time_slot_id)}`, item);
      return result;
    }, new Map());
  }, [availabilityRows]);
  const selectedTotal = selectedSlots.reduce((total, key) => {
    const slotId = key.split("|")[1];
    const slot = detailSlots.find((item) => item.id === slotId);
    return total + Number(slot?.price || 0);
  }, 0);
  const selectedSlotPayload = selectedSlots.map((key) => {
    const [booking_date, slotId] = key.split("|");
    return {
      booking_date,
      room_time_slot_id: Number(slotId)
    };
  });

  function updateDetailForm(field, value) {
    setDetailForm((current) => ({ ...current, [field]: value }));
  }

  async function loadAvailability() {
    if (!room?.id || !firstBookingDate) return;
    setAvailabilityLoading(true);

    try {
      const params = new URLSearchParams({
        date_from: firstBookingDate,
        days: String(bookingDays.length)
      });
      const payload = await apiFetch(`/rooms/${room.id}/availability?${params.toString()}`);
      setAvailabilityRows(payload.data || []);
    } catch (error) {
      setDetailNotice({ type: "error", text: `Khong tai duoc lich phong: ${error.message}` });
      setAvailabilityRows([]);
    } finally {
      setAvailabilityLoading(false);
    }
  }

  function toggleSlot(day, slot) {
    const key = `${day.iso}|${slot.id}`;
    const availability = slotStatusMap.get(key);
    if (availability && availability.status !== "available") return;

    setSelectedSlots((current) =>
      current.includes(key)
        ? current.filter((item) => item !== key)
        : [...current, key]
    );
  }

  async function submitDetailBooking() {
    setDetailNotice(null);
    setPaymentBooking(null);

    if (!selectedSlots.length) {
      setDetailNotice({ type: "error", text: "Chon it nhat 1 khung gio truoc nha." });
      return;
    }
    if (!detailForm.full_name.trim() || !detailForm.phone.trim()) {
      setDetailNotice({ type: "error", text: "Nhap ho ten va so dien thoai de tao booking." });
      return;
    }
    if (!detailForm.adult_confirm || !detailForm.return_confirm) {
      setDetailNotice({ type: "error", text: "Ban can tick xac nhan thong tin truoc khi dat phong." });
      return;
    }

    setDetailSubmitting(true);
    try {
      const payload = await apiFetch("/bookings", {
        method: "POST",
        body: JSON.stringify({
          room_id: room.id,
          full_name: detailForm.full_name,
          phone: detailForm.phone,
          guests: Number(search.guests),
          note: detailForm.note,
          slots: selectedSlotPayload
        })
      });

      setPaymentBooking(payload.data);
      setSelectedSlots([]);
      setDetailNotice({ type: "success", text: "Da tao booking. Quet VietQR de giu phong trong 10 phut." });
      await loadAvailability();
    } catch (error) {
      setDetailNotice({ type: "error", text: error.message });
    } finally {
      setDetailSubmitting(false);
    }
  }

  function copyTransferContent() {
    const content = paymentBooking?.payment?.transfer_content;
    if (!content) return;
    navigator.clipboard?.writeText(content);
    setDetailNotice({ type: "success", text: "Da copy noi dung chuyen khoan." });
  }

  async function refreshPaymentStatus(bookingId, silent = true) {
    if (!bookingId) return;

    try {
      const payload = await apiFetch(`/bookings/${bookingId}/payment`);
      setPaymentBooking((current) => {
        if (!current || String(current.id) !== String(bookingId)) return current;
        return {
          ...current,
          status: payload.data?.status || current.status,
          total_amount: payload.data?.total_amount ?? current.total_amount,
          payment: payload.data?.payment || current.payment
        };
      });

      if (payload.data?.status === "confirmed" || payload.data?.payment?.status === "paid") {
        setDetailNotice({ type: "success", text: "Thanh toan thanh cong. Booking da duoc xac nhan." });
        await loadAvailability();
      } else if (payload.data?.status === "expired" || payload.data?.payment?.status === "cancelled") {
        setDetailNotice({ type: "error", text: "Booking da qua 10 phut chua thanh toan nen phong da duoc tra lai." });
        await loadAvailability();
      } else if (!silent) {
        setDetailNotice({ type: "muted", text: "Dang cho xac nhan thanh toan." });
      }
    } catch (error) {
      if (!silent) setDetailNotice({ type: "error", text: error.message });
    }
  }

  useEffect(() => {
    setSelectedSlots([]);
    setPaymentBooking(null);
    setAvailabilityRows([]);
    if (room?.id) loadAvailability();
  }, [room?.id]);

  useEffect(() => {
    const bookingId = paymentBooking?.id;
    const paymentStatus = paymentBooking?.payment?.status;
    const bookingStatus = paymentBooking?.status;
    if (!bookingId || paymentStatus === "paid" || bookingStatus === "confirmed" || bookingStatus === "expired") return undefined;

    const socket = io(SOCKET_BASE_URL, {
      transports: ["websocket", "polling"]
    });

    socket.emit("booking:join", bookingId);
    socket.on("booking:updated", async (booking) => {
      if (String(booking.id) !== String(bookingId)) return;
      setPaymentBooking(booking);
      if (booking.status === "confirmed" || booking.payment?.status === "paid") {
        setDetailNotice({ type: "success", text: "Thanh toan thanh cong. Booking da duoc xac nhan." });
      }
      if (booking.status === "expired") {
        setDetailNotice({ type: "error", text: "Booking da qua 10 phut chua thanh toan nen phong da duoc tra lai." });
      }
      await loadAvailability();
    });

    const timer = window.setInterval(() => {
      refreshPaymentStatus(bookingId);
    }, 4000);

    return () => {
      window.clearInterval(timer);
      socket.emit("booking:leave", bookingId);
      socket.disconnect();
    };
  }, [paymentBooking?.id, paymentBooking?.payment?.status, paymentBooking?.status]);

  if (loading) {
    return (
      <section className="room-detail-page">
        <div className="empty-state"><Loader2 className="spin" size={22} /> Dang tai chi tiet phong...</div>
      </section>
    );
  }

  if (!room) {
    return (
      <section className="room-detail-page">
        <button className="back-btn" type="button" onClick={onBack}><ArrowLeft size={18} /> Quay lai</button>
        {notice && <div className={`notice ${notice.type}`}>{notice.text}</div>}
        <div className="empty-state">Khong tim thay thong tin phong.</div>
      </section>
    );
  }

  return (
    <section className="room-detail-page booking-detail-page">
      <button className="back-btn detail-back-btn" type="button" onClick={onBack}><ArrowLeft size={18} /> Quay lai</button>

      <div className="booking-detail-layout">
        <div className="detail-left-column">
          <h1 className="booking-detail-title">Libra - 22</h1>

          <div className="booking-gallery">
            <button className="gallery-arrow gallery-arrow-left" type="button" aria-label="Anh truoc"><ChevronLeft size={22} /></button>
            <img className="booking-gallery-main" src={gallery[0]} alt={room.name} />
            <div className="gallery-peek gallery-peek-left"><img src={gallery[1] || gallery[0]} alt="" /></div>
            <div className="gallery-peek gallery-peek-right"><img src={gallery[2] || gallery[0]} alt="" /></div>
            <button className="gallery-arrow gallery-arrow-right" type="button" aria-label="Anh sau"><ChevronRight size={22} /></button>
            <div className="gallery-dots" aria-hidden="true"><span /><span /><span /></div>
          </div>

          <div className="slot-booking-section">
            <div className="price-board">
              <h2>Bang gia</h2>
              <div className="price-row">
                <span><strong>{compactMoney(200000)}</strong>d/3h</span>
                <span><strong>{compactMoney(room.price_per_night || 370000)}</strong>d/dem</span>
                <span><strong>{compactMoney(580000)}</strong>d/ngay</span>
              </div>
            </div>

            <div className="slot-heading-row">
              <div>
                <h2>Lua chon khung gio danh cho ban</h2>
                <div className="slot-legend">
                  <span><i className="legend-box booked" />Da Dat</span>
                  <span><i className="legend-box available" />Con Trong</span>
                  <span><i className="legend-box selected" />Dang chon</span>
                </div>
              </div>
              <button className="primary-btn compact-slot-btn" type="button" onClick={() => onBook(room)}>
                {availabilityLoading ? <Loader2 className="spin" size={16} /> : null}
                Dat phong
              </button>
            </div>

            <div className="slot-table-wrap">
              <table className="slot-table">
                <thead>
                  <tr>
                    <th colSpan="2">Chi nhanh</th>
                    <th colSpan={detailSlots.length}>{room.branch?.address || "134/35 Duong Ha Huy Giap, Phuong Trung Dung, Bien Hoa, Dong Nai"}</th>
                  </tr>
                  <tr>
                    <th colSpan="2">Ten phong</th>
                    <th colSpan={detailSlots.length}>Libra 22</th>
                  </tr>
                  <tr>
                    <th>Thu</th>
                    <th>Ngay</th>
                    {detailSlots.map((slot) => (
                      <th key={slot.id}>
                        {slot.label}
                        {slot.subLabel && <small>{slot.subLabel}</small>}
                      </th>
                    ))}
                  </tr>
                </thead>
                <tbody>
                  {bookingDays.map((day) => (
                    <tr key={day.iso}>
                      <td className={day.index === 0 ? "today-cell" : ""}>{day.label}</td>
                      <td className={day.index === 0 ? "today-cell" : ""}>{day.dateText}</td>
                      {detailSlots.map((slot) => {
                        const key = `${day.iso}|${slot.id}`;
                        const availability = slotStatusMap.get(key);
                        const isBooked = availability && availability.status !== "available";
                        const isSelected = selectedSlots.includes(key);
                        return (
                          <td key={key}>
                            <button
                              type="button"
                              className={[
                                "slot-cell-btn",
                                isBooked ? "is-booked" : "",
                                isSelected ? "is-selected" : ""
                              ].filter(Boolean).join(" ")}
                              disabled={isBooked}
                              onClick={() => toggleSlot(day, slot)}
                              aria-label={`${day.dateText} ${slot.label}`}
                            >
                              {isBooked && <Star className="booked-star" size={14} fill="currentColor" />}
                            </button>
                          </td>
                        );
                      })}
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
            <div className="slot-summary">
              <p>** Khach hang duoc giam them 5% khi book 2 khung gio, 10% khi book 3 khung gio</p>
              <strong>Tong tien tam tinh: {compactMoney(selectedTotal)} d</strong>
            </div>
          </div>

          <div className="room-amenity-section">
            <h2>Tien nghi phong</h2>
            <div className="room-amenity-list">
              <span><Utensils size={22} />Nha bep hien dai</span>
              <span><Film size={22} />Netflix</span>
              <span><BedDouble size={22} />Giuong King</span>
              <span><Projector size={22} />May chieu</span>
              <span><ShieldCheck size={22} />Guong toan than</span>
              <span><Wifi size={22} />Wifi toc do cao</span>
              <span><Bath size={22} />Bon tam</span>
              <span><WashingMachine size={22} />May giat tu dong</span>
              <span><Gamepad2 size={22} />Boardgames</span>
            </div>
          </div>
        </div>

        <aside className="detail-booking-panel">
          <h2>Thong tin Dat phong</h2>
          {(detailNotice || notice) && (
            <div className={`notice ${detailNotice?.type || notice?.type}`}>{detailNotice?.text || notice?.text}</div>
          )}
          <input
            className="booking-text-input"
            placeholder="Ho va ten"
            value={detailForm.full_name}
            onChange={(event) => updateDetailForm("full_name", event.target.value)}
          />
          <input
            className="booking-text-input"
            placeholder="So dien thoai"
            value={detailForm.phone}
            onChange={(event) => updateDetailForm("phone", event.target.value)}
          />
          <p className="booking-note">* Ban vui long nhap dung so dien thoai, Home se gui thong tin check-in qua Zalo</p>

          <label className="booking-label">So luong khach</label>
          <select
            className="booking-text-input"
            value={search.guests}
            onChange={(event) => updateSearch("guests", event.target.value)}
          >
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
          <p className="booking-note">* Neu &gt; 2 khach, Home xin phep phu thu 100k/khach oi.</p>
          <p className="booking-note">* Home chi nhan toi da 2 khach neu khach book o khung gio qua dem.</p>

          <label className="booking-label">Can cuoc cong dan</label>
          <div className="id-upload-grid">
            <button type="button"><ImagePlus size={30} /><span>Mat truoc</span></button>
            <button type="button"><ImagePlus size={30} /><span>Mat sau</span></button>
          </div>
          <p className="booking-note">* Thong tin CCCD cua ban duoc luu tru va bao mat rieng tu de khai bao luu tru, se duoc xoa bo sau khi ban check-out.</p>

          <textarea
            className="booking-textarea"
            placeholder="Ghi chu cho The Anh The Home"
            value={detailForm.note}
            onChange={(event) => updateDetailForm("note", event.target.value)}
          />

          <label className="booking-check danger-check">
            <input
              type="checkbox"
              checked={detailForm.adult_confirm}
              onChange={(event) => updateDetailForm("adult_confirm", event.target.checked)}
            />
            <span>Xac nhan moi nguoi da du tuoi vi thanh nien, hoac tre em phai co nguoi giam ho. nguoi Dat phong chiu trach nhiem voi thong tin nay.</span>
          </label>
          <label className="booking-check">
            <input
              type="checkbox"
              checked={detailForm.return_confirm}
              onChange={(event) => updateDetailForm("return_confirm", event.target.checked)}
            />
            <span>Sau khi quet ma thanh toan thanh cong ban hay quay lai day de chup thong tin Booking.</span>
          </label>

          {paymentBooking?.payment && (
            <div className="vietqr-card">
              <div className="vietqr-title">
                <CreditCard size={18} />
                <span>{paymentBooking.payment.status === "paid" ? "Da thanh toan" : paymentBooking.payment.provider === "momo" ? "Thanh toan MoMo" : "Thanh toan VietQR"}</span>
              </div>
              {paymentBooking.payment.qr_url && (
                <img src={paymentBooking.payment.qr_url} alt="Ma thanh toan" />
              )}
              {paymentBooking.payment.provider === "momo" && !paymentBooking.payment.qr_url && (
                <div className="momo-empty-qr">
                  <CreditCard size={34} />
                  <span>MoMo khong tra anh QR trong response nay.</span>
                  <strong>Bam nut ben duoi de mo trang thanh toan MoMo.</strong>
                </div>
              )}
              <div className="vietqr-row">
                <span>So tien</span>
                <strong>{money(paymentBooking.payment.amount)}</strong>
              </div>
              <div className="vietqr-row">
                <span>{paymentBooking.payment.provider === "momo" ? "Ma don" : "Noi dung"}</span>
                <button type="button" onClick={copyTransferContent}>
                  {paymentBooking.payment.transfer_content} <Copy size={14} />
                </button>
              </div>
              {paymentBooking.payment.raw_payload?.response?.payUrl && (
                <a className="primary-btn full momo-pay-btn" href={paymentBooking.payment.raw_payload.response.payUrl} target="_blank" rel="noreferrer">
                  Mo MoMo de thanh toan
                </a>
              )}
              <p>Booking #{paymentBooking.booking_code}. He thong dang giu phong trong 10 phut.</p>
              <button className="ghost-btn vietqr-refresh-btn" type="button" onClick={() => refreshPaymentStatus(paymentBooking.id, false)}>
                <RefreshCw size={14} />
                Kiem tra thanh toan
              </button>
            </div>
          )}

          <p className="policy-copy">Khi bam Dat phong dong nghia voi viec ban da doc va dong y voi cac <b>Noi quy</b> & <b>Chinh sach</b> cua The Anh The Home</p>

          <div className="booking-warning">
            <b>*Chu y:</b><br />
            - Ban dang dat phong tai: Home - Ben Ninh Kieu, Can Tho.<br />
            - Day la he thong dat phong tu dong, nen khi bam Dat phong ban se duoc chuyen sang quet ma QR de thanh toan qua App ngan hang.
          </div>

          <button className="primary-btn full detail-submit-btn" type="button" onClick={submitDetailBooking} disabled={detailSubmitting}>
            {detailSubmitting ? <Loader2 className="spin" size={17} /> : <CalendarCheck size={17} />}
            Dat phong va lay QR
          </button>
        </aside>
      </div>
    </section>
  );
}

export default App;
