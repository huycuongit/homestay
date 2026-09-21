function BrandLogo({ className = "", label = "FEBoking" }) {
  return (
    <span className={`brand-logo ${className}`.trim()}>
      <img src="/assets/imgs/feboking-logo.png" alt={label || "FEBoking"} />
    </span>
  );
}

export default BrandLogo;
