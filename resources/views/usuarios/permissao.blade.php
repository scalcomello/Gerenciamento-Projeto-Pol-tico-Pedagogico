@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>
        Permissões
    </h1>
    <ol class="breadcrumb">
        <li><a href="usuarios"><i class="fa fa-user"></i>Usuários</a></li>
        <li><a href="permissao">Permissão</a></li>
    </ol>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-header with-border">
                        <i class="ion ion-android-unlock"></i>
                        <h3 class="box-title">Gerenciar Permissões de Acesso</h3>
                    </div>
                    {!! Form::open(array('route' => 'user.store_permission', 'class' => 'form-horizontal')) !!}
                    <div class="fetched-data">

                        {{ csrf_field() }}
                        <div class="box-body">
                            <!-- Mensagem de Ação -->
                            @include('adminlte::mensage')

                            <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                                {!!  Form::label('role_id','Perfil',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-6">

                                    {{ Form::select('role_id' ,$rolelist,null,['class' => 'js-example-basic-single'])  }}
                                    @if ($errors->has('role_id'))
                                        <span class="help-block"><strong>{{ $errors->first('role_id') }}</strong></span>
                                    @endif


                                    <button type="button"
                                            onclick="javascript: location.href='{{ route('user.create') }}'"
                                            title="Cadastrar Grupo" class="btn btn-default"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('permission_id') ? ' has-error' : '' }}">
                                {!!  Form::label('permission_id','Permissão',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-8">

                                    {{ Form::select('permission_id' ,$permissionlist,null,['class' => 'js-example-basic-single'])  }}
                                    @if ($errors->has('permission_id'))
                                        <span class="help-block"><strong>{{ $errors->first('permission_id') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="box-footer">
                                {!! Form::submit('Cadastrar', ['class' => 'btn btn-info' ]) !!}
                            </div>
                            {!! @Form::close() !!}
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>


            @foreach($role as $rows2)
                <div class="col-md-13">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="ion ion-android-contact"></i>
                            <h3 class="box-title">{{$rows2->label}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            @foreach($permission as $rows)
                                @if($rows2->id == $rows->role_id)

<div class="aaa">
                                    {!! Form::open(['method'=>'DELETE', 'url' => '/permissao/'.$rows->id]) !!}

                                    <a >
                                        <button class="btn btn-alert"
                                                onclick="return confirm('Deseja remover a permissao {{$rows->permission->label}}?')"
                                                title="Excluir"><i class="fa fa-close"></i> {{$rows->permission->label}}
                                        </button>
                                    </a >
                                    {!! Form::close() !!}</div>


                                @endif
                            @endforeach
                        </div>
                    </div><!-- /.box -->


                </div><!-- /.col -->

            @endforeach
            </div> </div>
@stop

@section('css')

                <style type="text/css">
                    .aaa {
                        width: 200px;
                        height: 30px;
                        float: left;
                        border: 1px solid #FFF;
}

</style>

@stop

@section('js')

                <script> $(document).ready(function () {
                        $('.js-example-basic-single').select2();
                    }); </script>
@stop