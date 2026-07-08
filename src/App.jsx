import { useEffect, useMemo, useState } from "react";
import {
  ArrowUp,
  Bath,
  BedDouble,
  Building2,
  CalendarCheck,
  ChevronLeft,
  ChevronRight,
  CheckCircle2,
  Clock,
  Film,
  Gamepad2,
  Hotel,
  Loader2,
  MessageCircle,
  MapPin,
  Phone,
  Projector,
  Search,
  Sofa,
  Star,
  Users,
  WashingMachine,
  X
} from "lucide-react";

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || "http://localhost:4100/api";
const ASSET_BASE_URL = API_BASE_URL.replace(/\/api\/?$/, "");

const heroShots = [
  {
    label: "view ban cong ngam hoang hon",
    src: "https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=500&q=80"
  },
  {
    label: "goc chill trong phong",
    src: "https://images.unsplash.com/photo-1616046229478-9901c5536a45?auto=format&fit=crop&w=500&q=80"
  },
  {
    label: "may chieu full HD",
    src: "https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=500&q=80"
  },
  {
    label: "phong ngu cinema",
    src: "https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=500&q=80"
  },
  {
    label: "thoa suc chill cung boardgames",
    src: "https://images.unsplash.com/photo-1610890716171-6b1bb98ffd09?auto=format&fit=crop&w=500&q=80"
  }
];

const featureList = [
  "Noi that hien dai, day du tien ich",
  "May chieu + Netflix FREE, chill het dem",
  "Bep nau rieng, nau an thoai mai nhu o nha",
  "May giat & say tien loi cho ky nghi dai ngay",
  "Khong gian sach se, am cung",
  "Vi tri thuan tien, de dang di chuyen den TP.HCM"
];

