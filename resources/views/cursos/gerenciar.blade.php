@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$nomecurso->denominacao}}

        </h1>
        <ol class="breadcrumb">
            <li><a href="../../cursos"><i class="fa fa-graduation-cap"></i>Cursos</a></li>
            <li class="active"><a href="gerenciar"><i class=""></i>Gerenciar</a></li>

        </ol>
    </section>


@endsection
@section('content_page')



    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Gerenciar</h3>


            <button title="Gerar Docx do PPC" type="button" onclick="location.href='/cursos/{{$curso}}/gerenciar/download';" class="btn btn-default pull-right"  data-toggle="modal" data-target="#myModalLabel"><a></a><i class="fa fa-download"></i>
                Download
            </button>

        </div>

        <section class="content">
            <div class="row">





                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-lime-active">
                                <div class="inner">

                                    <h4>Estrutura Curricular</h4>
                                   <br><br>
                                </div>
                                <div class="icon">
                                    {!! Html::image('../bootstrap/icon/attach.png') !!}

                                </div>
                                <a href="gerenciar/estrutura_curricular" class="small-box-footer">Acessar<i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua-active">
                                <div class="inner">


                                    <h4>Legislação</h4>
                                    <br><br>

                                </div>
                                <div class="icon">
                                    {!! Html::image('/bootstrap/icon/weight-balance.png') !!}
                                </div>
                                <a href="gerenciar/legislacao" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-gray-active">
                                <div class="inner">


                                    <h4>Corpo Docente</h4>
                                    <br><br>
                                </div>
                                <div class="icon">
                                    {!! Html::image('bootstrap/icon/classroom.png') !!}
                                </div>
                                <a href="gerenciar/corpo_docente" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red-active">
                                <div class="inner">


                                    <h4>Estrutura Documental</h4>
                                    <br><br>
                                </div>
                                <div class="icon">
                                    {!! Html::image('bootstrap/icon/workflow.png') !!}
                                </div>
                                <a href="gerenciar/estrutura_documental" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->


                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-orange-active">
                                <div class="inner">
                                    <h4>Corpo Administrativo </h4>
                                    <br><br>
                                </div>
                                <div class="icon">
                                    {!! Html::image('bootstrap/icon/group-of-people-in-a-formation.png') !!}
                                </div>
                                <a href="gerenciar/corpo_administrativo" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green-active">
                                <div class="inner">


                                    <h4>Equipe Organizadora</h4>
                                    <br><br>
                                </div>
                                <div class="icon">
                                    {!! Html::image('bootstrap/icon/group.png') !!}
                                </div>
                                <a href="gerenciar/equipe_organizadora" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple-active">
                                <div class="inner">


                                    <h4>Coordenação</h4>
                                    <br><br>
                                </div>
                                <div class="icon">
                                    {!! Html::image('bootstrap/icon/manager.png') !!}
                                </div>
                                <a href="gerenciar/coordenacao" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>


                    </div>





    </div>
        </section>
    </div>




@endsection

@section('scripts')

    <script type="text/javascript">
        $(function () {
            //alert('Teste section');
        });
    </script>

@endsection