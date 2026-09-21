import { ArrowLeft, ArrowRight, MapPin, Navigation } from "lucide-react";

function mapUrl(branch) {
  const query = branch.lat && branch.lng
    ? `${branch.lat},${branch.lng}`
    : branch.address || branch.name;
  return `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(query)}`;
}

function BranchesPage({ branches = [], onBackHome, onBrowseRooms }) {
  return (
    <section className="branches-page">
      <div className="branches-page-heading">
        <button className="back-btn" type="button" onClick={onBackHome}><ArrowLeft size={18} /> Về trang chủ</button>
        <p className="section-kicker">Hệ thống chi nhánh</p>
        <h1>Tìm FEBoking gần bạn</h1>
        <p>Chọn chi nhánh phù hợp, xem đường đi hoặc khám phá các phòng đang có tại đó.</p>
      </div>

      <div className="branches-directory">
          {branches.map((branch, index) => (
            <article className="branch-directory-card" key={branch.id}>
              <img src={`/assets/imgs/room-0${(index % 4) + 1}.png`} alt={`Không gian chi nhánh ${branch.nav_name || branch.name}`} />
              <div>
                <h2>{branch.nav_name || branch.name}</h2>
                <p><MapPin size={16} /> {branch.address || "Địa chỉ đang cập nhật"}</p>
                <div className="branch-directory-actions">
                  <a href={mapUrl(branch)} target="_blank" rel="noreferrer"><Navigation size={15} /> Mở Google Maps</a>
                  <button type="button" onClick={() => onBrowseRooms(branch.id)}>Xem phòng <ArrowRight size={15} /></button>
                </div>
              </div>
            </article>
          ))}
      </div>
    </section>
  );
}

export default BranchesPage;
