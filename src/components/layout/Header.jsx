import { useState } from "react";
import { ArrowRight, ChevronDown, LogOut, Menu, Search, UserRound, X } from "lucide-react";
import BrandLogo from "./BrandLogo";

function Header({
  branches = [],
  publicPage = "home",
  selectedBranchId,
  user,
  onBranchSelect,
  onShowBranches,
  onHomeClick,
  onShowRooms,
  onShowBooking,
  onLoginClick,
  onLogout,
  settings = {}
}) {
  const [mobileOpen, setMobileOpen] = useState(false);
  const siteName = settings.site_name || "FEBoking";
  const closeMobileMenu = () => setMobileOpen(false);

  return (
    <header className={`topbar ${mobileOpen ? "mobile-open" : ""}`}>
      <button className="brand brand-button" type="button" onClick={() => { onHomeClick(); closeMobileMenu(); }} aria-label="FEBoking">
        <BrandLogo className="site-brand-logo" label={siteName} />
      </button>
      <button className="mobile-menu-toggle" type="button" onClick={() => setMobileOpen((open) => !open)} aria-label={mobileOpen ? "Đóng menu" : "Mở menu"}>
        {mobileOpen ? <X size={22} /> : <Menu size={24} />}
      </button>
      <nav className="nav-links" aria-label="Điều hướng chính">
        <button className={publicPage === "home" && !selectedBranchId ? "nav-link-btn active" : "nav-link-btn"} type="button" onClick={() => { onHomeClick(); closeMobileMenu(); }}>
          Trang chủ
        </button>
        <div className="nav-dropdown">
          <button className={publicPage === "rooms" ? "nav-link-btn active" : "nav-link-btn"} type="button" onClick={() => { onShowRooms(null); closeMobileMenu(); }}>
            Phòng
            <ChevronDown size={14} />
          </button>
          <div className="nav-dropdown-menu" role="menu">
            <button type="button" onClick={() => { onBranchSelect(null, { target: "rooms", scroll: false }); closeMobileMenu(); }}>
              Tất cả chi nhánh
            </button>
            {branches.map((branch) => (
              <button
                key={branch.id}
                className={String(branch.id) === String(selectedBranchId) ? "selected" : ""}
                type="button"
                onClick={() => { onBranchSelect(branch.id, { target: "rooms", scroll: false }); closeMobileMenu(); }}
              >
                <span>{branch.nav_name || branch.name}</span>
                {branch.address ? <small>{branch.address}</small> : null}
              </button>
            ))}
          </div>
        </div>
        <button className={publicPage === "branches" ? "nav-link-btn active" : "nav-link-btn"} type="button" onClick={() => { onShowBranches(); closeMobileMenu(); }}>
          Chi nhánh
        </button>
      </nav>
      <div className="header-actions">
        <button className="nav-search-btn" type="button" onClick={() => { onShowBooking(); closeMobileMenu(); }} aria-label="Tìm kiếm phòng">
          <Search size={18} />
        </button>
        {user ? (
          <button className="nav-auth-btn" type="button" onClick={() => { onLogout(); closeMobileMenu(); }}>
            <UserRound size={15} />
            {user.name || user.phone || "Tài khoản"}
            <LogOut size={14} />
          </button>
        ) : (
          <button className="nav-auth-btn" type="button" onClick={() => { onLoginClick(); closeMobileMenu(); }}>
            <UserRound size={15} />
            Đăng nhập
          </button>
        )}
        <button className="nav-cta" type="button" onClick={() => { onShowBooking(); closeMobileMenu(); }}>Đặt phòng ngay <ArrowRight size={16} /></button>
      </div>
    </header>
  );
}

export default Header;
