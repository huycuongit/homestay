@extends('main.contentpage.layouts.master')

@section('meta')
    <meta name="linkGetProvince" content="{{ route('admin.provinces.active') }}" />
    <meta name="linkGetDistrict" content="{{ route('admin.districts.active', ['provinceCode' => '_provinceCode']) }}" />
    <meta name="linkGetWard" content="{{ route('admin.wards.active', ['districtCode' => '_districtCode']) }}" />
	<meta name="linkEvents" content="{{ route('page.slug', ['slug' => 'bi-quyet']) }}"/>
@endsection

<!-- CSS in page -->
@section('css')
@endSection

@push('css')
	<!-- Date time range -->
	<link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

    <style>
        /* CSS Experience */
        #ishtcn {
			padding: 10px;
			color: #ff8b00;
			font-family: Unbounded, sans-serif;
			font-size: 40px;
			text-align: center;
			margin: 55px 0px 55px 0px;
			font-weight: 600;
		}
		#ibub6y {
			padding: 0px 0px 0px 0;
		}
		#i31a7w {
			padding: 0px 0px 0px 0;
		}
		#i41uvf {
			margin: 0px 15px 0px 0px;
			padding: 10px 25px 10px 25px;
		}
		#ibnea8 {
			margin: 0px 15px 0px 15px;
			padding: 10px 25px 10px 25px;
		}
		#iibh03 {
			margin: 0px 0px 0px 15px;
			padding: 10px 25px 10px 25px;
		}

		#i01g6 {
			padding: 0px 0px 0px 0;
			background-repeat: repeat;
			background-position: center center;
			background-attachment: local;
			background-size: cover;
			background-image: linear-gradient(#f7f6f4 0%, #f7f6f4 100%);
		}
		#iswyxk {
			display: inline-block;
			padding: 10px 10px 10px 10px;
			min-width: 50px;
			width: 100%;
			background-repeat: repeat;
			background-position: center center;
			background-attachment: scroll;
			background-size: cover;
			background-image: url("/panel/laravel_page/images/2024-03-11-09:03:28-sunnydays_box.png");
			text-decoration: none;
			color: #ffffff;
			border-radius: 25px 25px 25px 25px;
			min-height: 215px;
		}
		#iemb7v {
			display: inline-block;
			padding: 10px 10px 10px 10px;
			min-height: 215px;
			min-width: 50px;
			width: 100%;
			background-repeat: repeat;
			background-position: center center;
			background-attachment: scroll;
			background-size: cover;
			background-image: url("/panel/laravel_page/images/2024-03-11-09:03:50-sunnydays_box.png");
			text-decoration: none;
			color: #ffffff;
			border-radius: 25px 25px 25px 25px;
			margin: 0 0px 10px 0px;
		}
		#ir6qdd {
			display: inline-block;
			padding: 10px 10px 10px 10px;
			min-height: 215px;
			min-width: 50px;
			width: 100%;
			background-repeat: repeat;
			background-position: center center;
			background-attachment: scroll;
			background-size: cover;
			background-image: url("/panel/laravel_page/images/2024-03-11-09:03:50-sunnydays_box.png");
			border-radius: 25px 25px 25px 25px;
			text-decoration: none;
			color: #ffffff;
		}
		#ipoo5m {
			padding: 10px;
			font-family: Unbounded, sans-serif;
			font-size: 20px;
			text-align: center;
		}
		#i3gh7i {
			padding: 10px;
			font-family: Unbounded, sans-serif;
			font-size: 20px;
			text-align: center;
		}
		#i305yk {
			padding: 10px;
			font-family: Unbounded, sans-serif;
			font-size: 20px;
			text-align: center;
		}
		#ip38ga {
			padding: 0px 10px 55px 10px;
			background-repeat: repeat;
			background-position: center center;
			background-attachment: local;
			background-size: cover;
			background-image: linear-gradient(#f7f6f4 0%, #f7f6f4 100%);
		}
		#ib7bb4 {
			padding: 0px 0px 0px 0;
			margin: 10px 16.5% 10px 16.5%;
		}
		#ioid5t {
			margin: 0px 15px 0px 15px;
			padding: 10px 25px 10px 25px;
		}
		#i2hu31 {
			margin: 0px 15px 0px 15px;
			padding: 10px 25px 10px 25px;
		}
		#i9ltfl {
			display: inline-block;
			padding: 10px 10px 10px 10px;
			min-height: 215px;
			min-width: 50px;
			width: 100%;
			background-repeat: repeat;
			background-position: center center;
			background-attachment: scroll;
			background-size: cover;
			background-image: url("/panel/laravel_page/images/2024-03-11-09:03:50-sunnydays_box.png");
			color: #ffffff;
			text-decoration: none;
			border-radius: 25px 25px 25px 25px;
		}
		#ieoy7a {
			display: inline-block;
			padding: 5px;
			min-height: 215px;
			min-width: 50px;
			width: 100%;
			background-repeat: repeat;
			background-position: center center;
			background-attachment: scroll;
			background-size: cover;
			background-image: url("/panel/laravel_page/images/2024-03-11-09:03:50-sunnydays_box.png");
			border-radius: 25px 25px 25px 25px;
			text-decoration: none;
			color: #ffffff;
		}
		#iw4t0m {
			padding: 10px;
			font-family: Unbounded, sans-serif;
			font-size: 20px;
			text-align: center;
		}
		#iy4kpx {
			padding: 25px 10px 10px 10px;
			font-family: Unbounded, sans-serif;
			font-size: 20px;
			text-align: center;
		}

        .experience-ct {
            font-size: 11px !important;
        }

        .sunnydays-box-ct {
            min-height: 130px !important;
            min-width: 200px !important;
        }

		@media (max-width: 992px) {
			#i2jb6 {
				margin: 55px 0px 0px 10%;
				font-size: 155%;
			}
			#izmwa {
				font-size: 250%;
				margin: 25px 0px 0px 10%;
			}
			#ilns3 {
				width: 255px !important;
			}
			#iii1g {
				margin: 10px 10px 25px 10%;
			}
		}
		@media (max-width: 768px) {
			.gjs-row {
				flex-wrap: wrap;
			}
		}
		@media only screen and (max-width: 600px) {
			.MultiCarousel .MultiCarousel-inner {
				width: 8160px !important;
			}
			.MultiCarousel .MultiCarousel-inner .item {
				width: calc(~"100vw - 25px") !important;
			}
			.MultiCarousel {
				padding: 5px;
			}
			.MultiCarousel .MultiCarousel-inner .item > div {
				padding: 5px;
				margin: 5px;
			}
		}
		@media (max-width: 480px) {
			.sunnydays_desktop_banner {
				display: none !important;
			}
			.sunndays_mobile_banner {
				display: block !important;
			}
			#i2jb6 {
				margin: 55px 0px 0px 7%;
			}
			#izmwa {
				margin: 15px 0px 0px 7%;
			}
			#ilns3 {
				margin: 5px 0px 15px 0px;
				width: 215px !important;
			}
			#ihiwl {
				text-align: center;
				font-size: 250%;
			}
			#i7elj {
				margin: 25px 0px 0px 0px;
				padding: 10px 10px 10px 10px;
			}
			#ikrc1i {
				margin: 0 0px 0px 0px;
			}
			#i22g6 {
				border-radius: 55px 55px 55px 55px;
			}
			#i41uvf {
				margin: 0px 15px 0px 15px;
				padding: 10px 0px 10px 0;
			}
			#iibh03 {
				margin: 0px 15px 0px 15px;
				padding: 10px 0px 10px 0;
			}
			#i597 {
				background-repeat: no-repeat;
				background-position: center center;
				background-attachment: local;
				background-size: cover;
				background-image: url("");
				padding: 0 !important;
			}
			#iii1g {
				margin: 10px 10px 25px 7%;
			}
			#im0z {
				display: none;
			}
			#irho9f {
				display: block;
				font-size: 25px;
				margin: 35px 5px 25px 5px;
			}
			#i77rk {
				margin: 0px 0px 0px 0;
				padding: 10px 10px 10px 10px;
			}
			#i0k7n {
				margin: 25px 0px 0px 0px;
				padding: 10px 10px 10px 10px;
			}
			#io7gn {
				margin: 25px 0px 0px 0px;
				padding: 10px 10px 10px 10px;
			}
			#ihxsw {
				width: 95px !important;
			}
			#izyz3 {
				font-size: 15px;
			}
			#iu0z6 {
				width: 95px !important;
			}
			#iftdew {
				font-size: 15px;
			}
			#i7rzog {
				width: 95px !important;
			}
			#izl17p {
				font-size: 15px;
			}
			#igjgvn {
				width: 95px !important;
			}
			#i4tvas {
				font-size: 15px;
			}
			#ibnea8 {
				padding: 10px 0px 10px 0;
			}
			#i59brf {
				padding: 0px 0px 0 0px;
				margin: 0px 0px 0px 0;
			}
			#ib7bb4 {
				margin: 10px 15px 10px 15px;
				padding: 5px 15px 5px 15px;
			}
			#ioid5t {
				margin: 0px 0px 0px 0;
				padding: 0px 0px 10px 0px;
			}
			#i2hu31 {
				padding: 10px 0px 10px 0;
				margin: 0px 0 0px 0px;
			}
			#iswyxk {
				min-height: 155px;
				background-repeat: repeat;
				background-position: right center;
				background-attachment: scroll;
				background-size: cover;
				background-image: url("/panel/laravel_page/images/2024-03-11-09:03:50-sunnydays_box.png");
			}
			#iemb7v {
				min-height: 155px;
				background-repeat: repeat;
				background-position: right center;
				background-attachment: scroll;
				background-size: cover;
				background-image: url("/panel/laravel_page/images/2024-03-11-09:03:50-sunnydays_box.png");
				margin: 0px 0px 0px 0;
			}
			#ir6qdd {
				min-height: 155px;
				background-repeat: repeat;
				background-position: right center;
				background-attachment: scroll;
				background-size: cover;
				background-image: url("/panel/laravel_page/images/2024-03-11-09:03:50-sunnydays_box.png");
			}
			#i9ltfl {
				min-height: 155px;
				background-repeat: repeat;
				background-position: right center;
				background-attachment: scroll;
				background-size: cover;
				background-image: url("/panel/laravel_page/images/2024-03-11-09:03:50-sunnydays_box.png");
			}
			#i3kkg {
				margin: 0px 10px 10px 10px;
				border-radius: 0 0px 0px 0px;
				padding: 5px 15px 5px 15px;
			}
			#icke {
				margin: 0 0px 0px 0px;
			}
			#img9iq {
				padding: 5px 0px 5px 0;
			}
			#i3ttdk {
				padding: 5px 0px 5px 0;
			}
			#i0htdl {
				padding: 5px 0px 5px 0;
			}
			#ilwmm {
				font-size: 25px;
			}
			#isajk {
				margin: 0 5px 5px 5px;
			}
			#i7ngk {
				margin: 15px 5px 5px 5px;
			}
			#i5j32 {
				margin: 15px 5px 5px 5px;
			}
			#ilx0c {
				margin: 15px 5px 5px 5px;
			}
			#i90xlj {
				margin: 0px 0px 0px 0;
				font-size: 15px;
			}
			#ishtcn {
				font-size: 25px;
				margin: 35px 5px 25px 5px;
			}
			#ipoo5m {
				font-size: 15px;
			}
			#i3gh7i {
				font-size: 15px;
			}
			#i305yk {
				font-size: 15px;
			}
			#iw4t0m {
				font-size: 15px;
			}
			#iy4kpx {
				font-size: 15px;
			}
			#ieoy7a {
				min-height: 155px;
				background-repeat: repeat;
				background-position: right center;
				background-attachment: scroll;
				background-size: cover;
				background-image: url("/panel/laravel_page/images/2024-03-11-09:03:50-sunnydays_box.png");
			}
			#ir5vfq {
				background-repeat: repeat;
				background-position: center center;
				background-attachment: local;
				background-size: cover;
				background-image: url("/panel/laravel_page/images/2024-02-21-11:02:52-2024-02-21-05_02_38-hlv frame.png");
			}
			#i41vtr {
				font-size: 25px;
				margin: 35px 5px 25px 5px;
			}
			#itrd3k {
				padding: 10px 0px 7px 0;
			}
			#i94rbr {
				padding: 10px 0px 7px 0;
			}
			#i13tbm {
				padding: 10px 0px 7px 0;
			}
			#i2ft3 {
				margin: 5px 10px 5px 10px;
			}
			#iqhjjf {
				margin: 5px 10px 5px 10px;
			}
			#if8u3f {
				font-size: 15px;
			}
			#ik88bh {
				font-size: 15px;
			}
			#i9fhbi {
				font-size: 15px;
			}
			#ik8y9p {
				text-align: left;
				font-size: 20px;
				padding: 10px 5px 0px 5px;
			}
			#i572ln {
				font-size: 11px;
				font-weight: 300;
				padding: 0px 5px 20px 5px;
			}
			#i7btk {
				top: 27%;
				position: absolute;
			}
			.i7btk {
				top: 27%;
				position: absolute;
			}
			#iv4sva {
				width: 155px !important;
			}
			.iv4sva {
				width: 155px !important;
			}
			#i95olz {
				padding: 0px 0px 0px 0;
			}
			.i95olz {
				padding: 0px 0px 0px 0;
			}
			#ipgaxr {
				margin: 0px 0px 0px 0;
			}
			#ifc7pc {
				padding: 5px 35px 55px 35px;
			}
			#ieue9s {
				font-size: 20px;
				padding: 10px 5px 0px 5px;
			}
			#ijtqzc {
				border-radius: 25px 25px 25px 25px;
			}
			#ircifx {
				border-radius: 25px 25px 25px 25px;
			}
			#i9689i {
				border-radius: 25px 25px 25px 25px;
				margin: 0px 0px 0px 0;
				padding: 0px 0px 0px 0;
			}
			#innfiv {
				padding: 0px 0px 0px 0;
				margin: 0px 0px 0px 0;
			}
			#ipqiop {
				border-radius: 25px 25px 25px 25px;
				padding: 0px 0px 0px 0;
			}
			#iuqhpp {
				padding: 0px 0px 0px 0;
			}
			#iw4vcd {
				padding: 5px 35px 55px 35px;
			}
			#ik7rgb {
				padding: 0px 0px 0px 0px;
			}
			#ihj5ge {
				padding: 5px 35px 55px 35px;
			}
			#i7vgjk {
				font-size: 20px;
				padding: 10px 5px 0px 5px;
			}
			#ittco1 {
				padding: 0px 5px 20px 5px;
				font-size: 11px;
			}
			#igna1j {
				padding: 5px 35px 55px 35px;
			}
			#ippm8f {
				padding: 10px 5px 0px 5px;
				font-size: 20px;
			}
			#itk7ji {
				padding: 10px 5px 0px 5px;
				font-size: 20px;
			}
			#ib6lbn {
				padding: 0px 5px 20px 5px;
				font-size: 11px;
			}
			#ibnroh {
				padding: 0px 5px 20px 5px;
				font-size: 11px;
			}
			#i02vxe {
				padding: 5px 35px 55px 35px;
			}
			#ik9wji {
				padding: 5px 0 5px 0px;
			}
			#ibtzti {
				padding: 5px 5px 5px 0px;
			}
			#izmkkp {
				padding: 5px 5px 5px 0;
			}
			#i0txpx {
				padding: 5px 0px 5px 5px;
				max-width: 30px;
			}
			#ikrjr3 {
				padding: 5px 5px 5px 0;
			}
			#i7th9u {
				font-size: 14px;
			}
			#irbpw1 {
				font-size: 14px;
			}
			#ivbt9y {
				font-size: 14px;
			}
			#ipusgj {
				font-size: 14px;
			}
			#i1pqmu {
				width: 25px !important;
			}
			#iesrjl {
				padding: 5px 0px 5px 5px;
				max-width: 30px;
			}
			#imts2a {
				padding: 5px 0px 5px 5px;
				max-width: 30px;
			}
			#is0qz3 {
				width: 20px !important;
			}
			#ipnfc9 {
				padding: 5px 0px 5px 5px;
				max-width: 30px;
			}
			#ij56f7 {
				width: 25px !important;
			}
			#ivubm9 {
				width: 25px !important;
			}
			#iljcui {
				margin: 5px 5px 0px 0;
			}
			#iyq5jv {
				padding: 5px 5px 5px 5px;
			}
			#iue81b {
				border-radius: 25px 25px 25px 25px;
			}
			#iul926 {
				border-radius: 25px 25px 25px 25px;
			}
			#it7bfi {
				border-radius: 25px 25px 25px 25px;
			}
			#iwn9r5 {
				border-radius: 25px 25px 25px 25px;
			}
			#ixbn3i {
				border-radius: 25px 25px 25px 25px;
			}
			#itt3gr {
				border-radius: 25px 25px 25px 25px;
			}
			#i1ohmx {
				font-weight: 400;
			}
			#iz90lf {
				font-family: Unbounded, sans-serif;
				font-size: 14px;
				font-weight: 700;
			}
			#i3ioq2 {
				font-weight: 400;
			}
			#iwdc0l {
				font-family: Unbounded, sans-serif;
				font-size: 14px;
				font-weight: 700;
			}
			#inateh {
				font-weight: 400;
			}
			#i6kri4 {
				font-family: Unbounded, sans-serif;
				font-size: 14px;
				font-weight: 700;
			}
			#igkz7p {
				font-weight: 400;
			}
			#i8bj9s {
				font-family: Unbounded, sans-serif;
				font-size: 14px;
				font-weight: 700;
			}

			.sunnydays-box-ct {
				min-height: 160px !important;
			}
		}

		.filter .form-select {
			border-radius: 20px;
		}


		.filter .form-select:focus {
			border-color: #FF9900;
			outline: 0;
			box-shadow: 0 0 0 0.2rem rgba(255, 153, 0, 0.25);
		}

		.filter .form-select:hover {
			border-color: #FF9900;
		}

		.filter  .form-select option:hover {
			background-color: #FF9900;
			color: #fff;
		}

		.filter .form-select option:checked {
			background-color: #FF9900;
			color: #fff;
		}

		.filter-location {
			display: none;
		}
		.filter .input-group {
			border: 1px solid #dfe4e8;
    		border-radius: 30px;
		}
		.filter .input-group:focus {
			border-color: #FF9900;
			outline: 0;
			box-shadow: 0 0 0 0.2rem rgba(255, 153, 0, 0.25);
		}

		.filter .input-group button:focus {
			outline: 0;
			border-color: #fff;
		}


		/* CSS card */
		.card-father {
			margin-bottom: 30px;
		}

		.card-event {
			margin: auto;
			width: 24rem;
			border-radius: 30px;
			cursor: pointer;
		}

		.card-event .card-img-top {
			border-radius: 30px 30px 0 0;
		}

		.card-event img {
			min-height: 255px;
			max-height: 255px;
		}

		.card-body h2 {
			color: #FF9900;
		}

		.card-title, .card-text {
			white-space: nowrap; /* Ngăn ngừa từ bị ngắt dòng */
			overflow: hidden; /* Ẩn phần vượt quá */
			text-overflow: ellipsis; /* Hiển thị dấu chấm (...) khi văn bản bị cắt bớt */
		}

		.card-location {
			font-size: 10px;
		}

		/* CSS customer range */
		.daterangepicker .ranges li:hover,
		.daterangepicker .ranges li.active {
			background-color: #FF9900;
			color: #fff;
		}

		.daterangepicker .ranges li.active::before {
			background-color: #FF9900;
		}

		.daterangepicker .applyBtn,
		.daterangepicker .cancelBtn {
			background-color: #FF9900;
			color: #fff;
		}

		.daterangepicker .applyBtn:hover,
		.daterangepicker .cancelBtn:hover {
			background-color: #FFCC80;
			color: #fff;
		}
		.daterangepicker .ranges li.active::before {
			background-color: #FF9900;
		}

		.daterangepicker .ranges li.active:hover::before {
			background-color: #FFCC80;
		}

		.daterangepicker .ranges li.active.active::before {
			background-color: #FF9900;
		}

		/* Thiết lập màu nền và màu chữ cho các ô trong bảng khi hover */
		.daterangepicker .table-condensed td.active:hover,
		.daterangepicker .table-condensed td.start-date:hover,
		.daterangepicker .table-condensed td.end-date:hover,
		.daterangepicker .table-condensed td.available.in-range:hover {
			background-color: #f4c886; /* Màu nền mong muốn khi hover */
			color: #fff; /* Màu chữ */
		}

		/* Thiết lập màu nền và màu chữ cho các ô trong bảng khi được chọn */
		.daterangepicker .table-condensed td.active,
		.daterangepicker .table-condensed td.start-date,
		.daterangepicker .table-condensed td.end-date,
		.daterangepicker .table-condensed td.available.in-range {
			background-color: #FF9900; /* Màu nền mong muốn khi được chọn */
			color: #fff; /* Màu chữ */
		}

		/* Panigation */
		/* Đặt phân trang bên phải */
		.pagination {
			justify-content: flex-end;
			padding: 0px 10px;
		}

		/* Góc bo tròn cho các phần tử li */
		.pagination .page-item a {
			color: gray;
			border-radius: 50% !important;
			padding: 5px 12px;
			font-size: 13px;
			margin: 5px;
		}

		/* Màu sắc thay đổi khi hover */
		.pagination .page-item a:hover {
			background-color: #FF9900; /* Màu nền mong muốn khi hover */
			color: #fff; /* Màu chữ */
		}

		.active>.page-link, .page-link.active {
			background-color: #FF9900 !important;
			color: #fff !important;
			border: 1px solid #e2e7e9;
    	}

		/* Filter */
		.filter-mg {
			margin-top: 40px;
		}
		.btn-filter {
			background-color: #FF9900 !important;
			color: #fff !important;
			border: 1px solid #e2e7e9;
		}
		.filter .col-sm-3 {
			margin-bottom: 10px;
		}

		.filter {
			padding: 10px;
		}

		.title-page {
			color: #fff;
			padding: 50px 10px;
			background-color: #FF9900;
			padding-right: calc(var(--bs-gutter-x)* .5);
			padding-left: calc(var(--bs-gutter-x)* .5);
			margin-right: auto;
			margin-left: auto;
		}

		.clearfix {
			height: 30px;
		}

		/* CSS show detail */
		.gjs-row {
			display: flex;
			justify-content: flex-start;
			align-items: stretch;
			flex-wrap: nowrap;
			padding: 10px;
		}
		.gjs-cell {
			min-height: 75px;
			flex-grow: 1;
			flex-basis: 100%;
		}

		#ifc7pc {
			background-repeat: repeat;
			background-position: center center;
			background-attachment: local;
			background-size: cover;
			background-image: linear-gradient(#f7f6f4 0%, #f7f6f4 100%);
			padding: 10px 10px 55px 10px;
		}

		#ircifx {
			padding: 0px 0px 0px 0;
			background-repeat: repeat;
			background-position: center center;
			background-attachment: local;
			background-size: cover;
			background-image: linear-gradient(#ff8b00 0%, #ff8b00 100%);
			color: #ffffff;
			border-radius: 50px 50px 50px 50px;
			max-width: 1250px;
		}

		#incl7g {
			flex-basis: 55%;
		}

		#ijtqzc {
			color: black;
			width: 100%;
			border-radius: 50px 50px 50px 50px;
		}

		#iqgm5a {
			padding: 15px 15px 15px 15px;
		}

		#i3ovnh {
			margin: 0px 0px 0px 0;
			padding: 0px 0px 0px 0;
		}

		#i5tdyi {
			display: inline-block;
			padding: 5px;
			min-width: 50px;
		}

		#ixize9 {
			text-align: right;
			min-height: 0px;
		}

		#ik8y9p {
			padding: 70px 50px 10px 50px;
			font-family: Unbounded, sans-serif;
			font-size: 30px;
			font-weight: 600;
		}

		#i572ln {
			padding: 10px 50px 10px 50px;
			margin: 15px 0px 0px 0;
			font-family: Unbounded, sans-serif;
			font-size: 14px;
			font-weight: 300;
			text-align: justify;
		}

		#i3ovnh {
			margin: 0px 0px 0px 0;
			padding: 0px 0px 0px 0;
		}

		#iqgm5a {
			padding: 15px 15px 15px 15px;
		}

		#i5tdyi {
			display: inline-block;
			padding: 5px;
			min-width: 50px;
		}

		#i1dvwh {
			color: black;
			width: 27px !important;
			float: none;
		}

		#iuqhpp {
			padding: 10px 50px 0 50px;
		}

		#izmkkp {
			padding: 10px 20px 10px 0px;
		}

		#igqhhy {
			padding: 0px 0px 0px 0;
		}

		#iesrjl {
			flex-basis: 0px;
			margin: 0px 0px 0px 0;
			padding: 5px 0px 0px 0px;
		}

		#i1pqmu {
			color: black;
			width: 33px !important;
		}


		#idjpjz {
			flex-basis: 70%;
			padding: 5px 5px 5px 5px;
		}

		#irbpw1 {
			padding: 0px 0px 0px 0;
			margin: 0px 0px 0px 0;
			font-family: Unbounded, sans-serif;
			font-size: 17px;
			font-weight: 500;
		}

		#iljcui {
			padding: 0px 0px 0 0px;
			margin: 10px 0px 10px 0;
			font-family: Unbounded, sans-serif;
			font-size: 11px;
			font-weight: 300;
			text-align: justify;
		}

		@media (max-width: 480px) { 
			#ifc7pc {
				padding: 5px 35px 55px 35px;
			}

			#ircifx {
				border-radius: 25px 25px 25px 25px;
			}

			#ijtqzc {
				border-radius: 25px 25px 25px 25px;
			}

			#ik8y9p {
				text-align: left;
				font-size: 20px;
				padding: 10px 5px 0px 5px;
			}

			#i572ln {
				font-size: 11px;
				font-weight: 300;
				padding: 0px 5px 20px 5px;
			}

			#iuqhpp {
				padding: 0px 0px 0px 0;
			}

			#izmkkp {
				padding: 5px 5px 5px 0;
			}
		}

		@media (max-width: 768px) {
			.gjs-row {
				flex-wrap: wrap;
			}
		}

        .event-item-all-time-comment {
			display: flex;
			justify-content: space-between; /* Đặt khoảng cách giữa các thành phần con */
    		align-items: center;   
		}

		.event-item-all-time-comment {
			display: flex;
			justify-content: space-between; /* Đặt khoảng cách giữa các thành phần con */
    		align-items: center;   
		}

        .card-news {
            border: none;
            border-radius: 0 !important;
        }

        .card-news .card-img-top {
            border-radius: 30px;
        }

        .card-news .card-title {
            height: auto;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 35px;
            max-height: 65px;
            min-height: 65px;
            word-wrap: break-word;
            white-space: normal;
        }

        .card-news .card-text {
            color: gray;
            height: auto;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.6;
            min-height: 4.8em;
            max-height: 4.8em;
            word-wrap: break-word;
            white-space: normal;
            font-size: 13px;
        }

        .event-item-all-address {
            font-size: 13px;
            color: gray;
        }

		h1 {
			font-family: Unbounded, sans-serif;
		}

		.col-ct-filter {
			max-width: 270px;
		}
    </style>

	
