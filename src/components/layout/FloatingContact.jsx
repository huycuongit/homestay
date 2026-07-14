import { ArrowUp, MessageCircle, Phone } from "lucide-react";

function FloatingContact() {
  return (
    <div className="floating-contact" id="contact" aria-label="Lien he nhanh">
      <a href="tel:0900000000" aria-label="Goi dien"><Phone size={19} /></a>
      <a href="#booking" aria-label="Nhan tin"><MessageCircle size={19} /></a>
      <a href="#booking" aria-label="Zalo">Zalo</a>
      <a href="#top" aria-label="Len dau trang"><ArrowUp size={20} /></a>
    </div>
  );
}

export default FloatingContact;
