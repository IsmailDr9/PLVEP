<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.3-pre
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url('design/adminpanel/plugins/jquery/jquery.min.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{url('design/adminpanel/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<link rel="stylesheet" href="{{url('design/adminpanel/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<script src="{{url('design/adminpanel/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{url('design/adminpanel/plugins/datatables/dataTables.buttons.min.js')}}"></script>

<script src="{{url('design/adminpanel/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script src="{{url('')}}/vendor/datatables/buttons.server-side.js"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('design/adminpanel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('design/adminpanel/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('design/adminpanel/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('design/adminpanel/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('design/adminpanel/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('design/adminpanel/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('design/adminpanel/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('design/adminpanel/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('design/adminpanel/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('design/adminpanel/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('design/adminpanel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('design/adminpanel/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('design/adminpanel/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('design/adminpanel/dist/js/demo.js')}}"></script>
<script src="{{url('design/adminpanel/dist/js/myFunction.js')}}"></script>
<script src="{{url('design/adminpanel/jstree/jstree.js')}}"></script>
<script src="{{url('design/adminpanel/jstree/jstree.wholerow.js')}}"></script>
<script src="{{url('design/adminpanel/jstree/jstree.checkbox.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

@stack('js')
@stack('css')
</body>
</html>
