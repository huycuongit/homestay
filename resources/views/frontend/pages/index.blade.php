@extends('frontend.layouts.master')

@section('css')
@endSection

@push('css')
    <link rel="preload" href="{{ asset('assets/css/home.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    </noscript>
    <style>
    </style>
@endpush
@section('content')
    <section id="checkin-section" class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">

                <!-- Ảnh minh hoạ -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="position-relative">
                        <img src="{{ asset('assets/imgs/homestay-room.jpg') }}" alt="Homestay Couple"
                            class="img-fluid rounded-4 shadow-sm w-100">
                        <div
                            class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                            <div class="text-white text-center"
                                style="background: rgba(0,0,0,0.35); padding: 10px 20px; border-radius: 12px;">
                                <h4 class="fw-bold mb-1">Ý Tưởng Hẹn Hò Cho Couple</h4>
                                <p class="mb-0">Homestay tự check-in, không ngại lễ tân</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nội dung bên phải -->
                <div class="col-md-6">
                    <h2 class="fw-bold text-warning mb-4">
                        Check-in linh hoạt – nghỉ ngơi thoải mái !
                    </h2>

                    <p>
                        <strong>Trần Anh The Home</strong> – homestay tiện nghi tại Biên Hòa, Long Thành,
                        Thủ Dầu Một, Dĩ An.
                    </p>

                    <ul class="list-unstyled mb-4">
                        <li>✨ Nội thất hiện đại, đầy đủ tiện ích</li>
                        <li>🎬 Máy chiếu + Netflix FREE, chill hết đêm</li>
                        <li>🍳 Bếp nấu riêng, nấu ăn thoải mái như ở nhà</li>
                        <li>👕 Máy giặt & sấy tiện lợi cho kỳ nghỉ dài ngày</li>
                        <li>🛏️ Không gian sạch sẽ, ấm cúng</li>
                        <li>🚗 Vị trí thuận tiện, dễ dàng di chuyển đến TP.HCM</li>
                    </ul>

                    <!-- Thống kê -->
                    <div class="d-flex flex-wrap gap-5 mt-4">
                        <div>
                            <h3 class="fw-bold text-warning mb-0">70+</h3>
                            <small class="text-muted">Phòng nghỉ</small>
                        </div>
                        <div>
                            <h3 class="fw-bold text-warning mb-0">1000+</h3>
                            <small class="text-muted">Lượt đặt phòng</small>
                        </div>
                        <div>
                            <h3 class="fw-bold text-warning mb-0">2000+</h3>
                            <small class="text-muted">Khách hàng hài lòng</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="top-rooms" class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-warning mb-0">Top phòng “cháy vé”</h3>
                <div class="d-flex gap-2">
                    <button class="btn btn-light rounded-circle shadow-sm"><i class="bi bi-arrow-left"></i></button>
                    <button class="btn btn-light rounded-circle shadow-sm"><i class="bi bi-arrow-right"></i></button>
                </div>
            </div>
    
            <div class="row g-4">
                {{-- @foreach($topRooms as $room) --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div class="position-relative">
                            <img src="{{ asset('storage/'.$room->image) }}" class="card-img-top" alt="{{ $room->name }}">
                            <span class="position-absolute top-0 start-0 bg-dark text-white px-3 py-1 rounded-end"
                                  style="font-size: 0.9rem;">{{ $room->tag ?? 'STAYCATION BIÊN HÒA' }}</span>
                        </div>
    
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h5 class="fw-bold mb-0">{{ $room->name }}</h5>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i> {{ $room->rating ?? '4.7' }}
                                </div>
                            </div>
                            <p class="small text-muted mb-3">{{ $room->address }}</p>
    
                            <div class="d-flex justify-content-between text-muted small mb-3">
                                <div><i class="bi bi-badge-tm"></i> 1 Bồn tắm</div>
                                <div><i class="bi bi-projector"></i> 1 Máy chiếu</div>
                                <div><i class="bi bi-bed"></i> 1 Giường đôi</div>
                                <div><i class="bi bi-couch"></i> 1 Sofa</div>
                            </div>
    
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold fs-5 text-dark">{{ number_format($room->price_day, 0, ',', '.') }}đ<span class="text-muted fs-6">/đêm/2 người</span></div>
                                    <div class="fw-bold text-secondary">{{ number_format($room->price_3h, 0, ',', '.') }}đ<span class="text-muted fs-6">/3h/2 người</span></div>
                                </div>
                                <a href="{{ route('booking.show', $room->slug) }}" class="btn btn-warning text-white fw-semibold px-4 py-2 rounded-pill">
                                    Đặt phòng
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @endforeach --}}
            </div>
        </div>
    </section>
    
@endsection


@section('js')
@endSection

@push('js')
    <script>
        $(function() {});
    </script>
@endpush
