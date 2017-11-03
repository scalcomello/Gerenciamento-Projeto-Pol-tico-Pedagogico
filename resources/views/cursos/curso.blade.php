@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Projeto político pedágogico

        </h1>
        <ol class="breadcrumb">
            <li><a href="home">Cursos</a></li>
        </ol>
    </section>
@endsection
@section('content_page')



    @if(Request::is('cursos'))
        <P>Cursos:
            <a href="cursos/novo">  <button type="button"  class="btn btn-default pull-right"><i class="fa fa-plus"></i> Novo Curso</button></P>
        <br>
    <!-- Apply any bg-* class to to the info-box to color it -->
    @foreach($curso as $rows)
        <a href="cursos/{{$rows->id}}/gerenciar">
            <div class="col-md-4 col-sm-7 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa  fa-clipboard"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{$rows->denominacao}}</span>

                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </a>
    @endforeach



        @elseif(Request::is('cursos/novo'))

        <div class="col-md-13">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-header with-border">

                            <i class="fa fa-pencil-square-o"></i>       <h3 class="box-title">Cadastrar Curso</h3>

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
                    </div></div>


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






@endsection

@section('scripts')

    <script type="text/javascript">
        $(function () {
            //alert('Teste section');
        });
    </script>

@endsection