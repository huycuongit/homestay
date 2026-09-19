import {
  Bath,
  BedDouble,
  CheckCircle2,
  ChevronLeft,
  ChevronRight,
  Heart,
  Loader2,
  MapPin,
  Projector,
  Sofa,
  Star
} from "lucide-react";
import { assetUrl, money } from "../../utils/format";

const hotRoomImage = "/assets/imgs/date-night-room.png";
const hotBadges = ["Hot", "Yêu thích", "Mới", "Ưu đãi"];

function RoomsSection({ rooms, selectedBranch, loading, notice, onOpenRoomDetail, onShowRooms, amenities = [] }) {
  const visibleRooms = rooms.slice(0, 4);
  const fallbackAmenities = amenities.slice(0, 4).map((amenity) => amenity.name);

  return (
    <section className="rooms-section" id="rooms">
      <div className="section-heading">
        <div>
          <p className="section-kicker">Phòng nghỉ nổi bật</p>
          <h2>{selectedBranch ? selectedBranch.name : "Tối nay mình đi đâu?"}</h2>
          <p>{selectedBranch ? selectedBranch.address : "Những không gian được các cặp đôi yêu thích nhất."}</p>
        </div>
        <div className="round-actions">
          <button className="text-round-action" type="button" onClick={onShowRooms}>Xem tất cả</button>
          <button type="button" onClick={onShowRooms} aria-label="Xem danh sách phòng"><ChevronLeft size={18} /></button>
          <button type="button" onClick={onShowRooms} aria-label="Xem danh sách phòng"><ChevronRight size={18} /></button>
        </div>
      </div>

      {notice && <div className={`notice ${notice.type}`}>{notice.type === "success" && <CheckCircle2 size={18} />} {notice.text}</div>}

      {loading ? (
        <div className="empty-state"><Loader2 className="spin" size={22} /> Đang tải phòng...</div>
      ) : visibleRooms.length ? (
        <div className="room-grid">
          {visibleRooms.map((room, index) => (
            <article className="room-card" key={room.id}>
              <div className="room-image">
                <img src={assetUrl(room.main_image || room.cover_image || room.image_url || hotRoomImage)} alt={room.name} />
                <span><Star size={12} fill="currentColor" /> {hotBadges[index % hotBadges.length]}</span>
                <button type="button" aria-label="Xem phòng yêu thích" onClick={() => onOpenRoomDetail(room)}><Heart size={20} /></button>
              </div>
              <div className="room-content">
                <div className="room-title-row">
                  <button className="room-title-link" type="button" onClick={() => onOpenRoomDetail(room)}>
                    {room.name}
                  </button>
                </div>
                <p className="room-address"><MapPin size={14} /> {room.branch?.nav_name || room.branch?.name || room.branch?.address || "ftft"}</p>
                <div className="room-amenities">
                  {(room.amenities?.length ? room.amenities.map((item) => item.name) : fallbackAmenities).slice(0, 4).map((name, amenityIndex) => {
                    const icons = [BedDouble, Projector, Bath, Sofa];
                    const AmenityIcon = icons[amenityIndex % icons.length];
                    return <span key={name}><AmenityIcon size={16} />{name}</span>;
                  })}
                </div>
                <div className="room-prices">
                  <span>{money(room.price_per_hour || room.price_per_night)}<small>/ 4 giờ</small></span>
                </div>
                <button className="primary-btn room-book-btn" type="button" onClick={() => onOpenRoomDetail(room)}>
                  Đặt ngay
                </button>
              </div>
            </article>
          ))}
        </div>
      ) : (
        <div className="empty-state">
          {selectedBranch ? "Chưa có phòng phù hợp. Hãy đổi số khách hoặc chi nhánh." : "Chọn chi nhánh để xem phòng phù hợp."}
        </div>
      )}
    </section>
  );
}

export default RoomsSection;
