@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Projeto político pedágogico

        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-home"></i>Início</a></li>
        </ol>
    </section>
@endsection
@section('content_page')


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
                                @if(Session::has('mensagem_sucesso'))

                                    <div class="callout callout-success">
                                        {{ Session::get('mensagem_sucesso') }}
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


                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Representantes</h3>
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

                                        <td width="50">
                                            <a href="{{ route('equipegestora.edit', ['id' => $rows->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td><td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Diretora do Departamento de Desenvolvimento Educacional</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($desenvolvimento_educacional as $rows)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows->pessoa->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('equipegestora.edit', ['id' => $rows->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td><td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Diretora do Departamento de Administração e Planejamento</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($administracao_planejamento as $rows1)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows1->pessoa->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('equipegestora.edit', ['id' => $rows1->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>

                                        </td><td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows1->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Coordenador Geral de Ensino</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($ensino as $rows2)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows2->pessoa->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('equipegestora.edit', ['id' => $rows2->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td><td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows2->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Coordenador Geral de Assistência ao Educando</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($assistencia_educando as $rows3)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows3->pessoa->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('equipegestora.edit', ['id' => $rows3->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td><td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows3->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Coordenador Geral de Pesquisa</th>
                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($pesquisa as $rows4)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows4->pessoa->nome}}</td>
                                        <td width="50">
                                            <a href="{{ route('ministerio.edit', ['id' => $rows4->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td><td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows4->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Coordenado Geral de Extensão</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($extensao as $rows5)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows4->pessoa->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('equipegestora.edit', ['id' => $rows5->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td><td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/equipe_gestora/'.$rows5->id]) !!}
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





@endsection

@section('scripts')

    <script type="text/javascript">
        $(function () {
            //alert('Teste section');
        });
    </script>

@endsection