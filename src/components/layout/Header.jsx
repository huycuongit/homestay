import { Hotel, LogOut, UserRound } from "lucide-react";

function Header({ branches, selectedBranchId, user, onBranchSelect, onLoginClick, onLogout }) {
  return (
    <header className="topbar">
      <button className="brand brand-button" type="button" onClick={() => onBranchSelect(null)} aria-label="ftft Booking">
        <span className="brand-mark"><Hotel size={18} /></span>
        <span>ftft</span>
      </button>
      <nav className="nav-links" aria-label="Main navigation">
        <button className={!selectedBranchId ? "nav-link-btn active" : "nav-link-btn"} type="button" onClick={() => onBranchSelect(null)}>
          Trang chu
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
        <a href="#contact">Lien he</a>
        {user ? (
          <button className="nav-auth-btn" type="button" onClick={onLogout}>
            <UserRound size={15} />
            {user.name || user.phone || "Tai khoan"}
            <LogOut size={14} />
          </button>
        ) : (
          <button className="nav-auth-btn" type="button" onClick={onLoginClick}>
            <UserRound size={15} />
            Dang nhap
          </button>
        )}
        <a className="nav-cta" href="#booking">Dat phong ngay!</a>
      </nav>
    </header>
  );
}

export default Header;
