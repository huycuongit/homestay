import { ArrowLeft, ArrowRight, CalendarDays, Clock3, Eye, Lightbulb, Share2 } from "lucide-react";
import { assetUrl } from "../../utils/format";

function plainText(value) {
  return String(value || "").replace(/<[^>]*>/g, "").replace(/\s+/g, " ").trim();
}

function formatDate(value) {
  const date = new Date(value);
  return Number.isNaN(date.getTime()) ? "Mới cập nhật" : new Intl.DateTimeFormat("vi-VN", { day: "2-digit", month: "2-digit", year: "numeric" }).format(date);
}

function articleImage(article) {
  return assetUrl(article?.avatar || article?.image_path || article?.url);
}

function bodyParagraphs(article) {
  const content = plainText(article?.content);
  const description = plainText(article?.description);
  return [description, content].filter((item, index, array) => item && array.indexOf(item) === index);
}

function NewsDetailPage({ detail, loading, fallbackNews = [], settings = {}, onBack, onOpenArticle }) {
  if (loading) return <section className="news-detail-loading">Đang tải bài viết...</section>;

  const article = detail?.article;
  if (!article) {
    return (
      <section className="news-detail-loading">
        <p>{detail?.error || "Không tìm thấy bài viết."}</p>
        <button type="button" onClick={onBack}>Quay về Tin tức</button>
      </section>
    );
  }

  const related = detail.related?.length ? detail.related : fallbackNews.filter((item) => item.id !== article.id).slice(0, 4);
  const popular = related.slice(0, 5);
  const paragraphs = bodyParagraphs(article);
  const siteName = settings.site_name || "FEBoking";

  return (
    <section className="news-detail-page">
      <header className="news-detail-hero">
        <img src={articleImage(article)} alt="" />
        <div className="news-detail-hero-overlay" />
        <div className="news-detail-hero-content">
          <button type="button" className="news-detail-back" onClick={onBack}><ArrowLeft size={16} /> Tin tức</button>
          <p className="section-kicker">TIN TỨC FEBOKING</p>
          <h1>{article.name}</h1>
          <p>{plainText(article.description) || "Những gợi ý dành cho một buổi hẹn thật khác."}</p>
          <div className="news-detail-meta">
            <span><CalendarDays size={15} /> {formatDate(article.publish_time || article.created_at)}</span>
            <span><Clock3 size={15} /> 3 phút đọc</span>
            <span><Eye size={15} /> {Number(article.views || 0) + 1} lượt xem</span>
            <span><Share2 size={15} /> Chia sẻ</span>
          </div>
        </div>
      </header>

      <div className="news-detail-content">
        <article className="news-article-body">
          <p className="news-lead">{paragraphs[0] || "Một khoảng thời gian riêng tư là cách đơn giản để hai người có thêm kỷ niệm cùng nhau."}</p>
          <img src={articleImage(article)} alt={article.name} onError={(event) => { event.currentTarget.src = "/assets/imgs/feboking-home.png"; }} />
          <h2>Khoảnh khắc dành cho hai người</h2>
          {(paragraphs.slice(1).length ? paragraphs.slice(1) : [
            "Một không gian vừa đủ riêng giúp cuộc hẹn trở nên thoải mái hơn. Bạn có thể chọn khung giờ phù hợp, mang theo món ăn yêu thích và để mọi thứ diễn ra thật tự nhiên.",
            "Điều quan trọng không phải là một kế hoạch hoàn hảo, mà là thời gian bạn thật sự dành cho nhau."
          ]).map((paragraph, index) => <p key={index}>{paragraph}</p>)}
          <div className="news-note"><Lightbulb size={22} /><p>Chỉ cần chọn một căn phòng hợp mood và khung giờ phù hợp, {siteName} sẽ giúp bạn có thêm thời gian cho những điều quan trọng.</p></div>
        </article>

        <aside className="news-detail-sidebar">
          <section className="news-detail-popular">
            <h2>Bài viết nổi bật</h2>
            {popular.map((item) => (
              <button type="button" key={item.id || item.slug} onClick={() => onOpenArticle(item)}>
                <img src={articleImage(item)} alt={item.name} onError={(event) => { event.currentTarget.src = "/assets/imgs/feboking-home.png"; }} />
                <span><strong>{item.name}</strong><small>{formatDate(item.publish_time || item.created_at)}</small></span>
              </button>
            ))}
          </section>
          <section className="news-detail-cta">
            <img src="/assets/imgs/feboking-cta.png" alt="" />
            <div><h2>Sẵn sàng cho buổi hẹn tiếp theo?</h2><p>Khám phá căn phòng phù hợp với không gian riêng tư cho hai người.</p><button type="button" onClick={onBack}>Xem bài viết khác <ArrowRight size={15} /></button></div>
          </section>
        </aside>
      </div>

      {related.length > 0 && (
        <section className="news-related">
          <div><h2>Bài viết liên quan</h2><button type="button" onClick={onBack}>Xem tất cả <ArrowRight size={15} /></button></div>
          <div className="news-related-grid">
            {related.slice(0, 4).map((item) => (
              <article className="news-clickable" key={item.id || item.slug} onClick={() => onOpenArticle(item)}>
                <img src={articleImage(item)} alt={item.name} onError={(event) => { event.currentTarget.src = "/assets/imgs/feboking-home.png"; }} />
                <div><small>{formatDate(item.publish_time || item.created_at)}</small><h3>{item.name}</h3></div>
              </article>
            ))}
          </div>
        </section>
      )}
    </section>
  );
}

export default NewsDetailPage;
