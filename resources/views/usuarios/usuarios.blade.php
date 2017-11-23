@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários</h1>
    <ol class="breadcrumb">
        <li><a href="usuarios"><i class="fa fa-user"></i>Usuários</a></li>
    </ol>
@stop

@section('content')

    @include('adminlte::mensage')


    <!-- Main content -->
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-header with-border">
                <i class="fa fa-th-list"></i>
                <h3 class="box-title">Usuários Cadastrados</h3>
                <button type="button" onclick="javascript: location.href='{{ route('user.create') }}'"
                        title="Cadastrar novo usuário" class="btn btn-default pull-right"><i
                            class="fa fa-user-plus"></i> Novo Usuário
                </button>

                <button type="button" onclick="javascript: location.href='{{ route('user.create') }}'"
                        title="Cadastrar novo usuário" class="btn btn-default pull-right"><i
                            class="fa fa-user-plus"></i> Criar perfil de usuário
                </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Perfil</th>
                        <th>Editar</th>
                        <th>Excluir</th>

                    </tr>
                    <?php $i = 1;?>
                    @foreach($usuarios as $rows)
                        <tr>
                            <td>{{$i.'.'}}</td>
                            <td>{{$rows->name}}</td>
                            <td>{{$rows->email}}</td>
                            <td>{{$rows->perfil->nome}}</td>

                            <td width="50">
                                <div class="tools">

                                    <a href="{{ route('user.edit', ['id' => $rows->id ]) }}">
                                        <button title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar
                                        </button>
                                    </a>

                                </div>

                            </td>
                            <td width="50">
                                {!! Form::open(['method'=>'DELETE', 'url' => '/usuarios/'.$rows->id]) !!}

                                <a>
                                    <button class="btn btn-danger"
                                            onclick="return confirm('Deseja remover o usuário {{$rows->name}}?')"
                                            title="Excluir"><i class="fa fa-trash-o"></i> Excluir
                                    </button>
                                </a>
                                {!! Form::close() !!}
                            </td>
                            <?php $i++;?>

                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>


@stop


@section('css')
    <link rel="stylesheet" href="#">
@stop

@section('js')
    <script></script>
@stop
