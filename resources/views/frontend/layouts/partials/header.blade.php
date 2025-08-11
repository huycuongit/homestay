<header>
    <input type="hidden" name="_token" value="jSobEperoKH5tjR2QOkaqJ48tBwBpLskWVeYG3EN" />

    <!-- Google Tag Manager (noscript) -->
    {!! isset($arrSetups) && isset($arrSetups['google_tag_manager']) ? $arrSetups['google_tag_manager'] : '' !!}
    <!-- End Google Tag Manager (noscript) -->

    <input type="hidden" name="_token" value="jSobEperoKH5tjR2QOkaqJ48tBwBpLskWVeYG3EN" />
    <!-- Top Info Bar -->
    <div class="sub-header text-white py-2">
        <div class="container d-flex justify-content-between align-items-center small flex-wrap h-100">
        <div class="scrolling-text-wrapper">
            <div class="scrolling-text">
                CHÀO MỪNG BẠN ĐẾN VỚI {{ checkValue($arrSetups, 'company_name') }}
            </div>
        </div>
    
            <div class="d-flex align-items-center gap-3">
                <div>
                    <i class="fa-solid fa-phone"></i>
                    {{ formatPhone(checkValue($arrSetups, 'company_hotline')) }} - {{ formatPhone(checkValue($arrSetups, 'company_hotline_2')) }}
                </div>
                <div class="border-start ps-3 d-none d-md-block">
                    <i class="fa-solid fa-envelope"></i>
                    <a href="mailto:{{ checkValue($arrSetups, 'company_email') }}" class="text-white text-decoration-none">
                        {{ checkValue($arrSetups, 'company_email') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
        <nav class="navbar navbar-expand-lg">
          <div class="container header-container">
            <a class="logo-block navbar-brand" href="{{ route('page.index') }}">
                <img class="logo" src="{{ Storage::url(checkValue($arrSetups, 'logo_app')) }}" alt="header-logo" />
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarNav" style="">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('page.index') }}"
                            class="nav-link nav-item-custom {{ request()->routeIs('page.index') ? 'active' : '' }}">
                            Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('page.slug', ['slug' => 'gioi-thieu']) }}"
                            class="nav-link nav-item-custom {{ request()->routeIs('page.slug') && request()->route()->slug == 'gioi-thieu' ? 'active' : '' }}">
                            Giới thiệu
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('page.slug', ['slug' => 'dich-vu']) }}"
                            class="nav-link nav-item-custom {{ request()->routeIs('page.slug') && request()->route()->slug == 'dich-vu' ? 'active' : '' }}">
                            Dịch vụ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('page.slug', ['slug' => 'thu-vien-anh']) }}"
                            class="nav-link nav-item-custom {{ request()->routeIs('page.slug') && request()->route()->slug == 'thu-vien-anh' ? 'active' : '' }}">
                            Thư viện ảnh
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('page.slug', ['slug' => 'lien-he']) }}"
                            class="nav-link nav-item-custom {{ request()->routeIs('page.slug') && request()->route()->slug == 'lien-he' ? 'active' : '' }}">
                            Liên hệ
                        </a>
                    </li>
                    <li class="nav-item nav-button">
                        <a href="#footer" class="nav-link nav-item-custom" id="accountDropdown"
                            role="button"  aria-expanded="false">
                            Báo giá ngay 
                            <i class="ps-2 fa-solid fa-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
          </div>
      </nav>
</header>
