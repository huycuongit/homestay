import { CalendarDays, Clock, Film, Loader2, MapPin, Search, Users } from "lucide-react";
import { bookingSlots, heroShots } from "../../data/homeContent";

function HeroSection({ branches, selectedBranchId, search, loading, onSearch, onBranchChange, onUpdateSearch }) {
  const visibleSlots = bookingSlots.filter((slot) => slot.type === search.booking_type);

  return (
    <section className="hero" id="booking">
      <div className="hero-stage">
        <div className="hero-backdrop">
          <div className="hero-brand">
            <div className="line-logo"><Film size={54} /></div>
            <h1>ftft HOMESTAY & CINEMA</h1>
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

        <form className="search-panel" onSubmit={onSearch}>
          <div className="field location-field">
            <label htmlFor="location"><MapPin size={15} /> Địa điểm</label>
            <select
              id="location"
              value={selectedBranchId || ""}
              onChange={(event) => onBranchChange(event.target.value || null)}
              required
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
            >
              <option value="hour">Theo 3 tiếng</option>
              <option value="night">Qua đêm</option>
            </select>
          </div>

          <div className="field">
            <label htmlFor="booking_date"><CalendarDays size={15} /> Ngày</label>
            <input
              id="booking_date"
              type="date"
              value={search.booking_date}
              onChange={(event) => onUpdateSearch("booking_date", event.target.value)}
              required
            />
          </div>

          <div className="field">
            <label htmlFor="slot_id"><Clock size={15} /> Khung giờ</label>
            <select
              id="slot_id"
              value={search.slot_id}
              onChange={(event) => onUpdateSearch("slot_id", event.target.value)}
              required
            >
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
                required
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
