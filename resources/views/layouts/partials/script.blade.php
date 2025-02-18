
<!-- Bootstrap js -->
<script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>

<!-- Apex Chart js -->
<script src="{{ asset('assets/js/lib/apexcharts.min.js') }}"></script>
<!-- Data Table js -->
<script src="{{ asset('assets/js/lib/dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>
<script  src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
<script  src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
<!-- Iconify Font js -->
<script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>
<!-- jQuery UI js -->
<script src="{{ asset('assets/js/lib/jquery-ui.min.js') }}"></script>
<!-- Vector Map js -->
<script src="{{ asset('assets/js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- Popup js -->
<script src="{{ asset('assets/js/lib/magnifc-popup.min.js') }}"></script>
<!-- Slick Slider js -->
<script src="{{ asset ('assets/js/lib/slick.min.js') }}"></script>
<!-- main js -->
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{ asset ('assets/js/homeOneChart.js') }}"></script>
<script src="{{asset('assets/js/flatpickr.js')}}"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": "5000",
        "positionClass": "toast-top-center",
    };
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>

