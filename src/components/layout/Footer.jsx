function Footer() {
  return (
    <footer className="footer">
      <div className="footer-inner">
        <div className="footer-main">
          <div className="footer-brand">
            <h2>Logo</h2>
            <p>Our vision is to provide convenience and help increase your sales business.</p>
            <div className="footer-socials" aria-label="Mang xa hoi">
              <a href="#top" aria-label="Facebook">f</a>
              <a href="#top" aria-label="Twitter">t</a>
              <a href="#top" aria-label="Instagram">o</a>
            </div>
          </div>

          <div className="footer-column">
            <h3>Lien he</h3>
            <a href="#top">How it works</a>
            <a href="#rooms">Featured</a>
            <a href="#booking">Partnership</a>
            <a href="#contact">Bussiness Relation</a>
          </div>

          <div className="footer-column">
            <h3>Chi nhanh</h3>
            <a href="#rooms">Bien Hoa</a>
            <a href="#rooms">Long Thanh</a>
            <a href="#rooms">Thu Dau Mot</a>
            <a href="#rooms">Di An</a>
          </div>

          <div className="footer-column policy-column">
            <h3>Chinh sach</h3>
            <a href="#top">Chinh sach dat hang</a>
            <a href="#top">Chinh sach Hoan/Huy phong</a>
            <a href="#top">Chinh sach bao mat thong tin</a>
            <a href="#top">Chinh sach thanh toan</a>
            <a href="#top">Dieu khoan va dieu kien giao dich chung</a>
          </div>
        </div>

        <div className="footer-bottom">
          <span>©2022 Company Name. All rights reserved</span>
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
