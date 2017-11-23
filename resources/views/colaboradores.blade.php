@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
        <h1>Colaboradores</h1>
        <ol class="breadcrumb">
            <li><a href="colaboradores"><i class="fa  fa-male"></i> Colaboradores</a></li>
        </ol>
@stop

@section('content')
        <div class="row">

                @if(Request::is('*/editar'))
                @can('edit_colaborador')
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <div class="box-header with-border">
                                        <i class="fa fa-pencil-square-o"></i>       <h3 class="box-title">Atualizar</h3>
                                </div>

                                    {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'colaboradores/'.$edit->id]) !!}

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
                                            <div class="col-sm-6">
                                                {!! Form::input('text','nome',old('nome'),array('class' => 'form-control','placeholder' => 'Nome do colaborador'))!!}
                                                @if ($errors->has('nome'))
                                                    <span class="help-block"><strong>{{ $errors->first('nome') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
                                            {!!  Form::label('cargo','Cargo',array('class' => 'col-sm-2 control-label')) !!}
                                            <div class="col-sm-6">
                                                {{ Form::select('cargo' ,[
                                                                                'professor' => 'Professor',
                                                                                'administrativo' => 'Administrativo',
                                                                                'outros' => 'Outros',

                                                                                ],'Professor',['class' => 'form-control'])
                                                                             }}

                                                @if ($errors->has('cargo'))
                                                    <span class="help-block"><strong>{{ $errors->first('cargo') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="box-footer">
                                                <a class="btn btn-default btn-close" href="{{ route('colaboradores.index') }}">Cancelar</a>
                                                {!! Form::submit('Atualziar', ['class' => 'btn btn-info' ]) !!}
                                        </div>
                                        {!! @Form::close() !!}
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>
                        @endcan


                        @else
                            @can('store_colaborador')
                                <div class="col-md-12">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <div class="box-header with-border">

                                                @if(Request::is('*/editar'))
                                                    <i class="fa fa-pencil-square-o"></i>       <h3 class="box-title">Atualizar</h3>
                                                @else
                                                    <i class="fa fa-user-plus"></i>   <h3 class="box-title">Cadastrar Colaborador</h3>
                                                @endif
                                            </div>

                                            @if(Request::is('*/editar'))
                                                {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'colaboradores/'.$edit->id]) !!}
                                            @else
                                                {!! Form::open(array('route' => 'colaboradores.store', 'class' => 'form-horizontal')) !!}
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
                                                        <div class="col-sm-6">
                                                            {!! Form::input('text','nome',old('nome'),array('class' => 'form-control','placeholder' => 'Nome do colaborador'))!!}
                                                            @if ($errors->has('nome'))
                                                                <span class="help-block"><strong>{{ $errors->first('nome') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
                                                        {!!  Form::label('cargo','Cargo',array('class' => 'col-sm-2 control-label')) !!}
                                                        <div class="col-sm-6">
                                                            {{ Form::select('cargo' ,[
                                                                                            'professor' => 'Professor',
                                                                                            'administrativo' => 'Administrativo',
                                                                                            'outros' => 'Outros',

                                                                                            ],'Professor',['class' => 'form-control'])
                                                                                         }}

                                                            @if ($errors->has('cargo'))
                                                                <span class="help-block"><strong>{{ $errors->first('cargo') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="box-footer">
                                                        @if(Request::is('*/editar'))
                                                            <a class="btn btn-default btn-close" href="{{ route('colaboradores.index') }}">Cancelar</a>
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

                                    @endcan
                                    @endif



                <div class="col-md-12">
                            <div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title">Lista de Colaboradores</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Cargo</th>
                                @can('edit_colaborador') <th>Editar</th>  @endcan
                                @can('delete_colaborador') <th>Exluir</th>  @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($colaboradores as $rows)
                                <tr>
                                    <td>{{$rows->nome}}</td>
                                    <td>{{$rows->cargo}}</td>

                                    @can('edit_colaborador') <td width="50"> <div class="tools">
                                            <a href="{{ route('colaboradores.edit', ['id' => $rows->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                        </div>
                                    </td>@endcan
                                    @can('delete_colaborador') <td width="50">
                                        {!! Form::open(['method'=>'DELETE', 'url' => '/colaboradores/'.$rows->id]) !!}

                                        <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                        {!! Form::close() !!}
                                    </td> @endcan

                                    @endforeach
                                </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Cargo</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>

@stop

@section('css')

@stop

@section('js')
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

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

@stop