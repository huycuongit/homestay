import { ArrowRight, ChevronDown, LogOut, Search, UserRound } from "lucide-react";
import BrandLogo from "./BrandLogo";

function Header({
  branches = [],
  publicPage = "home",
  selectedBranchId,
  user,
  onBranchSelect,
  onHomeClick,
  onShowRooms,
  onShowBooking,
  onLoginClick,
  onLogout,
  settings = {}
}) {
  const selectedBranch = branches.find((branch) => String(branch.id) === String(selectedBranchId));
  const siteName = settings.site_name || "ftft";

  return (
    <header className="topbar">
      <button className="brand brand-button" type="button" onClick={onHomeClick} aria-label="ftft Booking">
        <BrandLogo className="site-brand-logo" label={siteName} />
      </button>
      <nav className="nav-links" aria-label="Điều hướng chính">
        <button className={publicPage === "home" && !selectedBranchId ? "nav-link-btn active" : "nav-link-btn"} type="button" onClick={onHomeClick}>
          Trang chủ
        </button>
        <div className="nav-dropdown">
          <button className={selectedBranchId ? "nav-link-btn active" : "nav-link-btn"} type="button">
            {selectedBranch?.nav_name || selectedBranch?.name || "Chi nhánh"}
            <ChevronDown size={14} />
          </button>
          <div className="nav-dropdown-menu" role="menu">
            <button type="button" onClick={() => onBranchSelect(null, { target: "rooms", scroll: false })}>
              Tất cả chi nhánh
            </button>
            {branches.map((branch) => (
              <button
                key={branch.id}
                className={String(branch.id) === String(selectedBranchId) ? "selected" : ""}
                type="button"
                onClick={() => onBranchSelect(branch.id, { target: "rooms", scroll: false })}
              >
                <span>{branch.nav_name || branch.name}</span>
                {branch.address ? <small>{branch.address}</small> : null}
              </button>
            ))}
          </div>
        </div>
        <button className={publicPage === "rooms" && !selectedBranchId ? "nav-link-btn active" : "nav-link-btn"} type="button" onClick={() => onShowRooms(null)}>
          Tất cả phòng
        </button>
      </nav>
      <div className="header-actions">
        <button className="nav-search-btn" type="button" onClick={onShowBooking} aria-label="Tìm kiếm phòng">
          <Search size={18} />
        </button>
        {user ? (
          <button className="nav-auth-btn" type="button" onClick={onLogout}>
            <UserRound size={15} />
            {user.name || user.phone || "Tài khoản"}
            <LogOut size={14} />
          </button>
        ) : (
          <button className="nav-auth-btn" type="button" onClick={onLoginClick}>
            <UserRound size={15} />
            Đăng nhập
          </button>
        )}
        <button className="nav-cta" type="button" onClick={onShowBooking}>Đặt phòng ngay <ArrowRight size={16} /></button>
      </div>
    </header>
  );
}

export default Header;
