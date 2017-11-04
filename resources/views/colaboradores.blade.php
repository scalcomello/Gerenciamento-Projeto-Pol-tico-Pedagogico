@extends('layouts.app')

@section('title_page')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Colaboradores</h1>
        <ol class="breadcrumb">
            <li><a href=home><i class="fa fa-dashboard"></i> Ínicio</a></li>
            <li><a href=colaboradores><i class="fa fa-dashboard"></i>Colaboradores</a></li>
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
                                <i class="fa fa-user-plus"></i>   <h3 class="box-title">Cadastrar Colaborador</h3>
                            @endif
                        </div>

                        @if(Request::is('*/editar'))
                            {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'colaboradores/'.$edit->id]) !!}
                        @else
                            {!! Form::open(array('route' => 'colaboradores.store', 'class' => 'form-horizontal')) !!}
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
                                        {!! Form::input('text','nome',old('nome'),array('class' => 'form-control','placeholder' => 'Nome do colaborador'))!!}
                                        @if ($errors->has('nome'))
                                            <span class="help-block"><strong>{{ $errors->first('nome') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
                                    {!!  Form::label('cargo','Cargo',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">
                                        {{ Form::select('cargo' ,[
                                                                        'professor' => 'Professor',
                                                                        'administrativo' => 'Administrativo',
                                                                        'outros' => 'Outros',


                                                                        ],'Professor',['class' => 'form-control'])
                                                                     }}

                                        @if ($errors->has('cargo'))
                                            <span class="help-block"><strong>{{ $errors->first('cargo') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="box-footer">
                                    @if(Request::is('*/editar'))
                                        <a class="btn btn-default btn-close" href="{{ route('colaboradores.index') }}">Cancelar</a>
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



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Lista de Colaboradores</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Cargo</th>
                                <th>Ação</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($colaboradores as $rows)
                                <tr>
                                    <td>{{$rows->nome}}</td>
                                    <td>{{$rows->cargo}}</td>
                                    <td width="50"> <div class="tools">
                                            <a href="{{ route('colaboradores.edit', ['id' => $rows->id ]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </div>

                                    </td>
                                    <td width="50">
                                        {!! Form::open(['method'=>'DELETE', 'url' => '/colaboradores/'.$rows->id]) !!}

                                        <button class="btn btn-default btn-sm type=" onclick="return confirm('Deseja remover este colaborador?')" type="submit"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                    @endforeach
                                </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Cargo</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
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