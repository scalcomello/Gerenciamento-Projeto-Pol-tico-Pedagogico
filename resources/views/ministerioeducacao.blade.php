@extends('adminlte::page')

@section('title', 'Usuários')


@section('content_header')

        <h1>Ministerio da Educação</h1>
        <ol class="breadcrumb">

            <li><a href=ministerio_da_educacao><i class="fa fa-asterisk"></i> Ministerio da Educação</a></li>
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
                            {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'ministerio_da_educacao/'.$edit->id]) !!}
                        @else
                            {!! Form::open(array('route' => 'ministerio.store', 'class' => 'form-horizontal')) !!}
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
                                        {!! Form::input('text','nome',old('nome'),array('class' => 'form-control','placeholder' => 'Nome do dirigente'))!!}
                                        @if ($errors->has('nome'))
                                            <span class="help-block"><strong>{{ $errors->first('nome') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
                                    {!!  Form::label('cargo','Cargo',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">
                                        {{ Form::select('cargo' ,[
                                                                        'presidente' => 'PRESIDENTE DA REPÚBLICA',
                                                                        'ministro' => 'MINISTRO DA EDUCAÇÃO',
                                                                        'sec_educ_prof_tecn' => 'SECRETÁRIO DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA',
                                                                        'reitor' => 'REITOR DO IFSULDEMINAS',
                                                                        'pro_reitor_admin_plan' => 'PRÓ-REITOR DE ADMINISTRAÇÃO E PLANEJAMENTO',
                                                                        'pro_reitor_ensino' => 'PRÓ-REITOR DE ENSINO',
                                                                        'pro_reitor_desenv_inst' => 'PRÓ-REITOR DE DESENVOLVIMENTO INSTITUCIONAL',
                                                                        'pro_reitor_posgrad_pesq_ino' => 'PRÓ-REITOR DE PÓS-GRADUAÇÃO, PESQUISA E INOVAÇÃO',
                                                                        'pro_reitor_ext' => 'PRÓ-REITOR DE EXTENSÃO'

                                                                        ],null,['class' => 'form-control'])
                                                                     }}

                                        @if ($errors->has('cargo'))
                                            <span class="help-block"><strong>{{ $errors->first('cargo') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="box-footer">
                                    @if(Request::is('*/editar'))
                                        <a class="btn btn-default btn-close" href="{{ route('ministerio.index') }}">Cancelar</a>
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
                            <h3 class="box-title">Lista de representantes</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRESIDENTE DA REPÚBLICA</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($presidente as $rows)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('ministerio.edit', ['id' => $rows->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows->id]) !!}
                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>

                                        <?php $i++;?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>MINISTRO DA EDUCAÇÃO</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $j = 1;?>
                                @foreach($ministro as $rows1)
                                    <tr>
                                        <td>{{$j}}</td>
                                        <td>{{$rows1->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('ministerio.edit', ['id' => $rows1->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows1->id]) !!}
                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows1->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $j++;?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>SECRETÁRIO DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $k = 1;?>
                                @foreach($sec_educ_prof_tecn as $rows2)
                                    <tr>
                                        <td>{{$k}}</td>
                                        <td>{{$rows2->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('ministerio.edit', ['id' => $rows2->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows2->id]) !!}
                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows2->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $k++;?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>REITOR DO IFSULDEMINAS</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $l = 1;?>
                                @foreach($reitor as $rows3)
                                    <tr>
                                        <td>{{$l}}</td>
                                        <td>{{$rows3->nome}}</td>


                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('ministerio.edit', ['id' => $rows3->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows3->id]) !!}
                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows3->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $l++;?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRÓ-REITOR DE ADMINISTRAÇÃO E PLANEJAMENTO</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $m = 1;?>
                                @foreach($pro_reitor_admin_plan as $rows4)
                                    <tr>
                                        <td>{{$m}}</td>
                                        <td>{{$rows4->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('ministerio.edit', ['id' => $rows4->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows4->id]) !!}
                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows4->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $m++;?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRÓ-REITOR DE ENSINO</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $n = 1;?>
                                @foreach($pro_reitor_ensino as $rows5)
                                    <tr>
                                        <td>{{$n}}</td>
                                        <td>{{$rows5->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('ministerio.edit', ['id' => $rows5->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows5->id]) !!}
                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows5->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $n++;?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRÓ-REITOR DE DESENVOLVIMENTO INSTITUCIONAL</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $v = 1;?>
                                @foreach($pro_reitor_desenv_inst as $rows6)
                                    <tr>
                                        <td>{{$v}}</td>
                                        <td>{{$rows6->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('ministerio.edit', ['id' => $rows6->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows6->id]) !!}
                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows6->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $v++;?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRÓ-REITOR DE PÓS-GRADUAÇÃO, PESQUISA E INOVAÇÃO</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $s = 1;?>
                                @foreach($pro_reitor_posgrad_pesq_ino as $rows7)
                                    <tr>
                                        <td>{{$s}}</td>
                                        <td>{{$rows7->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('ministerio.edit', ['id' => $rows7->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows7->id]) !!}
                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows7->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $s++;?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRÓ-REITOR DE EXTENSÃO</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $t = 1;?>
                                @foreach($pro_reitor_ext as $rows8)
                                    <tr>
                                        <td>{{$t}}</td>
                                        <td>{{$rows8->nome}}</td>

                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('ministerio.edit', ['id' => $rows8->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows8->id]) !!}
                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o colaborador {{$rows8->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>
                                        <?php $t++;?>
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

@stop

@section('js')
    <script>  </script>
@stop