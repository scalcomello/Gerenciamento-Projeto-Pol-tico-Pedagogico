

<!-- FastClick -->
<script src="{{ asset ("/plugins/fastclick/fastclick.js") }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("/dist/js/app.min.js") }}" type="text/javascript"></script>
<!-- Sparkline -->
<script src="{{ asset ("/plugins/sparkline/jquery.sparkline.min.js") }}" type="text/javascript"></script>
<!-- jvectormap -->
<script src="{{ asset ("/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/plugins/jvectormap/jquery-jvectormap-world-mill-en.js") }}" type="text/javascript"></script>

<!-- ChartJS 1.0.1 -->
<script src="{{ asset ("/plugins/chartjs/Chart.min.js") }}" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset ("/dist/js/pages/dashboard2.js") }}" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ("/dist/js/demo.js") }}" type="text/javascript"></script>

<!-- jQuery 2.2.3 -->
<script src="{{ asset ("/plugins/jQuery/jquery-2.2.3.min.js") }}" type="text/javascript" ></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset ("/bootstrap/js/bootstrap.min.js") }}" type="text/javascript" ></script>
<!-- DataTables -->
<script src="{{ asset ("/plugins/datatables/jquery.dataTables.min.js") }}" type="text/javascript" ></script>
<script src="{{ asset ("/plugins/datatables/dataTables.bootstrap.min.js") }}" type="text/javascript" ></script>
<!-- SlimScroll -->
<script src="{{ asset ("/plugins/slimScroll/jquery.slimscroll.min.js") }}"  type="text/javascript" ></script>



<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/plugins/morris/morris.min.js"></script>


<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>





<!-- iCheck -->
<script src="/plugins/iCheck/icheck.min.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>


<!-- jQuery 2.2.3 -->
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>




<script>



    $(function () {
        $("#example1").DataTable({      "oLanguage": {
            "sProcessing":   "Processando...",
            "sLengthMenu":   "Mostrar _MENU_ registros",
            "sZeroRecords":  "Não foram encontrados resultados",
            "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix":  "",
            "sSearch":       "Buscar:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Seguinte",
                "sLast":     "Último"
            }
        }});

    });

</script>