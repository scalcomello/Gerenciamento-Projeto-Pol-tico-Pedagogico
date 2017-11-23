@extends('adminlte::page')

@section('title', 'Usuários')


@section('content_header')

        <h1>
            Ementário -
            @foreach($disciplinas_nome as $line)
            {{  $line->nome }}
            @endforeach
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-home"></i>Início</a></li>
        </ol>

@stop

@section('content')



    <!-- Main content -->
    <section class="content">
        <div class="row">


                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-header with-border">

                            <h3 class="box-title">Ementa</h3>
                        </div>


                        <div class="modal-body">
                            {!! Form::open(array('route' => 'notificacao', 'class' => 'form-horizontal')) !!}
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group {{ $errors->has('nota') ? 'has-error' : '' }}">
                                    {{ Form::label('nota', 'Mensagem', ['class'=>'control-label']) }}
                                    {{ Form::textarea('nota', $disciplina->ementa,['id' => 'editor1', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) }}
                                    {{ $errors->first('nota', '<span class="help-block">:message</span>') }}
                                </div>


                                {!! Form::submit('Salvar', ['class' => 'btn btn-info' ]) !!}


                                {!! @Form::close() !!}
                            </div>
                            <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                        </div>

                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>

    </section>
    <!-- /.box -->

    <!-- Main content -->
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-header with-border">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Bibliografias Basica</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Autor</th>
                        <th >Titulo</th>
                        <th >ano</th>
                        <th >Ação</th>

                    </tr>
                    <?php $i=1;?>
                    @foreach($bibliografiabasico as $rows)
                        <tr>
                            <td>{{$i.'.'}}</td>
                            <td>{{$rows->livro->autor}}</td>
                            <td>{{$rows->livro->titulo}} : {{$rows->livro->subtitulo}}</td>
                            <td>{{$rows->livro->ano}}</td>


                            <td width="50">
                                {!! Form::open(['method'=>'DELETE', 'url' => '/bibliografia/'.$rows->id]) !!}

                                <button class="btn btn-default btn-sm type=" onclick="return confirm('Deseja remover este livro?')" type="submit"><i class="fa fa-trash-o"></i></button>
                                {!! Form::close() !!}
                            </td>       <?php $i++;?>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div></div>


    <!-- Main content bibliografica complementar -->
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-header with-border">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Bibliografias Complementar</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Autor</th>
                        <th >Titulo</th>
                        <th >ano</th>
                        <th >Ação</th>

                    </tr>
                    <?php $i=1;?>
                    @foreach($bibliografiacomplementar as $rows)
                        <tr>
                            <td>{{$i.'.'}}</td>
                            <td>{{$rows->livro->autor}}</td>
                            <td>{{$rows->livro->titulo}} : {{$rows->livro->subtitulo}}</td>
                            <td>{{$rows->livro->ano}}</td>



                            <td width="50">
                                {!! Form::open(['method'=>'DELETE', 'url' => '/bibliografia/'.$rows->id]) !!}

                                <button class="btn btn-default btn-sm type=" onclick="return confirm('Deseja remover este livro?')" type="submit"><i class="fa fa-trash-o"></i></button>
                                {!! Form::close() !!}
                            </td>       <?php $i++;?>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div></div>



@stop

@section('css')
    <link rel="stylesheet" href="#">
@stop

@section('js')
    <script>  </script>
@stop