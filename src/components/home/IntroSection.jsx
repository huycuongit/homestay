import { featureList } from "../../data/homeContent";

function IntroSection() {
  return (
    <section className="intro-section">
      <div className="intro-media">
        <img
          src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=85"
          alt="Phong homestay cho couple"
        />
        <div className="intro-caption">
          <h2>Y tuong Hen Ho Cho Couple</h2>
          <p>homestay tu check-in, khong ngai le tan</p>
        </div>
      </div>

      <div className="intro-copy">
        <h2>Check-in linh hoat - nghi ngoi thoai mai !</h2>
        <p>
          ftft - homestay tien nghi tai Bien Hoa, Long Thanh,
          Thu Dau Mot, Di An.
        </p>
        <ul>
          {featureList.map((feature) => (
            <li key={feature}>{feature}</li>
          ))}
        </ul>
        <div className="intro-stats">
          <div><strong>70+</strong><span>Phong nghi</span></div>
          <div><strong>1000+</strong><span>Luot dat phong</span></div>
          <div><strong>2000+</strong><span>Khach hang hai long</span></div>
        </div>
      </div>
    </section>
  );
}

export default IntroSection;
