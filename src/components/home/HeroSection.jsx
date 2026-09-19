import { Bath, CalendarDays, Clock, Heart, Loader2, MapPin, Projector, Search, ShieldCheck, Soup, Users } from "lucide-react";
import { bookingSlots as fallbackBookingSlots, heroShots } from "../../data/homeContent";
import { assetUrl } from "../../utils/format";

const heroFeatures = [
  { icon: ShieldCheck, title: "Không gian riêng tư", text: "Thoải mái, an toàn" },
  { icon: Projector, title: "Máy chiếu & Netflix", text: "Xem phim thỏa thích" },
  { icon: Bath, title: "Bồn tắm thư giãn", text: "Giảm căng thẳng" },
  { icon: Soup, title: "Bếp tiện nghi", text: "Nấu ăn cùng nhau" },
  { icon: MapPin, title: "Nhiều chi nhánh", text: "Ngay trong nội thành" },
  { icon: Heart, title: "Được các cặp đôi yêu thích", text: "Hơn 10.000 lượt đặt phòng" }
];

function HeroSection({ branches, bookingOptions = [], selectedBranchId, search, loading, onSearch, onBranchChange, onUpdateSearch, settings = {}, images = [], commits = [] }) {
  const slots = bookingOptions.length ? bookingOptions : fallbackBookingSlots;
  const dynamicShots = images.length
    ? images.slice(0, 5).map((image) => ({ label: image.name || image.description || "Ảnh trải nghiệm", src: assetUrl(image.url) }))
    : heroShots;
  const dynamicFeatures = commits.length
    ? commits.slice(0, 6).map((commit, index) => ({
        icon: [ShieldCheck, Projector, Bath, Soup, MapPin, Heart][index % 6],
        title: commit.name,
        text: commit.description
      }))
    : heroFeatures;
  const visibleSlots = slots.filter((slot) => slot.type === search.booking_type);
  const rateOptions = slots.reduce((result, slot) => {
    if (!result.some((item) => item.value === slot.type)) {
      result.push({ value: slot.type, label: slot.rateName || slot.type });
    }
    return result;
  }, []);

  return (
    <section className="hero" id="booking">
      <div className="hero-stage">
        <div className="hero-backdrop">
          <div className="hero-copy">
            <p className="hero-kicker">{settings.hero_kicker || settings.site_name || "ftft"}</p>
            <h1>{settings.hero_title || "Một khoảng riêng,"}<br /><span>{settings.hero_title_highlight || "ngay gần bạn."}</span></h1>
            <p className="hero-subtitle">
              {settings.hero_subtitle || "Homestay, căn hộ riêng tư dành cho những buổi hẹn, staycation và những ngày chỉ muốn ở cạnh nhau."}
            </p>
          </div>

          <div className="hero-note hero-note-left handwriting">{settings.hero_note_left || "Good things\nhappen here ♡"}</div>
          <div className="hero-note hero-note-right handwriting">{settings.hero_note_right || "Same place\ndifferent feelings ♡"}</div>
          <div className="hero-shot-strip" aria-label="Ảnh trải nghiệm nổi bật">
            {dynamicShots.map((shot) => (
              <figure className="hero-shot" key={shot.label}>
                <img src={shot.src} alt={shot.label} />
              </figure>
            ))}
          </div>
        </div>

        <form className="search-panel" onSubmit={onSearch}>
          <div className="field location-field">
            <label htmlFor="location"><MapPin size={18} /> Khu vực</label>
            <select
              id="location"
              value={selectedBranchId || ""}
              onChange={(event) => onBranchChange(event.target.value || null)}
            >
              <option value="">Chọn khu vực</option>
              {branches.map((branch) => (
                <option key={branch.id} value={branch.id}>
                  {branch.nav_name || branch.name}
                </option>
              ))}
            </select>
          </div>

          <div className="field">
            <label htmlFor="booking_type"><Clock size={18} /> Loại phòng</label>
            <select
              id="booking_type"
              value={search.booking_type}
              onChange={(event) => onUpdateSearch("booking_type", event.target.value)}
              disabled={!selectedBranchId}
            >
              <option value="">Tất cả</option>
              {rateOptions.map((option) => (
                <option key={option.value} value={option.value}>
                  {option.label}
                </option>
              ))}
            </select>
          </div>

          <div className="field">
            <label htmlFor="booking_date"><CalendarDays size={18} /> Ngày</label>
            <input
              id="booking_date"
              type="date"
              value={search.booking_date}
              onChange={(event) => onUpdateSearch("booking_date", event.target.value)}
              disabled={!selectedBranchId}
            />
          </div>

          <div className="field">
            <label htmlFor="slot_id"><Clock size={18} /> Khung giờ</label>
            <select
              id="slot_id"
              value={search.slot_id}
              onChange={(event) => onUpdateSearch("slot_id", event.target.value)}
              disabled={!selectedBranchId || !search.booking_type}
            >
              <option value="">Chọn khung giờ</option>
              {visibleSlots.map((slot) => (
                <option key={slot.id} value={slot.id}>
                  {slot.label} {slot.subLabel || ""}
                </option>
              ))}
            </select>
          </div>

          <div className="field">
            <label htmlFor="guests"><Users size={18} /> Khách</label>
            <div className="guest-control">
              <Users size={17} />
              <input
                id="guests"
                type="number"
                min="1"
                value={search.guests}
                onChange={(event) => onUpdateSearch("guests", event.target.value)}
                disabled={!selectedBranchId}
              />
              <span>khách</span>
            </div>
          </div>

          <button className="primary-btn" type="submit" disabled={loading}>
            {loading ? <Loader2 className="spin" size={18} /> : <Search size={18} />}
            Tìm phòng
          </button>
        </form>
      </div>
      <div className="hero-feature-row">
        {dynamicFeatures.map(({ icon: Icon, title, text }) => (
          <div className="hero-feature" key={title}>
            <Icon size={30} />
            <strong>{title}</strong>
            <span>{text}</span>
          </div>
        ))}
      </div>
    </section>
  );
}

export default HeroSection;
