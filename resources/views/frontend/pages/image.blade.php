@extends('frontend.layouts.master')
@section('meta')
    <meta name="linkEvents" content="{{ route('page.slug', ['slug' => 'tin-tuyen-dung']) }}" />
@endsection
@section('css')
@endSection

@push('css')
    <style>
        @media (min-width: 1200px) {
            .gallery-section-title {
                font-family: Manrope;
                font-weight: 400;
                font-style: Regular;
                font-size: 64px;
                leading-trim: NONE;
                line-height: line height/32;
                letter-spacing: 0%;
                color: var(--main-color);
                padding: 50px 0;
            }

            .image-name {
                font-weight: 400;
                font-style: Regular;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 140%;
                letter-spacing: 0%;
                text-align: center;
                color: var(--main-color);
                border: 2px solid var(--main-color)
            }

            .gallery-item {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                /* đổ bóng nhẹ */
                border-radius: 8px;
                transition: transform 0.2s ease;
                background: #fff;
            }

            .gallery-item:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                /* bóng mạnh hơn khi hover */
            }

            .gallery-item img {
                max-height: 205px;
                max-width: 278px;
                width: 100%;
                height: 205px;
                object-fit: cover;
            }

            .gallery-content {
                height: 82px;
                padding: 25px;
            }
            .btn-active {
                background-color: var(--main-color);
                color: var(--sub-color);
                border: none;
                padding: 10px 20px;

                font-weight: 700;
                font-style: Bold;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 4%;

            }
            .btn-custom {
                border: 1px solid var(--main-color);
                background-color: #fff;
                padding: 10px 20px;

                font-weight: 700;
                font-style: Bold;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 4%;
            }
            /***** End Job CSS *****/
        }
        @media (min-width: 769px) and (max-width: 1199px) {
            .gallery-section-title {
                font-family: Manrope;
                font-weight: 400;
                font-style: Regular;
                font-size: 64px;
                leading-trim: NONE;
                line-height: line height/32;
                letter-spacing: 0%;
                color: var(--main-color);
                padding: 50px 0;
            }

            .image-name {
                font-weight: 400;
                font-style: Regular;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 140%;
                letter-spacing: 0%;
                text-align: center;
                color: var(--main-color);
                border: 2px solid var(--main-color)
            }

            .gallery-item {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                /* đổ bóng nhẹ */
                border-radius: 8px;
                transition: transform 0.2s ease;
                background: #fff;
            }

            .gallery-item:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                /* bóng mạnh hơn khi hover */
            }

            .gallery-item img {
                max-height: 205px;
                max-width: 278px;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .gallery-content {
                height: 82px;
                padding: 25px;
            }
            .btn-active {
                background-color: var(--main-color);
                color: var(--sub-color);
                border: none;
                padding: 10px 20px;

                font-weight: 700;
                font-style: Bold;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 4%;

            }
            .btn-custom {
                border: 1px solid var(--main-color);
                background-color: #fff;
                padding: 10px 20px;

                font-weight: 700;
                font-style: Bold;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 4%;
            }
            /***** End Job CSS *****/
        }
        @media (max-width: 768px) {
            .gallery-section-title {
                font-family: Manrope;
                font-weight: 400;
                font-style: Regular;
                font-size: 50px;
                leading-trim: NONE;
                line-height: line height/32;
                letter-spacing: 0%;
                color: var(--main-color);
                padding: 30px 0;
            }

            .image-name {
                font-weight: 400;
                font-style: Regular;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 140%;
                letter-spacing: 0%;
                text-align: center;
                color: var(--main-color);
                border: 2px solid var(--main-color)
            }

            .gallery-item {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                /* đổ bóng nhẹ */
                border-radius: 8px;
                transition: transform 0.2s ease;
                background: #fff;
            }

            .gallery-item:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                /* bóng mạnh hơn khi hover */
            }

            .gallery-item img {
                max-height: 205px;
                max-width: 278px;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .gallery-content {
                height: 82px;
                padding: 25px;
            }
            .btn-active {
                background-color: var(--main-color);
                color: var(--sub-color);
                border: none;
                padding: 10px 20px;

                font-weight: 700;
                font-style: Bold;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 4%;

            }
            .btn-custom {
                border: 1px solid var(--main-color);
                background-color: #fff;
                padding: 10px 20px;

                font-weight: 700;
                font-style: Bold;
                font-size: 18px;
                leading-trim: NONE;
                line-height: 100%;
                letter-spacing: 4%;
            }
            /***** End Job CSS *****/
        }
    </style>
@endpush

@section('content')
    <section id="gallery-section" class="py-5 bg-light">
        <div class="container">
            <!-- Heading -->
            <h2 class="gallery-section-title">THƯ VIỆN ẢNH</h2>

            <!-- Filter Buttons -->
            <div class="mb-5 d-flex flex-wrap gap-3">
                <button class="btn-custom btn-active " data-category="all">Tất cả ảnh</button>
                @foreach ($galleries as $gallery)
                    <button class="btn-custom" data-category="{{ $gallery->id }}">{{ $gallery->name }}</button>
                @endforeach
            </div>

            <div class="row" id="gallery-container">
                @foreach ($images as $image)
                    <div class="col-md-3 mb-4 " data-category="bao-tri">
                        <div class="gallery-item">
                            <img src="{{ Storage::url($image->url) }}" class="" alt="Ảnh">
                            <div class="gallery-content">
                                <h6 class="image-name">{{ $image->name }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <x-commit-section :arr-setups="$arrSetups" :commits="$commits" />


    <input type="hidden" value="{{ route('page.slug', ['thu-vien-anh']) }}" id="url-ajax" />
    <!-- /. URL action -->
    <!-- ======= End Job Section ======= -->
@endSection

@section('js')
@endSection

@push('js')
<script>
    $(document).ready(function () {
        $('.btn-custom, .btn-active').on('click', function () {
            const categoryId = $(this).data('category');
            const url = $('#url-ajax').val();
    
            // Thay đổi class active
            $('.btn-custom, .btn-active').removeClass('btn-active');
            $(this).addClass('btn-active');
    
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    gallery_id: categoryId
                },
                success: function (response) {
                    $('#gallery-container').html(response.data);
                },
                error: function () {
                    alert('Tải ảnh thất bại.');
                }
            });
        });
    });
    </script>
    
@endpush
