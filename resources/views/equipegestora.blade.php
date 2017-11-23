@extends('adminlte::page')

@section('title', 'Usuários')


@section('content_header')

        <h1>Equipe gestora</h1>
        <ol class="breadcrumb">
            <li><a href="equipe_gestora"><i class="fa fa-group"></i>Equipe gestora</a></li>
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
                                <i class="fa fa-user-plus"></i>   <h3 class="box-title">Cadastrar Representante</h3>
                            @endif
                        </div>

                        @if(Request::is('*/editar'))
                            {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'equipe_gestora/'.$edit->id]) !!}
                        @else
                            {!! Form::open(array('route' => 'equipegestora.store', 'class' => 'form-horizontal')) !!}
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

                                <div class="form-group{{ $errors->has('pessoas_id') ? ' has-error' : '' }}">
                                    {!!  Form::label('pessoas_id','Nome',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">
                                        {{ Form::select('pessoas_id' ,$pessoas_nome,null,['class' => 'selectpicker','data-live-search'=> 'true', 'data-width'=>'auto'])  }}
                                        @if ($errors->has('pessoas_id'))
                                            <span class="help-block"><strong>{{ $errors->first('pessoas_id') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">
                                    {!!  Form::label('categoria','Categoria',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">
                                        {{ Form::select('categoria' ,[  'diretor' => 'Diretor Geral',
                                                                        'desenvolvimento_educacional' => 'Diretora do Departamento de Desenvolvimento Educacional',
                                                                        'administracao_planejamento' => 'Diretora do Departamento de Administração e Planejamento',
                                                                        'ensino' => 'Coordenador Geral de Ensino',
                                                                        'assistencia_educando' => 'Coordenador Geral de Assistência ao Educando',
                                                                        'pesquisa' => 'Coordenador Geral de Pesquisa',
                                                                        'extensao' => 'Coordenado Geral de Extensão'

                                                                        ],null,['class' => 'selectpicker','data-live-search'=> 'true', 'data-width'=>'auto'])
                                                                     }}

                                        @if ($errors->has('categoria'))
                                            <span class="help-block"><strong>{{ $errors->first('cargo') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="box-footer">
                                    @if(Request::is('*/editar'))
                                        <a class="btn btn-default btn-close" href="{{ route('equipegestora.index') }}">Cancelar</a>
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
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">Lista representantes</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Diretor Geral</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($diretor as $rows)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('equipegestora.edit', ['id' => $rows->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>

                                        </td>
                                        <?php $i++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Diretora do Departamento de Desenvolvimento Educacional</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $a = 1;?>
                                @foreach($desenvolvimento_educacional as $rows)
                                    <tr>
                                        <td>{{$a}}</td>
                                        <td>{{$rows->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('equipegestora.edit', ['id' => $rows->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $a++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Diretora do Departamento de Administração e Planejamento</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $b = 1;?>
                                @foreach($administracao_planejamento as $rows1)
                                    <tr>
                                        <td>{{$b}}</td>
                                        <td>{{$rows1->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('equipegestora.edit', ['id' => $rows1->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows1->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows1->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td> <?php $b++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Coordenador Geral de Ensino</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $c = 1;?>
                                @foreach($ensino as $rows2)
                                    <tr>
                                        <td>{{$c}}</td>
                                        <td>{{$rows2->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('equipegestora.edit', ['id' => $rows2->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows2->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows2->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td> <?php $c++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Coordenador Geral de Assistência ao Educando</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $d = 1;?>
                                @foreach($assistencia_educando as $rows3)
                                    <tr>
                                        <td>{{$d}}</td>
                                        <td>{{$rows3->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('equipegestora.edit', ['id' => $rows3->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows3->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows3->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>  <?php $d++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Coordenador Geral de Pesquisa</th>
                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $e = 1;?>
                                @foreach($pesquisa as $rows4)
                                    <tr>
                                        <td>{{$e}}</td>
                                        <td>{{$rows4->pessoa->nome}}</td>
                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('equipegestora.edit', ['id' => $rows4->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows4->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows4->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $e++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Coordenado Geral de Extensão</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $f = 1;?>
                                @foreach($extensao as $rows5)
                                    <tr>
                                        <td>{{$f}}</td>
                                        <td>{{$rows5->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('equipegestora.edit', ['id' => $rows5->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows5->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows5->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $f++; ?>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
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