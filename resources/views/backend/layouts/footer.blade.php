<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y');?> <a href="{{url('/dashboard')}}">@if(systemSetting()->app_name){{systemSetting()->app_name}} @else {{ env('APP_NAME') }}  @endif </a>All rights reserved</strong>
    <div class="float-right d-none d-sm-inline-block">
        <b>Developed By: </b> Narendra
    </div>
@yield('js')


    <!-- jQuery -->
    <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('theme-design/js/adminlte.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('plugins/jquery-repeater/src/lib.js')}}" type="text/javascript"></script>
    <script src="{{url('plugins/jquery-repeater/src/jquery.input.js')}}" type="text/javascript"></script>
    <script src="{{url('plugins/jquery-repeater/src/repeater.js')}}" type="text/javascript"></script>

    <script src="{{url('js/repeater.js')}}"></script>
    <!-- Toastr -->
    <script src="{{url('plugins/toastr/toastr.min.js')}}"></script>
    <!-- Select2 -->
    <script src={{url("plugins/select2/js/select2.full.js")}}></script>
    <!-- English Datepicker -->
    <script type="text/javascript"
            src="{{asset('plugins/english-datepicker/english-datepicker.min.js')}}"></script>
    <script src={{url("plugins/bootstrap-toggle/js/bootstrap-toggle.js")}}></script>
    <!-- summernote -->
    <script src="{{url('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{url('js/date_converter.js')}}"></script>
    <script src="{{url('js/custom_app.js')}}"></script>

    <script src="{{asset('/plugins/nepali-datepicker/nepali.datepicker.v3.7.min.js')}}" type="text/javascript"></script>

</footer>
