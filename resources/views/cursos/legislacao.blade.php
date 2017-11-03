@extends('layouts.app')

@section('title_page')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Legislação Curso

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
                                <i class="fa fa-balance-scale"></i>   <h3 class="box-title">Cadastrar Legislação</h3>
                            @endif
                        </div>




                            {!! Form::open(array('route' => 'curso.store_legislacao', 'class' => 'form-horizontal')) !!}


                        <div class="fetched-data">

                            {{ csrf_field() }}
                            <div class="box-body">
                                @if(Session::has('mensagem_sucesso'))

                                    <div class="callout callout-success">
                                        {{ Session::get('mensagem_sucesso') }}
                                    </div>

                                @endif
                                    {{ Form::hidden('cursos_id',$curso) }}

                                    <div class="form-group{{ $errors->has('legislacaos_id') ? ' has-error' : '' }}">
                                        {!!  Form::label('legislacaos_id','Legislação',array('class' => 'col-sm-2 control-label')) !!}
                                        <div class="col-sm-6">
                                            {{ Form::select('legislacaos_id' ,$legislacaos_lei,null,['class' => 'selectpicker','data-live-search'=> 'true'])  }}
                                            @if ($errors->has('legislacaos_id'))
                                                <span class="help-block"><strong>{{ $errors->first('legislacaos_id') }}</strong></span>
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









                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Legislação Referencial</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">

                            <table class="table table-bordered">
                                <tr>

                                    <th>Legislação</th>
                                    <th width="50" >Ação</th>
                                </tr>

                                @foreach($legislacao_curso as $rows)
                                    <tr>

                                        <td>{{$rows->legislacao->lei}}</td>

                                        <td width="50">
                                            {!! Form::open(['method'=>'DELETE', 'url' =>'/cursos/legislacao/'. $rows->id]) !!}
                                            <button class="btn btn-default btn-sm type=" type="submit"><i class="fa fa-trash-o"></i></button>
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