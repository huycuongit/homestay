import { LogOut, UserRound } from "lucide-react";
import BrandLogo from "./BrandLogo";

function Header({ branches, selectedBranchId, user, onBranchSelect, onLoginClick, onLogout }) {
  return (
    <header className="topbar">
      <button className="brand brand-button" type="button" onClick={() => onBranchSelect(null)} aria-label="ftft Booking">
        <BrandLogo className="site-brand-logo" />
      </button>
      <nav className="nav-links" aria-label="Điều hướng chính">
        <button className={!selectedBranchId ? "nav-link-btn active" : "nav-link-btn"} type="button" onClick={() => onBranchSelect(null)}>
          Trang chủ
        </button>
        {branches.map((branch) => (
          <button
            className={String(selectedBranchId || "") === String(branch.id) ? "nav-link-btn active" : "nav-link-btn"}
            type="button"
            key={branch.id}
            onClick={() => onBranchSelect(branch.id)}
          >
            {branch.nav_name || branch.name}
          </button>
        ))}
        <a href="#contact">Liên hệ</a>
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
        <a className="nav-cta" href="#booking">Đặt phòng ngay!</a>
      </nav>
    </header>
  );
}

export default Header;
