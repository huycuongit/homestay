function BrandLogo({ className = "", showText = false, label = "ftft" }) {
  const brandName = String(label || "ftft")
    .replace(/FEBooking/gi, "ftft")
    .replace(/FEBoking/gi, "ftft")
    .replace(/\bFEB\b/g, "ftft");

  return (
    <span className={`brand-logo ${className}`.trim()}>
      <span className="brand-logo-mark" aria-hidden="true">ft</span>
      <strong>{showText ? brandName : brandName}</strong>
    </span>
  );
}

export default BrandLogo;
