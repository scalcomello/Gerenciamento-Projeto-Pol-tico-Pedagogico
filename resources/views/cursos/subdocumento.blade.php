@extends('adminlte::page')

@section('title', 'Usuários')


@section('content_header')
        <h1>
            {{$nomecurso->denominacao}} - {{$titulo->titulo}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-home"></i>Início</a></li>
        </ol>
@stop

@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="row">

    <button type="button" class="btn btn-default pull-right" data-toggle="modal"
            data-target="#myModa2"><i class="fa fa-plus"></i>
        Novo
    </button>


    <br>
    <section class="content">
        <?php $i=0;
              $editor='';
        ?>
        @foreach($subdocumento as $item)
                <?php $i=$i+1;?>
                    @php
                        $editor='editor'.$i
                    @endphp


            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-header with-border">

                            <a  class="pull-right" href="{{ route('curso.destroy_subdocumento', ['id' => $item->id ]) }}"
                            ><i class="fa fa-trash-o"></i></a>

                            <a style="padding-right:10px" class="pull-right" href="{{ route('curso.edit_subdocumento', ['id' => $item->id ]) }}"
                               data-hover="tooltip"
                               data-placement="top"
                               data-target="#myModa3{{$item->id }}"
                               data-toggle="modal" title="Edit"
                            > <i class="fa fa-edit"></i></a>

                            <h3 class="box-title">{{$item->subtitulo}}</h3>
                        </div>



                        <div class="modal-body">

                            {!! Form::open(['route'=>'curso.descricao_subdocumento']) !!}

                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }}">
                                    {{ Form::label('descricao', 'Conteúdo', ['class'=>'control-label']) }}
                                    {{ Form::textarea('descricao', $item->descricao,['id' => $editor, 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) }}
                                    {{ $errors->first('descricao', '<span class="help-block">:message</span>') }}
                                </div>


                                {{ Form::hidden('documentos_id',$item->documentos_id) }}
                                {{ Form::hidden('id',$item->id) }}

                                {!! Form::submit('Salvar', ['class' => 'btn btn-info' ]) !!}


                                {!! @Form::close() !!}
                            </div>
                            <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                            <script>

                                CKEDITOR.replace({{$editor}});
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

























    <!-- Modal cadastro componente -->
    <div class="modal fade" id="myModa2" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Novo</h4>
                </div>
                <div class="modal-body">

                    {!! Form::open(['route'=>'curso.store_subdocumento']) !!}

                    {{ csrf_field() }}
                    <div class="box-body">


                        <div class="form-group{{ $errors->has('subtitulo') ? ' has-error' : '' }}">
                            {!!  Form::label('subtitulo','Titulo',array('class' => 'col-sm-4 control-label')) !!}
                            <div class="col-sm-8">
                                {!! Form::input('text','subtitulo',old('subtitulo'),array('class' => 'form-control','placeholder' => ''))!!}
                                @if ($errors->has('subtitulo'))
                                    <span class="help-block"><strong>{{ $errors->first('subtitulo') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{ Form::hidden('documentos_id',$titulo->id) }}

                        <div class="form-group{{ $errors->has('subordem') ? ' has-error' : '' }}">
                            {!!  Form::label('subordem','Subordem',array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-6">
                                {!! Form::input('text','subordem',old('subordem'),array('class' => 'form-control','placeholder' => ''))!!}
                                @if ($errors->has('subordem'))
                                    <span class="help-block"><strong>{{ $errors->first('subordem') }}</strong></span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Salvar', ['class' => 'btn btn-primary' ]) !!}
                    <button type="button"  class="btn btn-default" data-dismiss="modal">Sair</button>
                </div>
                {!! @Form::close() !!}
            </div>
        </div>
    </div>




    <!-- Modal editar componente -->
    @foreach($subdocumento as $rows1)
        <div class="modal fade" id="myModa3{{$rows1->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"   class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Componente Curricular</h4>
                    </div>
                    <div class="modal-body">

                        {!! Form::model($rows1,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'cursos/atualizar/estrutura_documental/'.$rows1->id]) !!}

                        {{ csrf_field() }}
                        <div class="box-body">

                            {{$rows1->id}}

                            <div class="form-group{{ $errors->has('subtitulo') ? ' has-error' : '' }}">
                                {!!  Form::label('subtitulo','Titulo',array('class' => 'col-sm-4 control-label')) !!}
                                <div class="col-sm-8">
                                    {!! Form::input('text','subtitulo',old('subtitulo'),array('class' => 'form-control','placeholder' => ''))!!}
                                    @if ($errors->has('subtitulo'))
                                        <span class="help-block"><strong>{{ $errors->first('subtitulo') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            {{ Form::hidden('documentos_id',$titulo->id) }}

                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary' ]) !!}
                        <button type="button"  class="btn btn-default" data-dismiss="modal">Sair</button>
                    </div>
                    {!! @Form::close() !!}
                </div>
            </div>
        </div>
            @endforeach
        </div>
    </section>

@stop

@section('css')
    <link rel="stylesheet" href="#">
@stop

@section('js')
    <script>  </script>
@stop