@endpush
<!-- /. CSS in page -->

@section('content')
    <!-- Events -->
	<div class="title-page">
		<div class="container my-3">
			<h1 class="text-left text-uppercase">BÍ QUYẾT HỌC PIANO</h1>
		</div>
	</div>
	
    <div class="container my-3" style="min-height: 50vh;">
		<!-- Filter -->
		<form id="form-search" action="{{ route('page.slug', ['slug' => 'tin-tuc']) }}" method="GET">
			<div class="row filter filter-mg">
				<div class="col-sm-3 col-ct-filter">
					<!-- Date and time range -->
					<input type="hidden" id="start_time" name="start_time">
					<input type="hidden" id="end_time" name="end_time">
					<div class="form-group">
						<div class="input-group">
							<button type="button" class="btn btn-default float-right" id="daterange-btn">
								<i class="far fa-calendar-alt"></i> Tất cả khung thời gian
								<i class="fas fa-caret-down"></i>
							</button>
						</div>
					</div>
					<!-- /.form group -->
				</div>
				<div class="col-sm-3">
					<button type="submit" class="btn btn-dark btn-filter"><i class="fa fa-filter"></i> Lọc</button>
				</div>
			</div>
		</form>
		<!-- /. Filter -->
		@if (count($tips) > 0)
			<!-- Events -->
			<div class="clearfix"></div>
            <div class="row list-event">
                @foreach ($tips as $kN => $vN)
                    <div class="col-sm-4 card-father">
                        <div class="card card-event card-news" data-url="{{ route('tip.detail', ['slug' => $vN->slug ]) }}">
                            <img src="{{ $vN->avatar ?? '/panel/laravel_page/images/2024-03-11-09:03:27-1 (1).png' }}" class="card-img-top" alt="...">
                            <div class="card-body">
								<h4 class="card-title">{{ $vN->name ?? 'Đang cập nhật ...' }}</h4>
								<p class="card-text">{{ $vN->description ?? 'Đang cập nhật ...' }}</p>
								<div class="event-item-all-time-comment">
                                    <p class="event-item-all-address">{{ $vN->formatted_publish_time ?? 'Đang cập nhật ...' }}</p>
                                    <p class="event-item-all-address">
                                        <i class="far fa-comment"></i>
                                        <span>Bình luận</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
			<div class="row">
				{{ $tips->links('components.pagination') }}
			</div>
			<!-- Events -->
        @else
			<div class="clearfix"></div>
            <h5 class="text-center text-uppercase" style="color: #FF9900;">Không có bí quyết nào phù hợp ! </h5>
        @endif
    </div>
    <!-- /. Events -->

    <!-- Experience -->
    <div id="i01g6" class="gjs-row ct-gjs-row">
        <div id="iqhjjf" class="gjs-cell container">
            <div id="ishtcn">
                NHỮNG TRẢI NGHIỆM <br />
                MÀ CHÚNG TÔI MANG ĐẾN
            </div>
            <div id="ibub6y" class="gjs-row sunnydays_section_first">
                <div id="ibnea8" class="gjs-cell">
                    <a id="iswyxk" class="sunnydays_box_1 sunnydays-box-ct">
                        <div id="ipoo5m" class="experience-ct">
                            MÔ HÌNH "LINH ĐỘNG TRỌN ĐỜI" ĐẦU TIÊN <br />
                            &nbsp;TẠI VIỆT NAM
                        </div>
                    </a>
                </div>
                <div id="ibnea8" data-bs-toggle="modal" data-bs-target="#myModalMain" class="gjs-cell">
                    <a id="iemb7v" title="" class="sunnydays_box_2 sunnydays-box-ct">
                        <div id="i3gh7i" class="experience-ct">
                            PHÒNG TẬP ĐÀN <br />
                            CHUYÊN DỤNG <br />
                            MIỄN PHÍ
                        </div>
                    </a>
                </div>
                <div id="ibnea8" class="gjs-cell">
                    <a id="ir6qdd" class="sunnydays_box_3 sunnydays-box-ct">
                        <div id="i305yk" class="experience-ct">
                            DỊCH VỤ CÁ NHÂN HÓA (1-1) LUÔN ĐỒNG HÀNH <br />
                            CÙNG BẠN
                        </div>
                    </a>
                </div>
                <div id="ibnea8" class="gjs-cell">
                    <a id="i9ltfl" class="sunnydays_box_4 sunnydays-box-ct">
                        <div id="iw4t0m" class="experience-ct">
                            CỘNG ĐỒNG <br />
                            &nbsp;TRUYỀN CẢM HỨNG <br />
                            MỖI NGÀY
                        </div>
                    </a>
                </div>
                <div id="ibnea8" class="gjs-cell">
                    <a id="ieoy7a" class="sunnydays_box_5 sunnydays-box-ct">
                        <div id="iy4kpx" class="experience-ct">
                            TRẢ GÓP 0% <br />
                            &nbsp;LÃI SUẤT
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /. Experience -->

	<!-- Display none -->
	<div id="ifc7pc" class="gjs-row sunnydays_section_detail_1" style="display: none">
		<div id="iqb16j" class="gjs-cell">
			<div id="ircifx" class="gjs-row container">
				<div id="incl7g" class="gjs-cell"><img id="ijtqzc" src="/panel/laravel_page/images/2024-02-26-05:02:50-img-in-popup-10.png" alt="#" /></div>
				<div id="iqgm5a" class="gjs-cell">
					<div id="i3ovnh" class="gjs-row">
						<div id="ixize9" class="gjs-cell">
							<a id="i5tdyi" class="sunnydays_section_detail_close_1"><img id="i1dvwh" src="/panel/laravel_page/images/2024-02-24-01:02:26-close-button-10.png" alt="#" /></a>
						</div>
					</div>
					<div id="ik8y9p">
						MÔ HÌNH "LINH ĐỘNG TRỌN ĐỜI"&nbsp; <br />
						ĐẦU TIÊN TẠI VIỆT NAM
					</div>
					<div id="i572ln">
						Hiểu được sự bận rộn trong cuộc sống hiện đại, Sunny Days mang đến mô hình "Linh Động Trọn Đời", đáp ứng quỹ thời gian của Quý Khách hàng. Bạn có thể đến bất cứ khung giờ nào có lớp, miễn là tiện cho Bạn.
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="ifc7pc" class="gjs-row sunnydays_section_detail_2" style="display: none;">
		<div id="iqb16j" class="gjs-cell">
			<div id="ircifx" class="gjs-row container">
				<div id="incl7g" class="gjs-cell"><img id="ijtqzc" src="/panel/laravel_page/images/2024-02-26-05:02:00-img-in-popup-11.png" alt="#" /></div>
				<div id="iqgm5a" class="gjs-cell">
					<div id="i3ovnh" class="gjs-row">
						<div id="ixize9" class="gjs-cell">
							<a id="i5tdyi" class="sunnydays_section_detail_close_2"><img id="i1dvwh" src="/panel/laravel_page/images/2024-02-24-01:02:26-close-button-10.png" alt="#" /></a>
						</div>
					</div>
					<div id="ik8y9p">
						PHÒNG TẬP ĐÀN <br />
						CHUYÊN DỤNG MIỄN PHÍ
					</div>

					<div id="iuqhpp" class="gjs-row">
						<div id="izmkkp" class="gjs-cell">
							<div id="igqhhy" class="gjs-row">
								<div id="iesrjl" class="gjs-cell"><img id="i1pqmu" src="/panel/laravel_page/images/2024-02-24-04:02:57-time.png" alt="#" /></div>
								<div id="idjpjz" class="gjs-cell">
									<div id="irbpw1">Tùy chọn thời gian</div>
									<div id="iljcui">
										Practice Studio mở tất cả các ngày trong tuần, từ 9h sáng đến 8h tối. Học viên có thể đến tập bất cứ lúc nào miễn là còn đàn. Khuyến khích học viên đặt trước để giữ chỗ bằng cách quét QRCODE.
									</div>
								</div>
							</div>
						</div>

						<div id="izmkkp" class="gjs-cell">
							<div id="igqhhy" class="gjs-row">
								<div id="iesrjl" class="gjs-cell">
									<img id="i1pqmu" src="/panel/laravel_page/images/2024-02-24-04:02:23-door.png" alt="#" style="width: 25px !important; height: 27px;"/>
								</div>
								<div id="idjpjz" class="gjs-cell">
									<div id="irbpw1">HLV hỗ trợ</div>
									<div id="iljcui">
										Sunny Days muốn thấy bạn đến tập mỗi ngày! Hãy cứ tập luyện nhiều nhất có thể lên tay, để thỏa đam mê Piano nhé!
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="iuqhpp" class="gjs-row">
						<div id="izmkkp" class="gjs-cell">
							<div id="igqhhy" class="gjs-row">
								<div id="iesrjl" class="gjs-cell"><img id="i1pqmu" src="/panel/laravel_page/images/2024-02-24-04:02:38-chat.png" alt="#" /></div>
								<div id="idjpjz" class="gjs-cell">
									<div id="irbpw1">HLV hỗ trợ</div>
									<div id="iljcui">
										Một buổi tập kéo dài 90 phút, trong đó học viên có thể yêu cầu HLV hỗ trợ khoảng 5-10 phút để việc tập luyện có hiệu quả.
									</div>
								</div>
							</div>
						</div>

						<div id="izmkkp" class="gjs-cell">
							<div id="igqhhy" class="gjs-row">
								<div id="iesrjl" class="gjs-cell"><img id="i1pqmu" src="/panel/laravel_page/images/2024-02-24-04:02:11-book.png" alt="#" /></div>
								<div id="idjpjz" class="gjs-cell">
									<div id="irbpw1">Tập luyện riêng tư</div>
									<div id="iljcui">
										Sử dụng tai nghe được chuẩn bị riêng cho mỗi cây đàn điện cho phép chỉ mình Học viên có thể nghe thấy tiếng đàn của mình! Tự do tập luyện mà không sợ có ai đó đang lắng nghe.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="ifc7pc" class="gjs-row sunnydays_section_detail_3" style="display: none;">
		<div id="iqb16j" class="gjs-cell">
			<div id="ircifx" class="gjs-row container">
				<div id="incl7g" class="gjs-cell"><img id="ijtqzc" src="/panel/laravel_page/images/2024-02-26-05:02:11-img-in-popup-12.png" alt="#" /></div>
				<div id="iqgm5a" class="gjs-cell">
					<div id="i3ovnh" class="gjs-row">
						<div id="ixize9" class="gjs-cell">
							<a id="i5tdyi" class="sunnydays_section_detail_close_3"><img id="i1dvwh" src="/panel/laravel_page/images/2024-02-24-01:02:26-close-button-10.png" alt="#" /></a>
						</div>
					</div>
					<div id="ik8y9p">
						DỊCH VỤ CÁ NHÂN HÓA (1-1) <br />
						LUÔN ĐỒNG HÀNH CÙNG BẠN
					</div>
					<div id="i572ln">
						Mỗi người là một câu chuyện - Tại Sunny Days, chúng tôi tin mỗi Quý Khách hàng là một cá thể độc nhất, với nhu cầu, phong cách sống, tính cách khách nhau. Do đó, chúng tôi đã xây dựng một Bảng Đánh Giá dành riêng cho
						Bạn, để chúng tôi có thể hiểu rõ hơn những điều cần chuẩn bị và đồng hành cùng Bạn một cách hiệu quả nhất trong thời gian sắp đến, chinh phục mục tiêu học Piano đã đặt ra.&nbsp;
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="ifc7pc" class="gjs-row sunnydays_section_detail_4" style="display: none;">
		<div id="iqb16j" class="gjs-cell">
			<div id="ircifx" class="gjs-row container">
				<div id="incl7g" class="gjs-cell"><img id="ijtqzc" src="/panel/laravel_page/images/2024-02-26-05:02:18-img-in-popup-13.png" alt="#" /></div>
				<div id="iqgm5a" class="gjs-cell">
					<div id="i3ovnh" class="gjs-row">
						<div id="ixize9" class="gjs-cell">
							<a id="i5tdyi" class="sunnydays_section_detail_close_4"><img id="i1dvwh" src="/panel/laravel_page/images/2024-02-24-01:02:26-close-button-10.png" alt="#" /></a>
						</div>
					</div>
					<div id="ik8y9p">
						CỘNG ĐỒNG <br />
						TRUYỀN CẢM HỨNG MỖI NGÀY
					</div>
					<div id="i572ln">
						Chúng tôi mong muốn tạo ra một không gian dành cho những thành viên cùng chia sẻ hoạt động &amp; trải nghiệm một cách thông qua việc học và tập Piano. Tại đó, Sunny Days hướng đến xây dựng một phong cách sống hiện
						đại cho những người trẻ. Không có phán xét, không có những điều tiêu cực, chỉ có sự chân thành, lắng đọng và cảm hứng mỗi ngày khiến bạn kết nối hoàn toàn với thực tại.
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="ifc7pc" class="gjs-row sunnydays_section_detail_5" style="display: none;">
		<div id="iqb16j" class="gjs-cell">
			<div id="ircifx" class="gjs-row container">
				<div id="incl7g" class="gjs-cell"><img id="ijtqzc" src="/panel/laravel_page/images/2024-02-26-05:02:29-img-in-popup-14.png" alt="#" /></div>
				<div id="iqgm5a" class="gjs-cell">
					<div id="i3ovnh" class="gjs-row">
						<div id="ixize9" class="gjs-cell">
							<a id="i5tdyi" class="sunnydays_section_detail_close_5"><img id="i1dvwh" src="/panel/laravel_page/images/2024-02-24-01:02:26-close-button-10.png" alt="#" /></a>
						</div>
					</div>
					<div id="ik8y9p">
						TRẢ GÓP <br />
						0% LÃI SUẤT
					</div>
					<div id="i572ln">
						Bên cạnh các hình thức thanh toán phổ thông (tiền mặt, chuyển khoản, sử dụng thẻ ngân hàng), Sunny Days cung cấp các hình thức trả góp 0% linh hoạt, hỗ trợ Quý Khách hàng các vấn đề về tài chính. Chương trình trả góp
						của chúng tôi cam kết không phát sinh bất kì chi phí nào, bao gồm cả phí chuyển đổi trả góp. Chúng tôi mong muốn Quý Khách hàng tiếp cận với bộ môn Piano một cách dễ dàng nhất, xóa đi sự đắn đo về vấn đề chi phí.
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /. Display none -->
@endsection

