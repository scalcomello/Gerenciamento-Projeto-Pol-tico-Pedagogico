@extends('layouts.app')

@section('title_page')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Conselho Superior</h1>
        <ol class="breadcrumb">
            <li><a href="conselhosuperior"><i class="fa fa-bookmark-o"></i>Conselho Superior</a></li>
        </ol>
    </section>
@endsection
@section('content_page')

    @include('layouts.sidebar')

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
                                <i class="fa fa-user-plus"></i>   <h3 class="box-title">Cadastrar Representante</h3>
                            @endif
                        </div>

                        @if(Request::is('*/editar'))
                            {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'conselhosuperior/'.$edit->id]) !!}
                        @else
                            {!! Form::open(array('route' => 'conselho.store', 'class' => 'form-horizontal')) !!}
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

                                <script>

                                    $('.selectpicker').addClass('col-sm-2').selectpicker('setStyle');
                                </script>

                                <div class="form-group{{ $errors->has('pessoas_id') ? ' has-error' : '' }}">
                                    {!!  Form::label('pessoas_id','Nome',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">

                                        {{ Form::select('pessoas_id' ,$pessoas_nome,null,['class' => 'selectpicker','data-live-search'=> 'true','data-show-subtext' => 'true', 'data-width'=>'auto'])  }}
                                        @if ($errors->has('pessoas_id'))
                                            <span class="help-block"><strong>{{ $errors->first('pessoas_id') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                                    {!!  Form::label('titulo','Título',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">
                                        {{ Form::select('titulo' ,[
                                                                          'presidente' => 'PRESIDENTE DO CONSELHO SUPERIOR DO IFSULDEMINAS',
                                                                          'repres_ministerio' => 'REPRESENTANTE Do MINISTERIO DA EDUCAÇÃO',
                                                                          'diretor' => 'REPRESENTANTES DIRETORES GERAIS DOS CÂMPUS',
                                                                          'corpo_docente' => 'REPRESENTANTES CORPO DOCENTE',
                                                                          'corpo_discente' => 'REPRESENTANTES CORPO DISCENTE',
                                                                          'tec_administrativo' => 'REPRESENTANTES TÉCNICOS-ADMINISTRATIVOS',
                                                                          'egresso' => 'REPRESENTANTES EGRESSOS',
                                                                          'trabalhador' => 'REPRESENTANTES DAS ENTIDADES DOS TRABALHADORES',
                                                                          'publico_estatal' => 'REPRESENTANTES DO SETOR PÚBLICO OU ESTATAIS',
                                                                          'patronal' => 'REPRESENTANTE DAS ENTIDADES PATRONAIS',
                                                                          'membros_natos' => 'MEMBROSS NATTOS'


                                                                        ],null,['class' => 'selectpicker','data-live-search'=> 'true','data-show-subtext' => 'true', 'data-width'=>'auto'])
                                                                     }}


                                        @if ($errors->has('titulo'))
                                            <span class="help-block"><strong>{{ $errors->first('titulo') }}</strong></span>
                                        @endif
                                    </div>
                                </div>



                                <div class="box-footer">
                                    @if(Request::is('*/editar'))
                                        <a class="btn btn-default btn-close" href="{{ route('conselho.index') }}">Cancelar</a>
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
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">Lista representantes</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRESIDENTE DO CONSELHO SUPERIOR DO IFSULDEMINAS</th>

                                    <th colspan="2">Ação</th>
                                </tr>

                                <?php $i = 1;?>
                                @foreach($presidente as $rows)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('conselho.edit', ['id' => $rows->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $i++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>REPRESENTANTE DO MINISTÉRIO DA EDUCAÇÃO</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $j = 1;?>
                                @foreach($repres_ministerio as $rows1)
                                    <tr>
                                        <td>{{$j}}</td>
                                        <td>{{$rows1->pessoa->nome}}</td>
                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('conselho.edit', ['id' => $rows1->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows1->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows1->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $j++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>REPRESENTANTES DIRETORES GERAIS DOS CÂMPUS</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $g = 1;?>
                                @foreach($diretor as $rows2)
                                    <tr>
                                        <td>{{$g}}</td>
                                        <td>{{$rows2->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('conselho.edit', ['id' => $rows2->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows2->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows2->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $g++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>REPRESENTANTES CORPO DOCENTE</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $m = 1;?>
                                @foreach($corpo_docente as $rows3)
                                    <tr>
                                        <td>{{$m}}</td>
                                        <td>{{$rows3->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('conselho.edit', ['id' => $rows3->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows3->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows3->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $m++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>REPRESENTANTES CORPO DISCENTE</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $q = 1;?>
                                @foreach($corpo_discente as $rows4)
                                    <tr>
                                        <td>{{$m}}</td>
                                        <td>{{$rows4->pessoa->nome}}</td>
                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('conselho.edit', ['id' => $rows4->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows4->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows4->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $q++; ?>
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
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">Lista representantes</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>REPRESENTANTES TÉCNICOS-ADMINISTRATIVOS</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $t = 1;?>
                                @foreach($tec_administrativo as $rows5)
                                    <tr>
                                        <td>{{$t}}</td>
                                        <td>{{$rows5->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('conselho.edit', ['id' => $rows5->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows5->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows5->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $t++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>REPRESENTANTES EGRESSOS</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $r = 1;?>
                                @foreach($egresso as $rows6)
                                    <tr>
                                        <td>{{$r}}</td>
                                        <td>{{$rows6->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('conselho.edit', ['id' => $rows6->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows6->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows6->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $r++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>REPRESENTANTES DAS ENTIDADES DOS TRABALHADORES</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $o = 1;?>
                                @foreach($trabalhador as $rows7)
                                    <tr>
                                        <td>{{$o}}</td>
                                        <td>{{$rows7->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('conselho.edit', ['id' => $rows7->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows7->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows7->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $o++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>REPRESENTANTES DO SETOR PÚBLICO OU ESTATAIS</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $p = 1;?>
                                @foreach($publico_estatal as $rows8)
                                    <tr>
                                        <td>{{$p}}</td>
                                        <td>{{$rows8->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('conselho.edit', ['id' => $rows8->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows8->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows8->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $p++; ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>REPRESENTANTE DAS ENTIDADES PATRONAIS</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $h = 1;?>
                                @foreach($patronal as $rows9)
                                    <tr>
                                        <td>{{$h}}</td>
                                        <td>{{$rows9->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('conselho.edit', ['id' => $rows9->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows9->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows9->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $h++; ?>
                                    </tr>
                                @endforeach

                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>MEMBROS NATOS</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $z = 1;?>
                                @foreach($membros_natos as $rows10)
                                    <tr>
                                        <td>{{$z}}</td>
                                        <td>{{$rows10->pessoa->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('conselho.edit', ['id' => $rows10->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows10->id]) !!}

                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows10->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $z++; ?>
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


@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            //alert('Teste section usuarios');
        });
    </script>
@endsection