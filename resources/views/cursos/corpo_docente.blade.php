@extends('adminlte::page')

@section('title', 'Usuários')


@section('content_header')

        <h1>{{$curso->denominacao}} - Colaboradores</h1>
        <ol class="breadcrumb">
            <li><a href="../../../cursos"><i class="fa fa-graduation-cap"></i>Cursos</a></li>
            <li class="active"><a href="../gerenciar"><i class=""></i>Gerenciar</a></li>
            <li class="active"><a href="corpo_docente"><i class=""></i>Corpo Docente</a></li>
        </ol>
    </section>
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-header with-border">
                            @if(Request::is('*/editar'))
                                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Atualizar</h3>
                            @else
                                <i class="fa fa-user-plus"></i>   <h3 class="box-title">Cadastrar Professor</h3>
                            @endif
                        </div>


                            {!! Form::open(array('route' => 'curso.store_corpodocente', 'class' => 'form-horizontal')) !!}


                        <div class="fetched-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                @if(Session::has('mensagem_sucesso'))

                                    <div class="callout callout-success">
                                        {{ Session::get('mensagem_sucesso') }}
                                    </div>

                                @endif
                                <div class="form-group{{ $errors->has('pessoas_id') ? ' has-error' : '' }}">
                                    {!!  Form::label('pessoas_id','Professor',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">
                                        {{ Form::select('pessoas_id' ,$pessoas_nome,null,['class' => 'form-control'])  }}
                                        @if ($errors->has('pessoas_id'))
                                            <span class="help-block"><strong>{{ $errors->first('pessoas_id') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                    {{ Form::hidden('cursos_id',$curso) }}

                                <div class="box-footer">

                                        {!! Form::submit('Cadastrar', ['class' => 'btn btn-info' ]) !!}

                                </div>
                                {!! @Form::close() !!}
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>




                <div class="col-md-13">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Titulação e regime de trabalho dos docentes</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">

                            <table class="table table-bordered">
                                <tr>

                                    <th>Professor</th>
                                    <th>Titulação Máxima</th>
                                    <th>Regime de Trabalho</th>

                                    <th width="50" >Ação</th>
                                </tr>

                                @foreach($corpodocente as $rows)
                                    <tr>

                                        <td>{{$rows->pessoa->nome}}</td>
                                        <td></td>
                                        <td></td>

                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' =>'/cursos/corpo_docente/'. $rows->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                        </td>

                                    </tr>
                                @endforeach

                            </table>
                        </div>

                    </div>

                </div>
            </div>
    </section>
    <!-- /.box -->


@stop

@section('css')
    <link rel="stylesheet" href="#">
@stop

@section('js')
    <script>  </script>
@stop