@extends('layouts.app')

@section('title_page')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Usuários</h1>

        <ol class="breadcrumb">
            <li class="active"><a href="usuarios"><i class="fa fa-user"></i>Usuários</a></li>
        </ol>
    </section>
@endsection

@section('content_page')

    @include('layouts.sidebar')

    @if(Session::has('mensagem_destroy'))
        <div class="callout callout-danger">
            {{ Session::get('mensagem_destroy') }}
        </div>

    @endif
    <!-- Main content -->
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-header with-border">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Lista de Usuários</h3>
                <button type="button"  onclick="javascript: location.href='{{ route('user.create') }}'"  title="Cadastrar novo usuário" class="btn btn-default pull-right"><i class="fa fa-user-plus"></i> Novo Usuário</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nome</th>
                        <th >E-mail</th>
                        <th >Perfil</th>
                        <th colspan="2">Ação</th>

                    </tr>
                    <?php $i=1;?>
                    @foreach($usuarios as $rows)
                        <tr>
                            <td>{{$i.'.'}}</td>
                            <td>{{$rows->name}}</td>
                            <td>{{$rows->email}}</td>
                            <td>{{$rows->perfil}}</td>

                            <td width="50"> <div class="tools">


                                    <a href="{{ route('user.edit', ['id' => $rows->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>

                                </div>

                            </td><td width="50">
                                {!! Form::open(['method'=>'DELETE', 'url' => '/usuarios/'.$rows->id]) !!}

                                <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o usuário {{$rows->name}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                {!! Form::close() !!}
                            </td>
                            <?php $i++;?>

                        </tr>
                    @endforeach
                </table>
            </div>

        </div></div>



            @endsection

            @section('scripts')

                <script type="text/javascript">
                    $(function () {
                        //alert('Teste section usuarios');

                    });
                </script>

@endsection