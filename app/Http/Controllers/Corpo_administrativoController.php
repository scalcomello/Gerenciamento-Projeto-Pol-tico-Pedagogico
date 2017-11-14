<?php

namespace App\Http\Controllers;

use App\Corpo_administrativo;
use App\Curso;
use Illuminate\Http\Request;
use App\Pessoa;

class Corpo_administrativoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_corpo_administrativo($curso)
    {

        $corpoadministrativo = Corpo_administrativo::select('id','pessoas_id')->with('pessoa')->get();
        $curso = Curso::find($curso);
        $pessoas_nome = Pessoa::where('cargo', '=', 'professor')->pluck('nome', 'id');

        return view('cursos.corpo_administrativo')
            ->with('corpoadministrativo', $corpoadministrativo)
            ->with('pessoas_nome', $pessoas_nome)
            ->with('curso', $curso);

    }

    public function store_administrativo(Request $request){

        $getTable = new Corpo_administrativo();
        $getTable->pessoas_id = $request->input('pessoas_id');
        $getTable->cursos_id = $request->input('cursos_id');
        $getTable->save();
        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return back();
    }

    public function destroy_administrativo($id){
        $remover = Corpo_administrativo::findOrFail($id);

        $remover->delete();
        \Session::flash('mensagem_destroy', 'Cadastro removido com sucesso!');
        return back();
    }

    public function rel_administrativo($id,$docx){

        $docx->setTemplateSymbol('@');

        $corpo_administrativo = Corpo_administrativo::select('pessoas_id')
            ->with('pessoa')->get();

        foreach ($corpo_administrativo as $rows) {

            $servidor['SERVIDOR'] = $rows->pessoa->nome;
            $cargo['CARGO'] = $rows->pessoa->titulo;
            $regime['REGIME'] = $rows->regimtrab;
            $resultado[] = array_merge($servidor, $cargo,$regime);
        }

        $docx->replaceTableVariable($resultado, array('parseLineBreaks' => true));
    }
}
