import { useCallback, useEffect, useMemo, useState } from "react";
import { io } from "socket.io-client";
import useEmblaCarousel from "embla-carousel-react";
import toast, { Toaster } from "react-hot-toast";
import {
  ArrowLeft,
  ArrowUp,
  Bath,
  BedDouble,
  Building2,
  CalendarCheck,
  Check,
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

import AuthModal from "./components/auth/AuthModal";
import FloatingContact from "./components/layout/FloatingContact";
import Footer from "./components/layout/Footer";
import Header from "./components/layout/Header";
import BrandLogo from "./components/layout/BrandLogo";
import HeroSection from "./components/home/HeroSection";
import IntroSection from "./components/home/IntroSection";
import RoomsSection from "./components/home/RoomsSection";
import { API_BASE_URL, SOCKET_BASE_URL } from "./config/appConfig";
import { adminResources, booleanFields, fieldLabels, imageFields, numberFields, textareaFields } from "./data/adminConfig";
import { bookingSlots } from "./data/homeContent";
import { apiFetch } from "./services/api";
import { buildSlotDateRange, defaultBookingDate, normalizeDateKey, toApiDate, upcomingBookingDays } from "./utils/date";
import { assetUrl, compactMoney, money } from "./utils/format";

function getRoomKeyFromPath() {
  const match = window.location.pathname.match(/^\/rooms\/([^/?#]+)/);
  return match ? match[1] : null;
}

function createDefaultSearch(options = bookingSlots) {
  const firstSlot = options[0] || {};
  return {
    booking_date: defaultBookingDate(),
    slot_id: firstSlot.id || "",
    check_in: "",
    check_out: "",
    booking_type: firstSlot.type || "",
    guests: 2
  };
}

function createEmptySearch() {
  return {
    booking_date: "",
    slot_id: "",
    check_in: "",
    check_out: "",
    booking_type: "",
    guests: 2
  };
}

function toAdminSlug(value) {
  return String(value || "")
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .replace(/đ/g, "d")
    .replace(/Đ/g, "d")
    .toLowerCase()
    .trim()
    .replace(/[^a-z0-9]+/g, "-")
    .replace(/^-+|-+$/g, "");
}

function readStoredUser() {
  try {
    return JSON.parse(localStorage.getItem("homestay_user") || "null");
  } catch (error) {
    return null;
  }
}

function normalizeBookingOptions(options = []) {
  return options.map((option) => ({
    id: option.code,
    label: option.label || `${String(option.start_time || option.start || "").slice(0, 5)} - ${String(option.end_time || option.end || "").slice(0, 5)}`,
    type: option.rate_code || option.type,
    rateName: option.rate_name || option.rateName || option.rate_code,
    start: String(option.start_time || option.start || "").slice(0, 5),
    end: String(option.end_time || option.end || "").slice(0, 5),
    crossesMidnight: Boolean(option.crosses_midnight ?? option.crossesMidnight),
    price: option.price_amount ?? option.price,
    position: option.position || 0
  })).filter((option) => option.id && option.type && option.start && option.end);
}

function getSearchSlotRange(search, options = bookingSlots) {
  const slot = options.find((item) => item.id === search.slot_id && item.type === search.booking_type);
  return buildSlotDateRange(search.booking_date, slot);
}

function App() {
  const [currentRoomId, setCurrentRoomId] = useState(getRoomKeyFromPath());
  const [isAdminRoute, setIsAdminRoute] = useState(window.location.pathname.startsWith("/admin"));
  const [detailRoom, setDetailRoom] = useState(null);
  const [detailLoading, setDetailLoading] = useState(false);
  const [search, setSearch] = useState(() => createEmptySearch());
  const [rooms, setRooms] = useState([]);
  const [homeRooms, setHomeRooms] = useState([]);
  const [branches, setBranches] = useState([]);
  const [bookingOptions, setBookingOptions] = useState(bookingSlots);
  const [selectedBranchId, setSelectedBranchId] = useState(null);
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

  async function fetchRooms(nextSearch = search, branchId = selectedBranchId) {
    if (!branchId) {
      setNotice({ type: "muted", text: "Vui lòng chọn chi nhánh trước khi tìm phòng." });
      return;
    }
    setLoading(true);
    setNotice(null);

    try {
      if (!nextSearch.booking_type || !nextSearch.booking_date || !nextSearch.slot_id || !nextSearch.guests) {
        setNotice({ type: "error", text: "Vui lòng chọn đầy đủ loại đặt, ngày, khung giờ và số khách." });
        return;
      }
      const slotRange = getSearchSlotRange(nextSearch, bookingOptions);
      if (!slotRange) {
        setNotice({ type: "error", text: "Vui lòng chọn ngày và khung giờ hợp lệ." });
        return;
      }
      const params = new URLSearchParams({
        check_in: toApiDate(slotRange.checkIn),
        check_out: toApiDate(slotRange.checkOut),
        slot_code: nextSearch.slot_id,
        guests: String(nextSearch.guests)
      });
      params.set("branch_id", String(branchId));
      const payload = await apiFetch(`/rooms/available?${params.toString()}`);
      setRooms(payload.data || []);
      if (!payload.data?.length) {
        setNotice({ type: "muted", text: "Không có phòng trống theo chi nhánh, ngày, khung giờ này. Thử đổi slot hoặc số khách." });
      }
    } catch (error) {
      setRooms([]);
      setNotice({ type: "error", text: error.message });
    } finally {
      setLoading(false);
    }
  }

  async function loadRooms(event) {
    event?.preventDefault();
    return fetchRooms();
  }

  function showHomeRooms(branchId = null, sourceRooms = homeRooms) {
    const nextRooms = branchId
      ? sourceRooms.filter((room) => String(room.branch_id || room.branch?.id || "") === String(branchId))
      : sourceRooms;

    setRooms(nextRooms);
    if (!nextRooms.length) {
      setNotice({ type: "muted", text: "Chưa có phòng nào đang hiển thị." });
    }
  }

  function updateSearch(field, value) {
    setSearch((current) => {
      if (field === "booking_type") {
        return { ...current, booking_type: value, slot_id: "" };
      }
      return { ...current, [field]: value };
    });
  }

  async function loadHomeContent() {
    try {
      const payload = await apiFetch("/home");
      const branchNames = {
        "pham-van-thuan-tam-hiep": "Biên Hòa",
        "ha-huy-giap-trung-dung": "Hà Huy Giáp",
        "chu-van-an-long-thanh": "Long Thành",
        "111-d1-chanh-nghia": "Thủ Dầu Một",
        "vo-thi-sau-di-an": "Dĩ An"
      };
      setBranches((payload.data?.branches || []).map((branch) => ({
        ...branch,
        nav_name: branchNames[branch.slug] || branch.name
      })));
      const nextBookingOptions = normalizeBookingOptions(payload.data?.booking_options || []);
      const defaultOptions = nextBookingOptions.length ? nextBookingOptions : bookingSlots;
      setBookingOptions(defaultOptions);
      setSearch(createEmptySearch());
      setSelectedBranchId(null);
      setHomeRooms(payload.data?.rooms || []);
      showHomeRooms(null, payload.data?.rooms || []);
    } catch (error) {
      setNotice({ type: "error", text: error.message });
    }
  }

  function selectBranch(branchId, options = {}) {
    const nextBranchId = branchId ? Number(branchId) : null;
    const nextSearch = createEmptySearch();
    setSelectedBranchId(nextBranchId);
    setSearch(nextSearch);
    window.history.pushState({}, "", "/");
    setCurrentRoomId(null);
    setNotice(null);
    showHomeRooms(nextBranchId);
    if (options.scroll !== false) {
      setTimeout(() => document.getElementById(branchId ? "rooms" : "top")?.scrollIntoView({ behavior: "smooth" }), 0);
    }
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
    const roomKey = room.slug || room.id;
    window.history.pushState({}, "", `/rooms/${roomKey}`);
    setCurrentRoomId(String(roomKey));
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
      const roomPayload = await apiFetch(`/rooms/${roomId}`);
      const apiImages = roomPayload.data?.images || [];
      const legacyImages = apiImages.length
        ? []
        : (await apiFetch(`/room-images?room_id=${roomPayload.data?.id || roomId}`)).data || [];
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
        text: `Đã gửi booking #${payload.data.id}. Tổng tiền tạm tính ${money(payload.data.total_price)}.`
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
    setNotice({ type: "muted", text: "Đã đăng xuất tài khoản khách." });
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
      setNotice({ type: "success", text: `Xin chào ${payload.user?.name || payload.user?.phone || "bạn"}!` });
    } catch (error) {
      setAuthNotice({ type: "error", text: error.message });
    } finally {
      setAuthLoading(false);
    }
  }

  useEffect(() => {
    loadHomeContent();
  }, []);

  useEffect(() => {
    function handlePopState() {
      setCurrentRoomId(getRoomKeyFromPath());
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
      <Header
        branches={branches}
        selectedBranchId={selectedBranchId}
        user={authUser}
        onBranchSelect={selectBranch}
        onLoginClick={() => openAuth("login")}
        onLogout={logoutUser}
      />

      <main id="top">
        {currentRoomId ? (
          <RoomDetailPage
            room={detailRoom}
            loading={detailLoading}
            notice={notice}
            search={search}
            updateSearch={updateSearch}
            onBack={backToHome}
          />
        ) : (
        <>
        <HeroSection
          branches={branches}
          bookingOptions={bookingOptions}
          selectedBranchId={selectedBranchId}
          search={search}
          loading={loading}
          onSearch={loadRooms}
          onBranchChange={(branchId) => selectBranch(branchId, { scroll: false })}
          onUpdateSearch={updateSearch}
        />
        <IntroSection />
        <RoomsSection
          rooms={rooms}
          selectedBranch={branches.find((branch) => String(branch.id) === String(selectedBranchId))}
          loading={loading}
          notice={notice}
          onOpenRoomDetail={openRoomDetail}
        />
        </>
        )}
      </main>

      <FloatingContact />
      <Footer />
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
      <Toaster
        position="top-right"
        toastOptions={{
          duration: 4200,
          style: {
            borderRadius: "8px",
            border: "1px solid #fecdd3",
            background: "#fff1f2",
            color: "#be123c",
            fontSize: "14px",
            fontWeight: 800,
            padding: "14px 16px"
          }
        }}
      />
    </div>
  );
}

function AdminPage() {
  const [token, setToken] = useState(() => localStorage.getItem("homestay_admin_token") || "");
  const [loginForm, setLoginForm] = useState({ username: "admin", password: "admin123" });
  const [activeKey, setActiveKey] = useState(adminResources[0].key);
  const [adminView, setAdminView] = useState("dashboard");
  const [rows, setRows] = useState([]);
  const [searchText, setSearchText] = useState("");
  const [statusFilter, setStatusFilter] = useState("all");
  const [dateFilter, setDateFilter] = useState("");
  const [perPage, setPerPage] = useState("10");
  const [page, setPage] = useState(1);
  const [amenityOptions, setAmenityOptions] = useState([]);
  const [packageOptions, setPackageOptions] = useState([]);
  const [slotOptions, setSlotOptions] = useState([]);
  const [branchOptions, setBranchOptions] = useState([]);
  const [roomOptions, setRoomOptions] = useState([]);
  const [ratePlanOptions, setRatePlanOptions] = useState([]);
  const [selectedRow, setSelectedRow] = useState(null);
  const [form, setForm] = useState({});
  const [loading, setLoading] = useState(false);
  const [saving, setSaving] = useState(false);
  const [notice, setNotice] = useState(null);

  const activeResource = adminResources.find((item) => item.key === activeKey) || adminResources[0];
  const groupedResources = useMemo(() => {
    return adminResources.reduce((groups, resource) => {
      const group = resource.group || "Danh mục";
      if (!groups[group]) groups[group] = [];
      groups[group].push(resource);
      return groups;
    }, {});
  }, []);
  const visibleRows = rows.filter((row) => row.active !== false).length;
  const inactiveRows = rows.length - visibleRows;
  const overviewTotal = rows.reduce((sum, row) => sum + Number(row.total_price || row.price_per_night || row.price_per_hour || 0), 0);
  const filteredRows = rows.filter((row) => {
    const term = searchText.trim().toLowerCase();
    const rowText = [
      previewValue(row),
      row.description,
      row.address,
      row.phone,
      row.slug,
      row.status
    ].filter(Boolean).join(" ").toLowerCase();
    const rowDate = String(row.created_at || row.updated_at || "").slice(0, 10);
    const statusMatched =
      statusFilter === "all" ||
      (statusFilter === "active" && row.active !== false && !["cancelled", "pending_payment"].includes(row.status)) ||
      (statusFilter === "inactive" && row.active === false) ||
      row.status === statusFilter;

    return (!term || rowText.includes(term)) && statusMatched && (!dateFilter || rowDate === dateFilter);
  });
  const lastPage = Math.max(Math.ceil(filteredRows.length / Number(perPage)), 1);
  const currentPage = Math.min(page, lastPage);
  const visibleListRows = filteredRows.slice((currentPage - 1) * Number(perPage), currentPage * Number(perPage));
  const resourceIcons = {
    amenities: Sofa,
    news: Film,
    images: ImagePlus,
    galleries: ImagePlus,
    branches: Building2,
    rooms: Hotel,
    "room-images": ImagePlus,
    bookings: CalendarCheck,
    homestays: MapPin,
    commits: CheckCircle2,
    contacts: Phone,
    pages: Copy,
    systems: ShieldCheck,
    admins: Users,
    roles: ShieldCheck,
    permissions: ShieldCheck
  };

  function blankForm(resource = activeResource) {
    return resource.fields.reduce((result, field) => {
      if (booleanFields.has(field)) result[field] = true;
      else if (field === "amenity_ids" || field === "package_ids" || field === "slot_codes") result[field] = [];
      else if (field === "room_image_urls") result[field] = [];
      else result[field] = "";
      return result;
    }, {});
  }

  async function adminRequest(path, options = {}) {
    const isFormData = options.body instanceof FormData;
    const adminPath = path === "/upload" ? path : `/admin${path}`;
    const response = await fetch(`${API_BASE_URL}${adminPath}`, {
      ...options,
      headers: {
        ...(isFormData ? {} : { "Content-Type": "application/json" }),
        ...(token ? { Authorization: `Bearer ${token}` } : {}),
        ...(options.headers || {})
      }
    });
    const payload = await response.json().catch(() => ({}));
    if (!response.ok) {
      throw new Error(payload.message || "Thao tác không thành công.");
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
      setNotice({ type: "success", text: "Đăng nhập admin thành công." });
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

  function chooseResource(resource, view = "list") {
    setActiveKey(resource.key);
    setSelectedRow(null);
    setForm(blankForm(resource));
    setSearchText("");
    setAdminView(view);
  }

  function startCreate() {
    setSelectedRow(null);
    setForm(blankForm());
    setNotice(null);
    setAdminView("create");
  }

  function startEdit(row) {
    setSelectedRow(row);
    setForm(
      activeResource.fields.reduce((result, field) => {
        result[field] = field === "password" ? "" : row[field] ?? (booleanFields.has(field) ? false : "");
        if (field === "amenity_ids" || field === "package_ids" || field === "slot_codes") result[field] = Array.isArray(row[field]) ? row[field].map(String) : [];
        if (field === "room_image_urls") result[field] = Array.isArray(row[field]) ? row[field] : [];
        return result;
      }, {})
    );
    setNotice(null);
    setAdminView("create");
  }

  function updateAdminField(field, value) {
    setForm((current) => {
      const next = { ...current, [field]: value };
      const canAutoSlug = activeResource.fields.includes("slug") && ["name", "title", "label"].includes(field);

      if (canAutoSlug) {
        const currentSourceSlug = toAdminSlug(current[field]);
        const slugIsAuto = !current.slug || current.slug === currentSourceSlug;
        if (slugIsAuto) next.slug = toAdminSlug(value);
      }

      return next;
    });
  }

  async function loadAmenityOptions() {
    try {
      const payload = await adminRequest("/amenities/all");
      setAmenityOptions(payload.data || []);
    } catch (error) {
      setAmenityOptions([]);
    }
  }

  async function loadPackageOptions() {
    try {
      const payload = await adminRequest("/rental-packages/all?active=1");
      setPackageOptions(payload.data || []);
    } catch (error) {
      setPackageOptions([]);
    }
  }

  async function loadSlotOptions() {
    try {
      const payload = await adminRequest("/slot-templates/all");
      const fromApi = (payload.data || []).map((slot) => ({
        id: slot.code,
        code: slot.code,
        name: slot.label || `${String(slot.start_time || "").slice(0, 5)} - ${String(slot.end_time || "").slice(0, 5)}`,
        rate_name: slot.rental_package_code || slot.rate_name
      })).filter((slot) => slot.code);
      const fallback = bookingSlots.map((slot) => ({
        id: slot.id,
        code: slot.id,
        name: slot.subLabel ? `${slot.label} ${slot.subLabel}` : slot.label,
        rate_name: slot.rateName
      }));
      const merged = [...fromApi, ...fallback].reduce((items, slot) => {
        if (!items.some((item) => item.code === slot.code)) items.push(slot);
        return items;
      }, []);
      setSlotOptions(merged);
    } catch (error) {
      setSlotOptions(bookingSlots.map((slot) => ({
        id: slot.id,
        code: slot.id,
        name: slot.subLabel ? `${slot.label} ${slot.subLabel}` : slot.label,
        rate_name: slot.rateName
      })));
    }
  }

  async function loadRelationOptions() {
    await Promise.all([
      adminRequest("/branches/all?active=1").then((payload) => setBranchOptions(payload.data || [])).catch(() => setBranchOptions([])),
      adminRequest("/rooms/all?active=1").then((payload) => setRoomOptions(payload.data || [])).catch(() => setRoomOptions([])),
      adminRequest("/rate-plans/all?active=1").then((payload) => setRatePlanOptions(payload.data || [])).catch(() => setRatePlanOptions([])),
      adminRequest("/rental-packages/all?active=1").then((payload) => setPackageOptions(payload.data || [])).catch(() => setPackageOptions([])),
      loadSlotOptions()
    ]);
  }

  function relationOptions(field) {
    if (field === "branch_id") {
      return branchOptions.map((item) => ({ value: item.id, label: item.name || item.address || `Chi nhánh #${item.id}` }));
    }
    if (field === "room_id") {
      return roomOptions.map((item) => ({
        value: item.id,
        label: `${item.name || `Phòng #${item.id}`}${item.branch?.name ? ` - ${item.branch.name}` : ""}`
      }));
    }
    if (field === "rental_package_id") {
      return packageOptions.map((item) => ({ value: item.id, label: item.name || item.code || `Gói #${item.id}` }));
    }
    if (field === "rate_plan_id") {
      return ratePlanOptions.map((item) => ({
        value: item.id,
        label: `${item.room_name || item.room?.name || `Phòng #${item.room_id}`} - ${item.rental_package_name || item.name || item.code || `Gói #${item.id}`}`
      }));
    }
    return [];
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
      setNotice({ type: "success", text: selectedRow ? "Đã cập nhật nội dung." : "Đã tạo nội dung mới." });
      setSelectedRow(null);
      setForm(blankForm());
      if (activeResource.key === "slot-templates") await loadSlotOptions();
      await loadAdminRows();
      setAdminView("list");
    } catch (error) {
      setNotice({ type: "error", text: error.message });
    } finally {
      setSaving(false);
    }
  }

  async function deleteRow(row) {
    const ok = window.confirm(`Xóa #${row.id}?`);
    if (!ok) return;
    setSaving(true);

    try {
      await adminRequest(`/${activeResource.key}/${row.id}`, { method: "DELETE" });
      setNotice({ type: "success", text: "Đã xóa nội dung." });
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
      setNotice({ type: "success", text: "Upload ảnh thành công." });
    } catch (error) {
      setNotice({ type: "error", text: error.message });
    } finally {
      setSaving(false);
    }
  }

  async function uploadRoomImages(field, files) {
    const fileList = Array.from(files || []);
    if (!fileList.length) return;
    setSaving(true);
    setNotice(null);

    try {
      const uploadedUrls = [];
      for (const file of fileList) {
        const body = new FormData();
        body.append("file", file);
        const payload = await adminRequest("/upload", {
          method: "POST",
          body
        });
        if (payload.data?.url) uploadedUrls.push(payload.data.url);
      }
      setForm((current) => ({
        ...current,
        [field]: [...(current[field] || []), ...uploadedUrls]
      }));
      setNotice({ type: "success", text: "Upload ảnh phòng thành công." });
    } catch (error) {
      setNotice({ type: "error", text: error.message });
    } finally {
      setSaving(false);
    }
  }

  function previewValue(row) {
    return row.name || row.title || row.full_name || row.booking_code || row.key || row.slug || row.email || `#${row.id}`;
  }

  function relationSummary(row) {
    const parts = [];
    const packageNames = row.packages?.length
      ? row.packages.map((item) => item.name).filter(Boolean)
      : (row.package_ids || [])
        .map((id) => packageOptions.find((item) => String(item.id) === String(id))?.name)
        .filter(Boolean);

    if (row.branch?.name || row.branch_name) parts.push(`Chi nhánh: ${row.branch?.name || row.branch_name}`);
    if (row.room?.name || row.room_name) parts.push(`Phòng: ${row.room?.name || row.room_name}`);
    if (row.customer_name) parts.push(`Khách: ${row.customer_name}`);
    if (row.customer_phone) parts.push(`SĐT: ${row.customer_phone}`);
    if (row.rental_package_name) parts.push(`Gói: ${row.rental_package_name}`);
    if (row.rate_name) parts.push(`Gói: ${row.rate_name}`);
    if (packageNames.length) parts.push(`Gói thuê: ${packageNames.join(", ")}`);
    if (row.slot_codes?.length) parts.push(`Khung giờ: ${row.slot_codes.join(", ")}`);
    if (row.max_guests) parts.push(`Tối đa: ${row.max_guests} khách`);
    if (row.price_amount !== undefined) parts.push(`Giá: ${money(row.price_amount)}`);
    if (row.total_amount !== undefined || row.total_price !== undefined) parts.push(`Tổng: ${money(row.total_amount ?? row.total_price)}`);
    if (row.start_time && row.end_time) parts.push(`Giờ: ${String(row.start_time).slice(0, 5)} - ${String(row.end_time).slice(0, 5)}`);
    if (row.check_in && row.check_out) {
      parts.push(`Lịch: ${new Date(row.check_in).toLocaleDateString("vi-VN")} - ${new Date(row.check_out).toLocaleDateString("vi-VN")}`);
    }
    if (!parts.length) {
      const fallback = row.description || row.address || row.phone || row.slug || row.code || "";
      if (fallback) parts.push(fallback);
    }
    return parts.slice(0, 6);
  }

  function adminColumns() {
    const commonStatus = { key: "status_display", label: "Trạng thái", render: (row) => statusText(row) };
    const updatedAt = { key: "updated_at", label: "Cập nhật", render: (row) => formatAdminDate(row.updated_at) };

    const byResource = {
      rooms: [
        { key: "name", label: "Tên phòng", primary: true },
        { key: "slug", label: "Slug" },
        { key: "branch", label: "Chi nhánh", render: (row) => row.branch?.name || row.branch_name || row.branch_id || "-" },
        { key: "packages", label: "Gói thuê", render: (row) => packageNames(row).join(", ") || "-" },
        { key: "slot_codes", label: "Khung giờ", render: (row) => row.slot_codes?.join(", ") || "-" },
        { key: "max_guests", label: "Khách" },
        commonStatus,
        updatedAt
      ],
      "rental-packages": [
        { key: "name", label: "Tên gói", primary: true },
        { key: "code", label: "Mã" },
        { key: "price_amount", label: "Giá", render: (row) => money(row.price_amount || 0) },
        { key: "duration_minutes", label: "Thời lượng", render: (row) => row.duration_minutes ? `${row.duration_minutes} phút` : "-" },
        commonStatus,
        updatedAt
      ],
      "room-time-slots": [
        { key: "label", label: "Khung giờ", primary: true },
        { key: "room", label: "Phòng", render: (row) => row.room_name || row.room?.name || row.room_id || "-" },
        { key: "rate", label: "Gói thuê", render: (row) => row.rate_name || row.rental_package_name || row.rate_plan_id || "-" },
        { key: "time", label: "Giờ", render: (row) => `${String(row.start_time || "").slice(0, 5)} - ${String(row.end_time || "").slice(0, 5)}` },
        { key: "crosses_midnight", label: "Qua ngày", render: (row) => row.crosses_midnight ? "Có" : "Không" },
        commonStatus
      ],
      "slot-templates": [
        { key: "label", label: "Khung giờ", primary: true },
        { key: "rental_package_code", label: "Gói thuê" },
        { key: "code", label: "Mã" },
        { key: "time", label: "Giờ", render: (row) => `${String(row.start_time || "").slice(0, 5)} - ${String(row.end_time || "").slice(0, 5)}` },
        { key: "crosses_midnight", label: "Qua ngày", render: (row) => row.crosses_midnight ? "Có" : "Không" },
        commonStatus
      ],
      bookings: [
        { key: "booking_code", label: "Mã booking", primary: true },
        { key: "customer_name", label: "Khách" },
        { key: "customer_phone", label: "SĐT" },
        { key: "room", label: "Phòng", render: (row) => row.room_name || row.room?.name || row.room_id || "-" },
        { key: "branch", label: "Chi nhánh", render: (row) => row.branch_name || row.branch?.name || row.branch_id || "-" },
        { key: "total", label: "Tổng tiền", render: (row) => money(row.total_amount ?? row.total_price ?? 0) },
        commonStatus
      ],
      branches: [
        { key: "name", label: "Tên chi nhánh", primary: true },
        { key: "address", label: "Địa chỉ" },
        { key: "slug", label: "Slug" },
        commonStatus,
        updatedAt
      ],
      amenities: [
        { key: "name", label: "Tên tiện nghi", primary: true },
        { key: "icon", label: "Icon" },
        { key: "position", label: "Vị trí" },
        commonStatus,
        updatedAt
      ]
    };

    if (byResource[activeResource.key]) return byResource[activeResource.key];

    const fields = activeResource.fields.filter((field) =>
      !["password", "content", "description", "iframe", "room_image_urls", "amenity_ids", "package_ids"].includes(field)
    );
    return [
      { key: fields[0] || "name", label: fieldLabel(fields[0] || "name"), primary: true },
      ...fields.slice(1, 5).map((field) => ({ key: field, label: fieldLabel(field) })),
      commonStatus
    ];
  }

  function packageNames(row) {
    return row.packages?.length
      ? row.packages.map((item) => item.name).filter(Boolean)
      : (row.package_ids || [])
        .map((id) => packageOptions.find((item) => String(item.id) === String(id))?.name)
        .filter(Boolean);
  }

  function formatAdminDate(value) {
    return value ? new Date(value).toLocaleDateString("vi-VN") : "-";
  }

  function renderAdminCell(row, column) {
    const value = column.render ? column.render(row) : row[column.key];
    const display = value === undefined || value === null || value === "" ? "-" : value;

    if (column.primary) {
      return (
        <button type="button" className="admin-row-title" onClick={() => startEdit(row)}>
          {display}
        </button>
      );
    }

    if (column.key === "status_display") {
      return (
        <span className="admin-status-cell">
          <i className={row.active === false || row.status === "cancelled" ? "status-dot off" : "status-dot"} />
          {display}
        </span>
      );
    }

    return <span>{display}</span>;
  }

  function statusText(row) {
    if (row.active === false) return "Ẩn";
    if (row.status === "cancelled") return "Đã hủy";
    if (row.status === "pending_payment") return "Chờ thanh toán";
    if (row.status === "confirmed") return "Đã xác nhận";
    return row.status || "Đang hiển thị";
  }

  function fieldLabel(field) {
    return fieldLabels[field] || field;
  }

  useEffect(() => {
    setForm(blankForm());
  }, []);

  useEffect(() => {
    if (token && adminView !== "dashboard") loadAdminRows(activeResource);
  }, [token, activeKey, adminView]);

  useEffect(() => {
    if (token && activeResource.key === "rooms") {
      loadAmenityOptions();
      loadPackageOptions();
      loadSlotOptions();
    }
    if (token && activeResource.key === "slot-templates") {
      loadPackageOptions();
    }
  }, [token, activeResource.key]);

  useEffect(() => {
    setPage(1);
  }, [activeKey, searchText, statusFilter, dateFilter, perPage]);

  useEffect(() => {
    if (token && adminView !== "dashboard") loadRelationOptions();
  }, [token, activeKey, adminView]);

  if (!token) {
    return (
      <main className="admin-login-shell">
        <form className="admin-login" onSubmit={login}>
          <div className="admin-login-brand">
            <BrandLogo className="admin-login-logo" showText={false} />
            <div>
              <h1>ftft CMS</h1>
              <p>Quản trị nội dung, phòng và booking.</p>
            </div>
          </div>
          {notice && <div className={`notice ${notice.type}`}>{notice.text}</div>}
          <label>
            Tài khoản
            <input value={loginForm.username} onChange={(event) => setLoginForm((current) => ({ ...current, username: event.target.value }))} />
          </label>
          <label>
            Mật khẩu
            <input type="password" value={loginForm.password} onChange={(event) => setLoginForm((current) => ({ ...current, password: event.target.value }))} />
          </label>
          <button className="primary-btn full" type="submit" disabled={saving}>
            {saving ? <Loader2 className="spin" size={18} /> : <ShieldCheck size={18} />}
            Đăng nhập
          </button>
        </form>
      </main>
    );
  }

  return (
    <main className="admin-shell admin-template">
      <aside className="admin-sidebar">
        <div className="admin-brand">
          <BrandLogo className="admin-sidebar-logo" />
          <button type="button" aria-label="Thu gọn menu">
            <ChevronLeft size={18} />
          </button>
        </div>
        <button
          className={adminView === "dashboard" ? "admin-dashboard-link active" : "admin-dashboard-link"}
          type="button"
          onClick={() => {
            setAdminView("dashboard");
            setNotice(null);
          }}
        >
          <LayoutDashboard size={18} />
          Tổng quan
        </button>
        <nav className="admin-resource-nav">
          {Object.entries(groupedResources).map(([group, resources]) => (
            <div className="admin-nav-group" key={group}>
              <p>{group}</p>
              {resources.map((resource) => (
                <div className={resource.key === activeKey && adminView !== "dashboard" ? "admin-menu-node open" : "admin-menu-node"} key={resource.key}>
                  <button
                    type="button"
                    className={resource.key === activeKey && adminView !== "dashboard" ? "active" : ""}
                    onClick={() => chooseResource(resource, "list")}
                  >
                    <span>
                      {(() => {
                        const Icon = resourceIcons[resource.key] || Copy;
                        return <Icon size={20} />;
                      })()}
                      {resource.label}
                    </span>
                    <ChevronRight size={16} />
                  </button>
                  {resource.key === activeKey && adminView !== "dashboard" && (
                    <div className="admin-menu-sub">
                      <button
                        type="button"
                        className={adminView === "create" && !selectedRow ? "active" : ""}
                        onClick={() => chooseResource(resource, "create")}
                      >
                        <span><i /> Tạo {resource.label.toLowerCase()}</span>
                      </button>
                      <button
                        type="button"
                        className={adminView === "list" || selectedRow ? "active" : ""}
                        onClick={() => chooseResource(resource, "list")}
                      >
                        <span><i /> Danh sách {resource.label.toLowerCase()}</span>
                      </button>
                    </div>
                  )}
                </div>
              ))}
            </div>
          ))}
        </nav>
        <button className="admin-logout" type="button" onClick={logout}>
          <LogOut size={16} />
          Đăng xuất
        </button>
      </aside>

      <section className="admin-main">
        {notice && <div className={`notice ${notice.type}`}>{notice.text}</div>}

        {adminView === "dashboard" ? (
          <section className="admin-overview-grid">
            <div className="admin-analytics-card">
              <div className="admin-analytics-copy">
                <h2>Tổng quan vận hành</h2>
                <p>Theo dõi phòng, booking và nội dung CMS</p>
                <h4>Hoạt động</h4>
                <div className="admin-analytics-stats">
                  <span><strong>{adminResources.length}</strong> Module</span>
                  <span><strong>{rows.length}</strong> Bản ghi</span>
                  <span><strong>{visibleRows}</strong> Đang hiển thị</span>
                  <span><strong>{inactiveRows}</strong> Tạm ẩn</span>
                </div>
              </div>
              <img className="admin-analytics-illustration" src="/admin-template/card-website-analytics-1.png" alt="" />
            </div>
            <div className="admin-metric-card admin-sales-card">
              <p>Doanh thu dự kiến</p>
              <span>Tổng giá trị trong module hiện tại</span>
              <h3>{overviewTotal ? compactMoney(overviewTotal) : rows.length}</h3>
              <div className="admin-mini-bars" aria-hidden="true">
                <i />
                <i />
                <i />
                <i />
                <i />
                <i />
              </div>
            </div>
            <div className="admin-metric-card admin-overview-card">
              <div className="admin-card-heading">
                <p>Tổng quan dữ liệu</p>
                <b>+18.2%</b>
              </div>
              <h3>{activeResource.label}</h3>
              <div className="admin-sales-split">
                <span><CreditCard size={18} /> Booking <strong>62.2%</strong></span>
                <span>Lượt xem <strong>25.5%</strong></span>
              </div>
              <div className="admin-progress"><i /><b /></div>
            </div>
          </section>
        ) : (
          <>
            <div className="admin-page-heading">
              <h1>{(adminView === "create" ? (selectedRow ? "Sửa " : "Tạo mới ") : "Danh sách ") + activeResource.label.toLowerCase()}</h1>
              <div>
                {adminView === "create" && (
                  <button className="ghost-btn admin-cancel-btn" type="button" onClick={() => setAdminView("list")}>
                    Hủy
                  </button>
                )}
                <button className="primary-btn" type="button" disabled={saving} onClick={adminView === "create" ? () => document.getElementById("admin-editor-form")?.requestSubmit() : startCreate}>
                  {saving && adminView === "create" ? <Loader2 className="spin" size={17} /> : adminView === "create" ? <Save size={17} /> : <Plus size={17} />}
                  {adminView === "create" ? "Lưu" : "Tạo mới"}
                </button>
              </div>
            </div>

            {adminView === "list" ? (
              <section className="admin-table-panel admin-list-page">
                <div className="admin-filter-panel">
                  <h2>Tìm kiếm</h2>
                  <div className="admin-filter-grid">
                    <input
                      value={searchText}
                      placeholder={`Tìm kiếm ${activeResource.label.toLowerCase()}`}
                      onChange={(event) => setSearchText(event.target.value)}
                      onKeyDown={(event) => {
                        if (event.key === "Enter") loadAdminRows();
                      }}
                    />
                    <select value={statusFilter} onChange={(event) => setStatusFilter(event.target.value)}>
                      <option value="all">Tất cả trạng thái</option>
                      <option value="active">Kích hoạt</option>
                      <option value="inactive">Tạm ẩn</option>
                      <option value="pending_payment">Chờ thanh toán</option>
                      <option value="confirmed">Đã xác nhận</option>
                      <option value="cancelled">Đã hủy</option>
                    </select>
                    <input type="date" value={dateFilter} onChange={(event) => setDateFilter(event.target.value)} />
                    <button className="admin-filter-btn" type="button" onClick={() => loadAdminRows()}>
                      <Search size={18} />
                      Lọc
                    </button>
                  </div>
                </div>
                {loading ? (
                  <div className="admin-loading"><Loader2 className="spin" size={20} /> Đang tải dữ liệu...</div>
                ) : (
                  <>
                  <div className="admin-table-wrap">
                    <table className="admin-table admin-dynamic-table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          {adminColumns().map((column) => (
                            <th key={column.key}>{column.label}</th>
                          ))}
                          <th>Nội dung</th>
                          <th>Trạng thái</th>
                          <th>Cập nhật</th>
                          <th aria-label="Tác vụ" />
                        </tr>
                      </thead>
                      <tbody>
                        {visibleListRows.map((row) => (
                          <tr key={row.id} className={selectedRow?.id === row.id ? "selected" : ""}>
                            <td>#{row.id}</td>
                            {adminColumns().map((column) => (
                              <td key={column.key}>{renderAdminCell(row, column)}</td>
                            ))}
                            <td>
                              <button type="button" className="admin-row-title" onClick={() => startEdit(row)}>
                                {previewValue(row)}
                              </button>
                              <div className="admin-row-meta">
                                {relationSummary(row).map((item) => (
                                  <span key={item}>{item}</span>
                                ))}
                              </div>
                            </td>
                            <td>
                              <i className={row.active === false || row.status === "cancelled" ? "status-dot off" : "status-dot"} />
                              {statusText(row)}
                            </td>
                            <td>{row.updated_at ? new Date(row.updated_at).toLocaleDateString("vi-VN") : "-"}</td>
                            <td>
                              <div className="admin-row-actions">
                                <button type="button" onClick={() => startEdit(row)} aria-label="Sửa"><Edit3 size={16} /></button>
                                <button type="button" onClick={() => deleteRow(row)} aria-label="Xóa"><Trash2 size={16} /></button>
                              </div>
                            </td>
                          </tr>
                        ))}
                        {!visibleListRows.length && (
                          <tr>
                            <td colSpan={adminColumns().length + 5} className="admin-empty">Chưa có dữ liệu.</td>
                          </tr>
                        )}
                      </tbody>
                    </table>
                  </div>
                  <div className="admin-list-footer">
                    <select value={perPage} onChange={(event) => setPerPage(event.target.value)} aria-label="Số dòng hiển thị">
                      <option value="10">10</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                    </select>
                    <span>{filteredRows.length} kết quả</span>
                    <div className="admin-pagination">
                      <button type="button" disabled={currentPage <= 1} onClick={() => setPage((value) => Math.max(value - 1, 1))}>
                        <ChevronLeft size={16} />
                      </button>
                      <span>{currentPage}/{lastPage}</span>
                      <button type="button" disabled={currentPage >= lastPage} onClick={() => setPage((value) => Math.min(value + 1, lastPage))}>
                        <ChevronRight size={16} />
                      </button>
                    </div>
                  </div>
                  </>
                )}
              </section>
            ) : (
              <form id="admin-editor-form" className="admin-editor admin-editor-page" onSubmit={saveRow}>
                <div className="admin-editor-head">
                  <div>
                    <h2>{selectedRow ? "Sửa #" + selectedRow.id : "Tạo " + activeResource.label.toLowerCase()}</h2>
                    <p>{activeResource.label}</p>
                  </div>
                  <button className="ghost-btn" type="button" onClick={startCreate}>Làm mới</button>
                </div>

                <div className="admin-field-grid">
                  {activeResource.fields.map((field) => (
                    <label key={field} className={textareaFields.has(field) || field === "room_image_urls" ? "wide" : ""}>
                      <span>{fieldLabel(field)}</span>
                      {booleanFields.has(field) ? (
                        <input
                          type="checkbox"
                          checked={Boolean(form[field])}
                          onChange={(event) => updateAdminField(field, event.target.checked)}
                        />
                      ) : field === "amenity_ids" ? (
                        <AdminAmenityMultiSelect
                          options={amenityOptions}
                          value={form[field] || []}
                          onChange={(value) => updateAdminField(field, value)}
                          emptyLabel="Chọn tiện nghi"
                          selectedLabel="tiện nghi đã chọn"
                          searchLabel="Tìm tiện nghi..."
                          notFoundLabel="Không tìm thấy tiện nghi."
                        />
                      ) : field === "package_ids" ? (
                        <AdminPackageMultiSelect
                          options={packageOptions}
                          value={form[field] || []}
                          onChange={(value) => updateAdminField(field, value)}
                        />
                      ) : field === "slot_codes" ? (
                        <AdminSlotMultiSelect
                          options={slotOptions}
                          value={form[field] || []}
                          onChange={(value) => updateAdminField(field, value)}
                        />
                      ) : field === "room_image_urls" ? (
                        <AdminRoomImagePicker
                          value={form[field] || []}
                          saving={saving}
                          onUpload={(files) => uploadRoomImages(field, files)}
                          onRemove={(imageUrl) => updateAdminField(field, (form[field] || []).filter((item) => item !== imageUrl))}
                        />
                      ) : ["branch_id", "room_id", "rate_plan_id", "rental_package_id"].includes(field) ? (
                        <AdminRelationSelect
                          value={form[field] || ""}
                          options={relationOptions(field)}
                          placeholder={`Chọn ${fieldLabel(field).toLowerCase()}`}
                          onChange={(value) => updateAdminField(field, value)}
                        />
                      ) : field === "rental_package_code" ? (
                        <select value={form[field] || ""} onChange={(event) => updateAdminField(field, event.target.value)}>
                          <option value="">Chọn gói thuê</option>
                          {packageOptions.map((option) => (
                            <option key={option.id} value={option.code}>{option.name || option.code}</option>
                          ))}
                        </select>
                      ) : field === "type" && activeResource.key === "rooms" ? (
                        <select value={form[field] || ""} onChange={(event) => updateAdminField(field, event.target.value)}>
                          <option value="">Chọn loại phòng</option>
                          <option value="standard">Standard</option>
                          <option value="cinema">Cinema</option>
                          <option value="couple">Couple</option>
                          <option value="vip">VIP</option>
                        </select>
                      ) : textareaFields.has(field) ? (
                        <textarea
                          value={form[field] || ""}
                          onChange={(event) => updateAdminField(field, event.target.value)}
                        />
                      ) : (
                        <input
                          type={field === "password" ? "password" : numberFields.has(field) ? "number" : "text"}
                          value={form[field] || ""}
                          placeholder={field === "password" && selectedRow ? "Để trống nếu không đổi" : ""}
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
              </form>
            )}
          </>
        )}
      </section>
    </main>
  );
}

function AdminRelationSelect({ value, options, placeholder, onChange }) {
  return (
    <select value={value || ""} onChange={(event) => onChange(event.target.value)}>
      <option value="">{placeholder}</option>
      {options.map((option) => (
        <option key={option.value} value={option.value}>
          {option.label}
        </option>
      ))}
    </select>
  );
}

function AdminAmenityMultiSelect({ options, value, onChange }) {
  const [open, setOpen] = useState(false);
  const [query, setQuery] = useState("");
  const selectedIds = (value || []).map(String);
  const selectedOptions = options.filter((option) => selectedIds.includes(String(option.id)));
  const filteredOptions = options.filter((option) =>
    String(option.name || "").toLowerCase().includes(query.trim().toLowerCase())
  );

  function toggleOption(id) {
    const idText = String(id);
    const next = selectedIds.includes(idText)
      ? selectedIds.filter((item) => item !== idText)
      : [...selectedIds, idText];
    onChange(next.map(Number));
  }

  function removeOption(id) {
    onChange(selectedIds.filter((item) => item !== String(id)).map(Number));
  }

  return (
    <div className="admin-shadcn-multiselect">
      <button
        className={open ? "admin-ms-trigger open" : "admin-ms-trigger"}
        type="button"
        onClick={() => setOpen((current) => !current)}
      >
        <span>{selectedOptions.length ? `${selectedOptions.length} tiện nghi đã chọn` : "Chọn tiện nghi"}</span>
        <ChevronRight size={16} />
      </button>

      {selectedOptions.length ? (
        <div className="admin-ms-badges">
          {selectedOptions.map((option) => (
            <span key={option.id}>
              {option.name}
              <button type="button" onClick={() => removeOption(option.id)} aria-label={`Bỏ ${option.name}`}>
                <X size={12} />
              </button>
            </span>
          ))}
        </div>
      ) : null}

      {open && (
        <div className="admin-ms-popover">
          <div className="admin-ms-search">
            <Search size={15} />
            <input
              value={query}
              placeholder="Tìm tiện nghi..."
              onChange={(event) => setQuery(event.target.value)}
            />
          </div>
          <div className="admin-ms-list">
            {filteredOptions.map((option) => {
              const checked = selectedIds.includes(String(option.id));
              return (
                <button
                  key={option.id}
                  className={checked ? "selected" : ""}
                  type="button"
                  onClick={() => toggleOption(option.id)}
                >
                  <span className="admin-ms-check">{checked && <Check size={13} />}</span>
                  <span>{option.name}</span>
                </button>
              );
            })}
            {!filteredOptions.length && <p>Không tìm thấy tiện nghi.</p>}
          </div>
        </div>
      )}
    </div>
  );
}

function AdminPackageMultiSelect({ options, value, onChange }) {
  const [open, setOpen] = useState(false);
  const [query, setQuery] = useState("");
  const selectedIds = (value || []).map(String);
  const selectedOptions = options.filter((option) => selectedIds.includes(String(option.id)));
  const filteredOptions = options.filter((option) =>
    String(`${option.name || ""} ${option.code || ""}`).toLowerCase().includes(query.trim().toLowerCase())
  );

  function toggleOption(id) {
    const idText = String(id);
    const next = selectedIds.includes(idText)
      ? selectedIds.filter((item) => item !== idText)
      : [...selectedIds, idText];
    onChange(next.map(Number));
  }

  function removeOption(id) {
    onChange(selectedIds.filter((item) => item !== String(id)).map(Number));
  }

  return (
    <div className="admin-shadcn-multiselect">
      <button
        className={open ? "admin-ms-trigger open" : "admin-ms-trigger"}
        type="button"
        onClick={() => setOpen((current) => !current)}
      >
        <span>{selectedOptions.length ? `${selectedOptions.length} gói thuê đã chọn` : "Chọn gói thuê"}</span>
        <ChevronRight size={16} />
      </button>

      {selectedOptions.length ? (
        <div className="admin-ms-badges">
          {selectedOptions.map((option) => (
            <span key={option.id}>
              {option.name}
              <button type="button" onClick={() => removeOption(option.id)} aria-label={`Bỏ ${option.name}`}>
                <X size={12} />
              </button>
            </span>
          ))}
        </div>
      ) : null}

      {open && (
        <div className="admin-ms-popover">
          <div className="admin-ms-search">
            <Search size={15} />
            <input
              value={query}
              placeholder="Tìm gói thuê..."
              onChange={(event) => setQuery(event.target.value)}
            />
          </div>
          <div className="admin-ms-list">
            {filteredOptions.map((option) => {
              const checked = selectedIds.includes(String(option.id));
              return (
                <button
                  key={option.id}
                  className={checked ? "selected" : ""}
                  type="button"
                  onClick={() => toggleOption(option.id)}
                >
                  <span className="admin-ms-check">{checked && <Check size={13} />}</span>
                  <span>{option.name}</span>
                </button>
              );
            })}
            {!filteredOptions.length && <p>Không tìm thấy gói thuê.</p>}
          </div>
        </div>
      )}
    </div>
  );
}

function AdminSlotMultiSelect({ options, value, onChange }) {
  const [open, setOpen] = useState(false);
  const [query, setQuery] = useState("");
  const selectedCodes = (value || []).map(String);
  const selectedOptions = options.filter((option) => selectedCodes.includes(String(option.code || option.id)));
  const filteredOptions = options.filter((option) =>
    String(`${option.name || ""} ${option.code || ""} ${option.rate_name || ""}`).toLowerCase().includes(query.trim().toLowerCase())
  );

  function toggleOption(code) {
    const codeText = String(code);
    const next = selectedCodes.includes(codeText)
      ? selectedCodes.filter((item) => item !== codeText)
      : [...selectedCodes, codeText];
    onChange(next);
  }

  function removeOption(code) {
    onChange(selectedCodes.filter((item) => item !== String(code)));
  }

  return (
    <div className="admin-shadcn-multiselect">
      <button
        className={open ? "admin-ms-trigger open" : "admin-ms-trigger"}
        type="button"
        onClick={() => setOpen((current) => !current)}
      >
        <span>{selectedOptions.length ? `${selectedOptions.length} khung giờ đã chọn` : "Chọn khung giờ"}</span>
        <ChevronRight size={16} />
      </button>

      {selectedOptions.length ? (
        <div className="admin-ms-badges">
          {selectedOptions.map((option) => (
            <span key={option.code || option.id}>
              {option.name}
              <button type="button" onClick={() => removeOption(option.code || option.id)} aria-label={`Bỏ ${option.name}`}>
                <X size={12} />
              </button>
            </span>
          ))}
        </div>
      ) : null}

      {open && (
        <div className="admin-ms-popover">
          <div className="admin-ms-search">
            <Search size={15} />
            <input
              value={query}
              placeholder="Tìm khung giờ..."
              onChange={(event) => setQuery(event.target.value)}
            />
          </div>
          <div className="admin-ms-list">
            {filteredOptions.map((option) => {
              const code = option.code || option.id;
              const checked = selectedCodes.includes(String(code));
              return (
                <button
                  key={code}
                  className={checked ? "selected" : ""}
                  type="button"
                  onClick={() => toggleOption(code)}
                >
                  <span className="admin-ms-check">{checked && <Check size={13} />}</span>
                  <span>{option.name}{option.rate_name ? ` - ${option.rate_name}` : ""}</span>
                </button>
              );
            })}
            {!filteredOptions.length && <p>Không tìm thấy khung giờ.</p>}
          </div>
        </div>
      )}
    </div>
  );
}

function AdminRoomImagePicker({ value, saving, onUpload, onRemove }) {
  const images = Array.isArray(value) ? value : [];

  return (
    <div className="admin-room-image-picker">
      <label className="admin-room-image-drop">
        <ImagePlus size={20} />
        <span>{saving ? "Đang upload..." : "Chọn ảnh phòng"}</span>
        <input
          type="file"
          accept="image/*"
          multiple
          disabled={saving}
          onChange={(event) => {
            onUpload(event.target.files);
            event.target.value = "";
          }}
        />
      </label>
      {images.length ? (
        <div className="admin-room-image-grid">
          {images.map((imageUrl) => (
            <figure key={imageUrl}>
              <img src={assetUrl(imageUrl)} alt="" />
              <button type="button" onClick={() => onRemove(imageUrl)} aria-label="Xóa ảnh">
                <X size={14} />
              </button>
            </figure>
          ))}
        </div>
      ) : (
        <p>Chưa có ảnh phòng.</p>
      )}
    </div>
  );
}

function RoomEmblaGallery({ images, title }) {
  const safeImages = images?.length ? images : [];
  const [selectedIndex, setSelectedIndex] = useState(0);
  const [emblaRef, emblaApi] = useEmblaCarousel({
    align: "center",
    loop: safeImages.length > 1
  });
  const scrollPrev = useCallback(() => emblaApi?.scrollPrev(), [emblaApi]);
  const scrollNext = useCallback(() => emblaApi?.scrollNext(), [emblaApi]);
  const scrollTo = useCallback((index) => emblaApi?.scrollTo(index), [emblaApi]);

  useEffect(() => {
    if (!emblaApi) return undefined;
    const onSelect = () => setSelectedIndex(emblaApi.selectedScrollSnap());
    emblaApi.on("select", onSelect);
    emblaApi.on("reInit", onSelect);
    onSelect();
    return () => {
      emblaApi.off("select", onSelect);
      emblaApi.off("reInit", onSelect);
    };
  }, [emblaApi]);

  useEffect(() => {
    setSelectedIndex(0);
    emblaApi?.scrollTo(0, true);
    emblaApi?.reInit();
  }, [safeImages.join("|"), emblaApi]);

  return (
    <div className="booking-gallery embla-booking-gallery">
      <div className="embla-gallery-viewport" ref={emblaRef}>
        <div className="embla-gallery-container">
          {safeImages.map((image, index) => (
            <div className="booking-gallery-slide" key={`${image}-${index}`}>
              <img src={image} alt={index === 0 ? title : `${title} ${index + 1}`} />
            </div>
          ))}
        </div>
      </div>
      {safeImages.length > 1 && (
        <>
          <button className="embla-gallery-arrow prev" type="button" onClick={scrollPrev} aria-label="Ảnh trước">
            <ChevronLeft size={22} />
          </button>
          <button className="embla-gallery-arrow next" type="button" onClick={scrollNext} aria-label="Ảnh sau">
            <ChevronRight size={22} />
          </button>
          <div className="embla-gallery-dots">
            {safeImages.map((image, index) => (
              <button
                key={`${image}-dot-${index}`}
                className={index === selectedIndex ? "active" : ""}
                type="button"
                onClick={() => scrollTo(index)}
                aria-label={`Xem ảnh ${index + 1}`}
              />
            ))}
          </div>
        </>
      )}
    </div>
  );
}

function RoomDetailPage({ room, loading, notice, search, updateSearch, onBack }) {
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
  const bookingDays = upcomingBookingDays(8, search.booking_date);
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

  function showDetailValidation(text) {
    const nextNotice = { type: "error", text };
    setDetailNotice(nextNotice);
    toast.error(text);
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
      setDetailNotice({ type: "error", text: `Không tải được lịch phòng: ${error.message}` });
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
      showDetailValidation("Chọn ít nhất 1 khung giờ trước nha.");
      return;
    }
    if (!detailForm.full_name.trim() || !detailForm.phone.trim()) {
      showDetailValidation("Nhập họ tên và số điện thoại để tạo booking.");
      return;
    }
    if (!detailForm.adult_confirm || !detailForm.return_confirm) {
      showDetailValidation("Bạn cần tick xác nhận thông tin trước khi đặt phòng.");
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
      setDetailNotice({ type: "success", text: "Đã tạo booking. Thanh toán để giữ phòng trong 10 phút." });
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
    setDetailNotice({ type: "success", text: "Đã copy nội dung thanh toán." });
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
        setDetailNotice({ type: "success", text: "Thanh toán thành công. Booking đã được xác nhận." });
        await loadAvailability();
      } else if (payload.data?.status === "expired" || payload.data?.payment?.status === "cancelled") {
        setDetailNotice({ type: "error", text: "Booking đã quá 10 phút chưa thanh toán nên phòng đã được trả lại." });
        await loadAvailability();
      } else if (!silent) {
        setDetailNotice({ type: "muted", text: "Đang chờ xác nhận thanh toán." });
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
  }, [room?.id, search.booking_date]);

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
        setDetailNotice({ type: "success", text: "Thanh toán thành công. Booking đã được xác nhận." });
      }
      if (booking.status === "expired") {
        setDetailNotice({ type: "error", text: "Booking đã quá 10 phút chưa thanh toán nên phòng đã được trả lại." });
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
        <div className="empty-state"><Loader2 className="spin" size={22} /> Đang tải chi tiết phòng...</div>
      </section>
    );
  }

  if (!room) {
    return (
      <section className="room-detail-page">
        <button className="back-btn" type="button" onClick={onBack}><ArrowLeft size={18} /> Quay lại</button>
        {notice && <div className={`notice ${notice.type}`}>{notice.text}</div>}
        <div className="empty-state">Không tìm thấy thông tin phòng.</div>
      </section>
    );
  }

  return (
    <section className="room-detail-page booking-detail-page">
      <button className="back-btn detail-back-btn" type="button" onClick={onBack}><ArrowLeft size={18} /> Quay lại</button>

      <div className="booking-detail-layout">
        <div className="detail-left-column">
          <h1 className="booking-detail-title">Libra - 22</h1>

          <RoomEmblaGallery images={gallery} title={room.name} />

          <div className="slot-booking-section">
            <div className="price-board">
              <h2>Bảng giá</h2>
              <div className="price-row">
                <span><strong>{compactMoney(200000)}</strong>d/3h</span>
                <span><strong>{compactMoney(room.price_per_night || 370000)}</strong>đ/đêm</span>
                <span><strong>{compactMoney(580000)}</strong>đ/ngày</span>
              </div>
            </div>

            <div className="slot-heading-row">
              <div>
                <h2>Lựa chọn khung giờ dành cho bạn</h2>
                <div className="slot-legend">
                  <span><i className="legend-box booked" />Đã đặt</span>
                  <span><i className="legend-box available" />Còn trống</span>
                  <span><i className="legend-box selected" />Đang chọn</span>
                </div>
              </div>
              <button
                className="primary-btn compact-slot-btn"
                type="button"
                onClick={() => document.querySelector(".detail-booking-panel")?.scrollIntoView({ behavior: "smooth", block: "start" })}
              >
                {availabilityLoading ? <Loader2 className="spin" size={16} /> : null}
                Đặt phòng
              </button>
            </div>

            <div className="slot-table-wrap">
              <table className="slot-table">
                <thead>
                  <tr>
                    <th colSpan="2">Chi nhánh</th>
                    <th colSpan={detailSlots.length}>{room.branch?.address || "134/35 Đường Hà Huy Giáp, Phường Trung Dũng, Biên Hòa, Đồng Nai"}</th>
                  </tr>
                  <tr>
                    <th colSpan="2">Tên phòng</th>
                    <th colSpan={detailSlots.length}>Libra 22</th>
                  </tr>
                  <tr>
                    <th>Thứ</th>
                    <th>Ngày</th>
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
              <p>** Khách hàng được giảm thêm 5% khi book 2 khung giờ, 10% khi book 3 khung giờ</p>
              <strong>Tổng tiền tạm tính: {compactMoney(selectedTotal)} đ</strong>
            </div>
          </div>

          <div className="room-amenity-section">
            <h2>Tiện nghi phòng</h2>
            <div className="room-amenity-list">
              <span><Utensils size={22} />Nhà bếp hiện đại</span>
              <span><Film size={22} />Netflix</span>
              <span><BedDouble size={22} />Giường King</span>
              <span><Projector size={22} />Máy chiếu</span>
              <span><ShieldCheck size={22} />Gương toàn thân</span>
              <span><Wifi size={22} />Wifi tốc độ cao</span>
              <span><Bath size={22} />Bồn tắm</span>
              <span><WashingMachine size={22} />Máy giặt tự động</span>
              <span><Gamepad2 size={22} />Boardgames</span>
            </div>
          </div>
        </div>

        <aside className="detail-booking-panel">
          <h2>Thông tin đặt phòng</h2>
          {(detailNotice || notice) && (
            <div className={`notice ${detailNotice?.type || notice?.type}`}>{detailNotice?.text || notice?.text}</div>
          )}
          <input
            className="booking-text-input"
            placeholder="Họ và tên"
            value={detailForm.full_name}
            onChange={(event) => updateDetailForm("full_name", event.target.value)}
          />
          <input
            className="booking-text-input"
            placeholder="Số điện thoại"
            value={detailForm.phone}
            onChange={(event) => updateDetailForm("phone", event.target.value)}
          />
          <p className="booking-note">* Bạn vui lòng nhập đúng số điện thoại, Home sẽ gửi thông tin check-in qua Zalo</p>

          <label className="booking-label">Số lượng khách</label>
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
          <p className="booking-note">* Nếu &gt; 2 khách, Home xin phép phụ thu 100k/khách ơi.</p>
          <p className="booking-note">* Home chỉ nhận tối đa 2 khách nếu khách book ở khung giờ qua đêm.</p>

          <label className="booking-label">Căn cước công dân</label>
          <div className="id-upload-grid">
            <button type="button"><ImagePlus size={30} /><span>Mặt trước</span></button>
            <button type="button"><ImagePlus size={30} /><span>Mặt sau</span></button>
          </div>
          <p className="booking-note">* Thông tin CCCD của bạn được lưu trữ và bảo mật riêng tư để khai báo lưu trú, sẽ được xóa bỏ sau khi bạn check-out.</p>

          <textarea
            className="booking-textarea"
            placeholder="Ghi chú cho ftft"
            value={detailForm.note}
            onChange={(event) => updateDetailForm("note", event.target.value)}
          />

          <label className="booking-check danger-check">
            <input
              type="checkbox"
              checked={detailForm.adult_confirm}
              onChange={(event) => updateDetailForm("adult_confirm", event.target.checked)}
            />
            <span>Xác nhận mọi người đã đủ tuổi vị thành niên, hoặc trẻ em phải có người giám hộ. Người đặt phòng chịu trách nhiệm với thông tin này.</span>
          </label>
          <label className="booking-check">
            <input
              type="checkbox"
              checked={detailForm.return_confirm}
              onChange={(event) => updateDetailForm("return_confirm", event.target.checked)}
            />
            <span>Sau khi quét mã thanh toán thành công, bạn hãy quay lại đây để chụp thông tin Booking.</span>
          </label>

          {paymentBooking?.payment && (
            <div className="vietqr-card">
              <div className="vietqr-title">
                <CreditCard size={18} />
                <span>{paymentBooking.payment.status === "paid" ? "Đã thanh toán" : paymentBooking.payment.provider === "momo" ? "Thanh toán MoMo" : "Thanh toán VietQR"}</span>
              </div>
              {paymentBooking.payment.qr_url && (
                <img src={paymentBooking.payment.qr_url} alt="Mã thanh toán" />
              )}
              {paymentBooking.payment.provider === "momo" && !paymentBooking.payment.qr_url && (
                <div className="momo-empty-qr">
                  <CreditCard size={34} />
                  <span>MoMo không trả ảnh QR trong response này.</span>
                  <strong>Bấm nút bên dưới để mở trang thanh toán MoMo.</strong>
                </div>
              )}
              <div className="vietqr-row">
                <span>Số tiền</span>
                <strong>{money(paymentBooking.payment.amount)}</strong>
              </div>
              <div className="vietqr-row">
                <span>{paymentBooking.payment.provider === "momo" ? "Mã đơn" : "Nội dung"}</span>
                <button type="button" onClick={copyTransferContent}>
                  {paymentBooking.payment.transfer_content} <Copy size={14} />
                </button>
              </div>
              {paymentBooking.payment.raw_payload?.response?.payUrl && (
                <a className="primary-btn full momo-pay-btn" href={paymentBooking.payment.raw_payload.response.payUrl} target="_blank" rel="noreferrer">
                  Mở MoMo để thanh toán
                </a>
              )}
              <p>Booking #{paymentBooking.booking_code}. Hệ thống đang giữ phòng trong 10 phút.</p>
              <button className="ghost-btn vietqr-refresh-btn" type="button" onClick={() => refreshPaymentStatus(paymentBooking.id, false)}>
                <RefreshCw size={14} />
                Kiểm tra thanh toán
              </button>
            </div>
          )}

          <p className="policy-copy">Khi bấm Đặt phòng đồng nghĩa với việc bạn đã đọc và đồng ý với các <b>Nội quy</b> & <b>Chính sách</b> của ftft</p>

          <div className="booking-warning">
            <b>*Chú ý:</b><br />
            - Bạn đang đặt phòng tại: Home - Bến Ninh Kiều, Cần Thơ.<br />
            - Đây là hệ thống đặt phòng tự động, nên khi bấm Đặt phòng bạn sẽ được chuyển sang quét mã QR để thanh toán qua app ngân hàng.
          </div>

          <button className="primary-btn full detail-submit-btn" type="button" onClick={submitDetailBooking} disabled={detailSubmitting}>
            {detailSubmitting ? <Loader2 className="spin" size={17} /> : <CalendarCheck size={17} />}
            Đặt phòng và lấy QR
          </button>
        </aside>
      </div>
    </section>
  );
}

export default App;
