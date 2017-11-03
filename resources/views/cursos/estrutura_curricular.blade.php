@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Estrutura Curricular
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-home"></i>Início</a></li>
        </ol>
    </section>
@endsection

@section('content_page')


    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-6 col-sm-7 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Componente Curricuar</h3>

                        <button type="button" class="btn btn-default pull-right" data-toggle="modal"
                                data-target="#myModa2"><i class="fa fa-plus"></i>
                            Componente Curricular
                        </button>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 30px">Sigla</th>
                            <th>Descrição</th>
                            <th style="width: 30px">Carga Horária</th>
                            <th colspan="2">Ação</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($componentecurricular as $rows1)

                            <tr>
                                <td>
                                    {{ $rows1->sigla}}
                                </td>
                                <td>
                                    {{ $rows1->descricao}}
                                </td>
                                <td>{{$rows1->cargahoraria}}</td>

                                <td width="30">
                                    <a href="{{ route('curso.edit_componente', ['id' => $rows1->id ]) }}"
                                       data-hover="tooltip"
                                       data-placement="top"
                                       data-target="#myModa3{{$rows1->id }}"
                                       data-toggle="modal" title="Edit"
                                    > <i class="fa fa-edit"></i></a>
                                </td>
                                <td width="30">
                                    {!! Form::open(['method'=>'DELETE', 'url' => 'cursos/remover/componente/'.$rows1->id]) !!}
                                    <a href="" type="submit"><i
                                                class="fa fa-trash-o"></i></a>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th style="width: 30px">Total</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div><!-- /.col -->

            <div class="col-md-6 col-sm-7 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gráfico</h3>
                    </div>
                    {!! Charts::assets() !!}
                    {!! $chart->render() !!}
                </div>
            </div><!-- /.col -->
        </div>


        <!-- Small boxes (Periodos) -->
        <div class="row">
            @for ($j = 1; $j <= $periodo; $j++)
                <div class="col-md-12 col-sm-7 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{$j}} Periodo</h3>
                            <button type="button" class="btn btn-default pull-right" data-toggle="modal"
                                    data-target="#myModal"><i class="fa fa-plus"></i>
                                Nova Disciplina
                            </button>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Disciplina</th>
                                <th style="width: 30px">Carga Horaria</th>
                                <th style="width: 30px">Aulas Semanais</th>
                                <th colspan="2">Ação</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;?>
                            @foreach($disciplina as $rows)
                                @if($rows->periodo == $j)
                                    <tr>
                                        <td>{{$i.'.'}}</td>
                                        <td><a href='estrutura_curricular/{{$rows->id}}/ementario'>{{$rows->disciplina->nome}}</a></td>
                                        <td width="80">
                                            <center>{{$rows->ch}}</center>
                                        </td>
                                        <td>
                                            <center>{{$rows->qtd_aula}}</center>
                                        </td>


                                        <td width="30">
                                            <a href="{{ route('curso.edit_disciplina', ['id' => $rows->id ]) }}"
                                               data-hover="tooltip"
                                               data-placement="top"
                                               data-target="#myModa4{{$rows->id }}"
                                               data-toggle="modal" title="Editar"
                                            > <i class="fa fa-edit"></i></a>
                                        </td>


                                        </td>
                                        <td width="30">
                                            {!! Form::open(['method'=>'DELETE', 'url' => 'cursos/remover/disciplina/'.$rows->id]) !!}

                                            <a title="Remover" href=""
                                               onclick="return confirm('Deseja remover este usuário?')"
                                               type="submit"
                                            > <i class="fa fa-trash-o"></i></a>

                                            {!! Form::close() !!}
                                        </td> <?php $i++;?>

                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Total: {{$total_ch[$j]}}</th>
                                <th>total: {{$total_qtd_aula[$j]}}</th>
                                <th></th>

                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><!-- /.col -->
            @endfor
        </div>
    </section>


    <!-- Modal cadastro disciplina -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="location.href='estrutura_curricular';" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Disciplina</h4>
                </div>
                <div class="modal-body">

                    {!! Form::open(array('route' => 'curso.store_disciplina', 'class' => 'form-horizontal')) !!}
                    {{ csrf_field() }}

                    <div class="box-body">


                        <div class="form-group{{ $errors->has('disciplinas_id') ? ' has-error' : '' }}">
                            {!!  Form::label('disciplinas_id','Disciplina',array('class' => 'col-sm-4 control-label')) !!}
                            <div class="col-sm-6">
                                {{ Form::select('disciplinas_id' ,$disciplinas_nome,null,['class' => 'form-control'])  }}
                                @if ($errors->has('disciplinas_id'))
                                    <span class="help-block"><strong>{{ $errors->first('disciplinas_id') }}</strong></span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('ch') ? ' has-error' : '' }}">
                            {!!  Form::label('ch','Carga Horária',array('class' => 'col-sm-4 control-label')) !!}
                            <div class="col-sm-2">
                                {!! Form::input('number','ch',old('ch'),array('class' => 'form-control','placeholder' => ''))!!}
                                @if ($errors->has('ch'))
                                    <span class="help-block"><strong>{{ $errors->first('ch') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('qtd_aula') ? ' has-error' : '' }}">
                            {!!  Form::label('qtd_aula','Quantidade de Aula',array('class' => 'col-sm-4 control-label')) !!}
                            <div class="col-sm-2">
                                {!! Form::input('number','qtd_aula',old('qtd_aula'),array('class' => 'form-control','placeholder' => ''))!!}
                                @if ($errors->has('qtd_aula'))
                                    <span class="help-block"><strong>{{ $errors->first('qtd_aula') }}</strong></span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('periodo') ? ' has-error' : '' }}">
                            {!!  Form::label('periodo','Periodo',array('class' => 'col-sm-4 control-label')) !!}
                            <div class="col-sm-2">
                                <select class="form-control" name="periodo"
                                        id="periodo">  @for ($j = 1; $j <= $periodo; $j++)
                                        <option value="{{$j}}">{{$j}}</option>
                                    @endfor
                                </select>

                                @if ($errors->has('periodo'))
                                    <span class="help-block"><strong>{{ $errors->first('periodo') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{ Form::hidden('cursos_id',$idcurso) }}




                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Salvar', ['class' => 'btn btn-primary' ]) !!}
                    <button type="button"  onclick="location.href='estrutura_curricular';" class="btn btn-default" data-dismiss="modal">Sair</button>
                </div>
                {!! @Form::close() !!}
            </div>
        </div>
    </div>


    <!-- Modal editar disciplina -->
    @foreach($disciplina as $rows)
        <div class="modal fade" id="myModa4{{$rows->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" onclick="location.href='estrutura_curricular';" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Disciplina</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::model($rows,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'cursos/atualizar/disciplina/'.$rows->id]) !!}

                        <div class="box-body">


                            <div class="form-group{{ $errors->has('disciplinas_id') ? ' has-error' : '' }}">
                                {!!  Form::label('disciplinas_id','Disciplina',array('class' => 'col-sm-4 control-label')) !!}
                                <div class="col-sm-6">
                                    {{ Form::select('disciplinas_id' ,$disciplinas_nome,null,['class' => 'form-control'])  }}
                                    @if ($errors->has('disciplinas_id'))
                                        <span class="help-block"><strong>{{ $errors->first('disciplinas_id') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('ch') ? ' has-error' : '' }}">
                                {!!  Form::label('ch','Carga Horária',array('class' => 'col-sm-4 control-label')) !!}
                                <div class="col-sm-2">
                                    {!! Form::input('number','ch',old('ch'),array('class' => 'form-control','placeholder' => ''))!!}
                                    @if ($errors->has('ch'))
                                        <span class="help-block"><strong>{{ $errors->first('ch') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('qtd_aula') ? ' has-error' : '' }}">
                                {!!  Form::label('qtd_aula','Quantidade de Aula',array('class' => 'col-sm-4 control-label')) !!}
                                <div class="col-sm-2">
                                    {!! Form::input('number','qtd_aula',old('qtd_aula'),array('class' => 'form-control','placeholder' => 'Carga Horária'))!!}
                                    @if ($errors->has('qtd_aula'))
                                        <span class="help-block"><strong>{{ $errors->first('qtd_aula') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('periodo') ? ' has-error' : '' }}">
                                {!!  Form::label('periodo','Periodo',array('class' => 'col-sm-4 control-label')) !!}
                                <div class="col-sm-2">
                                    <select class="form-control" name="periodo"
                                            id="periodo">  @for ($j = 1; $j <= $periodo; $j++)
                                            <option value="{{$j}}">{{$j}}</option>
                                        @endfor
                                    </select>

                                    @if ($errors->has('periodo'))
                                        <span class="help-block"><strong>{{ $errors->first('periodo') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            {{ Form::hidden('cursos_id',$idcurso) }}

                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary' ]) !!}
                        <button type="button" onclick="location.href='estrutura_curricular';" class="btn btn-default" data-dismiss="modal">Sair</button>
                    </div>
                    {!! @Form::close() !!}
                </div>
            </div>
        </div>
    @endforeach


    <!-- Modal cadastro componente -->
    <div class="modal fade" id="myModa2" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="location.href='estrutura_curricular';" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Componente Curricular</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('route' => 'curso.store_componente', 'class' => 'form-horizontal')) !!}
                    {{ csrf_field() }}
                    <div class="box-body">


                        <div class="form-group{{ $errors->has('sigla') ? ' has-error' : '' }}">
                            {!!  Form::label('sigla','Sigla',array('class' => 'col-sm-4 control-label')) !!}
                            <div class="col-sm-8">
                                {!! Form::input('text','sigla',old('sigla'),array('class' => 'form-control','placeholder' => 'sigla'))!!}
                                @if ($errors->has('sigla'))
                                    <span class="help-block"><strong>{{ $errors->first('sigla') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                            {!!  Form::label('descricao','Descricão',array('class' => 'col-sm-4 control-label')) !!}
                            <div class="col-sm-8">
                                {!! Form::input('text','descricao',old('descricao'),array('class' => 'form-control','placeholder' => 'Descrição'))!!}
                                @if ($errors->has('descricao'))
                                    <span class="help-block"><strong>{{ $errors->first('descricao') }}</strong></span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('cargahoraria') ? ' has-error' : '' }}">
                            {!!  Form::label('cargahoraria','Carga Horária',array('class' => 'col-sm-4 control-label')) !!}
                            <div class="col-sm-3">
                                {!! Form::input('text','cargahoraria',old('cargahoraria'),array('class' => 'form-control','placeholder' => 'Carga Horária'))!!}
                                @if ($errors->has('cargahoraria'))
                                    <span class="help-block"><strong>{{ $errors->first('cargahoraria') }}</strong></span>
                                @endif
                            </div>
                        </div>


                        {{ Form::hidden('cursos_id',$idcurso) }}


                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Salvar', ['class' => 'btn btn-primary' ]) !!}
                    <button type="button"  onclick="location.href='estrutura_curricular';" class="btn btn-default" data-dismiss="modal">Sair</button>
                </div>
                {!! @Form::close() !!}
            </div>
        </div>
    </div>


    <!-- Modal editar componente -->
    @foreach($componentecurricular as $rows1)
        <div class="modal fade" id="myModa3{{$rows1->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"  onclick="location.href='estrutura_curricular';" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Componente Curricular</h4>
                    </div>
                    <div class="modal-body">

                        {!! Form::model($rows1,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'cursos/atualizar/componente/'.$rows1->id]) !!}

                        {{ csrf_field() }}
                        <div class="box-body">

                            {{$rows1->id}}

                            <div class="form-group{{ $errors->has('sigla') ? ' has-error' : '' }}">
                                {!!  Form::label('sigla','Sigla',array('class' => 'col-sm-4 control-label')) !!}
                                <div class="col-sm-8">
                                    {!! Form::input('text','sigla',old('sigla'),array('class' => 'form-control','placeholder' => 'sigla'))!!}
                                    @if ($errors->has('sigla'))
                                        <span class="help-block"><strong>{{ $errors->first('sigla') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                                {!!  Form::label('descricao','Descricão',array('class' => 'col-sm-4 control-label')) !!}
                                <div class="col-sm-8">
                                    {!! Form::input('text','descricao',old('descricao'),array('class' => 'form-control','placeholder' => 'Descrição'))!!}
                                    @if ($errors->has('descricao'))
                                        <span class="help-block"><strong>{{ $errors->first('descricao') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('cargahoraria') ? ' has-error' : '' }}">
                                {!!  Form::label('cargahoraria','Carga Horária',array('class' => 'col-sm-4 control-label')) !!}
                                <div class="col-sm-3">
                                    {!! Form::input('text','cargahoraria',old('cargahoraria'),array('class' => 'form-control','placeholder' => 'Carga Horária'))!!}
                                    @if ($errors->has('cargahoraria'))
                                        <span class="help-block"><strong>{{ $errors->first('cargahoraria') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            {{ Form::hidden('cursos_id',$idcurso) }}


                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary' ]) !!}
                        <button type="button" onclick="location.href='estrutura_curricular';" class="btn btn-default" data-dismiss="modal">Sair</button>
                    </div>
                    {!! @Form::close() !!}
                </div>
            </div>
        </div>
            @endforeach


            @if(!empty(Session::get('error_code')) && Session::get('error_code') == true)
                <script>

                    setTimeout(function(){
                        $('#myModal').modal('show');
                    }, 2000);
                </script>
            @endif

            @endsection

            @section('scripts')
                <script type="text/javascript">
                    $(function () {
                        //alert('Teste section usuarios');
                    });
                </script>
@endsection