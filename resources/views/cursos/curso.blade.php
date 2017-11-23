@extends('adminlte::page')

@section('title', 'Usuários')


@section('content_header')

        <h1>
            Cursos

        </h1>
        <ol class="breadcrumb">
            <li><a href="../../cursos"><i class="fa fa-graduation-cap"></i>Cursos</a></li>
            <li class="active"><a href="gerenciar"><i class=""></i>Gerenciar</a></li>

        </ol>
@stop

@section('content')


    @if(Request::is('cursos'))

        <!-- Main content -->
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-header with-border">
                    <i class="fa fa-file-text-o"></i>
                    <h3 class="box-title">Cursos Cadastrados</h3>
                    <button type="button"  onclick="javascript: location.href='{{ route('curso.create') }}'"  title="Cadastrar novo curso" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Novo Curso</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    @foreach($curso as $rows)
                        <a href="cursos/{{$rows->id}}/gerenciar">
                            <div class="col-md-4 col-sm-7 col-xs-12">
                                <div class="info-box bg-green">
                                    <span class="info-box-icon"><i class="fa  fa-clipboard"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><b>{{$rows->denominacao}}</b></span>
                                        <span class="progress-description">Coordenador: {{$rows->coordenador}}</span>
                                        <span class="progress-description">Turno: {{$rows->turno}} </span>
                                        <span class="progress-description">Ano Implementação: {{$rows->ano_implementacao}}</span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->
                        </a>
                    @endforeach
                </div>

            </div></div>






    @elseif(Request::is('cursos/novo'))

        <div class="col-md-13">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-header with-border">

                        <i class="fa fa-pencil-square-o"></i>
                        <h3 class="box-title">Cadastrar Curso</h3>

                    </div>

                    @if(Request::is('*/editar'))
                        {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'cursos/'.$edit->id]) !!}
                    @else
                        {!! Form::open(array('route' => 'curso.store', 'class' => 'form-horizontal')) !!}
                    @endif
                    @if(Session::has('mensagem_sucesso'))

                        <div class="callout callout-success">
                            {{ Session::get('mensagem_sucesso') }}
                        </div>

                    @endif
                    <div class="fetched-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row clearfix{{ $errors->has('denominacao') ? ' has-error' : '' }}">
                                        {!!  Form::label('denominacao','Nome do Curso',array('class' => 'col-sm-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::input('text','denominacao',old('denominacao'),array('class' => 'form-control' ,'placeholder' => 'Nome do curso'))!!}
                                            @if ($errors->has('denominacao'))
                                                <span class="help-block"><strong>{{ $errors->first('denominacao') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('coordenador') ? ' has-error' : '' }}">
                                        {!!  Form::label('coordenador','Coordenador',array('class' => 'col-sm-3 control-label')) !!}
                                        <div class="col-sm-5">
                                            {!! Form::input('text','coordenador',old('coordenador'),array('class' => 'form-control','placeholder' => ''))!!}
                                            @if ($errors->has('coordenador'))
                                                <span class="help-block"><strong>{{ $errors->first('coordenador') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('qtd_periodo') ? ' has-error' : '' }}">
                                        {!!  Form::label('qtd_periodo','Quantidade Período',array('class' => 'col-sm-3 control-label')) !!}
                                        <div class="col-sm-8">
                                            {!! Form::input('text','qtd_periodo',old('qtd_periodo'),array('class' => 'form-control','placeholder' => ''))!!}
                                            @if ($errors->has('qtd_periodo'))
                                                <span class="help-block"><strong>{{ $errors->first('qtd_periodo') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="box-footer">
                                @if(Request::is('*/editar'))
                                    {!! Form::submit('Atualziar', ['class' => 'btn btn-info' ]) !!}
                                @else
                                    {!! Form::submit('Cadastrar', ['class' => 'btn btn-info' ]) !!}
                                @endif
                            </div>
                            {!! @Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif



@stop

@section('css')
    <link rel="stylesheet" href="#">
@stop

@section('js')
    <script>  </script>
@stop