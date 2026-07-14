import { Hotel } from "lucide-react";

function Header() {
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
        <a className="nav-cta" href="#booking">Dat phong ngay!</a>
      </nav>
    </header>
  );
}

export default Header;