<!-- JS in page -->
@section('js')
@endSection

@push('js')
	<!-- Moment -->
	<script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
	<!-- /. Moment -->

	<!-- Date rangepicker -->
	<script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

	<!-- Tempusdominus Bootstrap 4 -->
	<script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

	<script>
		function callDaterangeBtn(startTime, endTime) {

			if (!startTime && !endTime) {
				displayText = 'Tất cả khung thời gian';
			} else {
				displayText = startTime + ' - ' + endTime;
				$('#start_time').val(startTime);
				$('#end_time').val(endTime);
			}
			
			// Cập nhật lại nội dung của #daterange-btn
			$('#daterange-btn').html('<i class="far fa-calendar-alt"></i> ' + displayText + ' <i class="fas fa-caret-down"></i>');

			$('#daterange-btn').daterangepicker({
				startDate: startTime ? moment(startTime, 'MM/DD/YYYY') : moment().subtract(100, 'years'),
				endDate: endTime ? moment(endTime, 'MM/DD/YYYY') : moment().add(100, 'years'),
				ranges: {
					'Tất cả thời gian': [moment().subtract(100, 'years'), moment().add(100, 'years')],
					'Hôm nay': [moment(), moment()]
				},
				locale: {
					customRangeLabel: 'Chọn ngày bất kỳ',
					applyLabel: 'Áp dụng',
					cancelLabel: 'Hủy',
				}
			}, function(start, end) {
				var displayText, startVal, endVal;
				if (start.isSame(moment().subtract(100, 'years'), 'day') && end.isSame(moment().add(100, 'years'), 'day')) {
					displayText = 'Tất cả khung thời gian';
					startVal = '';
					endVal = '';
				} else {
					displayText = start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY');
					startVal = start.format('DD/MM/YYYY');
					endVal = end.format('DD/MM/YYYY');
				}
				
				// Cập nhật giá trị của #start_time và #end_time
				$('#start_time').val(startVal);
				$('#end_time').val(endVal);

				// Cập nhật lại nội dung của #daterange-btn
				$('#daterange-btn').html('<i class="far fa-calendar-alt"></i> ' + displayText + ' <i class="fas fa-caret-down"></i>');
			});
		}

		function selectAddress(eventType, provinceId, districtId, wardId) {

            if (!$('#is_online').is(':checked')) {
                $('#province_id').closest('.form-group').hide();
                $('#district_id').closest('.form-group').hide();
                $('#ward_id').closest('.form-group').hide();
            }

            $('#is_online').change(function(){
                if ($(this).is(':checked')) {
                    $('#province_id').closest('.form-group').show();
                    $('#district_id').closest('.form-group').show(); 
                    $('#ward_id').closest('.form-group').show();
                } else {
                    $('#province_id').closest('.form-group').hide();
                    $('#district_id').closest('.form-group').hide();
                    $('#ward_id').closest('.form-group').hide();
                }
            });

            // Load các tỉnh khi trang web được tải xong
            var _linkGetProvince = $('meta[name="linkGetProvince"]').attr('content');
            $.ajax({
                url: _linkGetProvince, // Thay thế bằng URL thực tế
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#province_id').empty();
                    $('#province_id').append('<option selected="true" disabled>Chọn Tỉnh / Thành</option>');
                    data.forEach(function(province) {
						var selected = (provinceId && provinceId == province.id) ? 'selected' : '';
                        $('#province_id').append(`<option value="${province.id}" data-code="${province.code}" ${selected}>${province.name}</option>`);
                    });
					if (provinceId) {
						$('#province_id').change(); // Trigger sự kiện change
					}
                },
                error: function() {
                    alert('Error loading provinces');
                }
            });

            // Khi tỉnh được chọn, load các quận/huyện
            $('#province_id').change(function() {                
                var provinceId = $(this).val();
                var provinceCode = $(this).find(':selected').data('code');
                var _linkGetDistrict = $('meta[name="linkGetDistrict"]').attr('content').replace('_provinceCode', provinceCode);
                $.ajax({
                    url: _linkGetDistrict,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#district_id').empty();
                        $('#district_id').append('<option selected="true" disabled>Chọn Quận / Huyện</option>');
                        data.forEach(function(district) {
							var selected = (districtId && districtId == district.id) ? 'selected' : '';
                            $('#district_id').append(`<option value="${district.id}" data-code="${district.code}" ${selected}>${district.name}</option>`);
                        });
						if (districtId) {
							$('#district_id').change(); // Trigger sự kiện change
						}
                    },
                    error: function() {
                        alert('Error loading districts');
                    }
                });
            });

            // Khi quận/huyện được chọn, load các phường/xã
            $('#district_id').change(function() {
                var districtId = $(this).val();
                var districtCode = $(this).find(':selected').data('code'); // Lấy giá trị của thuộc tính 'data-code'
                var _linkGetWard = $('meta[name="linkGetWard"]').attr('content').replace('_districtCode', districtCode);
                $.ajax({
                    url: _linkGetWard, // Sử dụng giá trị 'code' trong URL
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#ward_id').empty();
                        $('#ward_id').append('<option selected="true" disabled>Chọn Phường / Xã</option>');
                        data.forEach(function(ward) {
							var selected = (wardId && wardId == ward.id) ? 'selected' : '';
                            $('#ward_id').append(`<option value="${ward.id}" data-code="${ward.code}" ${selected}>${ward.name}</option>`);
                        });
                    },
                    error: function() {
                        alert('Error loading wards');
                    }
                });
            });
        }

		function showHideLocation() {
			$('#event_type').on('change', function() {
				var eventType = $(this).val();
				var filterLocationRow = $('.filter-location');
				$('#province_id').val('');
				$('#district_id').val('');
				$('#ward_id').val('');

				$('#province_id').prop('selectedIndex', 0);
				$('#district_id').prop('selectedIndex', 0);
				$('#ward_id').prop('selectedIndex', 0);

				if (eventType === 'offline') {
					filterLocationRow.show();
				} else {
					filterLocationRow.hide();
				}
			});
		}

		function filterPanigane() {
			$(document).on('click', '.page-link', function(event) {
                event.preventDefault();
                let _that = $(this);
                let page = _that.attr('href').split('page=')[1];
                let inputId = window.innerWidth <= 767 ? 'search-news-input-mobile' : 'search-news-input';
                let _keyword = $('#' + inputId).val();
				var _linkEvents = $('meta[name="linkEvents"]').attr('content');
                $.ajax({
                    url: _linkEvents,
                    data: {
                        page: page,
                        keyword: _keyword
                    },
                    type: "GET",
                    success: function(response) {
                        $('.list-event').html(response.data);
                        let nextPage = parseInt(page) + 1;
                        let prevPage = parseInt(page) - 1;
                        updatePaginationState(page, _that.attr('data-last'));
                        updateNextButton(nextPage, _that.attr('data-last'));
                        updatePrevButton(prevPage);
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi ở đây
                        console.error(error);
                    }
                });
            });
		}

		function initPaginationState() {
			let currentPage = 1; // Giả định trang ban đầu là trang 1
			let lastPage = $('.page-link').last().attr('data-last');
			updatePaginationState(currentPage, lastPage);
		}

		function updatePrevButton(prevPage) {
			if(prevPage >= 1) {
				$('.page-pre .page-link').attr('href', '{{ url("tin-tuc?page=") }}' + prevPage).show();
				$('.page-pre').show();
			} else {
				$('.page-pre').hide();
			}
		}

		function updateNextButton(nextPage, lastPage) {

			if(nextPage <= lastPage) {
				$('.page-next .page-link').attr('href', '{{ url("tin-tuc?page=") }}' + nextPage);
				$('.page-next').show();
			} else {
				$('.page-next').hide();
			}
		}

		function updatePaginationState(currentPage, lastPage) {
			currentPage = parseInt(currentPage);
			lastPage = parseInt(lastPage);

			// Ẩn hoặc hiển thị nút 'Previous'
			if (currentPage <= 1) {
				$('.page-pre').hide();
			} else {
				$('.page-pre').show();
			}

			// Đặt trang hiện tại là 'active'
			$('.page-item').removeClass('active');
			$('.page-item').each(function() {
				let page = $(this).find('.page-link').attr('data-current');
				if (page && parseInt(page) === currentPage) {
					$(this).addClass('active');
				}
			});
		}

		function clickFormSeachSubmit() {
			$('#event_type, #province_id, #district_id, #ward_id').on('change', function() {
				$('#form-search').submit();
			});

			$('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {
				var startDate, endDate;

				// Lấy ngày bắt đầu và kết thúc từ picker
				if (picker.chosenLabel === 'Hôm nay') {
					startDate = moment();
					endDate = moment();
				} else if (picker.chosenLabel === 'Tuần này') {
					startDate = moment().startOf('week');
					endDate = moment().endOf('week');
				} else if (picker.chosenLabel === 'Tháng này') {
					startDate = moment().startOf('month');
					endDate = moment().endOf('month');
				} else if (picker.chosenLabel === 'Ngày mai') {
					startDate = moment().add(1, 'days');
					endDate = moment().add(1, 'days');
				} else {
					// Lấy ngày bắt đầu và kết thúc từ picker cho các tùy chọn khác
					startDate = picker.startDate;
					endDate = picker.endDate;
				}

				// Đẩy ngày bắt đầu và kết thúc vào form
				$('#form-search').append('<input type="hidden" name="start_date" value="' + startDate.format('YYYY-MM-DD') + '">');
				$('#form-search').append('<input type="hidden" name="end_date" value="' + endDate.format('YYYY-MM-DD') + '">');

				// Gọi hàm submit form
				$('#form-search').submit();
			});
		}

		function btnClickFormSearchSubmit() {
			$('#form-search').on('submit', function(event) {
				event.preventDefault();
				var isFilterButtonClicked = $(event.originalEvent.explicitOriginalTarget).hasClass('btn-filter');
				this.submit();
			});
		}

		function clickToDetail() {
			$('body').on('click', '.card-event', function() {
				var url = $(this).attr('data-url');
				window.location.href = url;
			});
		}

		function redirectToUrl(event) {
			var url = event.currentTarget.getAttribute('data-url');
			if (url) {
				window.location.href = url;
			}
		}


		function loadParamsFilter(eventType, provinceId, districtId, wardId) {
			var filterLocationRow = $('.filter-location');
			$('#event_type').val(eventType);
			if (eventType === 'offline') {
				$('#province_id').val(provinceId);
				$('#district_id').val(districtId);
            	$('#ward_id').val(wardId);
				filterLocationRow.show();
			} else {
				filterLocationRow.hide();
			}
		}

		
		$(function () {
			var urlParams = new URLSearchParams(window.location.search);
			var startTime = urlParams.get('start_time');
			var endTime = urlParams.get('end_time');

			callDaterangeBtn(startTime, endTime);
			initPaginationState();
			filterPanigane();
			clickToDetail();
		});


	</script>
@endpush
<!-- /. JS in page -->