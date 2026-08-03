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
import { assetUrl, money } from "../../utils/format";

function RoomsSection({ rooms, selectedBranch, loading, notice, onOpenRoomDetail }) {
  return (
    <section className="rooms-section" id="rooms">
      <div className="section-heading">
        <div>
          <h2>{selectedBranch ? selectedBranch.name : 'Top phong "chay ve"'}</h2>
          {selectedBranch && <p>{selectedBranch.address}</p>}
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
                <img src={assetUrl(room.main_image)} alt={room.name} />
                <span>{room.branch?.name || "ftft"}</span>
              </div>
              <div className="room-content">
                <div className="room-title-row">
                  <button className="room-title-link" type="button" onClick={() => onOpenRoomDetail(room)}>
                    {room.name}
                  </button>
                  <strong><Star size={15} fill="currentColor" /> 4.7</strong>
                </div>
                <p className="room-address">{room.branch?.address || room.branch?.name || "ftft"}</p>
                <div className="room-amenities">
                  <span><Bath size={16} />Bon tam</span>
                  <span><Projector size={16} />May chieu</span>
                  <span><BedDouble size={16} />Giuong doi</span>
                  <span><Sofa size={16} />Sofa</span>
                </div>
                <div className="room-prices">
                  <span>{money(room.price_per_night)}<small>/dem/2 nguoi</small></span>
                  <span>{money(room.price_per_hour)}<small>/3h/2 nguoi</small></span>
                  {room.price_per_day ? <span>{money(room.price_per_day)}<small>/ngay/2 nguoi</small></span> : null}
                </div>
                <button className="primary-btn room-book-btn" type="button" onClick={() => onOpenRoomDetail(room)}>
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
        <div className="empty-state">
          {selectedBranch ? "Chua co phong phu hop. Hay doi so khach hoac chi nhanh." : "Chon chi nhanh de xem phong phu hop."}
        </div>
      )}
    </section>
  );
}

export default RoomsSection;
