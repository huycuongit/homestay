import { Building2, Film, Loader2, MapPin, Users } from "lucide-react";
import { heroShots } from "../../data/homeContent";

function HeroSection({ search, loading, onSearch, onUpdateSearch }) {
  return (
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

        <form className="search-panel" onSubmit={onSearch}>
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
              onChange={(event) => onUpdateSearch("check_in", event.target.value)}
              required
            />
          </div>
          <div className="field">
            <label htmlFor="check_out">Check Out</label>
            <input
              id="check_out"
              type="datetime-local"
              value={search.check_out}
              onChange={(event) => onUpdateSearch("check_out", event.target.value)}
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
                onChange={(event) => onUpdateSearch("guests", event.target.value)}
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
  );
}

export default HeroSection;