function formatLocalInput(date) {
  const pad = (value) => String(value).padStart(2, "0");
  return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T${pad(date.getHours())}:${pad(date.getMinutes())}`;
}

function defaultCheckIn() {
  const date = new Date();
  date.setMinutes(0, 0, 0);
  date.setHours(date.getHours() + 2);
  return formatLocalInput(date);
}

function defaultCheckOut() {
  const date = new Date();
  date.setMinutes(0, 0, 0);
  date.setDate(date.getDate() + 1);
  date.setHours(12);
  return formatLocalInput(date);
}

function toApiDate(value) {
  return new Date(value).toISOString();
}

function assetUrl(value) {
  if (!value) return "https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=900&q=80";
  if (/^https?:\/\//.test(value)) return value;
  return `${ASSET_BASE_URL}${value.startsWith("/") ? value : `/${value}`}`;
}

function money(value) {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
    maximumFractionDigits: 0
  }).format(Number(value || 0));
}

async function apiFetch(path, options = {}) {
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
    throw new Error(details || "Khong ket noi duoc may chu.");
  }

  return payload;
}

function App() {
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
    setBookingForm({ customer_name: "", customer_phone: "", customer_email: "", note: "" });
    setNotice(null);
  }

  function closeBooking() {
    if (!submitting) setSelectedRoom(null);
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

  useEffect(() => {
    loadRooms();
  }, []);

  return (
    <div className="app-shell">
      <header className="topbar">
        <a className="brand" href="#top" aria-label="Homestay Booking">
          <span className="brand-mark"><Hotel size={18} /></span>
          <span>BurgerBliss</span>
        </a>
        <nav className="nav-links" aria-label="Main navigation">
          <a href="#top">Trang chu</a>
          <a href="#rooms">Bien Hoa</a>
          <a href="#rooms">Long Thanh</a>
          <a href="#rooms">Thu Dau Mot</a>
          <a href="#rooms">Di An</a>
          <a href="#contact">Lien he</a>
          <a className="nav-cta" href="#booking">Dat phong ngay!</a>
        </nav>
      </header>

      <main id="top">
        <section className="hero" id="booking">
          <div className="hero-stage">
            <div className="hero-backdrop">
              <div className="hero-brand">
                <div className="line-logo"><Film size={54} /></div>
                <h1>COZYNEST HOMESTAY & CINEMA</h1>
                <p>CHILL OUT & MOVIE ON</p>
              </div>

              <div className="callout callout-left">
                <span>view ban cong<br />ngam hoang hon</span>
              </div>
              <div className="callout callout-center">
                <span>may chieu full HD<br />120 inches</span>
              </div>
              <div className="callout callout-right">
                <span>thoa suc chill<br />cung boardgames</span>
              </div>

              <div className="hero-shot-strip" aria-label="Anh noi bat">
                {heroShots.map((shot) => (
                  <figure className="hero-shot" key={shot.label}>
                    <img src={shot.src} alt={shot.label} />
                  </figure>
                ))}
              </div>
            </div>

            <form className="search-panel" onSubmit={loadRooms}>
              <div className="field location-field">
                <label htmlFor="location"><MapPin size={15} /> Dia diem</label>
                <div className="fake-input">
                  <Building2 size={18} />
                  <span>115 Duong D9, Thu Dau Mot</span>
                </div>
              </div>
              <div className="field">
                <label htmlFor="check_in">Check In</label>
                <input
                  id="check_in"
                  type="datetime-local"
                  value={search.check_in}
                  onChange={(event) => updateSearch("check_in", event.target.value)}
                  required
                />
              </div>
              <div className="field">
                <label htmlFor="check_out">Check Out</label>
                <input
                  id="check_out"
                  type="datetime-local"
                  value={search.check_out}
                  onChange={(event) => updateSearch("check_out", event.target.value)}
                  required
                />
              </div>
              <div className="field">
                <label htmlFor="guests">So luong khach</label>
                <div className="guest-control">
                  <Users size={17} />
                  <input
                    id="guests"
                    type="number"
                    min="1"
                    value={search.guests}
                    onChange={(event) => updateSearch("guests", event.target.value)}
                    required
                  />
                  <span>khach</span>
                </div>
              </div>
              <input type="hidden" value={search.booking_type} readOnly />
              <button className="primary-btn" type="submit" disabled={loading}>
                {loading ? <Loader2 className="spin" size={18} /> : <Users size={18} />}
                Dat phong
              </button>
            </form>
          </div>
        </section>

        <section className="intro-section">
          <div className="intro-media">
            <img
              src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=85"
              alt="Phong homestay cho couple"
            />
            <div className="intro-caption">
              <h2>Y tuong Hen Ho Cho Couple</h2>
              <p>homestay tu check-in, khong ngai le tan</p>
            </div>
          </div>

          <div className="intro-copy">
            <h2>Check-in linh hoat - nghi ngoi thoai mai !</h2>
            <p>
              Tran Anh The Hone - homestay tien nghi tai Bien Hoa, Long Thanh,
              Thu Dau Mot, Di An.
            </p>
            <ul>
              {featureList.map((feature) => (
                <li key={feature}>{feature}</li>
              ))}
            </ul>
            <div className="intro-stats">
              <div><strong>70+</strong><span>Phong nghi</span></div>
              <div><strong>1000+</strong><span>Luot dat phong</span></div>
              <div><strong>2000+</strong><span>Khach hang hai long</span></div>
            </div>
          </div>
        </section>

        <section className="rooms-section" id="rooms">
          <div className="section-heading">
            <div>
              <h2>Top phong "chay ve"</h2>
            </div>
            <div className="round-actions" aria-hidden="true">
              <button type="button"><ChevronLeft size={18} /></button>
              <button type="button"><ChevronRight size={18} /></button>
            </div>
          </div>

          {notice && <div className={`notice ${notice.type}`}>{notice.type === "success" && <CheckCircle2 size={18} />} {notice.text}</div>}

          {loading ? (
            <div className="empty-state"><Loader2 className="spin" size={22} /> Dang tai phong...</div>
          ) : rooms.length ? (
            <div className="room-grid">
              {rooms.map((room) => (
                <article className="room-card" key={room.id}>
                  <div className="room-image">
                    <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?auto=format&fit=crop&w=700&q=85" alt={room.name} />
                    <span>STAYCATION BIEN HOA</span>
                  </div>
                  <div className="room-content">
                    <div className="room-title-row">
                      <h3>Libra - 22</h3>
                      <strong><Star size={15} fill="currentColor" /> 4.7</strong>
                    </div>
                    <p className="room-address">{room.branch?.address || room.branch?.name || "134/35 Duong Ha Huy Giap, Bien Hoa, Dong Nai"}</p>
                    <div className="room-amenities">
                      <span><Bath size={16} />Bon tam</span>
                      <span><Projector size={16} />May chieu</span>
                      <span><BedDouble size={16} />Giuong doi</span>
                      <span><Sofa size={16} />Sofa</span>
                    </div>
                    <div className="room-prices">
                      <span>{money(room.price_per_night)}<small>/dem/2 nguoi</small></span>
                      <span>{money(room.price_per_hour)}<small>/3h/2 nguoi</small></span>
                    </div>
                    <button className="primary-btn room-book-btn" type="button" onClick={() => openBooking(room)}>
                      Dat phong
                    </button>
                  </div>
                </article>
              ))}
            </div>
          ) : (
            <div className="empty-state">Chua co phong phu hop. Hay doi khoang thoi gian hoac so khach.</div>
          )}
        </section>
      </main>

      <div className="floating-contact" id="contact" aria-label="Lien he nhanh">
        <a href="tel:0900000000" aria-label="Goi dien"><Phone size={19} /></a>
        <a href="#booking" aria-label="Nhan tin"><MessageCircle size={19} /></a>
        <a href="#booking" aria-label="Zalo">Zalo</a>
        <a href="#top" aria-label="Len dau trang"><ArrowUp size={20} /></a>
      </div>

      <footer className="footer">
        <span>Homestay Booking</span>
        <span>API: {API_BASE_URL}</span>
      </footer>

      {selectedRoom && (
        <div className="modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="booking-modal-title">
          <form className="booking-modal" onSubmit={submitBooking}>
            <div className="modal-head">
              <div>
                <p className="eyebrow">Thong tin khach</p>
                <h2 id="booking-modal-title">Dat {selectedRoom.name}</h2>
              </div>
              <button className="icon-btn" type="button" onClick={closeBooking} aria-label="Dong form booking">
                <X size={20} />
              </button>
            </div>

            <div className="booking-summary">
              <span>{search.booking_type === "hour" ? "Theo gio" : "Theo dem"}</span>
              <strong>Tam tinh tu {money(selectedTotalPreview)}</strong>
            </div>

            <div className="form-grid">
              <label>
                Ho ten
                <input
                  value={bookingForm.customer_name}
                  onChange={(event) => setBookingForm((current) => ({ ...current, customer_name: event.target.value }))}
                  required
                />
              </label>
              <label>
                So dien thoai
                <input
                  value={bookingForm.customer_phone}
                  onChange={(event) => setBookingForm((current) => ({ ...current, customer_phone: event.target.value }))}
                  required
                />
              </label>
              <label>
                Email
                <input
                  type="email"
                  value={bookingForm.customer_email}
                  onChange={(event) => setBookingForm((current) => ({ ...current, customer_email: event.target.value }))}
                />
              </label>
              <label>
                Ghi chu
                <input
                  value={bookingForm.note}
                  onChange={(event) => setBookingForm((current) => ({ ...current, note: event.target.value }))}
                  placeholder="Den som, can ho tro..."
                />
              </label>
            </div>

            <button className="primary-btn full" type="submit" disabled={submitting}>
              {submitting ? <Loader2 className="spin" size={18} /> : <CalendarCheck size={18} />}
              Gui booking
            </button>
          </form>
        </div>
      )}
    </div>
  );
}

export default App;
