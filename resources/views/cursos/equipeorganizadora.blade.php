@extends('adminlte::page')

@section('title', 'Usuários')


@section('content_header')

        <h1>{{$curso->denominacao}} - Equipe Organizadora</h1>
        <ol class="breadcrumb">
            <li><a href="../../../cursos"><i class="fa fa-graduation-cap"></i>Cursos</a></li>
            <li class="active"><a href="../gerenciar"><i class=""></i>Gerenciar</a></li>
            <li class="active"><a href="equipe_organizadora"><i class=""></i>Equipe organizadora</a></li>
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
                                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Atualizar</h3>
                            @else
                                <i class="fa fa-user-plus"></i>   <h3 class="box-title">Cadastrar Professor</h3>
                            @endif
                        </div>

                        @if(Request::is('*/editar'))
                            {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'equipe_organizadora/'.$edit->id]) !!}
                        @else
                            {!! Form::open(array('route' => 'curso.equipeorg.store_organizadora', 'class' => 'form-horizontal')) !!}
                        @endif

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
                                        {{ Form::select('pessoas_id' ,$pessoas_nome,null,['class' => 'selectpicker','data-live-search'=> 'true'])  }}
                                        @if ($errors->has('pessoas_id'))
                                            <span class="help-block"><strong>{{ $errors->first('pessoas_id') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">
                                    {!!  Form::label('categoria','Categoria',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">
                                        {{ Form::select('categoria' ,[
                                                                        'docente' => 'DOCENTE',
                                                                        'pedagogo' => 'PEDAGOGO',

                                                                        ],null,['class' => 'selectpicker','data-live-search'=> 'true'])
                                                                     }}
                                        @if ($errors->has('categoria'))
                                            <span class="help-block"><strong>{{ $errors->first('categoria') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                    {{ Form::hidden('cursos_id',$curso->id) }}

                                <div class="box-footer">
                                    @if(Request::is('*/editar'))
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



                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Docentes</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Professor</th>
                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($docente as $rows)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows->pessoa->nome}}</td>
                                        <td width="50">
                                            <a href="{{ route('curso.edit', ['id' => $rows->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => 'cursos/'.$curso->id.'/gerenciar/equipe_organizadora/'.$rows->id.'/remover']) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pegagogos</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Professor</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($pedagogo as $rows2)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows2->pessoa->nome}}</td>
                                        <td width="50">
                                            <a href="{{ route('curso.edit', ['id' => $rows2->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => 'cursos/'.$curso->id.'/gerenciar/equipe_organizadora/'.$rows2->id.'/remover']) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
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