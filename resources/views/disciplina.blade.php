@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Disciplinas

        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-home"></i>Início</a></li>
        </ol>
    </section>
@endsection
@section('content_page')



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
                                  <h3 class="box-title">Cadastrar Disciplina</h3>
                            @endif
                        </div>



                        @if(Request::is('*/editar'))
                            {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'disciplina/'.$edit->id]) !!}
                        @else
                            {!! Form::open(array('route' => 'disciplina.store', 'class' => 'form-horizontal')) !!}
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
                                            {!! Form::input('text','nome',old('nome'),array('class' => 'form-control','placeholder' => ''))!!}
                                            @if ($errors->has('nome'))
                                                <span class="help-block"><strong>{{ $errors->first('nome') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                <div class="box-footer">
                                    @if(Request::is('*/editar'))
                                        <a class="btn btn-default btn-close" href="{{ route('disciplina.index') }}">Cancelar</a>
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


    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Disciplinas Cadastradas</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">

                <table id="example1" class="table table-bordered table-striped">
                    <tr>

                        <th>Disciplinas</th>
                        <th width="50">Ação</th>
                        <th> </th>
                    </tr>

                    @foreach($disciplinas as $rows)
                        <tr>
                            <td>{{$rows->nome}}</td>

                            <td width="50"> <div class="tools">
                                    <a href="{{ route('disciplina.edit', ['id' => $rows->id ]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                </div>

                            </td>
                            <td width="50">
                                {!! Form::open(['method'=>'DELETE', 'url' => '/disciplina/'.$rows->id]) !!}

                                <button class="btn btn-default btn-sm type=" onclick="return confirm('Deseja remover esta disciplina?')" type="submit"><i class="fa fa-trash-o"></i></button>
                                {!! Form::close() !!}
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
            //alert('Teste section');
        });
    </script>

@endsection