<!-- Bootstrap JS -->
<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-validate.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/chartjs/chart.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-knob/excanvas.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-knob/jquery.knob.js') }}"></script>
<script src="{{ asset('assets/admin/js/index.js') }}"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
          'use strict'

          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.querySelectorAll('.needs-validation')

          // Loop over them and prevent submission
          Array.prototype.slice.call(forms)
            .forEach(function (form) {
              form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                  event.preventDefault()
                  event.stopPropagation()
                }

                form.classList.add('was-validated')
              }, false)
            })
        })()
</script>
<!--app JS-->
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<!--admin JS-->
<script src="{{ asset('assets/admin/js/application_admin.js') }}"></script>
