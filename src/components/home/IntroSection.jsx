import { featureList } from "../../data/homeContent";

function IntroSection() {
  return (
    <section className="intro-section">
      <div className="intro-media">
        <img
          src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=85"
          alt="Phòng homestay cho couple"
        />
        <div className="intro-caption">
          <h2>Ý tưởng hẹn hò cho couple</h2>
          <p>Homestay tự check-in, không ngại lễ tân</p>
        </div>
      </div>

      <div className="intro-copy">
        <h2>Check-in linh hoạt - nghỉ ngơi thoải mái!</h2>
        <p>
          ftft - homestay tiện nghi tại Biên Hòa, Long Thành,
          Thủ Dầu Một, Dĩ An.
        </p>
        <ul>
          {featureList.map((feature) => (
            <li key={feature}>{feature}</li>
          ))}
        </ul>
        <div className="intro-stats">
          <div><strong>70+</strong><span>Phòng nghỉ</span></div>
          <div><strong>1000+</strong><span>Lượt đặt phòng</span></div>
          <div><strong>2000+</strong><span>Khách hàng hài lòng</span></div>
        </div>
      </div>
    </section>
  );
}

export default IntroSection;
