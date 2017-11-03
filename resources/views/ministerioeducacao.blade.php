@extends('layouts.app')

@section('title_page')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Ministerio da Educação</h1>
        <ol class="breadcrumb">
            <li><a href=home><i class="fa fa-dashboard"></i> Ínicio</a></li>
            <li><a href=ministerio_da_educacao><i class="fa fa-dashboard"></i> Ministerio da Educação</a></li>
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
                                <i class="fa fa-pencil-square-o"></i>       <h3 class="box-title">Atualizar</h3>
                            @else
                                <i class="fa fa-user-plus"></i>   <h3 class="box-title">Cadastrar Representante</h3>
                            @endif
                        </div>

                        @if(Request::is('*/editar'))
                            {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'ministerio_da_educacao/'.$edit->id]) !!}
                        @else
                            {!! Form::open(array('route' => 'ministerio.store', 'class' => 'form-horizontal')) !!}
                        @endif

                        <div class="fetched-data">
                            {{ csrf_field() }}
                            <div class="box-body">

                                @if(Session::has('mensagem_sucesso'))

                                    <div class="callout callout-success">
                                        {{ Session::get('mensagem_sucesso') }}
                                    </div>
                                @endif

                                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                    {!!  Form::label('nome','Nome',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">
                                        {!! Form::input('text','nome',old('nome'),array('class' => 'form-control','placeholder' => 'Nome do dirigente'))!!}
                                        @if ($errors->has('nome'))
                                            <span class="help-block"><strong>{{ $errors->first('nome') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
                                    {!!  Form::label('cargo','Cargo',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">
                                        {{ Form::select('cargo' ,[
                                                                        'presidente' => 'PRESIDENTE DA REPÚBLICA',
                                                                        'ministro' => 'MINISTRO DA EDUCAÇÃO',
                                                                        'sec_educ_prof_tecn' => 'SECRETÁRIO DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA',
                                                                        'reitor' => 'REITOR DO IFSULDEMINAS',
                                                                        'pro_reitor_admin_plan' => 'PRÓ-REITOR DE ADMINISTRAÇÃO E PLANEJAMENTO',
                                                                        'pro_reitor_ensino' => 'PRÓ-REITOR DE ENSINO',
                                                                        'pro_reitor_desenv_inst' => 'PRÓ-REITOR DE DESENVOLVIMENTO INSTITUCIONAL',
                                                                        'pro_reitor_posgrad_pesq_ino' => 'PRÓ-REITOR DE PÓS-GRADUAÇÃO, PESQUISA E INOVAÇÃO',
                                                                        'pro_reitor_ext' => 'PRÓ-REITOR DE EXTENSÃO'

                                                                        ],null,['class' => 'form-control'])
                                                                     }}

                                        @if ($errors->has('cargo'))
                                            <span class="help-block"><strong>{{ $errors->first('cargo') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="box-footer">
                                    @if(Request::is('*/editar'))
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
                            <h3 class="box-title">Representantes</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRESIDENTE DA REPÚBLICA</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($presidente as $rows)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('ministerio.edit', ['id' => $rows->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>

                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>MINISTRO DA EDUCAÇÃO</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($ministro as $rows1)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows1->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('ministerio.edit', ['id' => $rows1->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows1->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>SECRETÁRIO DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($sec_educ_prof_tecn as $rows2)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows2->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('ministerio.edit', ['id' => $rows2->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows2->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>REITOR DO IFSULDEMINAS</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($reitor as $rows3)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows3->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('ministerio.edit', ['id' => $rows3->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows3->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRÓ-REITOR DE ADMINISTRAÇÃO E PLANEJAMENTO</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($pro_reitor_admin_plan as $rows4)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows4->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('ministerio.edit', ['id' => $rows4->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows4->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRÓ-REITOR DE ENSINO</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($pro_reitor_ensino as $rows5)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows5->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('ministerio.edit', ['id' => $rows5->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows5->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRÓ-REITOR DE DESENVOLVIMENTO INSTITUCIONAL</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($pro_reitor_desenv_inst as $rows6)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows6->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('ministerio.edit', ['id' => $rows6->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows6->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRÓ-REITOR DE PÓS-GRADUAÇÃO, PESQUISA E INOVAÇÃO</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($pro_reitor_posgrad_pesq_ino as $rows7)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows7->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('ministerio.edit', ['id' => $rows7->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows7->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                            <?php $i++; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>PRÓ-REITOR DE EXTENSÃO</th>

                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i = 1;?>
                                @foreach($pro_reitor_ext as $rows8)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows8->nome}}</td>

                                        <td width="50">
                                            <a href="{{ route('ministerio.edit', ['id' => $rows8->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/ministerio_da_educacao/'.$rows8->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i
                                                        class="fa fa-trash-o"></i></button>
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