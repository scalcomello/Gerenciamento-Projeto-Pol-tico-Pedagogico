@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Caracterização Institucional

        </h1>
        <ol class="breadcrumb">
            <li><a href="caracterizacao"><i class="fa fa-building-o"></i>Caracterização Institucional</a></li>
            <li><a href="caracterizacao"><i class=""></i>caracterização</a></li>
        </ol>
    </section>

@endsection
@section('content_page')


    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-header with-border">
                            <i class="fa fa-file-text-o"></i>
                            <h3 class="box-title">{{$caracterizacao->titulo}}</h3>

                        </div>

                        <div class="modal-body">
                            {!! Form::open(['route'=>'caracterizacao.store_caracterizacao']) !!}
                            <div class="box-body">
                                <div class="form-group {{ $errors->has('conteudo') ? 'has-error' : '' }}">
                                    {{ Form::label('conteudo', 'Conteúdo', ['class'=>'control-label']) }}
                                    {{ Form::textarea('conteudo', $caracterizacao->conteudo,['id' => 'editor1', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) }}
                                    {{ $errors->first('conteudo', '<span class="help-block">:message</span>') }}
                                </div>

                                {{ Form::hidden('id',$caracterizacao->id) }}


                                {!! Form::submit('Salvar', ['class' => 'btn btn-info' ]) !!}


                                {!! @Form::close() !!}
                            </div>
                            <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                        </div>
                    </div>
                </div>
            </div>


        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-header with-border">
                        <i class="fa fa-file-text-o"></i>
                        <h3 class="box-title">{{$historico_campus->titulo}}</h3>

                    </div>

                    <div class="modal-body">
                        {!! Form::open(['route'=>'caracterizacao.store_caracterizacao']) !!}
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('conteudo') ? 'has-error' : '' }}">
                                {{ Form::label('conteudo', 'Conteúdo', ['class'=>'control-label']) }}
                                {{ Form::textarea('conteudo', $historico_campus->conteudo,['id' => 'editor2', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) }}
                                {{ $errors->first('conteudo', '<span class="help-block">:message</span>') }}
                            </div>

                            {{ Form::hidden('id',$historico_campus->id) }}


                            {!! Form::submit('Salvar', ['class' => 'btn btn-info' ]) !!}


                            {!! @Form::close() !!}
                        </div>
                        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace('editor2');
                        </script>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>


@endsection

@section('scripts')

    <script type="text/javascript">
        $(function () {
            //alert('Teste section');
        });
    </script>

@endsection