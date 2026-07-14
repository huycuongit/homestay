import { Hotel, LogOut, UserRound } from "lucide-react";

function Header({ user, onLoginClick, onLogout }) {
  return (
    <header className="topbar">
      <a className="brand" href="#top" aria-label="Homestay Booking">
        <span className="brand-mark"><Hotel size={18} /></span>
        <span>BurgerBliss</span>
      </a>
      <nav className="nav-links" aria-label="Main navigation">
        <a href="#top">Trang chu</a>
        <a href="#rooms">Bien Hoa</a>
        <a href="#rooms">Long Thanh</a>
        <a href="#rooms">Thu Dau Mot</a>
        <a href="#rooms">Di An</a>
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
