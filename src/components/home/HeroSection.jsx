import { CalendarDays, Clock, Loader2, MapPin, Search, Users } from "lucide-react";
import { bookingSlots as fallbackBookingSlots, heroShots } from "../../data/homeContent";
import BrandLogo from "../layout/BrandLogo";

function HeroSection({ branches, bookingOptions = [], selectedBranchId, search, loading, onSearch, onBranchChange, onUpdateSearch }) {
  const slots = bookingOptions.length ? bookingOptions : fallbackBookingSlots;
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
          <div className="hero-brand">
            <BrandLogo className="hero-logo" showText={false} />
            <h1>ftft HOMESTAY & CINEMA</h1>
            <p>CHILL OUT & MOVIE ON</p>
          </div>

          <div className="callout callout-left">
            <span>view ban công<br />ngắm hoàng hôn</span>
          </div>
          <div className="callout callout-center">
            <span>máy chiếu full HD<br />120 inches</span>
          </div>
          <div className="callout callout-right">
            <span>thỏa sức chill<br />cùng boardgames</span>
          </div>

          <div className="hero-shot-strip" aria-label="Ảnh nổi bật">
            {heroShots.map((shot) => (
              <figure className="hero-shot" key={shot.label}>
                <img src={shot.src} alt={shot.label} />
              </figure>
            ))}
          </div>
        </div>

        <form className="search-panel" onSubmit={onSearch}>
          <div className="field location-field">
            <label htmlFor="location"><MapPin size={15} /> Địa điểm</label>
            <select
              id="location"
              value={selectedBranchId || ""}
              onChange={(event) => onBranchChange(event.target.value || null)}
            >
              <option value="">Chọn chi nhánh</option>
              {branches.map((branch) => (
                <option key={branch.id} value={branch.id}>
                  {branch.nav_name || branch.name}
                </option>
              ))}
            </select>
          </div>

          <div className="field">
            <label htmlFor="booking_type"><Clock size={15} /> Loại đặt</label>
            <select
              id="booking_type"
              value={search.booking_type}
              onChange={(event) => onUpdateSearch("booking_type", event.target.value)}
              disabled={!selectedBranchId}
            >
              <option value="">Chọn loại đặt</option>
              {rateOptions.map((option) => (
                <option key={option.value} value={option.value}>
                  {option.label}
                </option>
              ))}
            </select>
          </div>

          <div className="field">
            <label htmlFor="booking_date"><CalendarDays size={15} /> Ngày</label>
            <input
              id="booking_date"
              type="date"
              value={search.booking_date}
              onChange={(event) => onUpdateSearch("booking_date", event.target.value)}
              disabled={!selectedBranchId}
            />
          </div>

          <div className="field">
            <label htmlFor="slot_id"><Clock size={15} /> Khung giờ</label>
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
            <label htmlFor="guests">Số khách</label>
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
    </section>
  );
}

export default HeroSection;
