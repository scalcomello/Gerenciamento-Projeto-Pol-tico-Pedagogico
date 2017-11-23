@extends('adminlte::page')

@section('title', 'Usuários')


@section('content_header')

        <h1>Perfil Usuário</h1>

        <ol class="breadcrumb">
            <li><a href=home></i> Ínicio</a></li>
            <li class="active">Usuários</li>
            <li class="active">Perfil</li>
        </ol>

@stop

@section('content')



    <div  class="ng-scope">

            <div class="panel profile-page animated zoomIn" >
                <div class="panel-body" >
                    <h3 class="with-line">Informação Geral</h3>
                    <div class="row">
                        <div class="col-md-6">




                                {{ csrf_field() }}
                            <div class="form-group row clearfix">
                                <label for="inputFirstName" class="col-sm-3 control-label">Foto</label>
                                <div class="col-sm-9">
                                    <div class="userpic">
                                        <div class="userpic-wrapper">
                                            <img src="{{ asset("/dist/img/avatar.png") }}" height="150" width="150"/>
                                        </div>

                                        <!-- end ngIf: !noPicture --> <label for="input"  >Mudar Foto</label>
                                        <input type="file" id="uploadFile"  class="ng-hide">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row clearfix">
                                <label for="inputFirstName" class="col-sm-3 control-label">Nome</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ Auth::user()->name}}">
                                </div>
                            </div>

                            <div class="form-group row clearfix">
                                <label for="inputLastName" class="col-sm-3 control-label">Perfil</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Administrador</option>
                                        <option>Administrador</option>
                                        <option>Coordenador</option>
                                        <option>Administrativo</option>
                                        <option>Professor</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row clearfix">
                                <div class="col-sm-9">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="with-line">Mudar Senha</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row clearfix">
                                <label for="inputPassword" class="col-sm-3 control-label">Nova Senha</label>
                                <div class="col-sm-7"><input type="password" class="form-control" id="inputPassword" placeholder="" value=""></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row clearfix">
                                <label for="inputConfirmPassword" class="col-sm-3 control-label">Confirmar Senha</label>
                                <div class="col-sm-7"><input type="password" class="form-control" id="inputConfirmPassword" placeholder=""></div>
                            </div>
                        </div>
                    </div>
                    <h3 class="with-line">Contato</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row clearfix"><label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9"><input type="email" class="form-control" id="inputEmail3" placeholder="" value="{{ Auth::user()->email}}"></div>
                            </div>

                        </div>
                    </div>
<br>
                    <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-with-icon save-profile"><i class="ion-android-checkmark-circle"></i> Atualizar Perfil </button>
                    </div>
            </div>

            </div>


        </div>
    </div>






@stop

@section('css')
    <link rel="stylesheet" href="#">
@stop

@section('js')
    <script>  </script>
@stop