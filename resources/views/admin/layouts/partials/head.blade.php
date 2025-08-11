@include('admin.layouts.partials.meta')

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('assets/admin/img/logo.png') }}" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
    rel="stylesheet" />

<!-- Icons -->
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/fontawesome.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/tabler-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/flag-icons.css') }}" />

<!-- Core CSS -->

<link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/rtl/core.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/rtl/theme-default.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/node-waves/node-waves.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/apex-charts/apex-charts.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/swiper/swiper.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet"
    href="{{ asset('assets/admin/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet"
    href="{{ asset('assets/admin/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/toastr/toastr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/animate-css/animate.css') }}" />

<!-- Page CSS -->
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/pages/cards-advance.css') }}" />

<!-- Helpers -->
<script src="{{ asset('assets/admin/vendor/js/helpers.js') }}"></script>
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets/admin/js/config.js') }}"></script>

<!-- In page -->
@yield('css')
@stack('css')
