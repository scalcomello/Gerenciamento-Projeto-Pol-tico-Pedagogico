@extends('layouts.app')

@section('title_page')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Caracterização Institucional</h1>
        <ol class="breadcrumb">

            <li><a href="identificacao"><i class="fa fa-building-o"></i>Caracterização Institucional</a></li>
            <li><a href="identificacao"><i class=""></i>Identificação</a></li>
        </ol>
    </section>
@endsection
@section('content_page')

    @include('layouts.sidebar')

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <!-- EDITAR DADOS RELACIONADOS A REITORIA -->

            @if(Request::is('*/reitoria/editar') || Request::is('*/identificacao_campi/editar') || Request::is('*/entidade_mantenedora/editar') )
                <div class="col-md-13">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-header with-border">
                                @if(Request::is('*/identificacao_campi/editar'))
                                <i class="fa fa-pencil-square-o"></i>       <h3 class="box-title">Atualizar Campi</h3>
                                    @elseif(Request::is('*/entidade_mantenedora/editar'))
                                    <i class="fa fa-pencil-square-o"></i>       <h3 class="box-title">Atualizar Entidade Mantenedora</h3>
                                    @else
                                    <i class="fa fa-pencil-square-o"></i>       <h3 class="box-title">Atualizar Reitoria</h3>
                                    @endif
                            </div>


                            {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'caracterizacao_institucional/'.$edit->id]) !!}
                            <div class="fetched-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row clearfix{{ $errors->has('nome_instituto') ? ' has-error' : '' }}">
                                                {!!  Form::label('nome_instituto','Nome do Instituto',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::input('text','nome_instituto',old('nome_instituto'),array('class' => 'form-control' ,'placeholder' => 'Nome da Instituição'))!!}
                                                    @if ($errors->has('nome_instituto'))
                                                        <span class="help-block"><strong>{{ $errors->first('nome_instituto') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('cnpj') ? ' has-error' : '' }}">
                                                {!!  Form::label('cnpj','CNPJ',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-5">
                                                    {!! Form::input('text','cnpj',old('cnpj'),array('class' => 'form-control','placeholder' => 'Cnpj'))!!}
                                                    @if ($errors->has('cnpj'))
                                                        <span class="help-block"><strong>{{ $errors->first('cnpj') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('nome_dirigente') ? ' has-error' : '' }}">
                                                {!!  Form::label('nome_dirigente','Nome do Dirigente',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::input('text','nome_dirigente',old('nome_dirigente'),array('class' => 'form-control','placeholder' => ''))!!}
                                                    @if ($errors->has('nome_dirigente'))
                                                        <span class="help-block"><strong>{{ $errors->first('nome_dirigente') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('endereco_instituto') ? ' has-error' : '' }}">
                                                {!!  Form::label('endereco_instituto','Endereço do Instituto',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::input('text','endereco_instituto',old('endereco_instituto'),array('class' => 'form-control','placeholder' => ''))!!}
                                                    @if ($errors->has('endereco_instituto'))
                                                        <span class="help-block"><strong>{{ $errors->first('endereco_instituto') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                                                {!!  Form::label('bairro','Bairro',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-5">
                                                    {!! Form::input('text','bairro',old('endereco_instituto'),array('class' => 'form-control','placeholder' => ''))!!}
                                                    @if ($errors->has('bairro'))
                                                        <span class="help-block"><strong>{{ $errors->first('bairro') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
                                                {!!  Form::label('cidade','Cidade',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::input('text','cidade',old('endereco_instituto'),array('class' => 'form-control','placeholder' => ''))!!}
                                                    @if ($errors->has('cidade'))
                                                        <span class="help-block"><strong>{{ $errors->first('cidade') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group{{ $errors->has('uf') ? ' has-error' : '' }}">
                                                {!!  Form::label('uf','UF',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-3">
                                                    {!! Form::input('text','uf',old('endereco_instituto'),array('class' => 'form-control','placeholder' => ''))!!}
                                                    @if ($errors->has('uf'))
                                                        <span class="help-block"><strong>{{ $errors->first('uf') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group{{ $errors->has('cep') ? ' has-error' : '' }}">
                                                {!!  Form::label('cep','Cep',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-6">
                                                    {!! Form::input('text','cep',old('endereco_instituto'),array('class' => 'form-control','placeholder' => ''))!!}
                                                    @if ($errors->has('cep'))
                                                        <span class="help-block"><strong>{{ $errors->first('cep') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                                                {!!  Form::label('telefone','Telefone',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-6">
                                                    {!! Form::input('text','telefone',old('endereco_instituto'),array('class' => 'form-control','placeholder' => ''))!!}
                                                    @if ($errors->has('telefone'))
                                                        <span class="help-block"><strong>{{ $errors->first('telefone') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                                                {!!  Form::label('fax','Fax',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-5">
                                                    {!! Form::input('text','fax',old('endereco_instituto'),array('class' => 'form-control','placeholder' => ''))!!}
                                                    @if ($errors->has('fax'))
                                                        <span class="help-block"><strong>{{ $errors->first('fax') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                {!!  Form::label('email','E-mail',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::input('email','email',old('endereco_instituto'),array('class' => 'form-control','placeholder' => ''))!!}
                                                    @if ($errors->has('email'))
                                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(Request::is('*/entidade_mantenedora/editar'))
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('denominacao') ? ' has-error' : '' }}">
                                                {!!  Form::label('denominacao','Denomiação do Instituto',array('class' => 'col-sm-3 control-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::input('text','denominacao',old('denominacao'),array('class' => 'form-control','placeholder' => ''))!!}
                                                    @if ($errors->has('denominacao'))
                                                        <span class="help-block"><strong>{{ $errors->first('denominacao') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="box-footer">
                                        <a class="btn btn-default btn-close" href="{{ route('caracterizacao.index_identificacao') }}">Cancelar</a>
                                            {!! Form::submit('Atualziar', ['class' => 'btn btn-info' ]) !!}

                                    </div>
                                    {!! @Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            @else


            <!-- LISTAR CAMPUS RELACIONADO A REITORIA -->
                <div class="col-md-13">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-header with-border">

                                @if(Request::is('*/editar'))
                                    <i class="fa fa-pencil-square-o"></i>       <h3 class="box-title">Atualizar</h3>
                                @else
                                    <i class="fa fa-building-o"></i>   <h3 class="box-title">Reitoria</h3>
                                @endif
                            </div>

                            @if(Request::is('*/editar'))
                                {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'ministerio_da_educacao/'.$edit->id]) !!}
                            @endif

                            <div class="fetched-data">
                                {{ csrf_field() }}
                                <div class="box-body">

                                    @foreach($reitoria as $row)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>Nome instituto:</b>  {!! $row->nome_instituto!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>CNPJ:</b>  {!! $row->cnpj!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>Nome Dirigente:</b>  {!! $row->nome_dirigente!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>Endereço:</b>  {!! $row->endereco_instituto!!}</h5>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="col-sm-5">
                                                        <h5><b>Bairro:</b>  {!! $row->bairro!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-sm-8">
                                                        <h5><b>Cidade:</b>  {!! $row->cidade!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group{{ $errors->has('uf') ? ' has-error' : '' }}">
                                                    <div class="col-sm-4">
                                                        <h5><b>UF:</b>  {!! $row->uf!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <h5><b>Cep:</b>  {!! $row->cep!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                                                    <div class="col-sm-6">
                                                        <h5><b>Telefone:</b>  {!! $row->telefone!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-5">
                                                        <h5><b>Fax:</b>  {!! $row->fax!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>E-mail:</b>  {!! $row->email!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">

                                            <a href="{{ route('caracterizacao.edit_reitoria', ['id' => $row->id ]) }}"
                                               class="btn btn-default btn-sm">Editar</a>

                                        </div>
                                        {!! @Form::close() !!}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- LISTAR CAMPUS RELACIONADO A ENTIDADE MANTENEDORA -->
                <div class="col-md-13">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-header with-border">

                                @if(Request::is('*/editar'))
                                    <i class="fa fa-pencil-square-o"></i>       <h3 class="box-title">Atualizar</h3>
                                @else
                                    <i class="fa fa-building-o"></i>   <h3 class="box-title">Entidade Mantenedora</h3>
                                @endif
                            </div>

                            @if(Request::is('*/editar'))
                                {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'ministerio_da_educacao/'.$edit->id]) !!}
                            @endif

                            <div class="fetched-data">
                                {{ csrf_field() }}
                                <div class="box-body">

                                    @foreach($mantenedora as $row2)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>Nome instituto:</b>  {!! $row2->nome_instituto!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>CNPJ:</b>  {!! $row2->cnpj!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>Nome Dirigente:</b>  {!! $row2->nome_dirigente!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>Endereço:</b>  {!! $row2->endereco_instituto!!}</h5>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="col-sm-5">
                                                        <h5><b>Bairro:</b>  {!! $row2->bairro!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-sm-8">
                                                        <h5><b>Cidade:</b>  {!! $row2->cidade!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="col-sm-4">
                                                        <h5><b>UF:</b>  {!! $row2->uf!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <h5><b>Cep:</b>  {!! $row2->cep!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <h5><b>Telefone:</b>  {!! $row2->telefone!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-5">
                                                        <h5><b>Fax:</b>  {!! $row2->fax!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>E-mail:</b>  {!! $row2->email!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>Denominação do Instituto:</b>  {!! $row2->denominacao!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">

                                            <a href="{{ route('caracterizacao.edit_entidade_mantenedora', ['id' => $row2->id ]) }}"
                                               class="btn btn-default btn-sm">Editar</a>

                                        </div>
                                        {!! @Form::close() !!}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- LISTAR CAMPUS RELACIONADO A IDENTIFICAÇÃO DO CAMPI -->
                <div class="col-md-13">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-header with-border">

                                @if(Request::is('*/editar'))
                                    <i class="fa fa-pencil-square-o"></i>       <h3 class="box-title">Atualizar</h3>
                                @else
                                    <i class="fa fa-building-o"></i>   <h3 class="box-title">Identificação do Campi</h3>
                                @endif
                            </div>

                            @if(Request::is('*/editar'))
                                {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'ministerio_da_educacao/'.$edit->id]) !!}
                            @endif

                            <div class="fetched-data">
                                {{ csrf_field() }}
                                <div class="box-body">

                                    @foreach($campi as $row3)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>Nome instituto:</b>  {!! $row3->nome_instituto!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>CNPJ:</b>  {!! $row3->cnpj!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>Nome Dirigente:</b>  {!! $row3->nome_dirigente!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>Endereço:</b>  {!! $row3->endereco_instituto!!}</h5>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="col-sm-5">
                                                        <h5><b>Bairro:</b>  {!! $row3->bairro!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-sm-8">
                                                        <h5><b>Cidade:</b>  {!! $row3->cidade!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="col-sm-4">
                                                        <h5><b>UF:</b>  {!! $row3->uf!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <h5><b>Cep:</b>  {!! $row3->cep!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <h5><b>Telefone:</b>  {!! $row3->telefone!!}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-5">
                                                        <h5><b>Fax:</b>  {!! $row3->fax!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-9">
                                                        <h5><b>E-mail:</b>  {!! $row3->email!!}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">

                                            <a href="{{ route('caracterizacao.edit_identificacao_campi', ['id' => $row3->id ]) }}"
                                               class="btn btn-default btn-sm">Editar</a>

                                        </div>
                                        {!! @Form::close() !!}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

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