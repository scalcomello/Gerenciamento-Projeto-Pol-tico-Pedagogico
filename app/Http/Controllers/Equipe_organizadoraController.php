<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;
use App\Equipe_organizadora as Equipeorg;
use Illuminate\Support\Facades\Redirect;
use App\Pessoa;

class Equipe_organizadoraController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_organizadora($denominacao)
    {


        $nomecurso = Curso::find($denominacao);
        $curso = $denominacao;


        $docente = Equipeorg::where('categoria', '=', 'docente')->get();
        $pedagogo = Equipeorg::where('categoria', '=', 'pedagogo')->get();
        $pessoas_nome = Pessoa::where('cargo', '=', 'professor')->pluck('nome', 'id');


        return view('cursos.equipeorganizadora')->with('docente', $docente)
            ->with('curso', $nomecurso)
            ->with('pessoas_nome', $pessoas_nome)
            ->with('pedagogo', $pedagogo);
    }

    public function store_organizadora(Request $request)
    {

        $getTable = new Equipeorg();
        $getTable->pessoas_id = $request->input('pessoas_id');
        $getTable->categoria = $request->input('categoria');
        $getTable->cursos_id = $request->input('cursos_id');
        $getTable->save();


        return back()->with('success', 'Cadastrado com sucesso.');
    }

    public function destroy_organizadora($curso,$id)
    {
        $remover = Equipeorg::findOrFail($id);
        $remover->delete();
        return back()->with('success', 'Removido com sucesso.');
    }

    public function edit_organizadora($id)
    {
        $edit = Equipeorg::findOrFail($id);

        $pessoas_nome = Pessoa::where('cargo', '=', 'professor')->pluck('nome', 'id');
        $docente = Equipeorg::where('categoria', '=', 'docente')->with('pessoa')->get();
        $pedagogo = Equipeorg::where('categoria', '=', 'pedagogo')->with('pessoa')->get();

        return view('cursos.equipeorganizadora')->with('docente', $docente)
            ->with('pedagogo', $pedagogo)
            ->with('pessoas_nome', $pessoas_nome)
            ->with('edit', $edit);
    }

    function update_organizadora($id, Request $request)
    {

        $getTable = Equipeorg::find($id);
        $getTable->pessoas_id = $request->input('pessoas_id');
        $getTable->categoria = $request->input('categoria');
        $getTable->save();

        return Redirect::to('cursos.equipe_organizadora');
    }

    public function rel_equipeorganizadora($docx)
    {
        $docx->setTemplateSymbol('@');

        $query = Equipeorg::where('categoria', '=', 'docente')->with('pessoa')->get();
        $query4 = Equipeorg::where('categoria', '=', 'pedagogo')->with('pessoa')->get();

        foreach($query as $valor):
            $docente[] = $valor->pessoa->nome;
        endforeach;

        foreach($query4 as $valor):
            $pedagogo[] =  $valor->pessoa->nome;

        endforeach;

        $docent = implode('\n',$docente);
        $pedagog = implode('\n',$pedagogo);


        $var3 = array('DOCENTE' => $docent, 'PEDAGOGO' => $pedagog);

        $option = array('parseLineBreaks' => true);
        $docx->replaceVariableByText($var3,$option);

    }

}
