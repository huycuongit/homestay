import { useMemo, useState } from "react";
import { ArrowLeft, ArrowRight, CalendarDays, Search } from "lucide-react";
import { assetUrl } from "../../utils/format";

const PAGE_SIZE = 6;

function formatDate(value) {
  if (!value) return "Mới cập nhật";
  const date = new Date(value);
  if (Number.isNaN(date.getTime())) return "Mới cập nhật";
  return new Intl.DateTimeFormat("vi-VN", { day: "2-digit", month: "2-digit", year: "numeric" }).format(date);
}

function plainText(value) {
  return String(value || "").replace(/<[^>]*>/g, "").replace(/\s+/g, " ").trim();
}

function articleImage(article) {
  return assetUrl(article.avatar || article.image_path || article.url);
}

function NewsPage({ news = [], settings = {}, onOpenArticle }) {
  const [query, setQuery] = useState("");
  const [page, setPage] = useState(1);
  const [email, setEmail] = useState("");
  const [subscribed, setSubscribed] = useState(false);
  const siteName = settings.site_name || "FEBoking";
  const sortedNews = useMemo(() => [...news].sort((a, b) => new Date(b.publish_time || b.created_at || 0) - new Date(a.publish_time || a.created_at || 0)), [news]);
  const filteredNews = useMemo(() => {
    const keyword = query.trim().toLocaleLowerCase("vi-VN");
    if (!keyword) return sortedNews;
    return sortedNews.filter((article) => [article.name, article.description, article.content].some((value) => plainText(value).toLocaleLowerCase("vi-VN").includes(keyword)));
  }, [query, sortedNews]);
  const featured = filteredNews[0];
  const gridArticles = query ? filteredNews : filteredNews.slice(1);
  const totalPages = Math.max(1, Math.ceil(gridArticles.length / PAGE_SIZE));
  const currentPage = Math.min(page, totalPages);
  const list = gridArticles.slice((currentPage - 1) * PAGE_SIZE, currentPage * PAGE_SIZE);

  function changeQuery(value) {
    setQuery(value);
    setPage(1);
  }

  function subscribe(event) {
    event.preventDefault();
    if (!email.trim()) return;
    setSubscribed(true);
    setEmail("");
  }

  return (
    <section className="news-page">
      <div className="news-hero">
        <img src={featured ? articleImage(featured) : "/assets/imgs/feboking-home.png"} alt="" />
        <div className="news-hero-overlay" />
        <div className="news-hero-content">
          <p className="section-kicker">TIN TỨC & CẨM NANG</p>
          <h1>Những câu chuyện làm nên <em>trải nghiệm đặc biệt</em></h1>
          <p>Gợi ý không gian, trải nghiệm và những điều thú vị cho những buổi hẹn ý nghĩa hơn cùng {siteName}.</p>
        </div>
      </div>

      <div className="news-content">
        <div className="news-list-heading">
          <div>
            <p className="section-kicker">BÀI VIẾT MỚI</p>
            <h2>Khám phá cùng {siteName}</h2>
          </div>
          <label className="news-search">
            <Search size={18} />
            <input value={query} onChange={(event) => changeQuery(event.target.value)} placeholder="Tìm kiếm bài viết..." />
          </label>
        </div>

        <div className="news-layout">
          <div>
            {featured && !query && (
              <article className="news-featured-card news-clickable" onClick={() => onOpenArticle(featured)}>
                <img src={articleImage(featured)} alt={featured.name} onError={(event) => { event.currentTarget.src = "/assets/imgs/feboking-home.png"; }} />
                <div>
                  <span>BÀI VIẾT MỚI NHẤT</span>
                  <h2>{featured.name}</h2>
                  <p>{plainText(featured.description || featured.content) || "Khám phá những gợi ý dành cho một buổi hẹn thật khác."}</p>
                  <small><CalendarDays size={15} /> {formatDate(featured.publish_time || featured.created_at)}</small>
                </div>
              </article>
            )}

            {list.length ? (
              <div className="news-grid">
                {list.map((article) => (
                  <article className="news-card news-clickable" key={article.id || article.slug || article.name} onClick={() => onOpenArticle(article)}>
                    <img src={articleImage(article)} alt={article.name} onError={(event) => { event.currentTarget.src = "/assets/imgs/feboking-home.png"; }} />
                    <div>
                      <small><CalendarDays size={14} /> {formatDate(article.publish_time || article.created_at)}</small>
                      <h3>{article.name}</h3>
                      <p>{plainText(article.description || article.content) || "Cập nhật mới nhất từ FEBoking."}</p>
                    </div>
                  </article>
                ))}
              </div>
            ) : (
              <div className="news-empty">Chưa tìm thấy bài viết phù hợp.</div>
            )}
          </div>

          {!query && sortedNews.length > 1 && (
            <aside className="news-sidebar">
              <h2>Bài viết nổi bật</h2>
              {sortedNews.slice(1, 6).map((article) => (
                <article className="news-clickable" key={article.id || article.slug} onClick={() => onOpenArticle(article)}>
                  <img src={articleImage(article)} alt={article.name} onError={(event) => { event.currentTarget.src = "/assets/imgs/feboking-home.png"; }} />
                  <div>
                    <h3>{article.name}</h3>
                    <small>{formatDate(article.publish_time || article.created_at)}</small>
                  </div>
                </article>
              ))}
            </aside>
          )}
        </div>

        {filteredNews.length > PAGE_SIZE && (
          <nav className="news-pagination" aria-label="Phân trang tin tức">
            <button type="button" disabled={currentPage === 1} onClick={() => setPage(currentPage - 1)} aria-label="Trang trước"><ArrowLeft size={17} /></button>
            {Array.from({ length: totalPages }, (_, index) => index + 1).map((item) => (
              <button type="button" className={item === currentPage ? "active" : ""} onClick={() => setPage(item)} key={item}>{item}</button>
            ))}
            <button type="button" disabled={currentPage === totalPages} onClick={() => setPage(currentPage + 1)} aria-label="Trang sau"><ArrowRight size={17} /></button>
          </nav>
        )}

        <section className="news-subscribe">
          <img src="/assets/imgs/feboking-footer-cta.png" alt="" />
          <div>
            <h2>Đừng bỏ lỡ những bài viết mới nhất</h2>
            <p>Nhận gợi ý hẹn hò và những trải nghiệm đặc biệt từ {siteName}.</p>
          </div>
          <form onSubmit={subscribe}>
            <input type="email" value={email} onChange={(event) => setEmail(event.target.value)} placeholder="Email của bạn" required />
            <button type="submit">{subscribed ? "Đã đăng ký" : "Đăng ký"} <ArrowRight size={16} /></button>
          </form>
        </section>
      </div>
    </section>
  );
}

export default NewsPage;
