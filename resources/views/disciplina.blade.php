@extends('adminlte::page')

@section('title', 'Usuários')


@section('content_header')

        <h1>Disciplinas</h1>
        <ol class="breadcrumb">
            <li><a href="disciplina"><i class="fa fa-list-alt"></i>Disciplina</a></li>
        </ol>

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
                                <i class="fa fa-pencil-square-o"></i>       <h3 class="box-title">Atualizar</h3>
                            @else
                                  <h3 class="box-title">Cadastrar Disciplina</h3>
                            @endif
                        </div>



                        @if(Request::is('*/editar'))
                            {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'disciplina/'.$edit->id]) !!}
                        @else
                            {!! Form::open(array('route' => 'disciplina.store', 'class' => 'form-horizontal')) !!}
                        @endif

                        <div class="fetched-data">

                            {{ csrf_field() }}
                            <div class="box-body">
                                <!-- Mensagem de Ação -->
                                @if(Session::has('mensagem_sucesso'))
                                    <div class="callout callout-success">
                                        {{ Session::get('mensagem_sucesso') }}
                                    </div>
                                @elseif(Session::has('mensagem_update'))
                                    <div class="callout callout-warning">
                                        {{ Session::get('mensagem_update') }}
                                    </div>
                                @elseif(Session::has('mensagem_destroy'))
                                    <div class="callout callout-danger">
                                        {{ Session::get('mensagem_destroy') }}
                                    </div>
                                @endif

                                    <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                        {!!  Form::label('nome','Nome',array('class' => 'col-sm-2 control-label')) !!}
                                        <div class="col-sm-4">
                                            {!! Form::input('text','nome',old('nome'),array('class' => 'form-control','placeholder' => ''))!!}
                                            @if ($errors->has('nome'))
                                                <span class="help-block"><strong>{{ $errors->first('nome') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                <div class="box-footer">
                                    @if(Request::is('*/editar'))
                                        <a class="btn btn-default btn-close" href="{{ route('disciplina.index') }}">Cancelar</a>
                                        {!! Form::submit('Atualziar', ['class' => 'btn btn-info' ]) !!}
                                    @else
                                        {!! Form::submit('Cadastrar', ['class' => 'btn btn-info' ]) !!}
                                    @endif
                                </div>
                                {!! @Form::close() !!}
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>


    <div class="col-md-13">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Disciplinas Cadastradas</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">

                <table id="tabela2" class="table table-bordered table-striped">
                    <thead>
                    <tr>

                        <th>Disciplinas</th>
                        <th>Ação</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($disciplinas as $rows)
                        <tr>

                            <td>{{$rows->nome}}</td>


                            <td width="50"> <div class="tools">
                                    <a href="{{ route('disciplina.edit', ['id' => $rows->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                </div>
                            </td>
                            <td width="50">
                                {!! Form::open(['method'=>'DELETE', 'url' => '/disciplina/'.$rows->id]) !!}

                                <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover a legislação {{$rows->lei}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                {!! Form::close() !!}
                            </td>


                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <th>Disciplinas</th>
                    <th>Ação</th>
                    </tfoot>
                </table>
            </div>

        </div>

    </div></div>
    </div>
    </section>
    <!-- /.box -->

    <script>
        $(function () {
            $("#tabela2").DataTable({      "oLanguage": {
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

@stop

@section('css')
    <link rel="stylesheet" href="#">
@stop

@section('js')
    <script>  </script>
@stop