import { CalendarCheck, Loader2, X } from "lucide-react";

function BookingModal({
  room,
  search,
  form,
  totalPreview,
  submitting,
  onClose,
  onSubmit,
  onChangeForm,
  money
}) {
  if (!room) return null;

  return (
    <div className="modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="booking-modal-title">
      <form className="booking-modal" onSubmit={onSubmit}>
        <div className="modal-head">
          <div>
            <p className="eyebrow">Thông tin khách</p>
            <h2 id="booking-modal-title">Đặt {room.name}</h2>
          </div>
          <button className="icon-btn" type="button" onClick={onClose} aria-label="Đóng form booking">
            <X size={20} />
          </button>
        </div>

        <div className="booking-summary">
          <span>{search.booking_type === "hour" ? "Theo giờ" : "Theo đêm"}</span>
          <strong>Tạm tính từ {money(totalPreview)}</strong>
        </div>

        <div className="form-grid">
          <label>
            Họ tên
            <input
              value={form.customer_name}
              onChange={(event) => onChangeForm((current) => ({ ...current, customer_name: event.target.value }))}
              required
            />
          </label>
          <label>
            Số điện thoại
            <input
              value={form.customer_phone}
              onChange={(event) => onChangeForm((current) => ({ ...current, customer_phone: event.target.value }))}
              required
            />
          </label>
          <label>
            Email
            <input
              type="email"
              value={form.customer_email}
              onChange={(event) => onChangeForm((current) => ({ ...current, customer_email: event.target.value }))}
            />
          </label>
          <label>
            Ghi chú
            <input
              value={form.note}
              onChange={(event) => onChangeForm((current) => ({ ...current, note: event.target.value }))}
              placeholder="Đến sớm, cần hỗ trợ..."
            />
          </label>
        </div>

        <button className="primary-btn full" type="submit" disabled={submitting}>
          {submitting ? <Loader2 className="spin" size={18} /> : <CalendarCheck size={18} />}
          Gửi booking
        </button>
      </form>
    </div>
  );
}

export default BookingModal;
