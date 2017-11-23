@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')

    <h1>Conselho Superior</h1>
    <ol class="breadcrumb">
        <li><a href="conselhosuperior"><i class="fa fa-bookmark-o"></i>Conselho Superior</a></li>
    </ol>
@stop

@section('content')

    <!-- Main content -->

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-header with-border">
                        @if(Request::is('*/editar'))
                            <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Atualizar</h3>
                        @else
                            <i class="fa fa-user-plus"></i>   <h3 class="box-title">Cadastrar Representante</h3>
                        @endif
                    </div>

                    @if(Request::is('*/editar'))
                        {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'conselhosuperior/'.$edit->id]) !!}
                    @else
                        {!! Form::open(array('route' => 'conselho.store', 'class' => 'form-horizontal')) !!}
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

                            <script>

                                $('.selectpicker').addClass('col-sm-2').selectpicker('setStyle');
                            </script>

                            <div class="form-group{{ $errors->has('pessoas_id') ? ' has-error' : '' }}">
                                {!!  Form::label('pessoas_id','Nome',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-6">

                                    {{ Form::select('pessoas_id' ,$pessoas_nome,null,['class' => 'js-example-basic-single'])  }}
                                    @if ($errors->has('pessoas_id'))
                                        <span class="help-block"><strong>{{ $errors->first('pessoas_id') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('grupo_conselhosuperior_id') ? ' has-error' : '' }}">
                                {!!  Form::label('grupo_conselhosuperior_id','Grupo',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-6">

                                    {{ Form::select('grupo_conselhosuperior_id' ,$grupolist,null,['class' => 'js-example-basic-single'])  }}
                                    @if ($errors->has('grupo_conselhosuperior_id'))
                                        <span class="help-block"><strong>{{ $errors->first('grupo_conselhosuperior_id') }}</strong></span>
                                    @endif


                                    <button type="button"
                                            onclick="javascript: location.href='{{ route('user.create') }}'"
                                            title="Cadastrar Grupo" class="btn btn-default"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="box-footer">
                                @if(Request::is('*/editar'))
                                    <a class="btn btn-default btn-close"
                                       href="{{ route('conselho.index') }}">Cancelar</a>
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


            @foreach($grupoconselho as $rows)
            <div class="col-md-13">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title">{{$rows->nomegrupo}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nome</th>
                                <th colspan="2">Ação</th>

                            </tr>
                            <?php $i=1;?>
                            @foreach($integrante as $rows2)
                                @if($rows->id == $rows2->grupo_conselhosuperior_id)
                                <tr>
                                    <td>{{$i.'.'}}</td>
                                    <td>{{$rows2->pessoa->nome}}</td>

                                    <td width="50">
                                        <a href="{{ route('conselho.edit', ['id' => $rows2->id ]) }}"
                                           ><button  title="Editar" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button></a></a>
                                    </td>
                                    <td width="50">
                                        {!! Form::open(['method'=>'DELETE', 'url' => '/conselhosuperior/'.$rows2->id]) !!}
                                        <a><button  class="btn btn-danger" onclick="return confirm('Deseja remover o usuário {{$rows2->pessoa->nome}}?')"  title="Excluir" ><i class="fa fa-trash-o"></i> Excluir</button></a>
                                        {!! Form::close() !!}
                                        <?php $i++; ?>
                                    </td>
                                    <?php $i++;?>

                                </tr>

                                @endif
                            @endforeach
                        </table>


                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
            @endforeach

        </div>
    </div>



@stop

@section('css')
    <link rel="stylesheet" href="#">
@stop

@section('js')
    <script> $(document).ready(function () {
            $('.js-example-basic-single').select2();
        }); </script>
@stop