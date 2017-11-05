@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <center>SGPPC - Sistema Gerenciamento do Projeto Pedagógico de Curso Superior</center>

        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-home"></i>Início</a></li>
        </ol>
    </section>
@endsection
@section('content_page')

    <!-- Main content -->
    <div class="col-md-12 ">

        <div class="box box-primary">
            <div class="box-header with-border">
                    <i class="fa fa-clipboard"></i>
                    <h3 class="box-title">Notificação</h3>

                    <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-bullhorn"></i>
                        Notificar
                    </button>

                </div>


                <div class="container">

                    @foreach($count as $rows)

                        <div class="col-md-11">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <i class="fa fa-user bg-blue"></i>

                                    <span class="bg-red pull-right">
            {!! $rows->data !!}
        </span>
                                    <h3 class="box-title">{!! $rows->usuario !!}</h3>
                                    <span class="time"><i class="fa fa-clock-o"></i> {!! $rows->hora !!}</span>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <dl>
                                        {!! $rows->nota !!}
                                    </dl>

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>

                @endforeach



                <!-- timeline time label -->


                    <!-- /.timeline-label -->


                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Notificação</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(array('route' => 'notificacao', 'class' => 'form-horizontal')) !!}
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('nota') ? 'has-error' : '' }}">
                                {{ Form::label('nota', 'Mensagem', ['class'=>'control-label']) }}
                                {{ Form::textarea('nota', null,['id' => 'editor1', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) }}
                                {{ $errors->first('nota', '<span class="help-block">:message</span>') }}
                            </div>
                            {{ Form::hidden('usuario',Auth::user()->name) }}


                            {!! Form::submit('Salvar', ['class' => 'btn btn-info' ]) !!}


                            {!! @Form::close() !!}
                        </div>
                        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace('editor1');
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        @endsection


        @section('scripts')

            <script type="text/javascript">
                $(function () {
                    //alert('Teste section');
                });
            </script>

@endsection