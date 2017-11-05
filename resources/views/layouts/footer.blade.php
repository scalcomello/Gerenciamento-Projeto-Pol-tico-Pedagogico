<!-- Main Footer -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <!--  Ano.Mes.Dia.Estado.-->
        <b>Versão</b> 17.03.11-Beta
    </div>
    <strong>Desenvolvido por: <a href="#">Tiago Scalco</a> - Copyright © 2016-2017. Todos os direitos
        reservados.</strong>


</footer>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

</div>

<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>

<!-- PACE -->
<script src="/plugins/pace/pace.min.js"></script>
<script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function () {
        Pace.restart();
    });
    $('.ajax').click(function () {
        $.ajax({
            url: '#', success: function (result) {
                $('.ajax-content').html('<hr>Ajax Request Completed !');
            }
        });
    });


</script>

<!-- DataTables -->
<script src="{{ asset ("/plugins/datatables/jquery.dataTables.min.js") }}" type="text/javascript" ></script>
<script src="{{ asset ("/plugins/datatables/dataTables.bootstrap.min.js") }}" type="text/javascript" ></script>




<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>


<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>


</body>
</html>