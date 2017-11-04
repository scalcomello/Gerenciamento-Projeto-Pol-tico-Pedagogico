@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Projeto político pedágogico

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
                                <i class="fa fa-user-plus"></i>   <h3 class="box-title">Cadastrar Representante</h3>
                            @endif
                        </div>



                        @if(Request::is('*/editar'))
                            {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'legislacao/'.$edit->id]) !!}
                        @else
                            {!! Form::open(array('route' => 'legislacao.store', 'class' => 'form-horizontal')) !!}
                        @endif

                        <div class="fetched-data">

                            {{ csrf_field() }}
                            <div class="box-body">
                                @if(Session::has('mensagem_sucesso'))

                                    <div class="callout callout-success">
                                        {{ Session::get('mensagem_sucesso') }}
                                    </div>

                                @endif

                                    <div class="form-group{{ $errors->has('lei') ? ' has-error' : '' }}">
                                        {!!  Form::label('lei','Lei',array('class' => 'col-sm-2 control-label')) !!}
                                        <div class="col-sm-6">
                                            {!! Form::input('text','lei',old('lei'),array('class' => 'form-control','placeholder' => ''))!!}
                                            @if ($errors->has('lei'))
                                                <span class="help-block"><strong>{{ $errors->first('lei') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                <div class="form-group{{ $errors->has('ementa') ? ' has-error' : '' }}">
                                    {!!  Form::label('ementa','Ementa',array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-6">
                                        {!! Form::textarea('ementa',old('ementa'),array('class' => 'form-control','rows' => '3', 'cols' => '40'))!!}

                                        @if ($errors->has('ementa'))
                                            <span class="help-block"><strong>{{ $errors->first('ementa') }}</strong></span>
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










                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Leis Cadatradas</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Campus</th>
                                    <th>Diretor</th>
                                    <th colspan="2">Ação</th>
                                </tr>
                                <?php $i=1;?>
                                @foreach($legislacao as $rows)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$rows->lei}}</td>
                                        <td>{{$rows->ementa}}</td>
                                        <td width="50">
                                            <a href="{{ route('legislacao.edit', ['id' => $rows->id ]) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </td><td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' => '/legislacao/'.$rows->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i class="fa fa-trash-o"></i></button>
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