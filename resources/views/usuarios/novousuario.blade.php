@extends('layouts.app')

@section('title_page')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Usuários</h1>

        <ol class="breadcrumb">
            <li><a href="../usuarios">Usuários</a></li>
            <li class="active">Novo</li>
        </ol>
    </section>
@endsection
@section('content_page')




    <!-- Main content -->
    <div class="col-md-12 ">
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-header with-border">
                    <i class="fa fa-user"></i>
                    <h3 class="box-title">Cadastrar Usuário</h3>
                </div>

                            @if(Request::is('*/editar'))
                                {!! Form::model($usuarios,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'usuarios/'.$usuarios->id]) !!}
                            @else
                            {!! Form::open(array('route' => 'user.store', 'class' => 'form-horizontal')) !!}
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
                                        {{ Form::hidden('foto', '/bower_components/admin-lte/dist/img/55162.png') }}


                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        {!!  Form::label('name','Nome',array('class' => 'col-sm-2 control-label')) !!}
                                            <div class="col-sm-6">
                                                {!! Form::input('text','name',old('name'),array('class' => 'form-control','placeholder' => 'Nome','autofocus'=>'autofocus','required' => 'required'))!!}
                                            @if ($errors->has('name'))
                                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        {!!  Form::label('e-mail','E-mail',array('class' => 'col-sm-2 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::input('text','email',old('email'),array('class' => 'form-control','placeholder' => 'E-mail','required' => 'required'))!!}
                                            @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                        <div class="form-group">
                                        {!!  Form::label('perfil','Perfil',array('class' => 'col-sm-2 control-label')) !!}
                                            <div class="col-md-6">
                                        {{ Form::select('perfil', [ 'Administrador' => 'Administrador','Coordenador' =>'Coordenador', 'Professor' =>'Professor'],null,['class' => 'form-control']) }}
                                            </div>
                                        </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        {!!  Form::label('senha','Senha',array('class' => 'col-sm-2 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::input('password','password','',array('class' => 'form-control','placeholder' => 'Senha','required' => 'required'))!!}
                                            @if ($errors->has('password'))<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!!  Form::label('senha','Confirmar senha',array('class' => 'col-sm-2 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::input('password','password_confirmation','',array('class' => 'form-control','placeholder' => 'Senha','required' => 'required'))!!}
                                        </div>
                                    </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="button"  onclick="javascript: location.href='{{ route('user.index') }}'" class="btn btn-default">Voltar</button>


                                        @if(Request::is('*/editar'))
                                            {!! Form::submit('Atualizar', ['class' => 'btn btn-info' ]) !!}
                                          @else
                                            {!! Form::submit('Criar', ['class' => 'btn btn-info' ]) !!}
                                            @endif
                                    </div>



                            {!! @Form::close() !!}
                                </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    </div>


        @endsection

        @section('scripts')

            <script type="text/javascript">
                $(function () {
                    //alert('Teste section usuarios');

                });
            </script>

@endsection
