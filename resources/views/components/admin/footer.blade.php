
<script src="{{ asset('admin/assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/jquery.uploader.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/dropzone.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/apexcharts.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/moment.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/daterangepicker.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script src="{{ asset('admin/assets/vendor/js/aos.js') }}"></script>
@yield('admin.js')
<script src="{{ asset('admin/assets/js/main.js') }}"></script>
<!-- for demo purpose -->
<script>
    var rtlReady = $('html').attr('dir', 'ltr');
    if (rtlReady !== undefined) {
        localStorage.setItem('layoutDirection', 'ltr');
    }
</script>
<!-- for demo purpose -->
</body>
</html>
