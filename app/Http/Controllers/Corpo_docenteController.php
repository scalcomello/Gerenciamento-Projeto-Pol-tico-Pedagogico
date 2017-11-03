<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use App\Corpo_docente;

class Corpo_docenteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($curso)
    {
         $corpodocente = Corpo_docente::select('id','pessoas_id')->with('pessoa')->get();
        $pessoas_nome = Pessoa::where('cargo', '=', 'professor')->pluck('nome', 'id');


        return view('cursos.corpo_docente') ->with('curso', $curso)
            ->with('corpodocente', $corpodocente)
            ->with('pessoas_nome', $pessoas_nome);


    }

    public function store_corpodocente(Request $request){

        $getTable = new Corpo_docente();
        $getTable->pessoas_id = $request->input('pessoas_id');
        $getTable->cursos_id = $request->input('cursos_id');
        $getTable->save();
        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return back();
    }

    public function destroy_corpodocente($id){
        $remover = Corpo_docente::findOrFail($id);

        $remover->delete();
        \Session::flash('mensagem_sucesso', 'Cadastro removido com sucesso!');
        return back();
    }

    public function rel_corpodocente($id,$docx){

        $docx->setTemplateSymbol('@');

        $corpo_docente = Corpo_docente::select('pessoas_id')->
        where('cursos_id', '=', $id)
            ->with('pessoa')->get();

        foreach ($corpo_docente as $rows) {

            $prof['PROFESSOR'] = $rows->pessoa->nome;
            $titulacao ['TITULACAO'] = $rows->pessoa->titulo;
            $regimtrab['REGIMTRAB'] = $rows->regimtrab;
            $result[] = array_merge($prof, $titulacao,$regimtrab);
        }

        $docx->replaceTableVariable($result, array('parseLineBreaks' => true));
    }



}
