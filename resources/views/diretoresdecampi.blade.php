@extends('layouts.app')

@section('title_page')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Diretores de Campi</h1>
        <ol class="breadcrumb">

            <li><a href="diretores_de_campi"><i class="fa fa-bank"></i>Diretores de Campi</a></li>
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
                                <h3 class="box-title">Cadastrar Diretor</h3>
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


                                <div class="form-group{{ $errors->has('pessoas_id') ? ' has-error' : '' }}">
                                    {!!  Form::label('pessoas_id','Diretor',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">

                                        {{ Form::select('pessoas_id' ,$pessoas_nome,null,['class' => 'selectpicker','data-live-search'=> 'true','data-show-subtext' => 'true', 'data-width'=>'auto'])  }}
                                        @if ($errors->has('pessoas_id'))
                                            <span class="help-block"><strong>{{ $errors->first('pessoas_id') }}</strong></span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group{{ $errors->has('campi') ? ' has-error' : '' }}">
                                    {!!  Form::label('campi','Campi',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-4">
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
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">Lista de campi cadastrados</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body" >

                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Diretor</th>
                                    <th>Campi</th>
                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i=1;?>
                                @foreach($diretores as $rows)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows->pessoa->nome}}</td>
                                        <td>{{$rows->campi}}</td>


                                        <td width="50"> <div class="tools">
                                                <a href="{{ route('diretores.edit', ['id' => $rows->id ]) }}" ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a>
                                            </div>
                                        </td><td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/diretores_de_campi/'.$rows->id]) !!}
                                            <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o diretor {{$rows->pessoa->nome}} do campus {{$rows->campi}} ?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                            {!! Form::close() !!}
                                        </td>



                                        <?php $i++; ?>
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