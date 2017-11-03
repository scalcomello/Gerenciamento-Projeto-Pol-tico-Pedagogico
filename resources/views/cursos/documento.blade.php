@extends('layouts.app')

@section('title_page')



    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

{{$nomecurso->denominacao}}
        </h1>
        <ol class="breadcrumb">

            <li><a href="home">Cursos</a></li>
            <li><a href="home">Gerenciar</a></li>
            <li><a href="home">Estrutura Documental</a></li>
        </ol>
    </section>
@endsection
@section('content_page')


    <section class="content">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-header with-border">
                        <i class="fa fa-caret-right"></i>
                        <h3 class="box-title">Categoria</h3>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h3>Ordem dos Titulos</h3>

                            <ul id="menu" class="todo-list">
                                @foreach($documento as $item)
                                    <li id="{{$item->id}}">
                                        <!-- drag handle -->
                                        <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                        <!-- todo text -->
                                        <a href="{{ route('curso.index_subdocumento', ['curso' => $curso,'titulo' => $item->id]) }}" > <span class="text">{{ $item->titulo }}</span></a>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <a href="{{ route('curso.edit_documento', ['curso' => $curso,'id' => $item->id ]) }}"
                                               ><i class="fa fa-edit"></i></a>

                                            <a href="{{ route('curso.destroy_documento', ['curso' => $curso,'id' => $item->id ]) }}"
                                            ><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <script>
                            $(function () {
                                $("#menu").sortable({
                                    stop: function () {
                                        $.map($(this).find('li'), function (el) {
                                            var itemID = el.id;
                                            var itemIndex = $(el).index();
                                            $.ajax({
                                                url: '/cursos/{{$curso}}/gerenciar/estrutura_documental/atualizar',
                                                type: 'GET',
                                                dataType: 'json',
                                                data: {itemID: itemID, itemIndex: itemIndex},
                                            })
                                        });
                                    }
                                });
                            });
                        </script>


                        <div class="col-md-4">
                            <h3>Adicionar Novo Titulo</h3>
                            @if(Request::is('*/editar'))
                                {!! Form::model($edit,['method' => 'PATCH','class' => 'form-horizontal', 'url' => 'cursos/'.$edit->cursos_id.'/gerenciar/estrutura_documental/'.$edit->id.'/editar']) !!}
                            @else
                            {!! Form::open(['route'=>'curso.add_documento']) !!}
                            @endif
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            {{ Form::hidden('cursos_id',$curso) }}

                            <div class="form-group {{ $errors->has('titulo') ? 'has-error' : '' }}">
                                {!! Form::label('Titulo:') !!}
                                {!! Form::text('titulo', old('titulo'), ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <span class="text-danger">{{ $errors->first('titulo') }}</span>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-info">Adicionar</button>
                            </div>

                            {!! Form::close() !!}

                        </div>

                        <!-- /.box -->
                    </div>

                </div>
            </div>
        </div>
    </section>



@endsection


@section('scripts')
    <script type="text/javascript">
        $(function () {
            // alert('Teste section');
        });
    </script>
@endsection