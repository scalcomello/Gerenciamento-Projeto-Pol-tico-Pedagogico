@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Histórico Institucional

        </h1>
        <ol class="breadcrumb">
            <li><a href="historico"><i class="fa fa-building-o"></i>Caracterização Institucional</a></li>
            <li><a href="historico"><i class=""></i>histórico</a></li>
        </ol>
    </section>
@endsection
@section('content_page')



    <section class="content">


        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-header with-border">
      <i class=fa-file-text-o"></i>
                        <i class="fa fa-file-text-o"></i>
                        <h3 class="box-title">{{$historico->titulo}}</h3>

                    </div>

                    <div class="modal-body">
                        {!! Form::open(['route'=>'caracterizacao.store_historico']) !!}
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('conteudo') ? 'has-error' : '' }}">
                                {{ Form::label('conteudo', 'Conteúdo', ['class'=>'control-label']) }}
                                {{ Form::textarea('conteudo', $historico->conteudo,['id' => 'editor1', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) }}
                                {{ $errors->first('conteudo', '<span class="help-block">:message</span>') }}
                            </div>

                            {{ Form::hidden('id',$historico->id) }}


                            {!! Form::submit('Salvar', ['class' => 'btn btn-info' ]) !!}


                            {!! @Form::close() !!}
                        </div>
                        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

                        <script>
                            var options = {
                                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
                            };
                        </script>
                        <script>
                            CKEDITOR.replace('editor1', options);

                        </script>
                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection

@section('scripts')


@endsection