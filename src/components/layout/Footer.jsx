import BrandLogo from "./BrandLogo";

function Footer({ branches = [], settings = {} }) {
  const visibleBranches = branches.slice(0, 5);
  const siteName = settings.site_name || "ftft";
  const footerIntro = settings.footer_intro || "Nền tảng đặt phòng homestay cho những khoảnh khắc đặc biệt.";

  return (
    <footer className="footer">
      <div className="footer-inner">
        <div className="footer-main">
          <div className="footer-brand">
            <BrandLogo className="footer-logo" label={siteName} />
            <p>{footerIntro}</p>
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
              <small>{visibleBranches.map((branch) => branch.nav_name || branch.name).join(" · ")}</small>
            </div>
            <a className="footer-link" href="#branches">Xem hệ thống chi nhánh</a>
          </div>
        </div>

        <div className="footer-bottom">
          <span>© 2026 {siteName}. {settings.copyright || "All rights reserved."}</span>
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
