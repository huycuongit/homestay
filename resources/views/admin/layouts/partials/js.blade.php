<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/js/menu.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/admin/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/admin/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/admin/js/forms-selects.js') }}"></script>

<!-- Js __construct -->
<script>
    function comfirmLogout() {
        $('.nav-logout').on('click', function(e) {
            e.preventDefault();
        });
    }

    function notImplemented() {
        $('.not-implemented').click(function(event) {
            event.preventDefault();
            alert('Tính năng đang triển khai');
        });
    }

    $(function() {
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });

        //-- Setup CKFinder & CkEditor
        var _routeIs = $('#route-is').val();
        if (_routeIs !== 'admin.dashboard.index') {
            // allFunctionCkfinder();
            // selectAllCKeditors();
        }

        //-- Logout
        comfirmLogout();

        //-- Not Implemented
        notImplemented();
    })
</script>
<!-- /. Js __construct -->

@yield('js')
@stack('js')
