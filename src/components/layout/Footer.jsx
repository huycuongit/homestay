import { useState } from "react";
import BrandLogo from "./BrandLogo";
import { ArrowRight, Instagram, Music2, Youtube } from "lucide-react";

function Footer({ branches = [], settings = {} }) {
  const visibleBranches = branches.slice(0, 5);
  const siteName = settings.site_name || "FEBoking";
  const footerIntro = settings.footer_intro || "Nền tảng đặt phòng homestay cho những khoảnh khắc đặc biệt.";
  const [email, setEmail] = useState("");
  const [subscribed, setSubscribed] = useState(false);

  function subscribe(event) {
    event.preventDefault();
    if (!email.trim()) return;
    setSubscribed(true);
    setEmail("");
  }

  return (
    <footer className="footer">
      <div className="footer-inner">
        <div className="footer-main">
          <div className="footer-brand">
            <BrandLogo className="footer-logo" label={siteName} />
            <p>{footerIntro}</p>
            <div className="footer-socials" aria-label="Mạng xã hội">
              <a href="#top" aria-label="Instagram"><Instagram size={15} /></a>
              <a href="#top" aria-label="TikTok"><Music2 size={15} /></a>
              <a href="#top" aria-label="YouTube"><Youtube size={16} /></a>
            </div>
          </div>

          <div className="footer-column">
            <h3 className="footer-title">Chi nhánh</h3>
            {visibleBranches.map((branch) => (
              <a className="footer-link" href="#branches" key={branch.id}>{branch.nav_name || branch.name}</a>
            ))}
          </div>

          <div className="footer-column">
            <h3 className="footer-title">Chính sách</h3>
            <a className="footer-link" href="#top">Chính sách đặt phòng</a>
            <a className="footer-link" href="#top">Chính sách hủy phòng</a>
            <a className="footer-link" href="#top">Điều khoản sử dụng</a>
            <a className="footer-link" href="#top">Chính sách bảo mật</a>
          </div>

          <div className="footer-column footer-map">
            <h3 className="footer-title">Map</h3>
            <div className="footer-map-box">
              <span>{siteName}</span>
              <small>{visibleBranches.length ? `${visibleBranches.length} chi nhánh đang hoạt động tại Đồng Nai và Bình Dương` : "Hệ thống chi nhánh FEBoking"}</small>
            </div>
            <a className="footer-link" href="#branches">Xem hệ thống chi nhánh</a>
          </div>

          <div className="footer-newsletter">
            <h3 className="footer-title">Nhận ưu đãi mới nhất</h3>
            <form onSubmit={subscribe}>
              <input
                className="footer-input"
                type="email"
                value={email}
                onChange={(event) => setEmail(event.target.value)}
                placeholder="Email của bạn"
                aria-label="Email nhận ưu đãi"
                required
              />
              <button type="submit" aria-label="Đăng ký nhận ưu đãi"><ArrowRight size={16} /></button>
            </form>
            <p>{subscribed ? "Đã đăng ký. Hẹn gặp bạn ở ưu đãi gần nhất." : "Chỉ gửi những ưu đãi thật sự đáng để bạn xem."}</p>
          </div>
        </div>

        <div className="footer-bottom">
          <span>© 2026 {siteName}. {settings.copyright || "A product by FEB. All rights reserved."}</span>
          <div>
            <a href="#top">Chính sách bảo mật</a>
            <a href="#top">Điều khoản sử dụng</a>
          </div>
        </div>
      </div>
    </footer>
  );
}

export default Footer;
