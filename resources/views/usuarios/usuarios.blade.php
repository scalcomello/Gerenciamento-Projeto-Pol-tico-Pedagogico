@extends('layouts.app')

@section('title_page')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Usuários</h1>

        <ol class="breadcrumb">
            <li><a href=home>Ínicio</a></li>
            <li class="active">Usuários</li>
        </ol>
    </section>
@endsection

@section('content_page')

    @include('layouts.sidebar')

    @if(Session::has('mensagem_sucesso'))

        <div class="callout callout-success">
            {{ Session::get('mensagem_sucesso') }}
        </div>

    @endif
    <!-- Main content -->
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-header with-border">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Lista de Usuários</h3>
                <button type="button"  onclick="javascript: location.href='{{ route('user.create') }}'" class="btn btn-default pull-right"><i class="fa fa-user-plus"></i> Novo Usuário</button>
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
                                    <a href="{{ route('user.edit', ['id' => $rows->id ]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                </div>

                            </td><td width="50">
                                {!! Form::open(['method'=>'DELETE', 'url' => '/usuarios/'.$rows->id]) !!}

                                <button class="btn btn-default btn-sm type=" onclick="return confirm('Deseja remover este usuário?')" type="submit"><i class="fa fa-trash-o"></i></button>
                                {!! Form::close() !!}
                            </td>       <?php $i++;?>

                        </tr>
                    @endforeach
                </table>
            </div>





            @endsection

            @section('scripts')

                <script type="text/javascript">
                    $(function () {
                        //alert('Teste section usuarios');

                    });
                </script>

@endsection