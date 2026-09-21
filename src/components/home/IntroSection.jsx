import { ArrowRight, Clapperboard, KeyRound, Map, Moon, Sofa } from "lucide-react";
import { branchHighlights, experienceMoods, experienceSteps } from "../../data/homeContent";
import { assetUrl } from "../../utils/format";

const stepIcons = {
  key: KeyRound,
  sofa: Sofa,
  movie: Clapperboard,
  moon: Moon
};

function IntroSection({ branches = [], onShowRooms, onShowBooking, onBranchSelect, onShowBranches, settings = {}, images = [], pages = [] }) {
  const siteName = settings.site_name || "FEBoking";
  const imagePool = images.length ? images.map((image) => assetUrl(image.url)) : [];
  const pageMoods = pages.filter((page) => String(page.key || page.slug || "").startsWith("mood_"));
  const moodItems = pageMoods.length
    ? pageMoods.slice(0, 5).map((page, index) => ({
        title: page.name,
        text: page.description || page.content?.replace(/<[^>]+>/g, "").slice(0, 70) || "",
        image: page.avatar ? assetUrl(page.avatar) : imagePool[index % imagePool.length]
      }))
    : experienceMoods.map((mood, index) => ({ ...mood, image: imagePool[index % imagePool.length] || mood.image }));
  const visibleBranches = branches.length
    ? branches.slice(0, 3).map((branch, index) => ({
        id: branch.id,
        name: branch.nav_name || branch.name,
        text: branch.address || `${branch.rooms_count || 0}+ phòng`,
        image: imagePool[index % imagePool.length] || branchHighlights[index % branchHighlights.length]?.image
      }))
    : branchHighlights;
  const stepItems = experienceSteps.map((step, index) => ({
    ...step,
    image: imagePool[(index + 2) % imagePool.length] || step.image
  }));

  return (
    <>
      <section className="mood-section" id="experience">
        <div className="section-heading mood-heading">
          <div>
            <p className="section-kicker">Chọn theo mood</p>
            <h2>{settings.mood_title || "Mỗi buổi hẹn, một cảm xúc"}</h2>
            <p>{settings.mood_subtitle || "Dễ dàng tìm không gian phù hợp với plan của bạn."}</p>
          </div>
        </div>
        <div className="mood-grid">
          {moodItems.map((mood) => (
            <article className="mood-card" key={mood.title}>
              <img src={mood.image || "/assets/imgs/feboking-home.png"} alt={mood.title} onError={(event) => { event.currentTarget.src = "/assets/imgs/feboking-home.png"; }} />
              <button type="button" onClick={onShowRooms} aria-label={`Xem ${mood.title}`}><ArrowRight size={16} /></button>
              <div>
                <h3>{mood.title}</h3>
                <p>{mood.text}</p>
              </div>
            </article>
          ))}
        </div>
      </section>

      <section className="journey-section">
        <div className="section-heading journey-heading">
          <div>
            <p className="section-kicker">Trải nghiệm cùng {siteName}</p>
            <h2>{settings.experience_title || "Một buổi hẹn, chẳng cần lên kế hoạch quá nhiều."}</h2>
            <p>{settings.experience_subtitle || `Chỉ cần chọn thời gian và không gian yêu thích, mọi thứ còn lại để ${siteName} lo.`}</p>
          </div>
          <span className="handwriting">Small moments<br />Big feelings ♡</span>
        </div>
        <div className="journey-timeline">
          {stepItems.map((step) => {
            const Icon = stepIcons[step.icon] || KeyRound;
            return (
              <article className="journey-card" key={step.time}>
                <time>{step.time}</time>
                <img src={step.image || "/assets/imgs/feboking-home.png"} alt={step.title} onError={(event) => { event.currentTarget.src = "/assets/imgs/feboking-home.png"; }} />
                <div className="journey-icon"><Icon size={20} /></div>
                <div>
                  <h3>{step.title}</h3>
                  <p>{step.text}</p>
                </div>
              </article>
            );
          })}
        </div>
      </section>

      <section className="branch-highlight-section" id="branches">
        <div className="section-heading branch-highlight-heading">
          <div>
            <p className="section-kicker">Hệ thống chi nhánh</p>
            <h2>{settings.branches_title || "Luôn có một điểm đến gần bạn"}</h2>
          </div>
          <button className="link-action" type="button" onClick={onShowBranches}>Xem bản đồ <ArrowRight size={16} /></button>
        </div>
        <div className="branch-highlight-grid">
          {visibleBranches.map((branch) => (
            <article className="branch-highlight-card" key={branch.name}>
              <img src={branch.image || "/assets/imgs/feboking-home.png"} alt={branch.name} onError={(event) => { event.currentTarget.src = "/assets/imgs/feboking-home.png"; }} />
              <div>
                <h3>{branch.name}</h3>
                <p>{branch.text}</p>
              </div>
              <button type="button" onClick={() => branch.id ? onBranchSelect(branch.id) : onShowRooms()} aria-label={`Xem phòng tại ${branch.name}`}>
                <Map size={18} />
              </button>
            </article>
          ))}
        </div>
      </section>

      <section className="home-cta" id="offers">
        <div>
          <h2>{settings.cta_title || "Không cần đi xa để có một buổi hẹn thật khác."}</h2>
          <p>{settings.cta_subtitle || "Chỉ cần một không gian đẹp, một bộ phim hay và vài giờ không cần vội."}</p>
          <button className="primary-btn" type="button" onClick={onShowBooking}>Đặt phòng ngay <ArrowRight size={16} /></button>
        </div>
        <span className="handwriting">A little escape<br />just the two of us ♡</span>
      </section>
    </>
  );
}

export default IntroSection;
