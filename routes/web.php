<?php

    Route::group(['middleware' => 'web'], function () {
    Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'home']); //inicio
    Route::post('notificacao', ['uses' => 'HomeController@notificacao', 'as' => 'notificacao']);//cadastrar notificação
    //Route::get('/menu', ['uses' => 'MenuController@menu']); //inicio
    //Route::get('menu/edit', ['uses' => 'MenuController@menustore']);//cadastrar notificação
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'login']);  //tela de login

    Auth::routes();
    Route::group(['as' => 'user.', 'prefix' => 'usuarios'], function () {
        Route::get('', ['uses' => 'UsuarioController@index', 'as' => 'index']);
        Route::get('novo', ['uses' => 'UsuarioController@create', 'as' => 'create']);
        Route::post('salvar', ['uses' => 'UsuarioController@store', 'as' => 'store']);
        Route::get('{id}/editar', ['uses' => 'UsuarioController@edit', 'as' => 'edit']);
        Route::get('{id}/perfil', ['uses' => 'UsuarioController@perfil', 'as' => 'perfil']);//somente em usuario porque possui 2 campos de edição
        Route::patch('{id}', ['uses' => 'UsuarioController@update', 'as' => 'update']);
        Route::delete('{id}', ['uses' => 'UsuarioController@destroy', 'as' => 'destroy']);
    });// fim user

    Route::group(['as' => 'ministerio.', 'prefix' => 'ministerio_da_educacao'], function () {
        Route::get('', ['uses' => 'Ministerio_da_educacaoController@index', 'as' => 'index']);
        Route::post('salvar', ['uses' => 'Ministerio_da_educacaoController@store', 'as' => 'store']);
        Route::get('{id}/editar', ['uses' => 'Ministerio_da_educacaoController@edit', 'as' => 'edit']);
        Route::patch('{id}', ['uses' => 'Ministerio_da_educacaoController@update', 'as' => 'update']);
        Route::delete('{id}', ['uses' => 'Ministerio_da_educacaoController@destroy', 'as' => 'destroy']);

    });//fim ministerio
    Route::group(['as' => 'conselho.', 'prefix' => 'conselhosuperior'], function () {
        Route::get('', ['uses' => 'ConselhosuperiorController@index', 'as' => 'index']);
        Route::post('salvar', ['uses' => 'ConselhosuperiorController@store', 'as' => 'store']);
        Route::get('{id}/editar', ['uses' => 'ConselhosuperiorController@edit', 'as' => 'edit']);
        Route::patch('{id}', ['uses' => 'ConselhosuperiorController@update', 'as' => 'update']);
        Route::delete('{id}', ['uses' => 'ConselhosuperiorController@destroy', 'as' => 'destroy']);
    });//fim conselho

    Route::group(['as' => 'diretores.', 'prefix' => 'diretores_de_campi'], function () {
        Route::get('', ['uses' => 'Diretores_de_campiController@index', 'as' => 'index']);
        Route::post('salvar', ['uses' => 'Diretores_de_campiController@store', 'as' => 'store']);
        Route::get('{id}/editar', ['uses' => 'Diretores_de_campiController@edit', 'as' => 'edit']);
        Route::patch('{id}', ['uses' => 'Diretores_de_campiController@update', 'as' => 'update']);
        Route::delete('{id}', ['uses' => 'Diretores_de_campiController@destroy', 'as' => 'destroy']);
    });// fim diretores

    Route::group(['as' => 'equipegestora.', 'prefix' => 'equipe_gestora'], function () {
        Route::get('', ['uses' => 'Equipe_gestoraController@index', 'as' => 'index']);
        Route::post('salvar', ['uses' => 'Equipe_gestoraController@store', 'as' => 'store']);
        Route::get('{id}/editar', ['uses' => 'Equipe_gestoraController@edit', 'as' => 'edit']);
        Route::patch('{id}', ['uses' => 'Equipe_gestoraController@update', 'as' => 'update']);
        Route::delete('{id}', ['uses' => 'Equipe_gestoraController@destroy', 'as' => 'destroy']);
    });//fim equipegestora

    Route::group(['as' => 'legislacao.', 'prefix' => 'legislacao'], function () {
        Route::get('', ['uses' => 'LegislacaoController@index', 'as' => 'index']);
        Route::post('salvar', ['uses' => 'LegislacaoController@store', 'as' => 'store']);
        Route::get('{id}/editar', ['uses' => 'LegislacaoController@edit', 'as' => 'edit']);
        Route::patch('{id}', ['uses' => 'LegislacaoController@update', 'as' => 'update']);
        Route::delete('{id}', ['uses' => 'LegislacaoController@destroy', 'as' => 'destroy']);
    });// fim legislacao

    Route::group(['as' => 'caracterizacao.', 'prefix' => 'caracterizacao_institucional'], function () {

        // identificacao
        Route::get('/identificacao', ['uses' => 'Caracterizacao_institucionalController@index_identificacao', 'as' => 'index_identificacao']);
        Route::get('{id}/reitoria/editar', ['uses' => 'Caracterizacao_institucionalController@edit', 'as' => 'edit_reitoria']);
        Route::get('{id}/entidade_mantenedora/editar', ['uses' => 'Caracterizacao_institucionalController@edit', 'as' => 'edit_entidade_mantenedora']);
        Route::get('{id}/identificacao_campi/editar', ['uses' => 'Caracterizacao_institucionalController@edit', 'as' => 'edit_identificacao_campi']);
        Route::patch('{id}', ['uses' => 'Caracterizacao_institucionalController@update', 'as' => 'update']);

        //caracterizacao
        Route::get('caracterizacao', ['uses' => 'Caracterizacao_institucionalController@index_caracterizacao', 'as' => 'index_caracterizacao']);
        Route::post('salvar/caracterizacao', ['uses' => 'Caracterizacao_institucionalController@store', 'as' => 'store_caracterizacao']);

        //historico
        Route::get('historico', ['uses' => 'Caracterizacao_institucionalController@index_historico', 'as' => 'index_historico']);
        Route::post('salvar/historico', ['uses' => 'Caracterizacao_institucionalController@store', 'as' => 'store_historico']);

    });//fim caracterizacao_institucional

    Route::group(['as' => 'colaboradores.', 'prefix' => 'colaboradores'], function () {
        Route::get('', ['uses' => 'ColaboradoresController@index', 'as' => 'index']);
        Route::post('salvar', ['uses' => 'ColaboradoresController@store', 'as' => 'store']);
        Route::get('{id}/editar', ['uses' => 'ColaboradoresController@edit', 'as' => 'edit']);
        Route::patch('{id}', ['uses' => 'ColaboradoresController@update', 'as' => 'update']);
        Route::delete('{id}', ['uses' => 'ColaboradoresController@destroy', 'as' => 'destroy']);
    });//fim colaboradores

    Route::group(['as' => 'curso.', 'prefix' => 'cursos'], function () {
        //Curso
        Route::get('', ['uses' => 'CursoController@index', 'as' => 'index']);
        Route::get('novo', ['uses' => 'CursoController@create', 'as' => 'create']);
        Route::post('novo/salvar', ['uses' => 'CursoController@store', 'as' => 'store']);
        Route::get('{id}/editar', ['uses' => 'CursoController@edit', 'as' => 'edit']);
        Route::patch('{id}', ['uses' => 'CursoController@update', 'as' => 'update']);
        Route::delete('{id}', ['uses' => 'CursoController@destroy', 'as' => 'destroy']);

        //Gerenciar
        Route::get('{id}/gerenciar', ['uses' => 'CursoController@gerenciar', 'as' => 'gerenciar']);

        //Estrutura curricular
        Route::get('{denominacao}/gerenciar/estrutura_curricular', ['uses' => 'Estrutura_curricularController@index_estrutura_curricular', 'as' => 'index_estrutura_curricular']);
        //disciplina
        Route::post('salvar/disciplina', ['uses' => 'Estrutura_curricularController@store_disciplina', 'as' => 'store_disciplina']);
        Route::get('editar/disciplina', ['uses' => 'Estrutura_curricularController@edit_disciplina', 'as' => 'edit_disciplina']);
        Route::patch('atualizar/disciplina/{id}', ['uses' => 'Estrutura_curricularController@update_disciplina', 'as' => 'update_disciplina']);
        Route::delete('remover/disciplina/{id}', ['uses' => 'Estrutura_curricularController@destroy_disciplina', 'as' => 'destroy_disciplina']);
        //componente
        Route::post('salvar/componente', ['uses' => 'Estrutura_curricularController@store_componente', 'as' => 'store_componente']);
        Route::get('editar/componente', ['uses' => 'Estrutura_curricularController@edit_componente', 'as' => 'edit_componente']);
        Route::patch('atualizar/componente/{id}', ['uses' => 'Estrutura_curricularController@update_componente', 'as' => 'update_componente']);
        Route::delete('remover/componente/{id}', ['uses' => 'Estrutura_curricularController@destroy_componente', 'as' => 'destroy_componente']);
        //Legislação
        Route::get('{id}/gerenciar/legislacao', ['uses' => 'Legislacao_cursoController@index']);
        Route::post('salvar/legislacao', ['uses' => 'Legislacao_cursoController@store_legislacao', 'as' => 'store_legislacao']);
        Route::delete('legislacao/{curso}', ['uses' => 'Legislacao_cursoController@destroy_legislacao', 'as' => 'destroy_legislacao']);
        //Corpo Docente
        Route::get('{curso}/gerenciar/corpo_docente', ['uses' => 'Corpo_docenteController@index_corpo_docente', 'as' => 'index_']);
        Route::post('salvar/corpo_docente', ['uses' => 'Corpo_docenteController@store_corpodocente', 'as' => 'store_corpodocente']);
        Route::delete('corpo_docente/{curso}', ['uses' => 'Corpo_docenteController@destroy_corpodocente', 'as' => 'destroy_corpodocente']);
        //Categoria
       // Route::get('{id}/gerenciar/categorias/editar', ['uses' => 'CategoriaController@edit']);
       // Route::get('{id}/gerenciar/categorias', ['uses' => 'CategoriaController@manageCategory']);
       // Route::get('{id}/gerenciar/categorias/save', ['uses' => 'CategoriaController@categorystore']);
       // Route::post('{salvar', ['uses' => 'CursoController@addconteudo', 'as' => 'addconteudo']);
       // Route::post('add-category', ['as' => 'add.category', 'uses' => 'CategoriaController@addCategory']);
        //Estrutura Documental
        Route::get('{curso}/gerenciar/estrutura_documental', ['uses' => 'DocumentoController@index', 'as' => 'index_documento']);
        Route::get('{id}/gerenciar/estrutura_documental/atualizar', ['uses' => 'DocumentoController@atualizaordem']);
        Route::post('salvar/documento', ['as' => 'add_documento', 'uses' => 'DocumentoController@store_documento']);
        Route::get('{curso}/gerenciar/estrutura_documental/{id}/editar', ['uses' => 'DocumentoController@edit_documento', 'as' => 'edit_documento']);
        Route::patch('{curso}/gerenciar/estrutura_documental/{id}/editar', ['uses' => 'DocumentoController@update_documento', 'as' => 'update_documento']);
        Route::get('{curso}/gerenciar/estrutura_documental/{id}/remover', ['as' => 'destroy_documento', 'uses' => 'DocumentoController@destroy_documento']);
        //Estrutura Subdocumental
        Route::get('{curso}/gerenciar/estrutura_documental/{documento}', ['uses' => 'SubdocumentoController@index', 'as' => 'index_subdocumento']);
        Route::post('salvar/subdocumento', ['uses' => 'SubdocumentoController@store_subdocumento', 'as' => 'store_subdocumento']);
        Route::get('{curso}/gerenciar/estrutura_documental/{documento}', ['uses' => 'SubdocumentoController@index', 'as' => 'index_subdocumento']);
        Route::get('editar/estrutura_documental', ['uses' => 'SubdocumentoController@edit_subdocumento', 'as' => 'edit_subdocumento']);
        Route::patch('atualizar/estrutura_documental/{id}', ['uses' => 'SubdocumentoController@update_subdocumento', 'as' => 'update_subdocumento']);
        Route::get('remover/estrutura_documental/{id}', ['uses' => 'SubdocumentoController@destroy_subdocumento', 'as' => 'destroy_subdocumento']);
        Route::post('salvar/descricao', ['uses' => 'SubdocumentoController@descricao_subdocumento', 'as' => 'descricao_subdocumento']);
        //Ementario(bibliografia)
        Route::get('{id}/gerenciar/estrutura_curricular/{iddisp}/ementario', ['uses' => 'EmentarioController@index_ementario', 'as' => 'index_ementario']);
        // Route::get('{id}/gerenciar/ementario/{disciplina}', ['uses' => 'EmentarioController@edit_ementario', 'as' => 'edit_ementario']);
        //Equipe Organizadora
        Route::get('{curso}/gerenciar/equipe_organizadora', ['uses' => 'Equipe_organizadoraController@index_organizadora', 'as' => 'index_organizadora']);
        Route::get('{curso}/gerenciar/equipe_organizadora/editar', ['uses' => 'Equipe_organizadoraController@edit_organizadora', 'as' => 'edit_organizadora']);
        Route::patch('{curso}', ['uses' => 'Equipe_organizadoraController@update_organizadora', 'as' => 'update_organizadora']);
        Route::delete('{curso}/gerenciar/equipe_organizadora/{id}/remover', ['uses' => 'Equipe_organizadoraController@destroy_organizadora', 'as' => 'destroy_organizadora']);
        Route::post('salvar', ['uses' => 'Equipe_organizadoraController@store_organizadora', 'as' => 'equipeorg.store_organizadora']);
        //Coordenação
        //Download/toolbar
        Route::get('{id}/gerenciar/download', ['uses' => 'GerarController@download', 'as' => 'download']);
    });// fim curso
    Route::group(['as' => 'bibliografia.', 'prefix' => 'bibliografia'], function () {
        Route::get('', ['uses' => 'BibliografiaController@index', 'as' => 'index']);
        Route::get('cadastrar', ['uses' => 'BibliografiaController@index', 'as' => 'index']);
        Route::get('{id}/editar', ['uses' => 'BibliografiaController@edit', 'as' => 'edit']);
        Route::post('salvar', ['uses' => 'BibliografiaController@store', 'as' => 'store']);
        Route::get('{id}', ['uses' => 'BibliografiaController@referencia', 'as' => 'referencia']);
        Route::patch('{id}', ['uses' => 'BibliografiaController@update', 'as' => 'update']);
        Route::delete('{id}', ['uses' => 'BibliografiaController@destroy', 'as' => 'delete']);
    });//fim bibliografia
    Route::group(['as' => 'disciplina.', 'prefix' => 'disciplina'], function () {
        Route::get('', ['uses' => 'DisciplinaController@index', 'as' => 'index']);
        Route::post('salvar', ['uses' => 'DisciplinaController@store', 'as' => 'store']);
        Route::get('{id}/editar', ['uses' => 'DisciplinaController@edit', 'as' => 'edit']);
        Route::patch('{id}', ['uses' => 'DisciplinaController@update', 'as' => 'update']);
        Route::delete('{id}', ['uses' => 'DisciplinaController@destroy', 'as' => 'destroy']);
    });//fim disciplina
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
        Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');
        // list all lfm routes here...
    });
});// fim middleware