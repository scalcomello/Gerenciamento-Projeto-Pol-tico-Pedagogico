@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <center> SGPPC - Sistema Gerenciamento do Projeto Pedagógico de Curso Superior </center>

        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-home"></i>Início</a></li>
        </ol>
    </section>
@endsection
@section('content_page')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Default Box Example</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <span class="label label-primary">Label</span>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            The body of the box
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            The footer of the box
        </div>
        <!-- box-footer -->
    </div>
    <!-- /.box -->


        @endsection


        @section('scripts')

            <script type="text/javascript">
                $(function () {
                    //alert('Teste section');
                });
            </script>

@endsection