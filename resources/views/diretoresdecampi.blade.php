@extends('layouts.app')

@section('title_page')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Diretores de Campi</h1>
        <ol class="breadcrumb">
            <li><a href=home><i class="fa fa-dashboard"></i> Ínicio</a></li>
            <li><a href=colaboradores><i class="fa fa-dashboard"></i>Diretores de Campi</a></li>
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
                                <i class="fa fa-pencil-square-o"></i>
                                <h3 class="box-title">Atualizar</h3>
                            @else
                                <i class="fa fa-user-plus"></i>
                                <h3 class="box-title">Cadastrar</h3>
                            @endif
                        </div>

                        @if(Request::is('*/editar'))
                            {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'diretores_de_campi/'.$edit->id]) !!}
                        @else
                            {!! Form::open(array('route' => 'diretores.store', 'class' => 'form-horizontal')) !!}
                        @endif

                        <div class="fetched-data">

                            {{ csrf_field() }}
                            <div class="box-body">
                                @if(Session::has('mensagem_sucesso'))

                                    <div class="callout callout-success">
                                        {{ Session::get('mensagem_sucesso') }}
                                    </div>

                                @endif

                                    <div class="form-group{{ $errors->has('diretor') ? ' has-error' : '' }}">
                                        {!!  Form::label('diretor','Diretor',array('class' => 'col-sm-2 control-label')) !!}
                                        <div class="col-sm-6">
                                            {{ Form::select('diretor' ,$pessoas_nome,null,['class' => 'selectpicker','data-live-search'=> 'true', 'data-width'=>'auto'])  }}
                                            @if ($errors->has('diretor'))
                                                <span class="help-block"><strong>{{ $errors->first('diretor') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                <div class="form-group{{ $errors->has('campi') ? ' has-error' : '' }}">
                                    {!!  Form::label('campi','Campi',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">
                                        {!! Form::input('text','campi',old('campi'),array('class' => 'form-control','placeholder' => 'Cidade do campi'))!!}
                                        @if ($errors->has('campi'))
                                            <span class="help-block"><strong>{{ $errors->first('campi') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="box-footer">
                                    @if(Request::is('*/editar'))
                                        <a class="btn btn-default btn-close" href="{{ route('diretores.index') }}">Cancelar</a>
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
                            <h3 class="box-title">Campi Cadastrados</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body" >

                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Campi</th>
                                    <th>Diretor</th>
                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i=1;?>
                                @foreach($diretores as $rows)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows->campi}}</td>
                                        <td>{{$rows->diretor}}</td>
                                        <td width="50">
                                            <a href="{{ route('diretores.edit', ['id' => $rows->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td><td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/diretores_de_campi/'.$rows->id]) !!}
                                            <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
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
            //alert('Teste section usuarios');
        });
    </script>
@endsection