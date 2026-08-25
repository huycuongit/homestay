const LOGO_SRC = "/assets/imgs/logo.png";

function BrandLogo({ className = "", showText = true, label = "ftft" }) {
  return (
    <span className={`brand-logo ${className}`.trim()}>
      <img src={LOGO_SRC} alt={label} />
      {showText && <strong>{label}</strong>}
    </span>
  );
}

export default BrandLogo;
