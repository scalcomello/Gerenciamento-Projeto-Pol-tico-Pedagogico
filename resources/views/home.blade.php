@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Inicío</h1>
    <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-home"></i>Início</a></li>
    </ol>
@stop

@section('content')

    @include('adminlte::mensage')

    <!-- Main content -->

    <!-- box -->
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-header with-border">
                <i class="fa fa-bars"></i>
                <h3 class="box-title">Sistema Gerenciamento do Projeto Pedagógico de Curso - SGPPC </h3>
            </div>

            <div class="box-body">

                <h2>O Projeto</h2>

                <p>Trata-se de um projeto de conclusão de curso (TCC) feito durante o ano de 2016/2017 no IFSULDEMINAS
                    campus Machado no curso de Licenciatura em Computação.
                </p>
                <h2> Objetivos</h2>

                <p>O software tem objetivo de auxiliar na construção e padronização de documentos de gestão escolar, mas
                    especificamente os Projetos Pedagógicos de Curso (PPC), buscando consolidar as diretrizes para a
                    elaboração dos PPCs do IFSULDEMINAS Campus Machado.Com finalidade de auxiliar todos os envolvidos na
                    gestão do Progeto Político de Curso, permitindo acompanhar o processo desda sua
                    elaboração/atualização até sua efetiva conclusão. O gerenciamento abrange informações completas
                    sobre o projeto político de curso, tais como os dados da (instituição, servidores, cursos,
                    professores etc.), o sistema permite que acompanhe a evolução do projeto e as alterações realizadas.
                    É importante observar que todos os tipos de exigencias feitas pelo Ministerio da Educação (MEC) já
                    estão previamente definidos no SGPPC, assim como os moldes do projeto.
                </p>
                <p><a>TCC escrito</a></p>
                <p><a>Trailer do software</a></p>

                <p> Tecnologias utilizadas:  </p>

                <ul>
                    <li>PHP 7</li>
                    <li>PHPDOCX</li>
                    <li>HTML5</li>
                    <li>CSS3</li>
                    <li>Bootstrap</li>
                    <li>ChartJs</li>
                    <li>CKeditor</li>
                    <li>Pace</li>
                    <li>Adminlte</li>
                    <li>MySQL</li>

                </ul>


                <h2>Funcionalidades</h2>

                <p>O Sistema de Gerenciamento do Projetos Político de Curso (SGPPC) dispõe das seguintes funcionalidades
                    principais:</p>
                <p> Gerenciamento de Pessoas</p>
                <p> Controle de Acesso configurável</p>
                <p> Gerenciamento de Instituições</p>

                <h2>Licensia do Software</h2>
                <p>O SGPPC é um sistema web com licença de software livre <a
                            href="https://github.com/scalcomello/Gerenciamento-Projeto-Pol-tico-Pedagogico/blob/master/LICENSE">GNU
                        General Public License v3.0</a></p>

                <p>Visite a seção de lançamentos no <a
                            href="https://github.com/scalcomello/Gerenciamento-Projeto-Pol-tico-Pedagogico">Github e
                        baixe a versão mais recente.</a></p>
            </div>

        </div>
    </div>


    <!-- box -->
    <div class="col-md-13">
        <div class="box box-primary">
            <div class="box-header">

                <div class="box-header with-border">
                    <i class="fa fa-clipboard"></i>
                    <h3 class="box-title">Comentarios</h3>
                    <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal" title="Escrever comentario">
                        <i class="fa fa-paper-plane-o"></i> Comentar
                    </button>
                </div>


                    @foreach($count as $rows)
                        <div class="col-md-11">
                            <div class="box box-solid">
                                <div class="box-header with-border">

                                    @can('edit-comentario', $rows)
                                        {!! Form::open(['id' => 'remove','method'=>'DELETE', 'url' => '/home/'.$rows->id]) !!}

                                        <a class="pull-right" title="Excluir" href="#"
                                           onclick="document.getElementById('remove').submit();"
                                           onclick="return confirm('Deseja remover seu comentario?')"
                                           title="Excluir"
                                        > <i class="fa fa-close"></i></a>

                                        {!! Form::close() !!}
                                    @endcan

                                    <i class="fa fa-user bg-blue"></i>

                                    <h3 class="box-title">{!! $rows->usuario->name !!}</h3>
                                    <span class="time"><i
                                                class="fa fa-clock-o"></i> {!! $rows->hora.'/'. $rows->data !!}</span>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <dl>
                                        {!! $rows->nota !!}
                                    </dl>

                                    @can('edit-comentario', $rows)
                                        <a class="pull-right" href="{{ route('edit', ['id' => $rows->id ]) }}"
                                           data-hover="tooltip"
                                           data-placement="top"
                                           data-target="#myModal2{{$rows->id }}"
                                           data-toggle="modal" title="Editar"
                                        > Editar</a>
                                    @endcan

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    @endforeach
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
                        <h4 class="modal-title" id="myModalLabel">Escreva sua mensagem</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(array('route' => 'notificacao', 'class' => 'form-horizontal')) !!}
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('nota') ? 'has-error' : '' }}">
                                <p>Mensagem:</p>
                                {{ Form::textarea('nota', null,['id' => 'editor1', 'rows' => 4, 'cols' => 90, 'style' => 'resize:none']) }}
                                {{ $errors->first('nota', '<span class="help-block">:message</span>') }}
                            </div>
                            {{ Form::hidden('usuario',Auth::user()->id) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                        {!! Form::submit('Publicar', ['class' => 'btn btn-info' ]) !!}
                    </div>
                    {!! @Form::close() !!}
                </div>
            </div>
        </div>



    @foreach($count as $rows)
        <!--Edit Modal -->
        <div class="modal fade" id="myModal2{{$rows->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Escreva sua mensagem</h4>
                    </div>
                    <div class="modal-body">

                        {!! Form::model($rows,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'home/'.$rows->id]) !!}

                        {{ csrf_field() }}

                        <div class="box-body">
                            <div class="form-group {{ $errors->has('nota') ? 'has-error' : '' }}">
                                <p>Mensagem:</p>
                                {{ Form::textarea('nota', null,[ 'rows' => 4, 'cols' => 90, 'style' => 'resize:none']) }}
                                {{ $errors->first('nota', '<span class="help-block">:message</span>') }}
                            </div>
                            {{ Form::hidden('usuario',Auth::user()->id) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                        {!! Form::submit('Salvar', ['class' => 'btn btn-info' ]) !!}
                    </div>
                    {!! @Form::close() !!}
                </div>
            </div>
        </div>
    @endforeach

@stop

@section('css')

@stop
@section('js')

@stop