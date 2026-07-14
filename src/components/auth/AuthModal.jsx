import { Loader2, UserRound, X } from "lucide-react";

function AuthModal({
  mode,
  form,
  loading,
  notice,
  onClose,
  onSubmit,
  onChange,
  onSwitchMode
}) {
  return (
    <div className="modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="auth-modal-title">
      <form className="auth-modal" onSubmit={onSubmit}>
        <div className="modal-head">
          <div>
            <p className="eyebrow">Tai khoan khach</p>
            <h2 id="auth-modal-title">{mode === "login" ? "Dang nhap" : "Dang ky"}</h2>
          </div>
          <button className="icon-btn" type="button" onClick={onClose} aria-label="Dong form dang nhap">
            <X size={20} />
          </button>
        </div>

        {notice && <div className={`notice ${notice.type}`}>{notice.text}</div>}

        <div className="auth-grid">
          {mode === "register" && (
            <label>
              Ho ten
              <input value={form.name} onChange={(event) => onChange("name", event.target.value)} required />
            </label>
          )}
          <label>
            So dien thoai
            <input value={form.phone} onChange={(event) => onChange("phone", event.target.value)} required />
          </label>
          {mode === "register" && (
            <label>
              Email
              <input type="email" value={form.email} onChange={(event) => onChange("email", event.target.value)} />
            </label>
          )}
          <label>
            Mat khau
            <input type="password" value={form.password} onChange={(event) => onChange("password", event.target.value)} required />
          </label>
        </div>

        <button className="primary-btn full auth-submit-btn" type="submit" disabled={loading}>
          {loading ? <Loader2 className="spin" size={18} /> : <UserRound size={18} />}
          {mode === "login" ? "Dang nhap" : "Tao tai khoan"}
        </button>

        <button className="auth-switch-btn" type="button" onClick={onSwitchMode}>
          {mode === "login" ? "Chua co tai khoan? Dang ky" : "Da co tai khoan? Dang nhap"}
        </button>
      </form>
    </div>
  );
}

export default AuthModal;
