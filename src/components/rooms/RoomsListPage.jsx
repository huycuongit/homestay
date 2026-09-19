import { useEffect, useMemo, useState } from "react";
import { Bath, BedDouble, Building2, Heart, MapPin, Projector, Search, Sofa, Star } from "lucide-react";
import { assetUrl } from "../../utils/format";

const fallbackRoomImage = "/assets/imgs/date-night-room.png";
const badges = ["Hot", "Yêu thích", "Mới", "Ưu đãi"];
const PAGE_SIZE = 8;
const amenityIcons = [BedDouble, Projector, Bath, Sofa];

function getPaginationItems(currentPage, totalPages) {
  if (totalPages <= 7) {
    return Array.from({ length: totalPages }, (_, index) => index + 1);
  }

  const items = [1];
  const start = Math.max(currentPage - 1, 2);
  const end = Math.min(currentPage + 1, totalPages - 1);

  if (start > 2) items.push("start-ellipsis");
  for (let page = start; page <= end; page += 1) {
    items.push(page);
  }
  if (end < totalPages - 1) items.push("end-ellipsis");
  items.push(totalPages);

  return items;
}

function RoomsListPage({ branches = [], rooms = [], selectedBranchId, onBranchChange, onOpenRoomDetail, onBackHome }) {
  const [page, setPage] = useState(1);
  const visibleRooms = useMemo(() => (
    selectedBranchId
      ? rooms.filter((room) => String(room.branch_id || room.branch?.id || "") === String(selectedBranchId))
      : rooms
  ), [rooms, selectedBranchId]);
  const selectedBranch = branches.find((branch) => String(branch.id) === String(selectedBranchId));
  const totalPages = Math.max(Math.ceil(visibleRooms.length / PAGE_SIZE), 1);
  const currentPage = Math.min(page, totalPages);
  const pageRooms = visibleRooms.slice((currentPage - 1) * PAGE_SIZE, currentPage * PAGE_SIZE);
  const paginationItems = getPaginationItems(currentPage, totalPages);

  useEffect(() => {
    setPage(1);
  }, [selectedBranchId, rooms.length]);

  return (
    <section className="rooms-list-page">
      <div className="rooms-list-hero">
        <div>
          <button className="text-action" type="button" onClick={onBackHome}>Trang chủ</button>
          <p className="section-kicker">Tất cả phòng</p>
          <h1>{selectedBranch ? `Phòng tại ${selectedBranch.nav_name || selectedBranch.name}` : "Chọn phòng cho buổi hẹn của bạn"}</h1>
          <p>{selectedBranch?.address || "Lọc theo chi nhánh để tìm không gian phù hợp gần bạn nhất."}</p>
        </div>
        <div className="rooms-list-filter">
          <label htmlFor="room-list-branch"><Building2 size={18} /> Chi nhánh</label>
          <select
            id="room-list-branch"
            value={selectedBranchId || ""}
            onChange={(event) => onBranchChange(event.target.value || null)}
          >
            <option value="">Tất cả chi nhánh</option>
            {branches.map((branch) => (
              <option key={branch.id} value={branch.id}>
                {branch.nav_name || branch.name}
              </option>
            ))}
          </select>
        </div>
      </div>

      <div className="rooms-list-toolbar">
        <strong>{visibleRooms.length} phòng</strong>
        <span>
          {selectedBranch ? "Đang lọc theo chi nhánh" : "Đang hiển thị toàn bộ chi nhánh"}
          {visibleRooms.length ? ` · Trang ${currentPage}/${totalPages}` : ""}
        </span>
      </div>

      {visibleRooms.length ? (
        <>
          <div className="room-grid rooms-list-grid">
            {pageRooms.map((room, index) => (
              <article className="room-card" key={room.id}>
                <div className="room-image">
                  <img src={assetUrl(room.main_image || room.cover_image || room.image_url || fallbackRoomImage)} alt={room.name} />
                  <span><Star size={12} fill="currentColor" /> {badges[((currentPage - 1) * PAGE_SIZE + index) % badges.length]}</span>
                  <button type="button" aria-label="Yêu thích"><Heart size={20} /></button>
                </div>
                <div className="room-content">
                  <div className="room-title-row">
                    <button className="room-title-link" type="button" onClick={() => onOpenRoomDetail(room)}>
                      {room.name}
                    </button>
                  </div>
                  <p className="room-address"><MapPin size={14} /> {room.branch?.nav_name || room.branch?.name || room.branch?.address || "ftft"}</p>
                  <div className="room-amenities">
                    {(room.amenities?.length ? room.amenities.map((item) => item.name) : ["Giường King", "Máy chiếu", "Bồn tắm", "Bếp tiện nghi"]).slice(0, 4).map((name, amenityIndex) => {
                      const Icon = amenityIcons[amenityIndex % amenityIcons.length];
                      return <span key={name}><Icon size={16} />{name}</span>;
                    })}
                  </div>
                  <button className="primary-btn room-book-btn" type="button" onClick={() => onOpenRoomDetail(room)}>
                    <Search size={15} />
                    Xem phòng
                  </button>
                </div>
              </article>
            ))}
          </div>

          <div className="rooms-list-pagination">
            <span>
              Hiển thị {(currentPage - 1) * PAGE_SIZE + 1}-{Math.min(currentPage * PAGE_SIZE, visibleRooms.length)} / {visibleRooms.length}
            </span>
            <div>
              <button type="button" disabled={currentPage <= 1} onClick={() => setPage((value) => Math.max(value - 1, 1))}>
                Trước
              </button>
              {paginationItems.map((item) => (
                typeof item === "number" ? (
                  <button
                    className={item === currentPage ? "active" : ""}
                    type="button"
                    key={item}
                    onClick={() => setPage(item)}
                  >
                    {item}
                  </button>
                ) : (
                  <span className="pagination-ellipsis" key={item}>...</span>
                )
              ))}
              <button type="button" disabled={currentPage >= totalPages} onClick={() => setPage((value) => Math.min(value + 1, totalPages))}>
                Sau
              </button>
            </div>
          </div>
        </>
      ) : (
        <div className="empty-state">
          Chi nhánh này chưa có phòng đang hiển thị.
        </div>
      )}
    </section>
  );
}

export default RoomsListPage;
