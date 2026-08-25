import BrandLogo from "./BrandLogo";

function Footer() {
  return (
    <footer className="footer">
      <div className="footer-inner">
        <div className="footer-main">
          <div className="footer-brand">
            <BrandLogo className="footer-logo" />
            <p>Tụi mình tạo ra trải nghiệm đặt phòng tiện, nhanh và dễ dùng hơn.</p>
            <div className="footer-socials" aria-label="Mạng xã hội">
              <a href="#top" aria-label="Facebook">f</a>
              <a href="#top" aria-label="Twitter">t</a>
              <a href="#top" aria-label="Instagram">o</a>
            </div>
          </div>

          <div className="footer-column">
            <h3>Liên hệ</h3>
            <a href="#top">Cách hoạt động</a>
            <a href="#rooms">Phòng nổi bật</a>
            <a href="#booking">Hợp tác</a>
            <a href="#contact">Kết nối kinh doanh</a>
          </div>

          <div className="footer-column">
            <h3>Chi nhánh</h3>
            <a href="#rooms">Biên Hòa</a>
            <a href="#rooms">Long Thành</a>
            <a href="#rooms">Thủ Dầu Một</a>
            <a href="#rooms">Dĩ An</a>
          </div>

          <div className="footer-column policy-column">
            <h3>Chính sách</h3>
            <a href="#top">Chính sách đặt phòng</a>
            <a href="#top">Chính sách hoàn/hủy phòng</a>
            <a href="#top">Chính sách bảo mật thông tin</a>
            <a href="#top">Chính sách thanh toán</a>
            <a href="#top">Điều khoản và điều kiện giao dịch chung</a>
          </div>
        </div>

        <div className="footer-bottom">
          <span>©2022 ftft. All rights reserved</span>
          <div>
            <a href="#top">Privacy & Policy</a>
            <a href="#top">Terms & Condition</a>
          </div>
        </div>
      </div>
    </footer>
  );
}

export default Footer;
