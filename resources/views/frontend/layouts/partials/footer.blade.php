
<div class="balloon-contact">
    <a
        href="tel:{{ checkValue($arrSetups, 'company_hotline') }}"
        class="balloon-icon bg-success"
        aria-label="Gọi {{ checkValue($arrSetups, 'company_hotline') }}">
        <i class="fa-solid fa-phone" aria-hidden="true"></i>
    </a>
    <a
        href="tel:{{ checkValue($arrSetups, 'company_hotline_2') }}"
        class="balloon-icon bg-success"
        aria-label="Gọi {{ checkValue($arrSetups, 'company_hotline_2') }}">
        <i class="fa-solid fa-phone" aria-hidden="true"></i>
    </a>

    {{-- <a href="#" class="balloon-icon bg-warning text-white">
        <i class="fa-solid fa-magnifying-glass"></i>
    </a> --}}

    <a
        href="{{ checkValue($arrSetups, 'link_zalo') }}"
        target="_blank"
        class="balloon-icon text-white"
        aria-label="Nhắn Zalo với công ty">
        <img src="{{ asset('assets/imgs/zalo-logo.png') }}" alt="Zalo" style="width: 100%;">
    </a>

    <a
        href="mailto:{{ checkValue($arrSetups, 'company_email') }}"
        class="balloon-icon bg-secondary text-white"
        aria-label="Gửi email đến {{ checkValue($arrSetups, 'company_email') }}">
        <i class="fa-solid fa-envelope" aria-hidden="true"></i>
    </a>
</div>

  <div id="footer" class="footer-section pt-5">
    <div class="container">
      <div class="row pb-4">
        <!-- Thông tin công ty -->
        <div class="col-md-4 footer-about mb-4">
          <div class="footer-main-title mb-4">Hoàng Giang
          </div>
          
          <div class="footer-description text-muted">
            {{ checkValue($arrSetups, 'company_introduce') }}
          </div>
          <div class="footer-map mt-3">
            {!! checkValue($arrSetups, 'company_map') !!}
          </div>
        </div>
  
        <!-- Menu -->
        <div class="col-md-4 footer-menu mb-4 ps-5">
          <div class="footer-title mb-4">Về chúng tôi</div>
          <div class="footer-links mt-3 d-flex flex-column gap-2">
            <a href="{{ route('page.slug', ['slug' => 'gioi-thieu']) }}" class="text-dark text-decoration-none">Giới thiệu</a>
            <a href="{{ route('page.slug', ['slug' => 'dich-vu']) }}" class="text-dark text-decoration-none">Dịch vụ chính</a>
            <a href="{{ route('page.slug', ['slug' => 'thu-vien-anh']) }}" class="text-dark text-decoration-none">Thư viện ảnh</a>
            <a href="{{ route('page.slug', ['slug' => 'lien-he']) }}" class="text-dark text-decoration-none">Liên hệ</a>
          </div>
        </div>
  
        <!-- Thông tin liên hệ -->
        <div class="col-md-4 footer-contact mb-4">
          <div class="footer-title mb-4">Thông tin liên hệ</div>
          <div class="footer-contact-list mt-3 d-flex flex-column gap-3 text-muted">
            <div><i class="fa-solid fa-envelope"></i>{{ checkValue($arrSetups, 'company_email') }}</div>
            <div><i class="fa-solid fa-location-dot"></i>{{ checkValue($arrSetups, 'company_address') }}</div>
            <div><i class="fa-solid fa-phone"></i>{{ formatPhone(checkValue($arrSetups, 'company_hotline')) }} - {{ formatPhone(checkValue($arrSetups, 'company_hotline_2')) }}</div>
          </div>
        </div>
      </div>
  
      <div class="footer-copyright">
        Copyright © 2024 Hoàng Giang Group
      </div>
    </div>
  </div>
  