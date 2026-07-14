import {
  Bath,
  BedDouble,
  CheckCircle2,
  ChevronLeft,
  ChevronRight,
  Loader2,
  Projector,
  Sofa,
  Star
} from "lucide-react";
import { money } from "../../utils/format";

function RoomsSection({ rooms, loading, notice, onOpenBooking, onOpenRoomDetail }) {
  return (
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
                  <button className="room-title-link" type="button" onClick={() => onOpenRoomDetail(room)}>
                    Libra - 22
                  </button>
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
                <button className="primary-btn room-book-btn" type="button" onClick={() => onOpenBooking(room)}>
                  Dat phong
                </button>
                <button className="room-detail-link" type="button" onClick={() => onOpenRoomDetail(room)}>
                  Xem chi tiet
                </button>
              </div>
            </article>
          ))}
        </div>
      ) : (
        <div className="empty-state">Chua co phong phu hop. Hay doi khoang thoi gian hoac so khach.</div>
      )}
    </section>
  );
}

export default RoomsSection;
