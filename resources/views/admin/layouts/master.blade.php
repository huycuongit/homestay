<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/admin/assets" data-template="vertical-menu-template-no-customizer"
    data-style="light">

<head>
    @include('admin.layouts.partials.head')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin.layouts.partials.menu')
            <!-- /. Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('admin.layouts.partials.nav')
                <!-- /. Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')
                    <input type="hidden" id="route-is" value="{{ Route::currentRouteName() }}" />
                    <!-- /. Content -->

                    <!-- Footer -->
                    @include('admin.layouts.partials.footer')
                    <!-- /. Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- /. Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- /. Layout wrapper -->

    <!-- Modal Logout -->
    <div class="modal fade" id="modalLogout" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Đăng xuất</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <p>Bạn có chắc muốn đăng xuất khỏi hệ thống không ?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Thoát
                        </button>
                        <button type="submit" class="btn btn-danger">Đăng xuất</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /. Modal Logout -->

    <!-- Core JS -->
    @include('admin.layouts.partials.js')
    <!-- /. Core JS -->
</body>

</html>
