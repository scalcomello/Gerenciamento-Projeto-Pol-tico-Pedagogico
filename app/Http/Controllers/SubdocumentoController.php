<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Documento;
use App\Subdocumento;
use Illuminate\Http\Request;

class SubdocumentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($curso,$documento)
    {

        $nomecurso = Curso::find($curso);
        $titulo = Documento::find($documento);

        $subdocumento = Subdocumento::where('documentos_id', '=', $documento)
            ->where('status', '=', 'true')
            ->orderBy('subordem','ASC')->get();

        return view('cursos.subdocumento')
            ->with('titulo', $titulo)
            ->with('nomecurso', $nomecurso)
            ->with('subdocumento', $subdocumento);


    }

    public function store_subdocumento(Request $request)
    {
        $validator = validator($request->all(), [

            'subtitulo' => 'required',

        ]);
        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $getTable = new Subdocumento();
        $getTable->subtitulo = $request->input('subtitulo');
        $getTable->documentos_id = $request->input('documentos_id');
        $getTable->subordem = $request->input('subordem');
        $getTable->status = 'true';

        $getTable->save();

        return back()->with('success', 'Novo titulo adicionado com sucesso.');
    }

    public function edit_subdocumento($id, Request $request)
    {
        $subdoc = Subdocumento::findOrFail($id);

        return view('cursos.subdocumento', ['componente' => $subdoc]);
    }

    public function update_subdocumento($id, Request $request)
    {

        $getTable = Subdocumento::find($id);
        $getTable->subtitulo = $request->input('subtitulo');
        $getTable->save();

        return back();
    }

    public function destroy_subdocumento($id)
    {

        $getTable = Subdocumento::findOrFail($id);
        $getTable->status = 'false';
        $getTable->save();
        //$remover->delete();
        return back()->with('success', 'Removido com sucesso!');
    }

    public function descricao_subdocumento(Request $request){

        $id = $request->input('id');
        $getTable = Subdocumento::findOrFail($id);
        $getTable->descricao = $request->input('descricao');
        $getTable->documentos_id = $request->input('documentos_id');
        $getTable->save();
        \Session::flash('mensagem_sucesso', 'Salvo com sucesso!');
        return back();

    }

}
