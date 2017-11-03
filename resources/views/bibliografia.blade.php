@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bibliografia

        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-home"></i>Início</a></li>
        </ol>
    </section>
@endsection
@section('content_page')






    @if(Request::is('*/cadastrar'))
    <!-- Main content -->
    <div class="col-md-12 ">
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-header with-border">
                    <i class=""></i>
                    <h3 class="box-title">Referência Bibliográfica</h3>
                </div>

                @if(Request::is('*/editar'))
                    {!! Form::model($bibliografia,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'bibliografia/'.$bibliografia->id]) !!}
                @else
                    {!! Form::open(array('route' => 'bibliografia.store', 'class' => 'form-horizontal')) !!}
                @endif
                <div class="fetched-data">

                    {{ csrf_field() }}

                    <div class="box-body">

                        @if(Session::has('mensagem_sucesso'))

                            <div class="callout callout-success">
                                {{ Session::get('mensagem_sucesso') }}
                            </div>

                        @endif

                        <div class="box-body">


                            <div class="form-group{{ $errors->has('autor') ? ' has-error' : '' }}">
                                {!!  Form::label('autor','Autor*',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-3">
                                    {!! Form::input('text','autor',old('autor'),array('class' => 'form-control','placeholder' => 'Nome (primeiro e do meio)','autofocus'=>'autofocus','required' => 'required'))!!}
                                    @if ($errors->has('autor'))
                                        <span class="help-block"><strong>{{ $errors->first('autor') }}</strong></span>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::input('text','sobrenome',old('sobrenome'),array('class' => 'form-control','placeholder' => 'Sobrenome','required' => 'required'))!!}
                                    @if ($errors->has('sobrenome'))
                                        <span class="help-block"><strong>{{ $errors->first('sobrenome') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                                {!!  Form::label('titulo','Titulo*',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-md-8">
                                    {!! Form::input('text','titulo',old('titulo'),array('class' => 'form-control','required' => 'required'))!!}
                                    @if ($errors->has('titulo'))<span class="help-block"><strong>{{ $errors->first('titulo') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('subtitulo') ? ' has-error' : '' }}">
                                {!!  Form::label('subtitulo','Subtitulo',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-md-8">
                                    {!! Form::input('text','subtitulo',old('subtitulo'),array('class' => 'form-control'))!!}
                                    @if ($errors->has('subtitulo'))<span class="help-block"><strong>{{ $errors->first('subtitulo') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('edicao') ? ' has-error' : '' }}">
                                {!!  Form::label('edicao','Edição',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-md-2">
                                    {!! Form::input('text','edicao',old('edicao'),array('class' => 'form-control'))!!}
                                    @if ($errors->has('edicao'))<span class="help-block"><strong>{{ $errors->first('edicao') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('local') ? ' has-error' : '' }}">
                                {!!  Form::label('local','Local*',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-md-3">
                                    {!! Form::input('text','local',old('local'),array('class' => 'form-control','required' => 'required'))!!}
                                    @if ($errors->has('local'))<span class="help-block"><strong>{{ $errors->first('local') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('editora') ? ' has-error' : '' }}">
                                {!!  Form::label('editora','Editora*',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-md-3">
                                    {!! Form::input('text','editora',old('editora'),array('class' => 'form-control','required' => 'required'))!!}
                                    @if ($errors->has('editora'))<span class="help-block"><strong>{{ $errors->first('editora') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ano') ? ' has-error' : '' }}">
                                {!!  Form::label('ano','Ano*',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-md-3">
                                    {!! Form::input('number','ano',old('ano'),array('class' => 'form-control','required' => 'required'))!!}
                                    @if ($errors->has('ano'))<span class="help-block"><strong>{{ $errors->first('ano') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('pagina') ? ' has-error' : '' }}">
                                {!!  Form::label('pagina','Página*',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-md-2">
                                    {!! Form::input('number','pagina',old('pagina'),array('class' => 'form-control','required' => 'required'))!!}
                                    @if ($errors->has('pagina'))<span class="help-block"><strong>{{ $errors->first('pagina') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('volume') ? ' has-error' : '' }}">
                                {!!  Form::label('volume','Volume',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-md-2">
                                    {!! Form::input('text','volume',old('volume'),array('class' => 'form-control'))!!}
                                    @if ($errors->has('volume'))<span class="help-block"><strong>{{ $errors->first('volume') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                        <div class="box-footer">
                            {!! Form::submit('Cadastrar Livro', ['class' => 'btn btn-info' ]) !!}
                        </div>
                        {!! @Form::close() !!}
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
@endif
        @if(Request::is('bibliografia'))

            <!-- Main content -->
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-header with-border">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title">Bibliografias</h3>
                        <button type="button"  onclick="javascript: location.href='{{ route('bibliografia.index') }}'" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Novo</button>


                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Autor</th>
                                <th >Titulo</th>
                                <th >ano</th>
                                <th colspan="3">Ação</th>

                            </tr>
                            <?php $i=1;?>
                            @foreach($bibliografia as $rows)
                                <tr>
                                    <td>{{$i.'.'}}</td>
                                    <td>{{$rows->livro->autor}}</td>
                                    <td>{{$rows->livro->titulo}} : {{$rows->livro->subtitulo}}</td>
                                    <td>{{$rows->livro->ano}}</td>

                                    <td width="30">
                                        <a href="{{ route('bibliografia.referencia', ['id' => $rows->id ]) }}"
                                           data-hover="tooltip"
                                           data-placement="top"
                                           data-target="#myModa4{{$rows->id}}"
                                           data-toggle="modal" title="Editar"
                                        > <i class="fa fa-edit"></i></a>
                                    </td>

                                    <td width="50">
                                        {!! Form::open(['method'=>'DELETE', 'url' => '/bibliografia/'.$rows->id]) !!}

                                        <button class="btn btn-default btn-sm type=" onclick="return confirm('Deseja remover este livro?')" type="submit"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                    </td>       <?php $i++;?>
                                    <td width="50"> <div class="tools">
                                            <a href="{{ route('bibliografia.referencia', ['id' => $rows->id ]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    @endif

                @foreach($bibliografia as $rows)
                    <!-- Modal -->
                        <div class="modal fade" id="myModa4{{$rows->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                </div>
                                </div>
                            </div>


                    @endforeach


        @endsection

@section('scripts')

    <script type="text/javascript">
        $(function () {
            //alert('Teste section');
        });
    </script>

@endsection